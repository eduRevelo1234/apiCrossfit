<?php

use App\Http\Controllers\PlanController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::controller(RolController::class)->prefix('rol')->group(function () {
    Route::get('/', 'index');
    Route::post('/', 'store');
    Route::post('/{id}', 'update');
    Route::put('/{id}', 'put');
    Route::get('/{id}', 'show');
    Route::delete('/{id}', 'destroy');
});

Route::controller(UserController::class)->prefix('user')->group(function () {
    Route::get('/', 'index');
    Route::post('/', 'store');
    Route::post('/{id}', 'update');
    Route::put('/{id}', 'put');
    Route::get('/{id}', 'show');
    Route::delete('/{id}', 'destroy');
});

Route::controller(PlanController::class)->prefix('plan')->group(function () {
    Route::get('/', 'index');
    Route::post('/', 'store');
    Route::post('/{id}', 'update');
    Route::put('/{id}', 'put');
    Route::get('/{id}', 'show');
    Route::delete('/{id}', 'destroy');
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});