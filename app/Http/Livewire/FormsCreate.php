<?php

namespace App\Http\Livewire;

use App\Models\Form;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class FormsCreate extends Component
{
    use WithFileUploads;

    //public $comp_type, $competitors_id, $vnev, $knev, $title, $birth, $birth_place, $sex, $mother, $zip, $address, $mobile, $email;
    //public $team_reg_code, $federal_reg_code, $privacy, $data_sheet, $sport_sheet, $profile_photo;
    //public $he_can_race = false, $can_race, $sport_time, $sport_valid;
    public $form;
    public $profile_photo, $data_sheet, $sport_sheet;
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
            'profile_photo' => 'nullable|mimes:pdf,jpg,png',
            'data_sheet' => 'nullable|mimes:pdf,jpg,png',
            'sport_sheet' => 'nullable|mimes:pdf,jpg,png',
        ]);

        $this->form = Form::updateOrCreate(
            [
                //'users_id' => request()->user()->id,
                'teams_id' => request()->user()->teams_id,
                'competitors_id' => $this->form['competitors_id'],
                'year' => now()->format('Y'),
                'status' => 'saved',
                'payment' => 'none',
            ],
            [
                'users_id' => request()->user()->id,
                //'comp_type' => $this->form['comp_type'] ?? null,
                //personal
                'title' => $this->form['title'] ?? null,
                'vnev' => $this->form['vnev'] ?? null,
                'knev' => $this->form['knev'] ?? null,
                'birth' => $this->form['birth'] ?? null,
                'birth_place' => $this->form['birth_place'] ?? null,
                'sex' => $this->form['sex'] ?? null,
                'mother' => $this->form['mother'] ?? null,
                'zip' => $this->form['zip'] ?? null,
                'city' => $this->form['city'] ?? null,
                'address' => $this->form['address'] ?? null,
                'mobile' => $this->form['mobile'] ?? null,
                'email' => $this->form['email'] ?? null,
                'team_reg_code' => $this->form['team_reg_code'] ?? null,
                'federal_reg_code' => $this->form['federal_reg_code'] ?? null,
                'privacy_policy' => $this->form['privacy_policy'] ?? null,
                //sport
                'sport_time' => $this->form['sport_time'] ?? null,
                'can_race' => $this->form['can_race'] ?? null,
                'sport_valid' => $this->form['sport_valid'] ?? null,
            ]
        );
        //File overwrites
        $this->process_file($this->form, 'profile_photo');
        $this->process_file($this->form, 'data_sheet');
        $this->process_file($this->form, 'sport_sheet');

        $this->emit('saved');
    }

    //finalization method
    public function final() {
        //save method
        $this->save();

        //validation
        $this->validate();
        if($this->validate_files()) return; //break if one file missing


        $this->form->status = 'pending';
        $this->form->turn_in = now()->format('Y-m-d H:i:s');
        $this->form->save();

        $this->reset();
        return redirect()->route('coach.forms.index');
    }

    //file processing
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
            $this->iteration++;
        }
        return;
    }

    public function changedComp() {
        $this->resetValidation();
        //teams_id - competitors_id - status-saved - payment-pending CHECK
        $query = Form::where([['teams_id', '=', request()->user()->teams_id], ['competitors_id', '=', $this->form['competitors_id']], ['status', '=', 'saved'], ['payment', '=', 'none']]);
        if($query->exists()) {
            $this->form = $query->first();
            $this->null_file_uploads();
        }else {
            $comp_id = $this->form['competitors_id'];
            $this->form = null;
            $this->form['competitors_id'] = $comp_id;
            $this->null_file_uploads();
        }
    }

    public function validate_files() {
        $error = false;
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

    public function null_file_uploads() { //nulling files
        $this->iteration++;
    }

    public function render()
    {
        if(request()->id) { //ha van ID az URL be
            $this->form = Form::find(request()->id);
            if (request()->user()->cannot('update', $this->form)) { //policy ha nem a team e akkor nem tudja
                abort(403);
            }
            $this->resetValidation();
            $this->null_file_uploads();
            //$this->changedComp();
        }
        if (request()->user()->cannot('create', Form::class)) {
            abort(403);
        }
        return view('livewire.forms-create');
    }
}
