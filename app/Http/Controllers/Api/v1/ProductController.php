<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\CatalogProduct;
use Illuminate\Http\JsonResponse;

class ProductController extends BaseApiController
{
    /**
     * @param int $productId
     * @return JsonResponse
     */
    public function getProduct(int $productId): JsonResponse
    {
        $product = CatalogProduct::find($productId);

        if ($product === null) {
            return $this->sendError('Товар не найден');
        }

        return $this->sendResponse($product->with('brand', 'comments', 'propertyValues')->get(), '');
    }
}
