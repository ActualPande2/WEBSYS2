<?php

use App\Http\Controllers\GameReviewController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/reviews', [GameReviewController::class, 'index'])->name('reviews.index');

Route::post('/reviews', [GameReviewController::class, 'store'])->name('reviews.store');