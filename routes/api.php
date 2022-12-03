<?php

use App\Http\Controllers\AlbumController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;


Route::post('/login', [UserController::class, 'login']);

// Websites API's
Route::get('/photo/all', [PhotoController::class, 'allPhotos']);
Route::get('/photo/{id}', [PhotoController::class, 'getPhoto']);

Route::get('/handle-payment', [TransactionController::class, 'handlePayment'])->name('transaction.handlePayment');
Route::get('/cancel-payment', [TransactionController::class, 'paymentCancel'])->name('transaction.paymentCancel');
Route::get('/payment-payment', [TransactionController::class, 'paymentSuccess'])->name('transaction.paymentSuccess');
Route::get('/payment-response',[TransactionController::class, 'paymentResponse'])->name('transaction.paymentResponse');

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
