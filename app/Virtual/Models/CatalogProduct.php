<?php

namespace App\Virtual\Models;

use DateTime;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     title="CatalogProduct",
 *     description="Catalog product model",
 *     required={"id", "name", "slug", "price", "quantity", "active", "order"},
 *     @OA\Xml(
 *         name="CatalogProduct"
 *     )
 * )
 */
class CatalogProduct
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
     *     title="Name",
     *     description="Name of the new product",
     *     example="Royal Canin"
     * )
     *
     * @var string $name
     */
    public string $name;

    /**
     * @OA\Property(
     *     title="Slug",
     *     description="Slug of the new product",
     *     example="royal_canin"
     * )
     *
     * @var string $slug
     */
    public string $slug;

    /**
     * @OA\Property(
     *     title="Decription",
     *     description="Decription of the new product",
     *     example="Lorem ipsum dolor sit amet, consectetur adipisicing elit. Atque aut consequuntur delectus"
     * )
     *
     * @var string|null $decription
     */
    public ?string $decription;

    /**
     * @OA\Property(
     *     title="Brand id",
     *     description="ID of the brand the product belongs to",
     *     example=1
     * )
     *
     * @var int|null $brand_id
     */
    public ?int $brand_id;

    /**
     * @OA\Property(
     *     title="Price",
     *     description="Price",
     *     example="gnuithiugh598.png"
     * )
     *
     * @var string|null $image
     */
    public ?string $image;

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
     *     title="Quantity",
     *     description="Quantity",
     *     format="int128",
     *     example=0
     * )
     *
     * @var int $quantity
     */
    public int $quantity;

    /**
     * @OA\Property(
     *     title="Active",
     *     example=true
     * )
     *
     * @var bool $active
     */
    public bool $active;

    /**
     * @OA\Property(
     *     title="Order",
     *     description="Element display order",
     *     example=0
     * )
     *
     * @var int $order
     */
    public int $order;

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
