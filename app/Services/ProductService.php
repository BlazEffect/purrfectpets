<?php

namespace App\Services;

use App\Models\CatalogProduct;

class ProductService
{
    /**
     * @param array $productIds
     * @return array
     */
    public function getProductsByIds(array $productIds): array
    {
        return CatalogProduct::select(['id', 'price'])
            ->whereIn('id', $productIds)
            ->pluck('price', 'id')
            ->toArray();
    }
}
