<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'price'
    ];

    public function products(): HasMany
    {
        return $this->hasMany(OrderProducts::class);
    }

    public function properties(): HasOne
    {
        return $this->hasOne(OrderProperty::class);
    }
}
