<?php

use App\Http\Controllers\itemController;
use Illuminate\Support\Facades\Route;

Route::get('/', [itemController::class, 'index'])->name('items.index');
Route::post('/items', [itemController::class, 'store'])->name('items.store');

Route::get('/items/{item}/edit', [itemController::class, 'edit'])->name('items.edit');
Route::put('/items/{item}', [itemController::class, 'update'])->name('items.update');
Route::delete('/items/{item}', [itemController::class, 'destroy'])->name('items.destroy');
