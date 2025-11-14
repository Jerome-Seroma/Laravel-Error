<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShopController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\AdminController;

Route::resource('products', ProductController::class)
    ->middleware(['auth']); 

Route::get('/', function () {
    return view('welcome');
});

Route::get('/shop', [ShopController::class, 'index'])->name('shop');

// Shopping Cart Routes
Route::get('/cart',[CartController::class,'index'])->name('cart.index');
Route::post('/cart/add/{product}', [CartController::class, 'store'])->name('cart.store');
Route::delete('/cart/remove/{rowId}', [CartController::class, 'destroy'])->name('cart.destroy');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard' , function(){
        return view('dashboard');
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Checkout Controller

    Route::get('/checkout', [CheckoutController::class, 'create'])->name('checkout.create')->middleware('auth');
    Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store')->middleware('auth');
    Route::get('/checkout/success', [CheckoutController::class, 'success'])->name('checkout.success');
});







//Admin routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function(){
// Admin dashboard
Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

//Product Management
Route::resource('products', ProductController::class);
Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('product.destroy');
Route::post('/products', [ProductController::class, 'store'])->name('products.store');
Route::patch('/products/{id}/update', [ProductController::class, 'Update'])->name('products.update');
Route::get('/products/{id}', [ProductController::class, 'edit'])->name('products.edit');

//Category Management
Route::resource('categories', CategoryController::class);
Route::get('/categories', [CategoryController::class, 'index'])->name('category.index');
Route::post('/categories', [CategoryController::class, 'store'])->name('category.store');
Route::delete('/categories/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');

//Order Management
Route::get('/orders', [AdminController::class, 'orders'])->name('orders.index');
Route::get('/orders/{order}', [AdminController::class, 'showOrder'])->name('orders.show');
Route::patch('/orders/{order}/status', [AdminController::class, 'updateOrderStatus'])->name('order.updateStatus');

});

require __DIR__.'/auth.php';
