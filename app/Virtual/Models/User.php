<?php

namespace App\Virtual\Models;

use DateTime;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     title="User",
 *     description="User model",
 *     required={"id", "email", "password", "active"},
 *     @OA\Xml(
 *         name="User"
 *     )
 * )
 */
class User
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
     *     title="Email",
     *     description="Email",
     *     example="morozov@test.com"
     * )
     *
     * @var string $email
     */
    public string $email;

    /**
     * @OA\Property(
     *     title="Email verified at",
     *     description="Email verified at",
     *     example="2024-04-08 00:00:00",
     *     format="datetime",
     *     type="string"
     * )
     *
     * @var DateTime|null $email_verified_at
     */
    private ?DateTime $email_verified_at;

    /**
     * @OA\Property(
     *     title="Password",
     *     example="gnijgheofjds094u645839gre3454"
     * )
     *
     * @var string $password
     */
    private string $password;

    /**
     * @OA\Property(
     *     title="Remember token",
     *     example="ghkjgjhoifu9043u9isd;fewoi430y"
     * )
     *
     * @var string|null $remember_token
     */
    private ?string $remember_token;

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
    private ?Datetime $created_at;

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
    private ?Datetime $updated_at;

    /**
     * @OA\Property(
     *     title="Active",
     *     example=true
     * )
     *
     * @var bool $active
     */
    public bool $active;
}
