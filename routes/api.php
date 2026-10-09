<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');





Route::middleware('auth:sanctum')->group(function () {
   Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
});


Route::middleware(['auth:sanctum'])->group(function(){
    Route::apiResource('products',ProductController::class); 
    Route::apiResource('orders', OrderController::class);
});