<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Responses\ApiSuccessResponse;
use App\Models\Banner;
use OpenApi\Annotations as OA;

class BannerController extends BaseApiController
{
    /**
     * @OA\Get (
     *     path="/banners",
     *     tags={"Banner"},
     *     summary="Получение баннеров из бд",
     *     description="Получение баннеров из бд",
     *     @OA\Response(
     *         response=200,
     *         description="Успешно",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example="true"),
     *             @OA\Property(property="data", type="array",
     *                 @OA\Items(ref="#/components/schemas/Banner")
     *             ),
     *             @OA\Property(property="message", type="string", example="")
     *         )
     *     )
     * )
     *
     * @return ApiSuccessResponse
     */
    public function getBanners(): ApiSuccessResponse
    {
        $banners = Banner::query()
            ->active()
            ->orderBy('order')
            ->orderBy('created_at', 'desc')
            ->get();

        return new ApiSuccessResponse($banners, '');
    }
}
