<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\NewsController;

Route::get('/', function () {
    return view('home');
});

Route::get('/products/{id}/confirm-delete', [ProductController::class, 'confirmDelete'])->name('products.confirm-delete');

Route::resource('products', ProductController::class);

// News
Route::resource('news', NewsController::class);

// Auth
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
