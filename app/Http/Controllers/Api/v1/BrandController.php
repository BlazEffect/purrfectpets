<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Responses\ApiErrorResponse;
use App\Http\Responses\ApiSuccessResponse;
use App\Services\BrandService;
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;

class BrandController extends BaseApiController
{
    public function __construct(
        private readonly BrandService $brandService
    ){}

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
        $brands = $this->brandService->getBrands();
        return new ApiSuccessResponse($brands, '');
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
        $brand = $this->brandService->getBrandById($brandId);

        if ($brand === null) {
            return new ApiErrorResponse('Бренд не найден.');
        }

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
        $brandWithProducts = $this->brandService->getProductsByBrandId($request, $brandId);

        if ($brandWithProducts === null) {
            return new ApiErrorResponse('Бренд не найден.');
        }

        return new ApiSuccessResponse($brandWithProducts, $brandWithProducts->products()->count());
    }
}
