<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GameReviewController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\AuthenticatedSessionController;

Route::get('/', function () {
    return view('home');
})->name('home');
Route::get('/about', function () {
    return view('about');
});

// Reviews

Route::get('/reviews', [GameReviewController::class, 'index'])->name('reviews.index');
Route::post('/reviews', [GameReviewController::class,'store'])->name('reviews.store');
Route::get('/reviews/{gameReview}/edit', [GameReviewController::class,'edit'])->name('reviews.edit');
Route::put('/reviews/{gameReview}', [GameReviewController::class,'update'])->name('reviews.update');
Route::delete('/reviews/{gameReview}', [GameReviewController::class,'destroy'])->name('reviews.destroy');

// Login and Registration

Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('/register', [RegisteredUserController::class, 'store']);
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store']);


// Middleware for Auth

Route::middleware('auth')->group(function() {

Route::post('/reviews', [GameReviewController::class,'store'])->name('reviews.store');
Route::get('/reviews/{gameReview}/edit', [GameReviewController::class,'edit'])->name('reviews.edit');
Route::put('/reviews/{gameReview}', [GameReviewController::class,'update'])->name('reviews.update');
Route::delete('/reviews/{gameReview}', [GameReviewController::class,'destroy'])->name('reviews.destroy');

});
