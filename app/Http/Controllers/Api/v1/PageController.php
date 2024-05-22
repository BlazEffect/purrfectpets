<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Responses\ApiErrorResponse;
use App\Http\Responses\ApiSuccessResponse;
use App\Models\Page;
use OpenApi\Annotations as OA;

class PageController extends BaseApiController
{
    /**
     * @OA\Get (
     *     path="/getPage/{url}",
     *     tags={"Page"},
     *     summary="Получение статической страницы",
     *     description="Получение статической страницы",
     *     @OA\Parameter(
     *         name="url",
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
     *             @OA\Property(property="data", type="object", ref="#/components/schemas/Page"),
     *             @OA\Property(property="message", type="string", example="")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Не существует",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example="false"),
     *             @OA\Property(property="message", type="string", example="Страницы не найдено.")
     *         )
     *     )
     * )
     *
     * @param string $url
     * @return ApiSuccessResponse|ApiErrorResponse
     */
    public function index(string $url): ApiSuccessResponse|ApiErrorResponse
    {
        $page = Page::query()
            ->where('url', $url)
            ->active()
            ->get();

        if ($page === null) {
            return new ApiErrorResponse('Страницы не найдено.');
        }

        return new ApiSuccessResponse($page, '');
    }
}
