<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return ['Laravel' => app()->version()];
});

require __DIR__.'/auth.php';


Route::resource('users', App\Http\Controllers\UserController::class)->except('create', 'edit');

Route::resource('accounts', App\Http\Controllers\AccountController::class)->except('create', 'edit');

Route::resource('plans', App\Http\Controllers\PlanController::class)->except('create', 'edit');

Route::resource('orders', App\Http\Controllers\OrderController::class)->except('create', 'edit');

Route::resource('order-items', App\Http\Controllers\OrderItemController::class)->only('store', 'destroy');


Route::resource('users', App\Http\Controllers\UserController::class)->except('create', 'edit');

Route::resource('accounts', App\Http\Controllers\AccountController::class)->except('create', 'edit');

Route::resource('plans', App\Http\Controllers\PlanController::class)->except('create', 'edit');

Route::resource('orders', App\Http\Controllers\OrderController::class)->except('create', 'edit');

Route::resource('order-items', App\Http\Controllers\OrderItemController::class)->only('store', 'destroy');


Route::resource('users', App\Http\Controllers\UserController::class)->except('create', 'edit');

Route::resource('accounts', App\Http\Controllers\AccountController::class)->except('create', 'edit');

Route::resource('plans', App\Http\Controllers\PlanController::class)->except('create', 'edit');

Route::resource('orders', App\Http\Controllers\OrderController::class)->except('create', 'edit');

Route::resource('order-items', App\Http\Controllers\OrderItemController::class)->only('store', 'destroy');


Route::resource('users', App\Http\Controllers\UserController::class)->except('create', 'edit');

Route::resource('accounts', App\Http\Controllers\AccountController::class)->except('create', 'edit');

Route::resource('plans', App\Http\Controllers\PlanController::class)->except('create', 'edit');

Route::resource('orders', App\Http\Controllers\OrderController::class)->except('create', 'edit');

Route::resource('order-items', App\Http\Controllers\OrderItemController::class)->only('store', 'destroy');
