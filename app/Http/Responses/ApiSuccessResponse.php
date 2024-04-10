<?php

namespace App\Http\Responses;

use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\JsonResponse;

class ApiSuccessResponse implements Responsable
{
    /**
     * @param mixed $result
     * @param string $message
     */
    public function __construct(
        private readonly mixed $result,
        private readonly string $message,
    ) {}

    /**
     * @param  $request
     * @return JsonResponse
     */
    public function toResponse($request): JsonResponse
    {
        return response()->json(
            [
                'success' => true,
                'data'    => $this->result,
                'message' => $this->message,
            ]
        );
    }
}
