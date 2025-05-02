<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;

// Home
Route::get('/', function () {
    return view('home');
});

// Products
Route::resource('products', ProductController::class)->only(['index', 'show']);

//Admin
Route::prefix('admin')->name('admin.')->group(function () {
    // Home redirect
    Route::get('/', function () {
        return redirect()->route('admin.dashboard');
    });

    // Dashboard
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    // Products Admin
    Route::get('/products/{id}/confirm-delete', [AdminProductController::class, 'confirmDelete'])->name('products.confirm-delete');
    Route::resource('products', AdminProductController::class)->except(['show']);
});


// News
Route::resource('news', NewsController::class);

// Auth
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
