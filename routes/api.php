<?php

use App\Http\Controllers\Api\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Route::get('posts', [PostController::class, 'index']);
// Route::get('post/{id}', [PostController::class, 'show']);
// Route::post('post', [PostController::class, 'store']);
// Route::put('post/{id}', [PostController::class, 'update']);
// Route::delete('post/{id}', [PostController::class, 'destroy']);

Route::apiResource('posts', PostController::class);
