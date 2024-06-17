<?php

namespace App\Virtual\Models;

use DateTime;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     title="Brand",
 *     description="Brand model",
 *     required={"id", "name", "slug", "active", "order"},
 *     @OA\Xml(
 *         name="Brand"
 *     )
 * )
 */
class Brand
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
     *     description="Name of the new brand",
     *     example="Royal Canin"
     * )
     *
     * @var string $name
     */
    public string $name;

    /**
     * @OA\Property(
     *     title="Slug",
     *     description="Slug of the new brnad",
     *     example="royal_canin"
     * )
     *
     * @var string $slug
     */
    public string $slug;

    /**
     * @OA\Property(
     *     title="Decription",
     *     description="Decription of the new brnad",
     *     example="Lorem ipsum dolor sit amet, consectetur adipisicing elit. Atque aut consequuntur delectus"
     * )
     *
     * @var string|null $decription
     */
    public ?string $decription;

    /**
     * @OA\Property(
     *     title="Image",
     *     description="Image",
     *     example="gnuithiugh598.png"
     * )
     *
     * @var string $image
     */
    public string $image;

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
