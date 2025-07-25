<?php

use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StyleController;
use App\Http\Controllers\StyleProductController;
use App\Http\Controllers\HomePageController;
use App\Http\Controllers\ClientStyleController;
use App\Http\Controllers\ClientProductController;
use App\Http\Controllers\ReciptController;
use App\Http\Controllers\SupplierController;

Route::get('/', [HomePageController::class, 'index'])->name('home');
Route::get('/estilos', [ClientStyleController::class, 'index'])->name('styles.list');
Route::get('/estilos/{style}', [ClientStyleController::class, 'show'])->name('styles.show');

Route::get('/produtos', [ClientProductController::class, 'index'])->name('products.list');
Route::get('/produtos/{products}', [ClientProductController::class, 'show'])->name('products.show');

Route::get('/admin', function () {
    return view('dashboard');
})->name('admin.index');

Route::prefix('clients')->group(function () {
    Route::get('/', [ClientController::class, 'index'])->name('clients.index');
    Route::get('/create', [ClientController::class, 'create'])->name('clients.create');
    Route::post('/create/store', [ClientController::class, 'store'])->name('clients.store');
    Route::get('/edit/{client}', [ClientController::class, 'edit'])->name('clients.edit');
    Route::put('/edit/{client}/update', [ClientController::class, 'update'])->name('clients.update');
    Route::delete('/delete/{client}/', [ClientController::class, 'destroy'])->name('clients.destroy');
    Route::get('/search', [ClientController::class, 'search'])->name('clients.search');
});

Route::prefix('events')->group(function () {
    Route::get('/', [EventController::class, 'index'])->name('events.index');
    Route::get('/create', [EventController::class, 'create'])->name('events.create');
    Route::post('/create/store', [EventController::class, 'store'])->name('events.store');
    Route::get('/edit/{event}', [EventController::class, 'edit'])->name('events.edit');
    Route::put('/edit/{event}/update', [EventController::class, 'update'])->name('events.update');
    Route::delete('/delete/{event}/', [EventController::class, 'destroy'])->name('events.destroy');
    Route::get('/search', [EventController::class, 'search'])->name('events.search');
});

Route::prefix('suppliers')->group(function () {
    Route::get('/', [SupplierController::class, 'index'])->name('suppliers.index');
    Route::get('/create', [SupplierController::class, 'create'])->name('suppliers.create');
    Route::post('/create/store', [SupplierController::class, 'store'])->name('suppliers.store');
    Route::get('/edit/{supplier}', [SupplierController::class, 'edit'])->name('suppliers.edit');
    Route::put('/edit/{supplier}/update', [SupplierController::class, 'update'])->name('suppliers.update');
    Route::delete('/delete/{supplier}/', [SupplierController::class, 'destroy'])->name('suppliers.destroy');
    Route::get('/search', [SupplierController::class, 'search'])->name('suppliers.search');
});
Route::prefix('styles')->group(function () {
    Route::get('/', [StyleController::class, 'index'])->name('styles.index');
    Route::get('/create', [StyleController::class, 'create'])->name('styles.create');
    Route::post('/create/store', [StyleController::class, 'store'])->name('styles.store');
    Route::get('/edit/{style}', [StyleController::class, 'edit'])->name('styles.edit');
    Route::put('/edit/{style}/update', [StyleController::class, 'update'])->name('styles.update');
    Route::delete('/delete/{style}/', [StyleController::class, 'destroy'])->name('styles.destroy');
    Route::get('/search', [StyleController::class, 'search'])->name('styles.search');
    Route::prefix('{style}/products')->group(function () {
        Route::get('/', [StyleProductController::class, 'index'])->name('styles.products.index');
        Route::get('/create', [StyleProductController::class, 'create'])->name('styles.products.create');
        Route::post('/create/store', [StyleProductController::class, 'store'])->name('styles.products.store');
        Route::get('/edit/{product}', [StyleProductController::class, 'edit'])->name('styles.products.edit');
        Route::put('/edit/{product}/update', [StyleProductController::class, 'update'])->name('styles.products.update');
        Route::delete('/delete/{product}/', [StyleProductController::class, 'destroy'])->name('styles.products.destroy');
        Route::get('/search', [StyleProductController::class, 'search'])->name('styles.products.search');
    });
});

Route::prefix('products')->group(function () {
    Route::get('/', [ProductController::class, 'index'])->name('products.index');
    Route::get('/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/create/store', [ProductController::class, 'store'])->name('products.store');
    Route::get('/edit/{product}', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('/edit/{product}/update', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/delete/{product}/', [ProductController::class, 'destroy'])->name('products.destroy');
    Route::get('/search', [ProductController::class, 'search'])->name('products.search');
    Route::get('generate/pdf', [ProductController::class, 'report'])->name('products.report');
});


Route::prefix('cart')->group(function () {
    Route::get('/', [CartController::class, 'index'])->name('cart.index');
    Route::post('{product}/add', [CartController::class, 'add_item'])->name('cart.add');
    Route::put('{product}/update', [CartController::class, 'update_item'])->name('cart.update_item');
    Route::delete('{product}/remove', [CartController::class, 'remove_item'])->name('cart.remove');
    Route::delete('/clear-cart', [CartController::class, 'clear_cart'])->name('cart.clear');
    Route::post('/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
});

Route::get('/recipts', [ReciptController::class, 'index'])->name('recipts.index');
Route::get('/recipts/{recipt}/generate', [ReciptController::class, 'generateRecipt'])->name('recipts.generate');

Route::get('/recipts/items-sold-chart', [ReciptController::class, 'chart'])->name('recipts.items_sold_chart');
Route::get('/events/chart-by-month', [EventController::class, 'showEventsChart'])->name('events.chart_by_month');
