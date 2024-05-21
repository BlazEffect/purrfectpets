<?php

namespace App\Virtual\Models;

use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     title="OrderProduct",
 *     required={"product_id", "count"},
 *     @OA\Xml(
 *         name="OrderProduct"
 *     )
 * )
 */
class OrderProduct
{
    /**
     * @OA\Property(
     *     title="Product ID",
     *     format="int128",
     *     example=1
     * )
     *
     * @var int $product_id
     */
    public int $product_id;

    /**
     * @OA\Property(
     *     title="Count",
     *     example=1
     * )
     *
     * @var int $count
     */
    public int $count;
}
