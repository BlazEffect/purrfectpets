<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Responses\ApiErrorResponse;
use App\Http\Responses\ApiSuccessResponse;
use App\Models\MenuType;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="Menu",
 *     required={"id", "name"},
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="name", type="string", example="Раздел"),
 *     @OA\Property(property="key", type="string", example="razdel"),
 *     @OA\Property(property="active", type="integer", example=1),
 *     @OA\Property(property="created_at", type="string", format="date-time", example="2024-04-08 00:00:00"),
 *     @OA\Property(property="updated_at", type="string", format="date-time", example="2024-04-08 00:00:00")
 * ),
 * @OA\Schema(
 *     schema="MenuItem",
 *     required={"id", "name"},
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="menu_type_id", type="integer", example=1),
 *     @OA\Property(property="name", type="string", example="Товар"),
 *     @OA\Property(property="parent_id", type="integer", example=1),
 *     @OA\Property(property="active", type="integer", example=1),
 *     @OA\Property(property="order", type="integer", example=1),
 *     @OA\Property(property="icon", type="string", example=""),
 *     @OA\Property(property="url", type="string", example="http://zooshop.local:7542"),
 *     @OA\Property(property="created_at", type="datetime", example="2024-04-08 00:00:00"),
 *     @OA\Property(property="updated_at", type="datetime", example="2024-04-08 00:00:00"),
 *     @OA\Property(property="children", type="array",
 *         @OA\Items(ref="#/components/schemas/ChildMenuItem")
 *     )
 * )
 * @OA\Schema(
 *     schema="ChildMenuItem",
 *     required={"id", "name"},
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="menu_type_id", type="integer", example=1),
 *     @OA\Property(property="name", type="string", example="Товар"),
 *     @OA\Property(property="parent_id", type="integer", example=1),
 *     @OA\Property(property="active", type="integer", example=1),
 *     @OA\Property(property="order", type="integer", example=1),
 *     @OA\Property(property="icon", type="string", example=""),
 *     @OA\Property(property="url", type="string", example="http://zooshop.local:7542"),
 *     @OA\Property(property="created_at", type="datetime", example="2024-04-08 00:00:00"),
 *     @OA\Property(property="updated_at", type="datetime", example="2024-04-08 00:00:00"),
 * )
 */
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
     *                 @OA\Items(ref="#/components/schemas/Menu")
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

        if (empty($menuType)) {
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
