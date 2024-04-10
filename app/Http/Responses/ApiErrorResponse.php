<?php

namespace App\Http\Responses;

use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ApiErrorResponse implements Responsable
{
    /**
     * @param string $error
     * @param array $errorMessages
     * @param int $code
     */
    public function __construct(
        private readonly string $error,
        private readonly array $errorMessages = [],
        private readonly int $code = Response::HTTP_NOT_FOUND,
    ) {}

    /**
     * @param  $request
     * @return JsonResponse
     */
    public function toResponse($request): JsonResponse
    {
        $response = [
            'success' => false,
            'message' => $this->error,
        ];

        if(!empty($this->errorMessages)){
            $response['data'] = $this->errorMessages;
        }

        return response()->json($response, $this->code);
    }
}
