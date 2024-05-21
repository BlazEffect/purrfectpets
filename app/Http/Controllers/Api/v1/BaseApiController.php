<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use OpenApi\Annotations as OA;

/**
 * @OA\OpenApi(
 *     @OA\Info(
 *         version="1.0.0",
 *         title="PurrfectPets",
 *         description="",
 *     ),
 *     @OA\Server(
 *         description="API Server",
 *         url=L5_SWAGGER_CONST_HOST
 *     ),
 *     @OA\ExternalDocumentation(
 *         description="Узнайте больше о Swagger",
 *         url="https://swagger.io"
 *     )
 * ),
 * @OA\SecurityScheme(
 *     scheme="Bearer",
 *     securityScheme="Bearer",
 *     type="apiKey",
 *     in="header",
 *     name="Authorization",
 * )
 */
class BaseApiController extends Controller
{
}
