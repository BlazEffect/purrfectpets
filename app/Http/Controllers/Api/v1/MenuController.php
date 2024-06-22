<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Responses\ApiErrorResponse;
use App\Http\Responses\ApiSuccessResponse;
use OpenApi\Annotations as OA;

class MenuController extends BaseApiController
{
    public function __construct(
        private readonly MenuService $menuService
    ){}

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
        $menus = $this->menuService->getMenus();
        return new ApiSuccessResponse($menus, '');
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
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Не существует",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example="false"),
     *             @OA\Property(property="message", type="string", example="Меню не найдено.")
     *         )
     *     )
     * )
     *
     * @param string $menuKey
     * @return ApiErrorResponse|ApiSuccessResponse
     */
    public function getMenuItems(string $menuKey)
    {
        $menuItems = $this->menuService->getMenuItems($menuKey);

        if ($menuItems === null) {
            return new ApiErrorResponse('Меню не найдено.');
        }

        return new ApiSuccessResponse($menuItems, '');
    }
}
