<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CatalogProductPropertyValue extends Model
{
    protected $table = 'catalog_product_properties_values';

    protected $fillable = [
        'property_id',
        'product_id',
        'value'
    ];

    public function property(): BelongsTo
    {
        return $this->belongsTo(CatalogProductProperty::class, 'property_id', 'id');
    }
}
