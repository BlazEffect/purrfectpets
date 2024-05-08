<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    protected $fillable = [
        'user_id',
        'first_name',
        'surname',
        'last_name',
        'phone',
    ];

    public $timestamps = false;

    protected $primaryKey = 'user_id';
}
