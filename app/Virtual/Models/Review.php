<?php

namespace App\Virtual\Models;

use DateTime;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     title="Review",
 *     required={"id", "user_id", "status", "name", "rating_value"},
 *     @OA\Xml(
 *         name="Review"
 *     )
 * )
 */
class Review
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
     *     description="Status for review",
     *     example=1
     * )
     *
     * @var bool $status
     */
    public bool $status;

    /**
     * @OA\Property(
     *     title="Name",
     *     description="Name of the new review",
     *     example="John Doe"
     * )
     *
     * @var string $name
     */
    public string $name;

    /**
     * @OA\Property(
     *     title="Text",
     *     description="Review text",
     *     example="Lorem ipsum dolor sit amet, consectetur adipisicing elit. Commodi laborum magnam maxime quia ut? Aperiam autem"
     * )
     *
     * @var string $text
     */
    public string $text;

    /**
     * @OA\Property(
     *     title="Rating value",
     *     description="Rating",
     *     example=1
     * )
     *
     * @var int $rating_value
     */
    public int $rating_value;

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
