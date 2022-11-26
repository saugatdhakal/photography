<?php
use App\Http\Controllers\AlbumController;
use App\Http\Controllers\PhotoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

// Public Routes
Route::post('/login', [UserController::class, 'login']);

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/tokenStatus/{token}', [UserController::class, 'tokenStatus']);

    Route::apiResource('image', PhotoController::class);

    Route::controller(AlbumController::class)
    ->prefix('album')
    ->group(function(){
        Route::get('/list','list');
        Route::post('/create','create');
    });

    Route::get('/tokenStatus/{token}', [UserController::class, 'tokenStatus']);

});
