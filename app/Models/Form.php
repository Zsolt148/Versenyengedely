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

    //protected $appends = ['full_name'];

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

    public function getFullNameAttribute()
    {
        return "{$this->title} {$this->vnev} {$this->knev}";
    }

    const STATUS_SAVED              = 'saved';
    const STATUS_PENDING            = 'pending';
    const STATUS_ACCEPTED           = 'accepted';
    const STATUS_DENIED             = 'denied';
    const STATUS_EXPIRED_FORM       = 'expired_form';
    const STATUS_EXPIRED_SPORT      = 'expired_sport';

    const STATUS = [
        self::STATUS_SAVED          => '<span class="rounded-full bg-white dark:bg-gray-200 text-gray-800 px-2 py-1 text-xs border border-black dark:border-white font-bold">Mentve</span>',
        self::STATUS_PENDING        => '<span class="rounded-full bg-yellow-300 text-yellow-800 px-2 py-1 text-xs font-bold">Feldolgoz??s alatt</span>',
        self::STATUS_ACCEPTED       => '<span class="rounded-full bg-green-300 text-green-800 px-2 py-1 text-xs font-bold">Elfogadva</span>',
        self::STATUS_DENIED         => '<span class="rounded-full bg-red-300 text-red-800 px-2 py-1 text-xs font-bold">Elutas??tva</span>',
        self::STATUS_EXPIRED_FORM   => '<span class="rounded-full bg-indigo-300 text-indigo-800 px-2 py-1 text-xs font-bold">Lej??rt k??rv??ny</span>',
        self::STATUS_EXPIRED_SPORT  => '<span class="rounded-full bg-indigo-300 text-indigo-800 px-2 py-1 text-xs font-bold">Lej??rt sportorvosi</span>',
    ];

    const STATUS_LABEL = [
        self::STATUS_SAVED          => 'Mentve',
        self::STATUS_PENDING        => 'Feldolgoz??s alatt',
        self::STATUS_ACCEPTED       => 'Elfogadva',
        self::STATUS_DENIED         => 'Elutas??tva',
        self::STATUS_EXPIRED_FORM   => 'Lej??rt k??rv??ny',
        self::STATUS_EXPIRED_SPORT  => 'Lej??rt sportorvosi',
    ];

    const PAYMENT_PENDING = 'pending';
    const PAYMENT_DONE = 'done';

    const PAYMENT = [
        self::PAYMENT_PENDING   => '<span class="rounded-full bg-yellow-300 text-yellow-800 px-2 py-1 text-xs font-bold">Folyamatban</span>',
        self::PAYMENT_DONE      => '<span class="rounded-full bg-green-300 text-green-800 px-2 py-1 text-xs font-bold">Fizetve</span>',
        null                    => '<span class="rounded-full bg-red-300 text-red-800 px-2 py-1 text-xs font-bold">Nincs</span>'
    ];

    const PAYMENT_LABEL = [
        self::PAYMENT_PENDING   => 'Feldolgoz??s alatt',
        self::PAYMENT_DONE      => 'Fizetve',
        null                    => 'Nincs',
    ];

    const YEARS = [
      '2022' => '2022', //TODO
      '2021' => '2021',
    ];

    const COLORS = [
        'created' => 'bg-green-300 dark:bg-green-700 text-green-800 dark:text-green-100',
        'updated' => 'bg-blue-300 dark:bg-blue-700 text-blue-800 dark:text-blue-100',
        'deleted' => 'bg-red-300 dark:bg-red-700 text-red-800 dark:text-red-100',
    ];

    const LOG_LABEL = [
        'created' => 'L??trehozva',
        'updated' => 'Szerkesztve',
        'deleted' => 'T??r??lve',
    ];

    const LOGS = [
      'id' => '#ID',
      'users_id' => 'L??trehozta',
      'teams_id' => 'Egyes??let',
      'competitors_id' => 'Sportol??',
      'processed_by' => 'Feldolgozta',
      'title' => 'El??n??v',
      'vnev' => 'Vezet??kn??v',
      'knev' => 'Keresztn??v',
      'birth' => 'Sz??let??si d??tum',
      'birth_place' => 'Sz??let??si hely',
      'sex' => 'Nem',
      'mother' => 'Anyja',
      'zip' => 'Ir??ny??t??sz??m',
      'city' => 'V??ros',
      'address' => 'C??m',
      'mobile' => 'Telefon',
      'email' => 'Email',
      'team_reg_code' => 'Egyes??leti regisztr??ci??s k??d',
      'federal_reg_code' => 'Sz??vets??gi regisztr??ci??s k??d',
      'privacy_policy' => 'Felhaszn??l??si felt??telek',
      'sport_time' => 'Sportorvosi id??pontja',
      'can_race' => 'Sportorvosi eredm??nye',
      'sport_valid' => 'Sportorvosi ??rv??nyess??ge',
      'year' => '??v',
      'status' => '??llapot',
      'payment' => 'Fizet??s ??llapota',
      'deny' => 'Elutas??t??s indoka',
      'turn_in' => 'Beny??jtotta',
      'processed' => 'Feldolgozva',
      'form_valid' => 'K??rv??ny ??rv??nyess??ge',
      'profile_photo' => 'Profilk??p',
      'data_sheet' => 'Adatlap',
      'sport_sheet' => 'Sportorvosi',
      'license' => 'Enged??ly',
      'deleted_at' => 'T??r??lve',
      'created_at' => 'L??trehozva',
      'updated_at' => 'Friss??tve',
    ];
}
