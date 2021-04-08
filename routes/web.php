<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BouquetController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ConfirmationController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

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
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resources([
    'bouquets'=>BouquetController::class,
    'users'=>UserController::class,
]);

Route::get('/register/user', [RegisterController::class,'showUserRegisterForm']);
Route::get('/login/admin', [LoginController::class, 'showAdminLoginForm']);
Route::get('/register/admin', [RegisterController::class,'showAdminRegisterForm']);
Route::view('unauthorized', 'unauthorized');

Route::middleware('auth')->group(function () {
    Route::resources([
        'carts'=>CartController::class,
        'checkouts'=>CheckoutController::class,
        'confirmations'=>ConfirmationController::class,
        'orders'=>OrderController::class,
        'users'=>UserController::class,
        'orders'=>OrderController::class,
    ]);
});

