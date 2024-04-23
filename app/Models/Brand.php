<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Brand extends Model
{
    protected $casts = [
        'active' => 'boolean'
    ];

    public function products(): HasMany
    {
        return $this->hasMany(CatalogProduct::class);
    }
}
