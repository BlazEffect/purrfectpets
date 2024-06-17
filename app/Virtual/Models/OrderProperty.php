<?php

namespace App\Virtual\Models;

use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     title="OrderProperty",
 *     description="Order property model",
 *     required={"order_id", "FIO", "email", "phone", "comment"},
 *     @OA\Xml(
 *         name="OrderProperty"
 *     )
 * )
 */
class OrderProperty
{
    /**
     * @OA\Property(
     *     title="OrderId",
     *     description="Order id",
     *     format="int128",
     *     example=1
     * )
     *
     * @var int $order_id
     */
    public int $order_id;

    /**
     * @OA\Property(
     *     title="FIO",
     *     example="Морозов Николай Михайлович"
     * )
     *
     * @var string $FIO
     */
    public string $FIO;

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
     *     title="Phone",
     *     example="+7(951)712-13-25"
     * )
     *
     * @var string|null $phone
     */
    public ?string $phone;

    /**
     * @OA\Property(
     *     title="Comment",
     *     example="Lorem ipsum dolor sit amet, consectetur adipisicing elit. Commodi laborum magnam maxime quia ut? Aperiam autem"
     * )
     *
     * @var string|null $comment
     */
    public ?string $comment;
}
