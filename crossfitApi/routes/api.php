<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\ClaseController;
use App\Http\Controllers\ExerciseController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\RutineController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::controller(RolController::class)->prefix('rol')->group(function () {
    Route::get('/search', 'search');
    Route::get('/', 'index');
    Route::post('/', 'store');
    Route::post('/{id}', 'update');
    Route::put('/{id}', 'put');
    Route::get('/{id}', 'show');
    Route::delete('/{id}', 'destroy');
});

Route::controller(UserController::class)->prefix('user')->group(function () {
    Route::post('/validate', 'validateLogIn');
    Route::get('/search', 'search');
    Route::get('/', 'index');
    Route::post('/', 'store');
    Route::post('/{id}', 'update');
    Route::put('/{id}', 'put');
    Route::get('/{id}', 'show');
    Route::delete('/{id}', 'destroy');
});

Route::controller(PlanController::class)->prefix('plan')->group(function () {
    Route::get('/search', 'search');
    Route::get('/', 'index');
    Route::post('/', 'store');
    Route::post('/{id}', 'update');
    Route::put('/{id}', 'put');
    Route::get('/{id}', 'show');
    Route::delete('/{id}', 'destroy');
});

Route::controller(SubscriptionController::class)->prefix('subscription')->group(function () {
    Route::get('/search', 'search');
    Route::get('/', 'index');
    Route::post('/', 'store');
    Route::post('/{id}', 'update');
    Route::put('/{id}', 'put');
    Route::get('/{id}', 'show');
    Route::delete('/{id}', 'destroy');
});

Route::controller(RutineController::class)->prefix('rutine')->group(function () {
    Route::get('/search', 'search');
    Route::get('/', 'index');
    Route::post('/', 'store');
    Route::post('/{id}', 'update');
    Route::put('/{id}', 'put');
    Route::get('/{id}', 'show');
    Route::delete('/{id}', 'destroy');
});

Route::controller(ClaseController::class)->prefix('clase')->group(function () {
    Route::get('/search', 'search');
    Route::get('/', 'index');
    Route::post('/', 'store');
    Route::post('/{id}', 'update');
    Route::put('/{id}', 'put');
    Route::get('/{id}', 'show');
    Route::delete('/{id}', 'destroy');
});

Route::controller(BookingController::class)->prefix('booking')->group(function () {
    Route::get('/search', 'search');
    Route::get('/', 'index');
    Route::post('/', 'store');
    Route::post('/{id}', 'update');
    Route::put('/{id}', 'put');
    Route::get('/{id}', 'show');
    Route::delete('/{id}', 'destroy');
});

Route::controller(ExerciseController::class)->prefix('exercise')->group(function () {
    Route::get('/search', 'search');
    Route::get('/', 'index');
    Route::post('/', 'store');
    Route::post('/{id}', 'update');
    Route::put('/{id}', 'put');
    Route::get('/{id}', 'show');
    Route::delete('/{id}', 'destroy');
});

Route::controller(ResultController::class)->prefix('result')->group(function () {
    Route::get('/search', 'search');
    Route::get('/', 'index');
    Route::post('/', 'store');
    Route::post('/{id}', 'update');
    Route::put('/{id}', 'put');
    Route::get('/{id}', 'show');
    Route::delete('/{id}', 'destroy');
});

Route::controller(PaymentController::class)->prefix('payment')->group(function () {
    Route::get('/search', 'search');
    Route::get('/', 'index');
    Route::post('/', 'store');
    Route::post('/{id}', 'update');
    Route::put('/{id}', 'put');
    Route::get('/{id}', 'show');
    Route::delete('/{id}', 'destroy');
});

/*
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/