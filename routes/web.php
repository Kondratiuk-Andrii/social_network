<?php

use App\Http\Controllers\MainController;
use App\Http\Controllers\PersonalController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [MainController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::group(['prefix' => 'users'], function () {
    Route::get('/', [ProfileController::class, 'index'])->name('user.index');
    Route::get('/{user}/show', [ProfileController::class, 'show'])->name('user.show');

    // personal
    Route::group(['prefix' => 'personal'], function () {
        Route::get('/', [PersonalController::class, 'index'])->name('user.personal.index');
    });
    // feed
    Route::group(['prefix' => 'feed'], function () {
        Route::get('/', [ProfileController::class, 'index'])->name('user.feed.index');
    });
})->middleware('auth');

Route::group(['prefix' => 'posts'], function () {
    Route::get('/', [PostController::class, 'index'])->name('post.index');
    Route::get('/create', [PostController::class, 'create'])->name('post.create');
    Route::post('/', [PostController::class, 'store'])->name('post.store');
    Route::get('/{post}', [PostController::class, 'show'])->name('post.show');
    Route::get('/{post}/edit', [PostController::class, 'edit'])->name('post.edit');
    Route::patch('/{post}', [PostController::class, 'update'])->name('post.update');
    Route::delete('/{post}', [PostController::class, 'destroy'])->name('post.destroy');
});

require __DIR__.'/auth.php';
