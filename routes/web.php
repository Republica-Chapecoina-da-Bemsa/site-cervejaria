<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StyleController;

Route::get('/', function () {
    return view('welcome');
});
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

Route::prefix('styles')->group(function () {
    Route::get('/', [StyleController::class, 'index'])->name('styles.index');
    Route::get('/create', [StyleController::class, 'create'])->name('styles.create');
    Route::post('/create/store', [StyleController::class, 'store'])->name('styles.store');
    Route::get('/edit/{style}', [StyleController::class, 'edit'])->name('styles.edit');
    Route::put('/edit/{style}/update', [StyleController::class, 'update'])->name('styles.update');
    Route::delete('/delete/{style}/', [StyleController::class, 'destroy'])->name('styles.destroy');
    Route::get('/search', [StyleController::class, 'search'])->name('styles.search');
});

Route::prefix('products')->group(function () {
    Route::get('/', [ProductController::class, 'index'])->name('products.index');
    Route::get('/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/create/store', [ProductController::class, 'store'])->name('products.store');
    Route::get('/edit/{product}', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('/edit/{product}/update', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/delete/{product}/', [ProductController::class, 'destroy'])->name('products.destroy');
    Route::get('/search', [ProductController::class, 'search'])->name('products.search');
});
