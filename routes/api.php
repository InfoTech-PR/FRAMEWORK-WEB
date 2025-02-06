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
  Route::get('os-cliente/{id}', [DashboardController::class, 'os_cliente']);
  Route::get('os-detail/{id}', [DashboardController::class, 'os_detail']);
  Route::post('clientes-os-date', [DashboardController::class, 'clientes_os_date']);
  Route::post('os-cliente/{id}/filter', [DashboardController::class, 'os_cliente_filter']);
  Route::get('clientes-nfs', [NFSDashboardController::class, 'clientes_nfs']);
  Route::post('clientes-nfs-date', [NFSDashboardController::class, 'clientes_nfs_date']);
  Route::get('nfs-cliente/{id}', [NFSDashboardController::class, 'nfs_cliente']);
  Route::get('nfs-detail/{id}', [NFSDashboardController::class, 'nfs_detail']);
  Route::get('faturamento-geral', [FatDashboardController::class, 'faturamento_geral']);
});
