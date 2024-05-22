<?php

namespace App\Virtual\Models;

use DateTime;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     title="Page",
 *     description="Page model",
 *     required={"id", "name", "url", "active", "order"},
 *     @OA\Xml(
 *         name="Page"
 *     )
 * )
 */
class Page
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
     *     description="Name of the new page",
     *     example="Название страницы"
     * )
     *
     * @var string $name
     */
    public string $name;

    /**
     * @OA\Property(
     *     title="Url",
     *     description="Url of the new page",
     *     example="/page"
     * )
     *
     * @var string $url
     */
    public string $url;

    /**
     * @OA\Property(
     *     title="Content",
     *     description="Content of the new page",
     *     example="Содержание страницы"
     * )
     *
     * @var string|null $content
     */
    public ?string $content;

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
