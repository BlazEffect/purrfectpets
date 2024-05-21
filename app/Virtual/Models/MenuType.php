<?php

namespace App\Virtual\Models;

use DateTime;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     title="MenuType",
 *     description="Menu type model",
 *     required={"id", "name", "key", "active"},
 *     @OA\Xml(
 *         name="MenuType"
 *     )
 * )
 */
class MenuType
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
     *     description="Name of the new menu",
     *     example="Header menu"
     * )
     *
     * @var string $name
     */
    public string $name;

    /**
     * @OA\Property(
     *     title="Key",
     *     description="Key of the new menu",
     *     example="header_menu"
     * )
     *
     * @var string $key
     */
    public string $key;

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
