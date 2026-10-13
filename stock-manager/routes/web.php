<?php

use App\Http\Controllers\itemController;
use Illuminate\Support\Facades\Route;

Route::get('/items', [itemController::class, 'index'])->name('items.index');
Route::post('/items', [itemController::class, 'store'])->name('items.store');
