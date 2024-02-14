<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [LoginController::class, 'login'])->name('login')->middleware('guest');
Route::post('/', [LoginController::class, 'authenticate'])->middleware('guest');
Route::get('/logout', [LoginController::class, 'logout'])->middleware('auth');

Route::get('/register', [RegisterController::class, 'register'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'input'])->middleware('guest');

Route::resource('/admin/products', ProductController::class)->middleware('auth', 'admin');

Route::get('/products', [UserController::class, 'user'])->middleware('auth');
Route::post('/addToCart/{id}', [UserController::class, 'addToCart'])->middleware('auth');

Route::get('/cart', [UserController::class, 'cart'])->middleware('auth');
Route::post('/cart', [UserController::class, 'checkout'])->middleware('auth');
Route::post('/cart/update/{id}', [UserController::class, 'updateCart'])->middleware('auth');
Route::delete('/cart/delete/{id}', [UserController::class, 'deleteCart'])->middleware('auth');