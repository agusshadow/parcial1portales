<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\NewsController as AdminNewsController;
use App\Http\Controllers\Admin\PlatformController;
use App\Http\Controllers\Admin\GenderController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;

// Home
Route::get('/', [HomeController::class, 'index'])->name('home');

// Products
Route::resource('products', ProductController::class)->only(['index', 'show']);

// News
Route::resource('news', NewsController::class)->only(['index', 'show']);

//Admin
Route::prefix('admin')->name('admin.')->middleware(AdminMiddleware::class)->group(function () {
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

    // News Admin
    Route::get('/news/{id}/confirm-delete', [AdminNewsController::class, 'confirmDelete'])->name('news.confirm-delete');
    Route::resource('news', AdminNewsController::class)->except(['show']);

    // Platforms Admin
    Route::get('/platforms/{id}/confirm-delete', [PlatformController::class, 'confirmDelete'])->name('platforms.confirm-delete');
    Route::resource('platforms', PlatformController::class)->except(['show']);

    // Genders Admin
    Route::get('/genders/{id}/confirm-delete', [GenderController::class, 'confirmDelete'])->name('genders.confirm-delete');
    Route::resource('genders', GenderController::class)->except(['show']);

    // Users Admin
    Route::get('/users/{id}/confirm-delete', [UserController::class, 'confirmDelete'])->name('users.confirm-delete');
    Route::resource('users', UserController::class)->except(['show']);

    // Orders Admin
    Route::resource('orders', AdminOrderController::class);
});

// Auth
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {

    // Cart
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
    Route::patch('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
    Route::get('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');

    // Checkout
    Route::get('/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
    Route::post('/checkout/process', [CartController::class, 'processOrder'])->name('cart.process');
    Route::get('/checkout/thank-you', [CartController::class, 'thankYou'])->name('cart.thank-you');

    // Order
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{id}', [OrderController::class, 'show'])->name('orders.show');
    Route::post('/orders/{id}/cancel', [OrderController::class, 'cancel'])->name('orders.cancel');
});
