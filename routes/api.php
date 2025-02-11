<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\NFSDashboardController;
use App\Http\Controllers\FatDashboardController;
use App\Http\Controllers\AuthController;
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
  Route::get('clientes-os', [DashboardController::class, 'clientes_os']);
  
});
