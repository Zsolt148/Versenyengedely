<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Competitor extends Model
{
    use HasFactory;

    protected $fillable = [
        'is_registered',
        'federal_reg_code',
        'team_reg_code',
        'name',
        'birth',
        'teams_id',
    ];

    public function team() {
        return $this->belongsTo(Team::class, 'teams_id');
    }

    public function isRegistered() {
        return $this->is_registered;
    }
}
