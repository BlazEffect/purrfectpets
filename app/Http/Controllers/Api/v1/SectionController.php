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
 *     @OA\Property(property="active", type="integer", example=1),
 *     @OA\Property(property="order", type="integer", example=1),
 *     @OA\Property(property="created_at", type="string", format="date-time", example="2024-04-08 00:00:00"),
 *     @OA\Property(property="updated_at", type="string", format="date-time", example="2024-04-08 00:00:00")
 * ),
 * @OA\Schema(
 *     schema="Product",
 *     required={"id", "name"},
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="name", type="string", example="Товар"),
 *     @OA\Property(property="slug", type="string", example="tovar"),
 *     @OA\Property(property="description", type="string", example="Описание товара"),
 *     @OA\Property(property="brand_id", type="integer", example=1),
 *     @OA\Property(property="image", type="string", example=""),
 *     @OA\Property(property="price", type="string", example="1.00"),
 *     @OA\Property(property="quantity", type="integer", example=1),
 *     @OA\Property(property="active", type="integer", example=1),
 *     @OA\Property(property="order", type="integer", example=1),
 *     @OA\Property(property="created_at", type="datetime", example="2024-04-08 00:00:00"),
 *     @OA\Property(property="updated_at", type="datetime", example="2024-04-08 00:00:00")
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
    public function getSections(): JsonResponse
    {
        return $this->sendResponse(CatalogSection::active()->get(), '');
    }

    /**
     * @param int $sectionId
     * @return JsonResponse
     */
    public function getChildSections(int $sectionId): JsonResponse
    {
        $section = CatalogSection::find($sectionId);

        if ($section === null) {
            return $this->sendError('Раздел не найден');
        }

        return $this->sendResponse($section->childSections()->active()->get(), '');
    }

    /**
     * @param int $sectionId
     * @return JsonResponse
     */
    public function getProducts(int $sectionId): JsonResponse
    {
        $section = CatalogSection::find($sectionId);

        if ($section === null) {
            return $this->sendError('Раздел не найден');
        }

        return $this->sendResponse($section->products()->active()->get(), '');
    }
}
