<?php

use App\Http\Controllers\AuthenticatedSessionController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\ReplyController;
use App\Http\Controllers\ReplyVoteController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\ThreadController;
use App\Http\Controllers\ThreadVoteController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/threads')->name('home');

Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('/register', [RegisteredUserController::class, 'store'])->name('register.store');

    Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('login.store');
});

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

Route::resource('threads', ThreadController::class)
    ->middlewareFor(['create', 'store', 'edit', 'update', 'destroy'], 'auth')
    ->where(['thread' => '[0-9]+']);

Route::resource('categories', CategoryController::class)
    ->only(['index', 'show'])
    ->where(['category' => '[0-9]+']);

Route::resource('tags', TagController::class)
    ->only(['index', 'show'])
    ->where(['tag' => '[0-9]+']);

Route::middleware('auth')->group(function () {
    Route::post('/threads/{thread}/votes', [ThreadVoteController::class, 'store'])
        ->whereNumber('thread')
        ->name('threads.votes.store');
});

Route::scopeBindings()->group(function () {
    Route::middleware('auth')->group(function () {
        Route::resource('threads.replies', ReplyController::class)
            ->only(['store', 'update', 'destroy']);

        Route::post('/threads/{thread}/replies/{reply}/votes', [ReplyVoteController::class, 'store'])
            ->where(['thread' => '[0-9]+', 'reply' => '[0-9]+'])
            ->name('threads.replies.votes.store');
    });
});
