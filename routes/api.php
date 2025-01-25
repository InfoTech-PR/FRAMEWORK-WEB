<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Resources\UsuarioResource;

Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth:sanctum');

Route::get('/user', function (Request $request) {
    return new UsuarioResource($request->user());
})->middleware('auth:sanctum');
