<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BouquetController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ConfirmationController;
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
Auth::routes();
Route::get('/', function () {
    return view('home');
});

Route::resources([
    'bouquets'=>BouquetController::class,
    'carts'=>CartController::class,
    'checkouts'=>CheckoutController::class,
    'confirmations'=>ConfirmationController::class,
]);

Route::post('/carts/switchToSaveForLater/{bouquet}', [CartController::class, 'switchToSaveForLater'])->name('carts.switchToSaveForLater');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
