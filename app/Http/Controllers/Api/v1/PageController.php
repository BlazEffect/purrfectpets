<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Responses\ApiSuccessResponse;
use App\Models\Page;
use OpenApi\Annotations as OA;

class PageController extends BaseApiController
{
    /**
     * @OA\Get (
     *     path="/getPage/{page:url}",
     *     tags={"Page"},
     *     summary="Получение статической страницы из бд",
     *     description="Получение статической страницы из бд",
     *     @OA\Parameter(
     *         name="page:url",
     *         description="Url страницы",
     *         required=true,
     *         in="path",
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Успешно",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example="true"),
     *             @OA\Property(property="data", type="object",
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="name", type="string", example="Название страницы"),
     *                 @OA\Property(property="url", type="string", example="Url страницы"),
     *                 @OA\Property(property="content", type="string", example="Содержание страницы"),
     *                 @OA\Property(property="active", type="integer", example=1),
     *                 @OA\Property(property="order", type="integer", example=1),
     *                 @OA\Property(property="created_at", type="datetime", example="2024-04-08 00:00:00"),
     *                 @OA\Property(property="updated_at", type="datetime", example="2024-04-08 00:00:00")
     *             ),
     *             @OA\Property(property="message", type="string", example="")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Страницы не существует",
     *     )
     * )
     *
     * @param Page $page
     * @return ApiSuccessResponse
     */
    public function index(Page $page): ApiSuccessResponse
    {
        return new ApiSuccessResponse($page, '');
    }
}
