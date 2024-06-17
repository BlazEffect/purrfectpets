<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Responses\ApiErrorResponse;
use App\Http\Responses\ApiSuccessResponse;
use App\Models\Brand;
use App\Models\CatalogProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use OpenApi\Annotations as OA;

class BrandController extends BaseApiController
{
    /**
     * @OA\Get (
     *     path="/brands",
     *     tags={"Brands"},
     *     summary="Получение всех активных брендов",
     *     description="Получение всех активных брендов",
     *     @OA\Response(
     *         response=200,
     *         description="Успешно",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example="true"),
     *             @OA\Property(property="data", type="array",
     *                 @OA\Items(ref="#/components/schemas/Brand")
     *             ),
     *             @OA\Property(property="message", type="string", example="")
     *         )
     *     )
     * )
     *
     * @return ApiSuccessResponse
     */
    public function getBrands(): ApiSuccessResponse
    {
        $brand = Brand::query()
            ->active()
            ->orderBy('order')
            ->orderBy('created_at', 'desc')
            ->get();

        $brand->map(fn(Brand $brand) =>
            $brand->image = Storage::disk('brands')->url($brand->image)
        );

        return new ApiSuccessResponse($brand, '');
    }

    /**
     * @OA\Get (
     *     path="/brand/{brandId}",
     *     tags={"Brands"},
     *     summary="Получение бренда по id",
     *     description="Получение бренда по id",
     *     @OA\Parameter(
     *         name="brandId",
     *         description="ID бренда",
     *         required=true,
     *         in="path",
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Успешно",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example="true"),
     *             @OA\Property(property="data", type="object", ref="#/components/schemas/Brand"),
     *             @OA\Property(property="message", type="string", example="")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Не существует",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example="false"),
     *             @OA\Property(property="message", type="string", example="Бренд не найден.")
     *         )
     *     )
     * )
     *
     * @param int $brandId
     * @return ApiSuccessResponse|ApiErrorResponse
     */
    public function getBrandById(int $brandId): ApiSuccessResponse|ApiErrorResponse
    {
        $brand = Brand::find($brandId);

        if ($brand === null) {
            return new ApiErrorResponse('Бренд не найден.');
        }

        $brand->image = Storage::disk('brands')->url($brand->image);

        return new ApiSuccessResponse($brand, '');
    }

    /**
     * @OA\Get (
     *     path="/brand/{brandId}/products",
     *     tags={"Brands"},
     *     summary="Получение продуктов бренда",
     *     description="Получение продуктов бренда",
     *     @OA\Parameter(
     *         name="brandId",
     *         description="ID бренда",
     *         required=true,
     *         in="path",
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="page",
     *         in="query",
     *         required=false,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Успешно",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example="true"),
     *             @OA\Property(property="data", type="object", ref="#/components/schemas/BrandWithProducts"),
     *             @OA\Property(property="message", type="string", example="")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Не существует",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example="false"),
     *             @OA\Property(property="message", type="string", example="Бренд не найден.")
     *         )
     *     )
     * )
     *
     * @param Request $request
     * @param int $brandId
     * @return ApiSuccessResponse|ApiErrorResponse
     */
    public function getProductsByBrandId(Request $request, int $brandId): ApiSuccessResponse|ApiErrorResponse
    {
        $brandWithProducts = Brand::with(['products' => function ($query) use ($request) {
            $query->when($request->has('page'), function ($subQuery) use ($request) {
                $subQuery->offset(($request->has('page') - 1) * 4)
                    ->limit(4);
            });
        }])->find($brandId);

        if ($brandWithProducts === null) {
            return new ApiErrorResponse('Бренд не найден.');
        }

        $brandWithProducts->image = Storage::disk('brands')->url($brandWithProducts->image);

        $brandWithProducts->products->map(fn(CatalogProduct $catalogProduct) =>
            $catalogProduct->image = Storage::disk('products')->url($catalogProduct->image)
        );

        return new ApiSuccessResponse($brandWithProducts, $brandWithProducts->products()->count());
    }
}
