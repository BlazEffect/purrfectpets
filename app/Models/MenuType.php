<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MenuType extends Model
{
    protected $casts = [
        'active' => 'boolean',
    ];

    public function items(): HasMany
    {
        return $this->hasMany(MenuItem::class)->where('parent_id', null);
    }

    public function scopeActive(Builder $query): void
    {
        $query->where('active', true);
    }
}
