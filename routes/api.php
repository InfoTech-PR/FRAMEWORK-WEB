<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\FuncionarioController;
use App\Http\Resources\UsuarioResource;

Route::post('auth/login', [AuthController::class, 'login']);
Route::group(['prefix' => 'auth'], function () {
  Route::post('register', [AuthController::class, 'register']);
  Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::get('logout', [AuthController::class, 'logout']);
    Route::get('user', [AuthController::class, 'user']);
  });
});

Route::get('/user', function (Request $request) {
  return new UsuarioResource($request->user());
})->middleware('auth:sanctum');

Route::group(['prefix' => 'dashboards'], function () {
  //O que inserir aqui exatamente?
});

Route::get('/clientes', [ClienteController::class, 'index']);
Route::get('/funcionarios', [FuncionarioController::class, 'index']);
