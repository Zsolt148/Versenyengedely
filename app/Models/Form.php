<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class Form extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];
    //TODO activity log
    //protected static $logAttributes = ['name', 'text'];
    //protected static $ignoreChangedAttributes = ['updated_at'];
    //protected static $logOnlyDirty = true;


    protected $casts = [
        'birth' => 'datetime:Y-m-d',
        'sport_time' => 'datetime:Y-m-d',
        'sport_valid' => 'datetime:Y-m-d',
        'turn_in' => 'datetime:Y-m-d H:i:s',
        'processed' => 'datetime:Y-m-d H:i:s',
        'president' => 'datetime:Y-m-d H:i:s',
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

    public function payment() {
        return $this->belongsTo(Payment::class, 'payment_id');
    }

    protected function serializeDate(\DateTimeInterface $date)
    {
        return $date->format('Y-m-d');
    }

    const STATUS = [
        'saved' => '<span class="inline-block rounded-full bg-white dark:bg-gray-200 text-gray-800 px-2 py-1 text-xs border border-black dark:border-white font-bold">Mentve</span>',
        'pending' => '<span class="inline-block rounded-full bg-yellow-300 text-yellow-800 px-2 py-1 text-xs font-bold">Feldolgozás alatt</span>',
        'accepted' => '<span class="inline-block rounded-full bg-green-300 text-green-800 px-2 py-1 text-xs font-bold">Elfogadva</span>',
        'denied' => '<span class="inline-block rounded-full bg-red-300 text-red-800 px-2 py-1 text-xs font-bold">Elutasítva</span>'
    ];

    const STATUS_LABEL = [
        'saved' => 'Mentve',
        'pending' => 'Feldolgozás alatt',
        'accepted' => 'Elfogadva',
        'denied' => 'Elutasítva',
    ];

    const PAYMENT = [
        'pending' => '<span class="inline-block rounded-full bg-yellow-300 text-yellow-800 px-2 py-1 text-xs font-bold">Folyamatban</span>',
        'done' => '<span class="inline-block rounded-full bg-green-300 text-green-800 px-2 py-1 text-xs font-bold">Fizetve</span>',
        'none' => '<span class="inline-block rounded-full bg-red-300 text-red-800 px-2 py-1 text-xs font-bold">Nincs</span>'
    ];

    const PAYMENT_LABEL = [
        'pending' => 'Feldolgozás alatt',
        'done' => 'Fizetve',
        'none' => 'Nincs',
    ];

    const YEARS = [
      '2021' => '2021',
    ];
}
