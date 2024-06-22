<?php

namespace App\Services;

use App\Models\Order;
use App\Models\OrderProperty;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class OrderService
{
    public function __construct(
        private readonly ProductService $productService,
        private readonly EmailService $emailService
    ){}

    /**
     * @return Collection
     */
    public function getOrders(): Collection
    {
        return Order::query()
            ->where('user_id', Auth::user()->id)
            ->get();
    }

    /**
     * @param int $orderId
     * @return Order|null
     */
    public function getOrder(int $orderId): ?Order
    {
        $order = Order::find($orderId);

        return $order?->with(['products', 'properties'])->find($orderId);
    }

    /**
     * @param Request $request
     * @return int|bool
     */
    public function createOrder(Request $request): int|bool
    {
        $arrProducts = $request->get('products');
        $productIds = array_column($arrProducts, 'product_id');
        $products = $this->productService->getProductsByIds($productIds);

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
                return false;
            }
        }

        $orderData = [
            'user_id' => Auth::user()->id,
            'price' => $allPrice
        ];

        $order = Order::create($orderData);
        $order->products()->createMany($orderProduct);
        $order->properties()->create($request->get('orderProperties'));

        $user = Auth::user();
        $orderProperties = OrderProperty::find($order->id);

        $this->emailService->sendOrderCreatedUserMail($user, $order, $orderProperties);
        $this->emailService->sendOrderCreatedAdminMail($order, $orderProperties);

        return $order->id;
    }

    /**
     * @param int $orderId
     * @return bool|null
     */
    public function cancelOrder(int $orderId): ?bool
    {
        $order = Order::find($orderId);

        if ($order === null || $order->user_id !== Auth::user()->id) {
            return false;
        }

        if ($order->status === 1) {
            return null;
        }

        $order->status = 1;
        $order->save();

        $user = Auth::user();
        $this->emailService->sendOrderCancelledMail($user, $order->id);

        return true;
    }
}
