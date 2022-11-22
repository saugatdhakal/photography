<?php

use App\Http\Controllers\PhotoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

// Public Routes
Route::post('/login', [UserController::class, 'login']);

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/tokenStatus/{token}', [UserController::class, 'tokenStatus']);
    Route::apiResource('image', PhotoController::class);
});
