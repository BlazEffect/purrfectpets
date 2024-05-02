<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Responses\ApiErrorResponse;
use App\Http\Responses\ApiSuccessResponse;
use App\Models\CatalogSection;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="Section",
 *     required={"id", "name"},
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="name", type="string", example="Раздел"),
 *     @OA\Property(property="slug", type="string", example="razdel"),
 *     @OA\Property(property="parent_id", type="integer", example=1),
 *     @OA\Property(property="description", type="string", example="Описание раздела"),
 *     @OA\Property(property="image", type="string", example=""),
 *     @OA\Property(property="active", type="boolean", example=true),
 *     @OA\Property(property="order", type="integer", example=1),
 *     @OA\Property(property="created_at", type="string", format="date-time", example="2024-04-08 00:00:00"),
 *     @OA\Property(property="updated_at", type="string", format="date-time", example="2024-04-08 00:00:00")
 * )
 */
class SectionController extends BaseApiController
{
    /**
     * @OA\Get (
     *     path="/sections",
     *     tags={"Section"},
     *     summary="Получение списка разделов",
     *     description="Получение списка разделов",
     *     @OA\Response(
     *         response=200,
     *         description="Успешно",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example="true"),
     *             @OA\Property(property="data", type="array",
     *                 @OA\Items(ref="#/components/schemas/Section")
     *             ),
     *             @OA\Property(property="message", type="string", example="")
     *         )
     *     )
     * )
     *
     * @return ApiSuccessResponse
     */
    public function getSections(): ApiSuccessResponse
    {
        return new ApiSuccessResponse(CatalogSection::active()->get(), '');
    }

    /**
     * @OA\Get (
     *     path="/section/{sectionId}/children",
     *     tags={"Section"},
     *     summary="Получение дочерних элементов раздела",
     *     description="Получение дочерних элементов раздела",
     *     @OA\Parameter(
     *         name="sectionId",
     *         description="ID раздела",
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
     *             @OA\Property(property="data", type="array",
     *                 @OA\Items(ref="#/components/schemas/Section")
     *             ),
     *             @OA\Property(property="message", type="string", example="")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Раздел не существует",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example="false"),
     *             @OA\Property(property="message", type="string", example="Раздел не найден."),
     *         )
     *     )
     * )
     *
     * @param int $sectionId
     * @return ApiSuccessResponse|ApiErrorResponse
     */
    public function getChildSections(int $sectionId): ApiSuccessResponse|ApiErrorResponse
    {
        $section = CatalogSection::find($sectionId);

        if ($section === null) {
            return new ApiErrorResponse('Раздел не найден.');
        }

        return new ApiSuccessResponse($section->childSections()->active()->get(), '');
    }

    /**
     * @OA\Get (
     *     path="/section/{sectionId}/products",
     *     tags={"Section"},
     *     summary="Получение дочерних элементов раздела",
     *     description="Получение дочерних элементов раздела",
     *     @OA\Parameter(
     *         name="sectionId",
     *         description="ID раздела",
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
     *             @OA\Property(property="data", type="array",
     *                 @OA\Items(ref="#/components/schemas/CatalogProduct")
     *             ),
     *             @OA\Property(property="message", type="string", example="")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Раздел не существует",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example="false"),
     *             @OA\Property(property="message", type="string", example="Раздел не найден."),
     *         )
     *     )
     * )
     *
     * @param int $sectionId
     * @return ApiSuccessResponse|ApiErrorResponse
     */
    public function getProducts(int $sectionId): ApiSuccessResponse|ApiErrorResponse
    {
        $section = CatalogSection::find($sectionId);

        if ($section === null) {
            return new ApiErrorResponse('Раздел не найден');
        }

        return new ApiSuccessResponse($section->products()->active()->get(), '');
    }
}
