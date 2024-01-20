<?php

use App\Http\Controllers\ProfileController;
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
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

Route::prefix('/product')->group(function () {
    Route::get('/search', [\App\Http\Controllers\ProductController::class, 'search'])
        ->name('product.search');
    Route::get('/{id}', [\App\Http\Controllers\ProductController::class, 'show'])
        ->name('product.show');
});
Route::prefix('/cart')->group(function () {
    Route::get('/',[\App\Http\Controllers\CartController::class, 'show'])
        ->name('cart.show');
    Route::post('/add',[\App\Http\Controllers\CartController::class, 'add'])
        ->name('cart.add.ajax');
    Route::post('/remove',[\App\Http\Controllers\CartController::class, 'remove'])
        ->name('cart.remove.ajax');
    Route::get('/clear',[\App\Http\Controllers\CartController::class, 'clear'])
        ->name('cart.clear.ajax');
    Route::get('/clear',[\App\Http\Controllers\CartController::class, 'delete'])
        ->name('cart.delete.ajax');
});
Route::prefix('/order')->group(function () {
    Route::get('/')
        ->name('order.show');
    Route::post('/')
        ->name('order.registry');
});
