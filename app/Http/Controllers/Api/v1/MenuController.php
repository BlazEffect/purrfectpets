<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Responses\ApiErrorResponse;
use App\Http\Responses\ApiSuccessResponse;
use App\Models\MenuType;
use OpenApi\Annotations as OA;

class MenuController extends BaseApiController
{
    /**
     * @OA\Get (
     *     path="/menus",
     *     tags={"Menu"},
     *     summary="Получение списка меню",
     *     description="Получение списка меню",
     *     @OA\Response(
     *         response=200,
     *         description="Успешно",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example="true"),
     *             @OA\Property(property="data", type="array",
     *                 @OA\Items(ref="#/components/schemas/MenuType")
     *             ),
     *             @OA\Property(property="message", type="string", example="")
     *         )
     *     )
     * )
     *
     * @return ApiSuccessResponse
     */
    public function getMenus(): ApiSuccessResponse
    {
        return new ApiSuccessResponse(MenuType::active()->get(), '');
    }

    /**
     * @OA\Get (
     *     path="/menu/{menuKey}/items",
     *     tags={"Menu"},
     *     summary="Получение списка элементов меню",
     *     description="Получение списка элементов меню",
     *     @OA\Response(
     *         response=200,
     *         description="Успешно",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example="true"),
     *             @OA\Property(property="data", type="array",
     *                 @OA\Items(ref="#/components/schemas/MenuItem")
     *             ),
     *             @OA\Property(property="message", type="string", example="")
     *         )
     *     )
     * )
     *
     * @param string $menuKey
     * @return ApiErrorResponse|ApiSuccessResponse
     */
    public function getMenuItems(string $menuKey)
    {
        $menuType = MenuType::query()->where('key', $menuKey)->active()->first();

        if ($menuType === null) {
            return new ApiErrorResponse('Меню не найдено.');
        }

        return new ApiSuccessResponse(
            $menuType
                ->items()
                ->with('children', function($query) {
                    $query->active();
                })
                ->active()
                ->get(),
            ''
        );
    }
}
