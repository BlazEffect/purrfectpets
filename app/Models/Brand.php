<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Brand extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'active',
        'order'
    ];

    protected $casts = [
        'active' => 'boolean'
    ];

    public function products(): HasMany
    {
        return $this->hasMany(CatalogProduct::class);
    }

    public function scopeActive(Builder $query): void
    {
        $query->where('active', true);
    }
}
