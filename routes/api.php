<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Services\UsuarioService;
use App\Http\Controllers\UsuarioController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('usuarios', UsuarioController::class);
Route::post('/usuarios/{id}/foto', [UsuarioController::class, 'atualizarFoto']);
