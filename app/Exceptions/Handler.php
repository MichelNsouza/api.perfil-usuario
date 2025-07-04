<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\JsonResponse;

class Handler extends ExceptionHandler
{

    protected $dontReport = [];

    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];


    public function render($request, Throwable $e): JsonResponse
    {
        if ($e instanceof ModelNotFoundException) {
            return response()->json(['error' => 'Recurso não encontrado'], 404);
        }

        if ($e instanceof ValidationException) {
            return parent::render($request, $e);
        }

        return response()->json([
            'error' => 'Erro interno do servidor',
            'mensagem' => env('APP_DEBUG') ? $e->getMessage() : null,
        ], 500);
    }
}
