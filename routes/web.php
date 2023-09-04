<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Models\Category;
use App\Models\Product;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $categories = Category::all();
    $products = Product::all();
    return view('dashboard', compact('categories', 'products'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/cart', [CartController::class, 'index'])->name('cart');
    Route::get('/add-to-cart/{id}', [CartController::class, 'index2'])->name('add.to.cart');
    Route::post('/addToCart/{id}', [CartController::class, 'create'])->name('addToCart');
    Route::get('/edit-cart/{id}', [CartController::class, 'edit'])->name('edit.cart');
    Route::patch('/update-cart/{id}', [CartController::class, 'update'])->name('update.cart');
    Route::delete('/delete-cart/{id}', [CartController::class, 'delete'])->name('delete.cart');
    Route::get('/invoice', [InvoiceController::class, 'index'])->name('invoice');
    Route::get('/buy-product-now/{id}', [InvoiceController::class, 'index2'])->name('buy.product.now');
    Route::post('/buyProductNow/{id}', [InvoiceController::class, 'create'])->name('buyProductNow');
    Route::get('/buy-product/{id}', [InvoiceController::class, 'index3'])->name('buy.product');
    Route::post('/buyProduct/{id}', [InvoiceController::class, 'create2'])->name('buyProduct');
});

Route::middleware('auth', 'admin')->group(function () {
    Route::get('/add-category', [CategoryController::class, 'index'])->name('add.category');
    Route::get('/add-product', [ProductController::class, 'index'])->name('add.product');
    Route::post('/addCategory', [CategoryController::class, 'create'])->name('addCategory');
    Route::post('/addProduct', [ProductController::class, 'create'])->name('addProduct');
    Route::get('/edit-product/{id}', [ProductController::class, 'edit'])->name('edit.product');
    Route::patch('/update-product/{id}', [ProductController::class, 'update'])->name('update.product');
    Route::delete('/delete-product/{id}', [ProductController::class, 'delete'])->name('delete.product');
});

require __DIR__.'/auth.php';
