<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class Form extends Model
{
    use HasFactory, SoftDeletes, LogsActivity;

    protected $guarded = [];

    protected static $ignoreChangedAttributes = ['updated_at'];
    protected static $logName = 'Form';
    protected static $logUnguarded = true;
    protected static $logOnlyDirty = true;
    protected static $submitEmptyLogs = false;


    protected $casts = [
        'birth' => 'datetime:Y-m-d',
        'sport_time' => 'datetime:Y-m-d',
        'sport_valid' => 'datetime:Y-m-d',
        'turn_in' => 'datetime:Y-m-d H:i:s',
        'processed' => 'datetime:Y-m-d H:i:s',
        'form_valid' => 'datetime:Y-m-d',
        'privacy_policy' => 'boolean',
        'can_race' => 'boolean',
    ];

    public function user() {
        return $this->belongsTo(User::class, 'users_id');
    }

    public function processedBy() {
        return $this->belongsTo(User::class, 'processed_by');
    }

    public function competitor() {
        return $this->belongsTo(Competitor::class, 'competitors_id');
    }

    public function team() {
        return $this->belongsTo(Team::class, 'teams_id');
    }

    public function payments() {
        return $this->belongsToMany(Payment::class, 'form_has_payments', 'form_id', 'payment_id');
    }

    protected function serializeDate(\DateTimeInterface $date)
    {
        return $date->format('Y-m-d');
    }

    const STATUS = [
        'saved' => '<span class="rounded-full bg-white dark:bg-gray-200 text-gray-800 px-2 py-1 text-xs border border-black dark:border-white font-bold">Mentve</span>',
        'pending' => '<span class="rounded-full bg-yellow-300 text-yellow-800 px-2 py-1 text-xs font-bold">Feldolgozás alatt</span>',
        'accepted' => '<span class="rounded-full bg-green-300 text-green-800 px-2 py-1 text-xs font-bold">Elfogadva</span>',
        'denied' => '<span class="rounded-full bg-red-300 text-red-800 px-2 py-1 text-xs font-bold">Elutasítva</span>',
        'expired_form' => '<span class="rounded-full bg-indigo-300 text-indigo-800 px-2 py-1 text-xs font-bold">Lejárt kérvény</span>',
        'expired_sport' => '<span class="rounded-full bg-indigo-300 text-indigo-800 px-2 py-1 text-xs font-bold">Lejárt sportorvosi</span>',
    ];

    const STATUS_LABEL = [
        'saved' => 'Mentve',
        'pending' => 'Feldolgozás alatt',
        'accepted' => 'Elfogadva',
        'denied' => 'Elutasítva',
        'expired_form' => 'Lejárt kérvény',
        'expired_sport' => 'Lejárt sportorvosi',
    ];

    const PAYMENT = [
        'pending' => '<span class="rounded-full bg-yellow-300 text-yellow-800 px-2 py-1 text-xs font-bold">Folyamatban</span>',
        'done' => '<span class="rounded-full bg-green-300 text-green-800 px-2 py-1 text-xs font-bold">Fizetve</span>',
        null => '<span class="rounded-full bg-red-300 text-red-800 px-2 py-1 text-xs font-bold">Nincs</span>'
    ];

    const PAYMENT_LABEL = [
        'pending' => 'Feldolgozás alatt',
        'done' => 'Fizetve',
        null => 'Nincs',
    ];

    const YEARS = [
      '2021' => '2021',
    ];

    const LOG_LABEL = [
      'created' => '<span class="text-green-500 font-bold">Létrehozva</span>',
      'updated' => '<span class="text-indigo-500 font-bold">Szerkesztve</span>',
      'deleted' => '<span class="text-red-500 font-bold">Törölve</span>',
    ];

    const LOGS = [
      'id' => '#ID',
      'users_id' => 'Létrehozta',
      'teams_id' => 'Egyesület',
      'competitors_id' => 'Sportoló',
      'processed_by' => 'Feldolgozta',
      'title' => 'Előnév',
      'vnev' => 'Vezetéknév',
      'knev' => 'Keresztnév',
      'birth' => 'Születési dátum',
      'birth_place' => 'Születési hely',
      'sex' => 'Nem',
      'mother' => 'Anyja',
      'zip' => 'Irányítószám',
      'city' => 'Város',
      'address' => 'Cím',
      'mobile' => 'Telefon',
      'email' => 'Email',
      'team_reg_code' => 'Egyesületi regisztrációs kód',
      'federal_reg_code' => 'Szövetségi regisztrációs kód',
      'privacy_policy' => 'Felhasználási feltételek',
      'sport_time' => 'Sportorvosi időpontja',
      'can_race' => 'Sportorvosi eredménye',
      'sport_valid' => 'Sportorvosi érvényessége',
      'year' => 'Év',
      'status' => 'Állapot',
      'payment' => 'Fizetés állapota',
      'deny' => 'Elutasítás indoka',
      'turn_in' => 'Benyújtotta',
      'processed' => 'Feldolgozva',
      'form_valid' => 'Kérvény érvényessége',
      'profile_photo' => 'Profilkép',
      'data_sheet' => 'Adatlap',
      'sport_sheet' => 'Sportorvosi',
      'license' => 'Engedély',
      'deleted_at' => 'Törölve',
      'created_at' => 'Létrehozva',
      'updated_at' => 'Frissítve',
    ];
}
