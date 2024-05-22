<?php

namespace App\Virtual\Models;

use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     title="UserProfile",
 *     description="User profile model",
 *     required={"user_id", "first_name", "surname"},
 *     @OA\Xml(
 *         name="UserProfile"
 *     )
 * )
 */
class UserProfile
{
    /**
     * @OA\Property(
     *     title="User id",
     *     description="User id",
     *     format="int128",
     *     example=1
     * )
     *
     * @var int $user_id
     */
    private int $user_id;

    /**
     * @OA\Property(
     *     title="First name",
     *     example="Николай"
     * )
     *
     * @var string $first_name
     */
    public string $first_name;

    /**
     * @OA\Property(
     *     title="Surname",
     *     example="Морозов"
     * )
     *
     * @var string $surname
     */
    public string $surname;

    /**
     * @OA\Property(
     *     title="Last name",
     *     example="Михайлович"
     * )
     *
     * @var string|null $last_name
     */
    public ?string $last_name;

    /**
     * @OA\Property(
     *     title="Phone",
     *     example="+7(951)712-13-25"
     * )
     *
     * @var string|null $phone
     */
    public ?string $phone;
}
