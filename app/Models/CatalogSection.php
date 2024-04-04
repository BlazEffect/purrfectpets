<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CatalogSection extends Model
{
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(CatalogProduct::class, 'catalog_sections_products', 'section_id', 'product_id');
    }

    public function childSections(): HasMany
    {
        return $this->hasMany(__CLASS__, 'parent_id', 'id');
    }

    public function scopeActive(Builder $query): void
    {
        $query->where('active', 1);
    }
}
