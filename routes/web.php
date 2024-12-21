<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserDetailInformationController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;

Route::get('', [HomeController::class, 'index'])->name('home');

Route::prefix('users')->group(function () {
    Route::prefix('{id}')->group(function () {
        Route::get('', [UserController::class, 'show'])->name('users.show');

        Route::middleware('auth')->group(function () {
            Route::get('edit', [UserController::class, 'edit'])->name('users.edit');
            Route::patch('', [UserController::class, 'update'])->name('users.update');
            Route::delete('', [UserController::class, 'destroy'])->name('users.destroy');

            Route::prefix('details')->group(function () {
                Route::patch('', [UserDetailInformationController::class, 'update'])->name('users.userDetailInformation.update');
                Route::delete('image', [UserDetailInformationController::class, 'deleteAvatar'])->name('users.userDetailInformation.deleteAvatar');
            });
        });
    });
});

Route::prefix('books')->group(function () {
    Route::prefix('{id}')->group(function () {
        Route::get('', [BookController::class, 'show'])->name('books.show');
    });
});

Route::prefix('authors')->group(function () {
    Route::prefix('{id}')->group(function () {
        Route::get('', [AuthorController::class, 'show'])->name('authors.show');
    });
});

Route::middleware(['auth'])->prefix('cart')->group(function () {
    Route::get('', [CartController::class, 'index'])->name('cart.index');
    Route::post('add/{bookId}', [CartController::class, 'addToCart'])->name('cart.add');
    Route::post('remove/{bookId}', [CartController::class, 'removeFromCart'])->name('cart.remove');
});

require __DIR__ . '/auth.php';
