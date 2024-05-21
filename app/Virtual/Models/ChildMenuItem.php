<?php

namespace App\Virtual\Models;

use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     title="ChildMenuItem",
 *     description="Menu item model",
 *     required={"id", "menu_type_id", "name", "active", "order"},
 *     @OA\Xml(
 *         name="ChildMenuItem"
 *     )
 * )
 */
class ChildMenuItem
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
     *     title="Menu type ID",
     *     format="int128",
     *     example=1
     * )
     *
     * @var int $menu_type_id
     */
    public int $menu_type_id;

    /**
     * @OA\Property(
     *     title="Name",
     *     description="Name of menu item",
     *     example="Catalog"
     * )
     *
     * @var string $name
     */
    public string $name;

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
     *     title="Icon",
     *     description="An icon that will be displayed next to the text",
     *     example="fa-catalog"
     * )
     *
     * @var string|null $icon
     */
    public ?string $icon;

    /**
     * @OA\Property(
     *     title="Url",
     *     description="Link where the menu item will lead",
     *     example="/catalog"
     * )
     *
     * @var string|null $url
     */
    public ?string $url;
}
