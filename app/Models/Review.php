<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    public function scopeModerated($builder)
    {
        return $builder->where('status', 1);
    }
}
