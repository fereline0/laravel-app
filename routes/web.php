<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserDetailInformationController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PublisherController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::prefix('users/{id}')->group(function () {
    Route::get('', [UserController::class, 'show'])->name('users.show');

    Route::middleware('auth')->group(function () {
        Route::prefix('edit')->group(function () {
            Route::get('general', [UserController::class, 'general'])->name('users.edit.general');
            Route::get('detail-information', [UserController::class, 'detailInformation'])->name('users.edit.detail-information');
            Route::get('update-password', [UserController::class, 'updatePassword'])->name('users.edit.update-password');
            Route::get('delete-account', [UserController::class, 'deleteAccount'])->name('users.edit.delete-account');
        });

        Route::patch('', [UserController::class, 'update'])->name('users.update');
        Route::delete('destroyWithValidation', [UserController::class, 'destroyWithValidation'])->name('users.destroyWithValidation');
        Route::delete('', [UserController::class, 'destroy'])->name('users.destroy')->middleware('permission:delete users');

        Route::prefix('details')->group(function () {
            Route::patch('', [UserDetailInformationController::class, 'update'])->name('users.userDetailInformation.update');
            Route::delete('image', [UserDetailInformationController::class, 'deleteImage'])->name('users.userDetailInformation.image.delete');
        });
    });
});

Route::middleware('auth')->prefix('admin')->group(function () {
    Route::get('users', [AdminController::class, 'users'])->name('admin.users');
    Route::get('categories', [AdminController::class, 'categories'])->name('admin.categories');
    Route::get('publishers', [AdminController::class, 'publishers'])->name('admin.publishers');
    Route::get('authors', [AdminController::class, 'authors'])->name('admin.authors');
    Route::get('books', [AdminController::class, 'books'])->name('admin.books');
});

Route::prefix('publishers')->group(function () {
    Route::middleware('permission:create publishers')->group(function () {
        Route::get('create', [PublisherController::class, 'create'])->name('publishers.create');
        Route::post('', [PublisherController::class, 'store'])->name('publishers.store');
    });

    Route::middleware('permission:edit publishers')->group(function () {
        Route::get('{id}/edit', [PublisherController::class, 'edit'])->name('publishers.edit');
        Route::patch('{id}', [PublisherController::class, 'update'])->name('publishers.update');
    });

    Route::middleware('permission:delete publishers')->group(function () {
        Route::delete('{id}', [PublisherController::class, 'destroy'])->name('publishers.destroy');
    });

    Route::get('{id}', [PublisherController::class, 'show'])->name('publishers.show');
});

Route::prefix('categories')->group(function () {
    Route::middleware('permission:create categories')->group(function () {
        Route::get('create', [CategoryController::class, 'create'])->name('categories.create');
        Route::post('', [CategoryController::class, 'store'])->name('categories.store');
    });

    Route::middleware('permission:edit categories')->group(function () {
        Route::get('{id}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
        Route::patch('{id}', [CategoryController::class, 'update'])->name('categories.update');
    });

    Route::middleware('permission:delete categories')->group(function () {
        Route::delete('{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');
    });

    Route::get('{id}', [CategoryController::class, 'show'])->name('categories.show');
});

Route::prefix('authors')->group(function () {
    Route::middleware('permission:create authors')->group(function () {
        Route::get('create', [AuthorController::class, 'create'])->name('authors.create');
        Route::post('', [AuthorController::class, 'store'])->name('authors.store');
    });

    Route::middleware('permission:edit authors')->group(function () {
        Route::get('{id}/edit', [AuthorController::class, 'edit'])->name('authors.edit');
        Route::patch('{id}', [AuthorController::class, 'update'])->name('authors.update');
    });

    Route::middleware('permission:delete authors')->group(function () {
        Route::delete('{id}', [AuthorController::class, 'destroy'])->name('authors.destroy');
    });

    Route::get('{id}', [AuthorController::class, 'show'])->name('authors.show');

    Route::delete('{id}/image', [AuthorController::class, 'deleteImage'])->name('authors.image.delete');
});

Route::prefix('books')->group(function () {
    Route::middleware('permission:create books')->group(function () {
        Route::get('create', [BookController::class, 'create'])->name('books.create');
        Route::post('', [BookController::class, 'store'])->name('books.store');
    });

    Route::middleware('permission:edit books')->group(function () {
        Route::get('{id}/edit', [BookController::class, 'edit'])->name('books.edit');
        Route::patch('{id}', [BookController::class, 'update'])->name('books.update');
    });

    Route::middleware('permission:delete books')->group(function () {
        Route::delete('{id}', [BookController::class, 'destroy'])->name('books.destroy');
    });

    Route::get('{id}', [BookController::class, 'show'])->name('books.show');

    Route::delete('{id}/image', [BookController::class, 'deleteImage'])->name('book.image.delete');
});

Route::middleware('auth')->prefix('cart')->group(function () {
    Route::get('', [CartController::class, 'index'])->name('cart.index');
    Route::post('add/{bookId}', [CartController::class, 'addToCart'])->name('cart.add');
    Route::post('remove/{bookId}', [CartController::class, 'removeFromCart'])->name('cart.remove');
});

require __DIR__ . '/auth.php';