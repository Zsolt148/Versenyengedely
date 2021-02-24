<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'type', // user - organizer - coach - admin - super
        'wannabe',
        'mandate',
        'teams_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function forms() {
        return $this->hasMany(Form::class, 'users_id');
    }

    public function team() {
        return $this->belongsTo(Team::class, 'teams_id');
    }

    public function competitors() {
        return $this->hasMany(Competitor::class, 'teams_id', 'teams_id');
    }

    public function address() {
        return $this->hasOne(Address::class, 'teams_id', 'teams_id');
    }

    public function payments() {
        return $this->hasMany(Payment::class, 'users_id');
    }

    const TYPES = [
        'user' => 'Felhasználó',
        'organizer' => 'Rendező',
        'coach' => 'Csapatvezető',
        'admin' => 'Admin',
        'super' => 'Super',
    ];
}
