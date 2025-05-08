<?php

use App\Http\Controllers\Api\CategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\FoodController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');












Route::get('/categories', [CategoryController::class, 'index']);
Route::get('/categories/search', [CategoryController::class, 'search']);
Route::get('/searchall', [CategoryController::class, 'searchall']);
Route::get('/foods', [FoodController::class, 'index']);
Route::get('/foods/search', [FoodController::class, 'search']);
Route::get('/food/{id}',[FoodController::class,'show']);