<?php

namespace App\Http\Middleware;

use App\Http\Responses\ApiErrorResponse;
use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        return $request->expectsJson() ? null : route('login');
    }

    public function handle($request, Closure $next, ...$guards): ApiErrorResponse|JsonResponse
    {
        foreach ($guards as $guard) {
            if ($this->auth->guard($guard)->check()) {
                $this->auth->shouldUse($guard);

                return $next($request);
            }
        }

        return new ApiErrorResponse('Вы не авторизованы.', [], Response::HTTP_UNAUTHORIZED);
    }
}
