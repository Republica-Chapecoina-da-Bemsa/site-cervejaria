<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
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
use App\Http\Controllers\EventController;

Route::get('/event', [EventController::class, 'index'])->name('event.index');
Route::get('/event/create', [EventController::class, 'create'])->name('event.create');
Route::post('/event/store', [EventController::class, 'store'])->name('event.store');
Route::delete('event/{id}', [EventController::class, 'destroy'])->name('event.destroy');
Route::get('event/{id}', [EventController::class, 'edit'])->name('event.edit');
Route::put('event/update/{id}', [EventController::class, 'update'])->name('event.update');
Route::post('event/search', [EventController::class, 'search'])->name('event.search');