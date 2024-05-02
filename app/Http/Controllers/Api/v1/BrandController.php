<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Responses\ApiSuccessResponse;
use App\Models\Brand;
use OpenApi\Annotations as OA;

class BrandController extends BaseApiController
{
    /**
     * @OA\Get (
     *     path="/brands",
     *     tags={"Brands"},
     *     summary="Получение всех активных брендов из бд",
     *     description="Получение всех активных брендов из бд",
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

        return new ApiSuccessResponse($brand, '');
    }

    /**
     * @OA\Get (
     *     path="/brand/{brandId}",
     *     tags={"Brands"},
     *     summary="Получение бренда по id из бд",
     *     description="Получение бренда по id из бд",
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
     *     )
     * )
     *
     * @param int $brandId
     * @return ApiSuccessResponse
     */
    public function getBrandById(int $brandId): ApiSuccessResponse
    {
        $brand = Brand::find($brandId);

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
     *     @OA\Response(
     *         response=200,
     *         description="Успешно",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example="true"),
     *             @OA\Property(property="data", type="object", ref="#/components/schemas/BrandWithProducts"),
     *             @OA\Property(property="message", type="string", example="")
     *         )
     *     )
     * )
     *
     * @param int $brandId
     * @return ApiSuccessResponse
     */
    public function getProductsByBrandId(int $brandId): ApiSuccessResponse
    {
        $brandWithProducts = Brand::with('products')->find($brandId);

        return new ApiSuccessResponse($brandWithProducts, '');
    }
}
