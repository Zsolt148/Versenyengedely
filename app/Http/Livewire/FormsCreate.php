<?php

namespace App\Http\Livewire;

use App\Models\Competitor;
use App\Models\Form;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Spatie\Activitylog\Models\Activity;

class FormsCreate extends Component
{
    use WithFileUploads;

    //public $comp_type, $competitors_id, $vnev, $knev, $title, $birth, $birth_place, $sex, $mother, $zip, $address, $mobile, $email;
    //public $team_reg_code, $federal_reg_code, $privacy, $data_sheet, $sport_sheet, $profile_photo;
    //public $he_can_race = false, $can_race, $sport_time, $sport_valid;
    public $form;
    public $profile_photo, $data_sheet, $sport_sheet, $logs;
    public $iteration = 0;

    protected $rules = [
        //'form.comp_type' => 'required',
        'form.competitors_id' => 'required',
        'form.title' => 'nullable',
        'form.vnev' => 'required',
        'form.knev' => 'required',
        'form.birth' => 'required|date',
        'form.birth_place' => 'required',
        'form.sex' => 'required',
        'form.mother' => 'required',
        'form.zip' => 'required|integer',
        'form.city' => 'required',
        'form.address' => 'required',
        'form.mobile' => 'required',
        'form.email' => 'required',
        'form.team_reg_code' => 'nullable',
        'form.federal_reg_code' => 'required',
        'form.privacy_policy' => 'required|min:1',
        'form.sport_time' => 'required',
        'form.can_race' => 'required',
        'form.sport_valid' => 'required',
    ];


    public function save() {

        $this->validateOnly('form.competitors_id');
        $this->validate([
            'profile_photo' => 'nullable|mimes:pdf,jpg,png|max:5120',
            'data_sheet' => 'nullable|mimes:pdf,jpg,png|max:5120',
            'sport_sheet' => 'nullable|mimes:pdf,jpg,png|max:5120',
        ]);

        $comp = Competitor::findOrFail($this->form['competitors_id']);

        if($this->validateCompetitor($comp)) return;

        $form = Form::firstOrNew([
            'teams_id' => request()->user()->teams_id,
            'competitors_id' => $comp->id,
        ]);

        $form->users_id = request()->user()->id;
        $form->year = now()->format('Y');

        if($form && $form->status == Form::STATUS_EXPIRED_FORM) {
            $form->status = Form::STATUS_SAVED;
        }else {
            $form->status = $this->form['status'] ?? Form::STATUS_SAVED;
        }

        //personal
        $form->title = $this->form['title'] ?? null;
        $form->vnev = $this->form['vnev'] ?? null;
        $form->knev = $this->form['knev'] ?? null;
        $form->birth = $this->form['birth'] ?? null;
        $form->birth_place = $this->form['birth_place'] ?? null;
        $form->sex = $this->form['sex'] ?? null;
        $form->mother = $this->form['mother'] ?? null;
        $form->zip = $this->form['zip'] ?? null;
        $form->city = $this->form['city'] ?? null;
        $form->address = $this->form['address'] ?? null;
        $form->mobile = $this->form['mobile'] ?? null;
        $form->email = $this->form['email'] ?? null;
        $form->team_reg_code = $this->form['team_reg_code'] ?? null;
        $form->federal_reg_code = $this->form['federal_reg_code'] ?? null;
        $form->privacy_policy = $this->form['privacy_policy'] ?? null;
        //sport
        $form->sport_time = $this->form['sport_time'] ?? null;
        $form->can_race = $this->form['can_race'] ?? null;
        $form->sport_valid = $this->form['sport_valid'] ?? null;

        $form->save();

        $this->form = $form;

        //File overwrites
        $this->process_file($this->form, 'profile_photo');
        $this->process_file($this->form, 'data_sheet');
        $this->process_file($this->form, 'sport_sheet');

        $this->emit('saved');
    }

    /**
     * finalization method
     * @return \Illuminate\Http\RedirectResponse|void
     */
    public function final() {
        //save method
        $this->save();

        //validation
        $this->validate();
        if($this->validateFiles()) return; //break if one file missing
        if($this->validateCompetitor(Competitor::findOrFail($this->form['competitors_id']))) return;

        $this->form->status = Form::STATUS_PENDING;
        $this->form->deny = null;
        $this->form->turn_in = now()->format('Y-m-d H:i:s');
        $this->form->save();

        $this->reset();

        return redirect()->route('coach.forms.index');
    }

