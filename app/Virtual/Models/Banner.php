<?php

namespace App\Virtual\Models;

use DateTime;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     title="Banner",
 *     description="Banner model",
 *     required={"id", "name", "image", "active", "order"},
 *     @OA\Xml(
 *         name="Banner"
 *     )
 * )
*/
class Banner
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
     *     description="Name of banner",
     *     example="Название для администратора"
     * )
     *
     * @var string $name
     */
    public string $name;

    /**
     * @OA\Property(
     *     title="Title",
     *     description="Title of banner",
     *     example="Отображаемое название"
     * )
     *
     * @var string|null $title
     */
    public ?string $title;

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
     *     title="Url",
     *     description="Link where the banner will lead",
     *     example="/catalog"
     * )
     *
     * @var string|null $url
     */
    public ?string $link;

    /**
     * @OA\Property(
     *     title="Text",
     *     description="Text of the new banner",
     *     example="Lorem ipsum dolor sit amet, consectetur adipisicing elit. Atque aut consequuntur delectus"
     * )
     *
     * @var string|null $text
     */
    public ?string $text;

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
