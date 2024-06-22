<?php

namespace App\Services;

use App\Models\CatalogProduct;
use App\Models\CatalogSection;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
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

    public function getProductsBySection(Request $request, int $sectionId): ?array
    {
        $section = CatalogSection::find($sectionId);

        if ($section === null) {
            return null;
        }

        $allProducts = $section->products()
            ->active()
            ->get();

        $offsetProducts = $allProducts->when($request->get('page'), fn(Collection $collection) =>
            $collection->slice(($request->get('page') - 1) * 20, 20)
        );

        if ($offsetProducts->isNotEmpty()) {
            $offsetProducts->map(fn(CatalogProduct $catalogProduct) =>
                $catalogProduct->image = Storage::disk('products')->url($catalogProduct->image)
            );
        }

        return [
            'products' => $offsetProducts,
            'total' => $allProducts->count()
        ];
    }
}
