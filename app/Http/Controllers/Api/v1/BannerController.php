<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Responses\ApiSuccessResponse;
use App\Models\Banner;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="Banner",
 *     required={"id", "name"},
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="name", type="string", example="Название для администратора"),
 *     @OA\Property(property="title", type="string", example="Отображаемое название"),
 *     @OA\Property(property="image", type="string", example="Картинка "),
 *     @OA\Property(property="link", type="string", example="Ссылка баннера"),
 *     @OA\Property(property="text", type="text", example="Текст баннера"),
 *     @OA\Property(property="active", type="boolean", example=true),
 *     @OA\Property(property="order", type="integer", example=1),
 *     @OA\Property(property="created_at", type="string", format="date-time", example="2024-04-08 00:00:00"),
 *     @OA\Property(property="updated_at", type="string", format="date-time", example="2024-04-08 00:00:00")
 * )
 */
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
