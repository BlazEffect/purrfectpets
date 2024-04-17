<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Responses\ApiSuccessResponse;
use App\Models\CatalogProduct;
use App\Models\Order;
use Auth;
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="OrderProduct",
 *     required={"productId", "count"},
 *     @OA\Property(property="productId", type="integer", example=1),
 *     @OA\Property(property="count", type="integer", example=1),
 * ),
 */
class OrderController extends BaseApiController
{
    /**
     * @OA\Post (
     *     path="/order/create",
     *     tags={"Order"},
     *     summary="Создание заказа",
     *     description="Создание заказа",
     *     security={
     *         { "Bearer":{} }
     *     },
     *     @OA\RequestBody(
     *         @OA\JsonContent(
     *             allOf={
     *                 @OA\Schema(
     *                     @OA\Property(property="orderProperties", type="object",
     *                         @OA\Property(property="FIO", type="string", example="Морозов Николай Михайлович"),
     *                         @OA\Property(property="email", type="string", example="morozov@test.com"),
     *                         @OA\Property(property="phone", type="string", example="+7(999)999-99-99"),
     *                         @OA\Property(property="address", type="string", example="Москва, ул. Ленина, д. 1"),
     *                         @OA\Property(property="comment", type="string", example="Комментарий")
     *                     ),
     *                     @OA\Property(property="products", type="array",
     *                         @OA\Items(ref="#/components/schemas/OrderProduct")
     *                     )
     *                 )
     *             }
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Успешно",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example="true"),
     *             @OA\Property(property="data", type="object",
     *                 @OA\Property(property="orderId", type="integer", example=1)
     *             ),
     *             @OA\Property(property="message", type="string", example="Заказ успешно создан.")
     *         )
     *     )
     * )
     *
     * @param Request $request
     * @return ApiSuccessResponse
     */
    public function createOrder(Request $request): ApiSuccessResponse
    {
        $arrProducts = $request->get('products');

        $products = CatalogProduct::select(['id', 'price'])
            ->whereIn('id', array_column($arrProducts, 'productId'))
            ->pluck('price', 'id')
            ->toArray();

        $allPrice = 0;

        $orderProduct = [];

        foreach ($arrProducts as $product) {
            $price = $products[$product['productId']] * $product['count'];

            $orderProduct[] = [
                'product_id' => $product['productId'],
                'count' => $product['count'],
                'price' => $price
            ];

            $allPrice += $price;
        }

        $orderData = [
            'user_id' => Auth::user()->id,
            'price' => $allPrice
        ];

        $order = Order::create($orderData);

        $order->products()->createMany($orderProduct);
        $order->properties()->create($request->get('orderProperties'));

        return new ApiSuccessResponse(['orderId' => $order->id], 'Заказ успешно создан.');
    }
}
