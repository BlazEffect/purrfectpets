<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderProducts extends Model
{
    protected $fillable = [
        'product_id',
        'count',
        'price'
    ];

    public $timestamps = false;

    protected $primaryKey = 'product_id';
}
