<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CatalogProduct extends Model
{
    public function sections(): BelongsToMany
    {
        return $this->belongsToMany(
            CatalogSection::class,
            'catalog_sections_products',
            'product_id',
            'section_id'
        );
    }

    public function scopeActive(Builder $query): void
    {
        $query->where('active', 1);
    }
}
