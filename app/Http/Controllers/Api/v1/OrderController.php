<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Responses\ApiErrorResponse;
use App\Http\Responses\ApiSuccessResponse;
use App\Models\CatalogProduct;
use App\Models\Order;
use Auth;
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;
use Symfony\Component\HttpFoundation\Response;

class OrderController extends BaseApiController
{
    /**
     * @OA\Get (
     *     path="/orders",
     *     tags={"Order"},
     *     summary="Получение заказов пользователя",
     *     description="Получение заказов пользователя",
     *     security={
     *         { "Bearer":{} }
     *     },
     *     @OA\Response(
     *         response=200,
     *         description="Успешно",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example="true"),
     *             @OA\Property(property="data", type="array",
     *                 @OA\Items(ref="#/components/schemas/Order")
     *             ),
     *             @OA\Property(property="message", type="string", example="")
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Не авторизирован",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example="false"),
     *             @OA\Property(property="message", type="string", example="Вы не авторизованы.")
     *         )
     *     )
     * )
     *
     * @return ApiSuccessResponse
     */
    public function getOrders(): ApiSuccessResponse
    {
        $orders = Order::query()
            ->where('user_id', Auth::user()->id)
            ->get();

        return new ApiSuccessResponse($orders, '');
    }

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
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Не авторизирован",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example="false"),
     *             @OA\Property(property="message", type="string", example="Вы не авторизованы.")
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Ошибка валидации",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example="false"),
     *             @OA\Property(property="data", type="object", example={}),
     *             @OA\Property(property="message", type="string", example="Заказ не создан. Один или несколько товаров не найдено.")
     *         )
     *     )
     * )
     *
     * @param Request $request
     * @return ApiSuccessResponse|ApiErrorResponse
     */
    public function createOrder(Request $request): ApiSuccessResponse|ApiErrorResponse
    {
        $arrProducts = $request->get('products');

        $products = CatalogProduct::select(['id', 'price'])
            ->whereIn('id', array_column($arrProducts, 'product_id'))
            ->pluck('price', 'id')
            ->toArray();

        $allPrice = 0;

        $orderProduct = [];

        foreach ($arrProducts as $product) {
            if (isset($products[$product['product_id']])) {
                $price = $products[$product['product_id']] * $product['count'];

                $orderProduct[] = [
                    'product_id' => $product['product_id'],
                    'count' => $product['count'],
                    'price' => $price
                ];

                $allPrice += $price;
            } else {
                return new ApiErrorResponse(
                    'Заказ не создан. Один или несколько товаров не найдено.',
                    [],
                    Response::HTTP_UNPROCESSABLE_ENTITY);
            }
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

    /**
     * @OA\Post (
     *     path="/order/{orderId}/cancel",
     *     tags={"Order"},
     *     summary="Отмена заказа",
     *     description="Отмена заказа",
     *     security={
     *         { "Bearer":{} }
     *     },
     *     @OA\Parameter(
     *         name="orderId",
     *         description="ID заказа",
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
     *             @OA\Property(property="data", type="object", example={}),
     *             @OA\Property(property="message", type="string", example="Заказ успешно отменён.")
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Неверный запрос",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example="false"),
     *             @OA\Property(property="message", type="string", example="Заказ уже отменён.")
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Не авторизирован",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example="false"),
     *             @OA\Property(property="message", type="string", example="Вы не авторизованы.")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Не существует",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example="false"),
     *             @OA\Property(property="message", type="string", example="Заказ не найден.")
     *         )
     *     )
     * )
     *
     * @param int $orderId
     * @return ApiSuccessResponse|ApiErrorResponse
     */
    public function cancelOrder(int $orderId): ApiSuccessResponse|ApiErrorResponse
    {
        $order = Order::find($orderId);

        if ($order === null || $order->user_id !== Auth::user()->id) {
            return new ApiErrorResponse('Заказ не найден.');
        }

        if ($order->status === 1) {
            return new ApiErrorResponse('Заказ уже отменён.', [], Response::HTTP_BAD_REQUEST);
        }

        $order->status = 1;
        $order->save();

        return new ApiSuccessResponse([], 'Заказ успешно отменён.');
    }
}
