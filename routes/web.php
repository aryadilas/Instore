<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductPhotoController;
use App\Http\Controllers\TransactionController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


// Route::domain('admin.' . env('APP_URL'))->group(function () {
    // Route::get('/admin', function () { return 'THIS ADMIN PAGE'; })->name('homeAdmin');
    
    
// });

Route::post('/logout', [AuthController::class, 'logout']); 
Route::middleware(['auth'])->group(function () {
    

    Route::middleware(['admin'])->group(function () {
        Route::get('/admin', [PageController::class, 'indexAdmin']);

        Route::get('/product', [ProductController::class, 'index']);
        Route::get('/product/add', [ProductController::class, 'add']);
        Route::post('/product/add', [ProductController::class, 'store']);
        Route::get('/product/edit/{productId}', [ProductController::class, 'edit']);
        Route::put('/product/update/{productId}', [ProductController::class, 'update']);
        Route::patch('/product/delete/{productId}', [ProductController::class, 'delete']);
        Route::patch('/product/restore/{productId}', [ProductController::class, 'restore']);

        Route::post('/product/store/product-photo/{productId}', [ProductPhotoController::class, 'store']);
        Route::delete('/product/delete/product-photo/{productPhotoId}', [ProductPhotoController::class, 'delete']);
        Route::patch('/product/update/product-photo/{productPhotoId}', [ProductPhotoController::class, 'update']);
        
        Route::get('/transaction', [TransactionController::class, 'index']);
        Route::get('/transaction/{transactionId}', [TransactionController::class, 'show']);
        Route::patch('/transaction/payment/confirm/{transactionId}', [TransactionController::class, 'confirmPayment']);
        Route::patch('/transaction/payment/reject/{transactionId}', [TransactionController::class, 'rejectPayment']);
        Route::patch('/transaction/status/shipping/{transactionId}', [TransactionController::class, 'statusShipping']);
    });
    
    Route::middleware(['user'])->group(function () {
        Route::get('/catalogue/{productId}', [CatalogController::class, 'show']);

        Route::get('/cart', [CartController::class, 'index']);
        Route::post('/cart/store/{productId}', [CartController::class, 'store']);
        Route::patch('/cart/update/{productId}/{qty}', [CartController::class, 'update']);
        Route::delete('/cart/delete/{cardDetailId}', [CartController::class, 'delete']);

        Route::post('/checkoutConfirm', [CheckoutController::class, 'index']);
        Route::post('/checkout', [CheckoutController::class, 'checkout']);

        Route::get('/order', [OrderController::class, 'index']);
        Route::post('/order/cancel/{transactionId}', [OrderController::class, 'cancel']);
        Route::patch('/order/receipt/{transactionId}', [OrderController::class, 'receipt']);
        Route::patch('/order/finish/{transactionId}', [OrderController::class, 'finish']);
    });

});

Route::middleware(['guest'])->group(function () {
    Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'registerForm']);
    Route::post('/register', [AuthController::class, 'register']);
});

Route::middleware(['notAdmin'])->group(function () {
    Route::get('/', [PageController::class, 'index']);
    Route::get('/catalogue', [CatalogController::class, 'index']);
});






