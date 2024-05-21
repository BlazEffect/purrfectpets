<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CatalogProduct extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'brand_id',
        'image',
        'price',
        'quantity',
        'active',
        'order'
    ];

    protected $casts = [
        'active' => 'boolean',
        'image' => 'array'
    ];

    public function sections(): BelongsToMany
    {
        return $this->belongsToMany(
            CatalogSection::class,
            'catalog_sections_products',
            'product_id',
            'section_id'
        );
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class, 'product_id', 'id');
    }

    public function propertyValues(): BelongsToMany
    {
        return $this->belongsToMany(
            CatalogProductProperty::class,
            'catalog_product_properties_values',
            'product_id',
            'property_id'
        )
            ->withPivot('value');
    }

    public function properties(): hasMany
    {
        return $this->hasMany(CatalogProductPropertyValue::class, 'product_id', 'id');
    }

    public function scopeActive(Builder $query): void
    {
        $query->where('active', true);
    }
}
