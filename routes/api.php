<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::resource('dashboard', App\Http\Controllers\DashboardController::class);
Route::resource('categories', App\Http\Controllers\CategoriesController::class);
Route::resource('news', App\Http\Controllers\NewsController::class);