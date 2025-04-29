<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return view('home');
});

Route::get('/products/{id}/confirm-delete', [ProductController::class, 'confirmDelete'])->name('products.confirm-delete');

Route::resource('products', ProductController::class);

Route::get('/news', function () {
    return view('news');
});

route::get('/login', function () {
    return view('auth.login');
});

Route::get('/register', function () {
    return view('auth.register');
});
