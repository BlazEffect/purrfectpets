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
        $banners = Brand::query()
            ->active()
            ->orderBy('order')
            ->orderBy('created_at', 'desc')
            ->get();

        return new ApiSuccessResponse($banners, '');
    }
}
