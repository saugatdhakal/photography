<?php

use App\Http\Controllers\AlbumController;
use App\Http\Controllers\CustomerTransationController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::post('/login', [UserController::class, 'login']);

// Websites API's
Route::controller(PhotoController::class)
    ->prefix('photo')
    ->group(function () {
        Route::get('/all',  'allPhotos');
        Route::get('/{id}',  'getPhoto');
    });

Route::controller(TransactionController::class)
    ->group(function () {
        Route::get('/handle-payment/{id}',  'handlePayment')->name('transaction.handlePayment');
        Route::get('/cancel-payment', 'paymentCancel')->name('transaction.paymentCancel');
        Route::get('/payment-success/{photo_id}', 'paymentSuccess')->name('transaction.paymentSuccess');
        Route::get('/payment-response', 'paymentResponse')->name('transaction.paymentResponse');
    });


Route::controller(CustomerTransationController::class)
    ->prefix('customer')
    ->group(function () {
        Route::get('/transaction/{id}', 'searchCustomerTransaction');
    });


// Dashboard Public Routes
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/tokenStatus/{token}', [UserController::class, 'tokenStatus']);

    Route::apiResource('image', PhotoController::class);

    Route::controller(AlbumController::class)
        ->prefix('album')
        ->group(function () {
            Route::get('/list', 'list');
            Route::post('/create', 'create');
        });

    Route::get('/tokenStatus/{token}', [UserController::class, 'tokenStatus']);
});
