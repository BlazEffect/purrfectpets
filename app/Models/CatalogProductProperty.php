<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CatalogProductProperty extends Model
{
    protected $table = 'catalog_product_properties';

    protected $fillable = [
        'name'
    ];

    public $timestamps = false;
}
