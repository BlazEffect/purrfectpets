<?php

namespace App\Virtual\Models;

use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     title="Order",
 *     description="Menu type model",
 *     required={"id", "user_id", "status", "is_paid", "price"},
 *     @OA\Xml(
 *         name="Order"
 *     )
 * )
 */
class Order
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
}
