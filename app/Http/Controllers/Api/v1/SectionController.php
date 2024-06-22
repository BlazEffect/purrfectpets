<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Responses\ApiErrorResponse;
use App\Http\Responses\ApiSuccessResponse;
use App\Services\ProductService;
use App\Services\SectionService;
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;

class SectionController extends BaseApiController
{
    public function __construct(
        private readonly SectionService $sectionService,
        private readonly ProductService $productService
    ){}

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
     *                 @OA\Items(ref="#/components/schemas/CatalogSection")
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
        $sections = $this->sectionService->getActiveSections();

        return new ApiSuccessResponse($sections, '');
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
     *                 @OA\Items(ref="#/components/schemas/CatalogSection")
     *             ),
     *             @OA\Property(property="message", type="string", example="")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Не существует",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example="false"),
     *             @OA\Property(property="message", type="string", example="Раздел не найден.")
     *         )
     *     )
     * )
     *
     * @param int $sectionId
     * @return ApiSuccessResponse|ApiErrorResponse
     */
    public function getChildSections(int $sectionId): ApiSuccessResponse|ApiErrorResponse
    {
        $childSections = $this->sectionService->getChildSections($sectionId);

        if ($childSections === null) {
            return new ApiErrorResponse('Раздел не найден.');
        }

        return new ApiSuccessResponse($childSections, '');
    }

    /**
     * @OA\Get (
     *     path="/section/{sectionId}/products",
     *     tags={"Section"},
     *     summary="Получение товаров раздела",
     *     description="Получение товаров раздела",
     *     @OA\Parameter(
     *         name="sectionId",
     *         description="ID раздела",
     *         required=true,
     *         in="path",
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="page",
     *         in="query",
     *         required=false,
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
     *         description="Не существует",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example="false"),
     *             @OA\Property(property="message", type="string", example="Раздел не найден.")
     *         )
     *     )
     * )
     *
     * @param Request $request
     * @param int $sectionId
     * @return ApiSuccessResponse|ApiErrorResponse
     */
    public function getProducts(Request $request, int $sectionId): ApiSuccessResponse|ApiErrorResponse
    {
        $result = $this->productService->getProductsBySection($request, $sectionId);

        if ($result === null) {
            return new ApiErrorResponse('Раздел не найден');
        }

        return new ApiSuccessResponse($result['products'], $result['total']);
    }
}
