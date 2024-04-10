<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Responses\ApiErrorResponse;
use App\Http\Responses\ApiSuccessResponse;
use App\Models\CatalogProduct;
use OpenApi\Annotations as OA;

class ProductController extends BaseApiController
{
    /**
     * @OA\Get (
     *     path="/product/{productId}",
     *     tags={"Product"},
     *     summary="Получение товара по ID",
     *     description="Получение товара по ID",
     *     @OA\Parameter(
     *           name="productId",
     *           description="ID продукта",
     *           required=true,
     *           in="path",
     *           @OA\Schema(
     *               type="integer"
     *           )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Успешно",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example="true"),
     *             @OA\Property(property="data", type="object",
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="name", type="string", example="Товар"),
     *                 @OA\Property(property="slug", type="string", example="tovar"),
     *                 @OA\Property(property="description", type="string", example="Описание товара"),
     *                 @OA\Property(property="brand_id", type="integer", example=1),
     *                 @OA\Property(property="image", type="string", example=""),
     *                 @OA\Property(property="price", type="string", example="1.00"),
     *                 @OA\Property(property="quantity", type="integer", example=1),
     *                 @OA\Property(property="active", type="integer", example=1),
     *                 @OA\Property(property="order", type="integer", example=1),
     *                 @OA\Property(property="created_at", type="datetime", example="2024-04-08 00:00:00"),
     *                 @OA\Property(property="updated_at", type="datetime", example="2024-04-08 00:00:00"),
     *                 @OA\Property(property="brand", type="object",
     *                     @OA\Property(property="id", type="integer", example=1),
     *                     @OA\Property(property="name", type="string", example="Бренд"),
     *                     @OA\Property(property="slug", type="string", example="brend"),
     *                     @OA\Property(property="description", type="string", example="Описание бренда"),
     *                     @OA\Property(property="active", type="integer", example=1),
     *                     @OA\Property(property="order", type="integer", example=1),
     *                     @OA\Property(property="created_at", type="datetime", example="2024-04-08 00:00:00"),
     *                     @OA\Property(property="updated_at", type="datetime", example="2024-04-08 00:00:00")
     *                 ),
     *                 @OA\Property(property="comments", type="object",
     *                     @OA\Property(property="id", type="integer", example=1),
     *                     @OA\Property(property="product_id", type="integer", example=1),
     *                     @OA\Property(property="user_id", type="integer", example=1),
     *                     @OA\Property(property="status", type="integer", example=1),
     *                     @OA\Property(property="name", type="string", example="Краткое название"),
     *                     @OA\Property(property="advantages", type="string", example="Преимущества"),
     *                     @OA\Property(property="disadvantages", type="string", example="Недостатки"),
     *                     @OA\Property(property="text", type="string", example="Более подробное описание"),
     *                     @OA\Property(property="rating_value", type="integer", example=1),
     *                     @OA\Property(property="created_at", type="datetime", example="2024-04-08 00:00:00"),
     *                     @OA\Property(property="updated_at", type="datetime", example="2024-04-08 00:00:00")
     *                 ),
     *                 @OA\Property(property="property_values", type="object",
     *                     @OA\Property(property="id", type="integer", example=1),
     *                     @OA\Property(property="name", type="string", example="Название свойства"),
     *                     @OA\Property(property="privot", type="object",
     *                         @OA\Property(property="product_id", type="integer", example=1),
     *                         @OA\Property(property="property_id", type="integer", example=1),
     *                         @OA\Property(property="value", type="string", example="Значение свойства")
     *                     )
     *                 )
     *             ),
     *             @OA\Property(property="message", type="string", example="")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Товара не существует",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example="false"),
     *             @OA\Property(property="message", type="string", example="Товар не найден."),
     *         )
     *     )
     * )
     *
     * @param int $productId
     * @return JsonResponse
     */
    public function getProduct(int $productId): JsonResponse
    {
        $product = CatalogProduct::find($productId);

        if ($product === null) {
            return $this->sendError('Товар не найден');
        }

        return $this->sendResponse($product->with('brand', 'comments', 'propertyValues')->get(), '');
    }
}
