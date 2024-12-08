<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});


Route::apiResource('users', App\Http\Controllers\UserController::class);

Route::apiResource('accounts', App\Http\Controllers\AccountController::class);

Route::apiResource('plans', App\Http\Controllers\PlanController::class);

Route::apiResource('orders', App\Http\Controllers\OrderController::class);
