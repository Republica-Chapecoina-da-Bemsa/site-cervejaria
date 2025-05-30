<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\EventController;
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