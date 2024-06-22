<?php

namespace App\Services;

use App\Models\Brand;
use App\Models\CatalogProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;

class BrandService
{
    /**
     * @return Collection
     */
    public function getBrands(): Collection
    {
        $brands = Brand::query()
            ->active()
            ->orderBy('order')
            ->orderBy('created_at', 'desc')
            ->get();

        $brands->map(fn(Brand $brand) =>
            $brand->image = Storage::disk('brands')->url($brand->image)
        );

        return $brands;
    }

    /**
     * @param int $brandId
     * @return Brand|null
     */
    public function getBrandById(int $brandId): ?Brand
    {
        $brand = Brand::find($brandId);

        if ($brand === null) {
            return null;
        }

        $brand->image = Storage::disk('brands')->url($brand->image);

        return $brand;
    }

    /**
     * @param Request $request
     * @param int $brandId
     * @return Brand|null
     */
    public function getProductsByBrandId(Request $request, int $brandId): ?Brand
    {
        $brandWithProducts = Brand::with(['products' => function ($query) use ($request) {
            $query->when($request->has('page'), function ($subQuery) use ($request) {
                $subQuery->offset(($request->post('page') - 1) * 4)
                    ->limit(4);
            });
        }])->find($brandId);

        if ($brandWithProducts === null) {
            return null;
        }

        $brandWithProducts->image = Storage::disk('brands')->url($brandWithProducts->image);

        $brandWithProducts->products->map(fn(CatalogProduct $catalogProduct) =>
        $catalogProduct->image = Storage::disk('products')->url($catalogProduct->image)
        );

        return $brandWithProducts;
    }
}
