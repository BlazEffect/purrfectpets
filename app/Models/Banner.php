<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $casts = [
        'active' => 'boolean'
    ];

    public function scopeActive(Builder $query): void
    {
        $query->where('active', true);
    }
}
