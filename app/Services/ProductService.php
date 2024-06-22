<?php

namespace App\Services;

use App\Models\CatalogProduct;
use Illuminate\Support\Facades\Storage;

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

    /**
     * @param int $productId
     * @return CatalogProduct|null
     */
    public function getProductById(int $productId): ?CatalogProduct
    {
        $product = CatalogProduct::find($productId);

        if ($product === null || $product->active === false) {
            return null;
        }

        $product = $product->load('brand', 'comments', 'propertyValues');
        $product->image = Storage::disk('products')->url($product->image);

        return $product;
    }
}
