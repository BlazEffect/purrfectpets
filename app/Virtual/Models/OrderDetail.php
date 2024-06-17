<?php

namespace App\Virtual\Models;

use DateTime;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     title="OrderDetail",
 *     description="Order detail model",
 *     required={"id", "user_id", "status", "is_paid", "price", "product"},
 *     @OA\Xml(
 *         name="OrderDetail"
 *     )
 * )
 */
class OrderDetail
{
    /**
     * @OA\Property(
     *     title="ID",
     *     description="ID",
     *     format="int128",
     *     example=1
     * )
     *
     * @var int $id
     */
    private int $id;

    /**
     * @OA\Property(
     *     title="User ID",
     *     description="User ID",
     *     format="int128",
     *     example=1
     * )
     *
     * @var int $user_id
     */
    public int $user_id;

    /**
     * @OA\Property(
     *     title="Status",
     *     description="Status for order",
     *     example=1
     * )
     *
     * @var int $status
     */
    public int $status;

    /**
     * @OA\Property(
     *     title="Active",
     *     example=true
     * )
     *
     * @var bool $is_paid
     */
    public bool $is_paid;

    /**
     * @OA\Property(
     *     title="Price",
     *     description="Price",
     *     example=1.00
     * )
     *
     * @var float $price
     */
    public float $price;

    /**
     * @OA\Property(
     *     title="Created at",
     *     description="Created at",
     *     example="2024-04-08 00:00:00",
     *     format="datetime",
     *     type="string"
     * )
     *
     * @var DateTime|null $created_at
     */
    private ?DateTime $created_at;

    /**
     * @OA\Property(
     *     title="Updated at",
     *     description="Updated at",
     *     example="2024-04-08 00:00:00",
     *     format="datetime",
     *     type="string"
     * )
     *
     * @var DateTime|null $updated_at
     */
    private ?DateTime $updated_at;

    /**
     * @OA\Property(
     *     title="Products",
     *     description="Products that belong to the order"
     * )
     *
     * @var OrderProduct[] $products
     */
    public array $products;

    /**
     * @OA\Property(
     *     title="Properties",
     *     description="Properties that belong to the order"
     * )
     *
     * @var OrderProperty $products
     */
    public OrderProperty $properties;
}
