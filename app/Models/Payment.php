<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function user() {
        return $this->belongsTo(User::class, 'users_id');
    }

    public function forms() {
        return $this->belongsToMany(Form::class, 'form_has_payments', 'payment_id', 'form_id');
    }
}