    /**
     * sport update
     * @return \Illuminate\Http\RedirectResponse|void
     */
    public function saveSport() {
        $this->process_file($this->form, 'sport_sheet');

        $this->validate();
        if($this->validateFiles()) return; //break if one file missing

        $this->form->sport_time = $this->form['sport_time'];
        $this->form->can_race = $this->form['can_race']; //TODO check if can race
        $this->form->sport_valid = $this->form['sport_valid'];
        $this->form->status = Form::STATUS_ACCEPTED;
        $this->form->save();

        $this->reset();
        return redirect()->route('coach.forms.index');
    }

    /**
     * file processing
     * @param $form
     * @param $file
     */
    public function process_file($form, $file) {
        //dd($this->$file, $this->$file->isValid());
        if($this->$file && $this->$file->isValid()) { //ha feltolt
            if($form->$file) { //ha van mar feltoltve a formba
                Storage::disk('public')->delete($form->$file); //regi falj torlese
            }
            $return = str_replace("public/", "", $this->$file->store('public')); //uj file
            $form->$file = $return;
            $form->save();
            $this->form->$file = $return;

            $this->$file = null;
            $this->nullFileUploads();
        }
        return;
    }

    public function changedComp() {

        $this->resetValidation();

        if($comp = Competitor::find($this->form['competitors_id'])) {

            //Ha megnyithato a form szerkesztesre akkor be tolti
            $query = Form::query()
                ->where('teams_id', '=', request()->user()->teams_id)
                ->where('competitors_id', '=', $comp->id)
                ->whereIn('status', [Form::STATUS_SAVED, Form::STATUS_DENIED, Form::STATUS_EXPIRED_FORM, Form::STATUS_EXPIRED_SPORT]);

            if($query->exists()) {
                $this->form = $query->first();
                $this->nullFileUploads();
            }else {
                $this->form = null;
                $this->form['competitors_id'] = $comp->id;
                $this->form['status'] = Form::STATUS_SAVED;
                $this->nullFileUploads();
            }

            if($this->validateCompetitor($comp)) return;
        }

    }

    /**
     * @param Competitor $competitor
     * @return bool
     */
    private function validateCompetitor(Competitor $competitor) {
        $error = false;

        if(!$competitor->isRegistered()) {
            $this->addError('form.competitors_id', 'Még nincs fizetve vagy regisztrálva a sportoló');
            $error = true;
        }

        if(Carbon::createFromFormat('Y', $competitor->birth)->diffInYears(Carbon::now()) < 25) {
            $this->addError('form.competitors_id', 'Nem lehet 25 év alatti a sportoló!');
            $error = true;
        }

        return $error;
    }

    /**
     * @return bool
     */
    private function validateFiles() {
        $error = false;
        //ha barmelyik error igaz akkor failed
        if($this->form->profile_photo == null) {
            $this->addError('profile_photo', 'A profilkép feltöltése kötelező!');
            $error = true;
        }
        if($this->form->data_sheet == null) {
            $this->addError('data_sheet', 'Az adatlap feltöltése kötelező!');
            $error = true;
        }
        if($this->form->sport_sheet == null) {
            $this->addError('sport_sheet', 'A sportorvosi igazolás feltöltése kötelező!');
            $error = true;
        }
        return $error;
    }

    private function nullFileUploads() { //nulling files
        $this->iteration++;
    }

    public function render()
    {
        //ha van ID az URL be
        if($id = request()->id) {
            $this->form = Form::find($id);
            //policy ha nem a felhaszáló egyesületé akkor
            abort_if(request()->user()->cannot('update', $this->form), 403);

            $this->resetValidation();
            $this->nullFileUploads();
        }

        $this->logs = null;

        if($this->form instanceof \Illuminate\Database\Eloquent\Model) {
            $this->logs = Activity::query()
                ->where('log_name', 'Form')
                ->where('subject_id', $this->form->id)
                ->orderBy('created_at', 'DESC')
                ->orderBy('id', 'DESC')
                ->get();
        }

        //ha nem csapatvezeto akkor abort
        abort_if(request()->user()->cannot('create', Form::class), 403);

        return view('livewire.forms-create');
    }
}
