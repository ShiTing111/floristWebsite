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

Route::resources([
    'bouquets'=>BouquetController::class,
    'users'=>UserController::class,
]);
// Route::get('/login', [LoginController::class, 'showUserLoginForm']);
Route::get('/register/user', [RegisterController::class,'showUserRegisterForm']);
// Route::post('/login', [LoginController::class,'userLogin']);
// Route::post('/register', [RegisterController::class,'createUser']);

// Route::get('/login/admin', [LoginController::class, 'showAdminLoginForm']);
Route::get('/register/admin', [RegisterController::class,'showAdminRegisterForm']);
// Route::post('/login/admin', [LoginController::class,'adminLogin']);
// Route::post('/register/admin', [RegisterController::class,'createAdmin']);

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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
