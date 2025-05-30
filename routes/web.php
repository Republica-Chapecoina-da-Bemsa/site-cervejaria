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
