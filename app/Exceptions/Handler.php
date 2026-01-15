<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $e)
    {
        // 🔐 Unauthenticated (token missing/expired/invalid)
        if ($e instanceof AuthenticationException) {
            return response()->json([
                'status' => false,
                'message' => 'Token is expired or invalid. Please login again.'
            ], 401);
        }

        // ❌ Validation errors
        if ($e instanceof ValidationException) {
            return response()->json([
                'status' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors(),
            ], 422);
        }

        // 🔍 Not found
        if ($e instanceof NotFoundHttpException) {
            return response()->json([
                'status' => false,
                'message' => 'API endpoint not found.'
            ], 404);
        }

        // ⚠️ Other HTTP errors
        if ($e instanceof HttpExceptionInterface) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage() ?: 'Request error'
            ], $e->getStatusCode());
        }

        // 💥 Server error
        return response()->json([
            'status' => false,
            'message' => 'Server error',
        ], 500);
    }
}
