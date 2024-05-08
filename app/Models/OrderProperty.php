<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderProperty extends Model
{
    protected $fillable = [
        'FIO',
        'email',
        'phone',
        'address',
        'comment'
    ];

    public $timestamps = false;

    protected $primaryKey = 'order_id';
}
