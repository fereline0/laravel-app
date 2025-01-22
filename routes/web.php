<?php

use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\CabinetController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;

Route::get('', [WelcomeController::class, 'index'])->name('welcome');

Route::prefix('dashboard')->name('dashboard.')->middleware('auth')->group(function () {
    Route::prefix('announcements')->name('announcements.')->middleware('permission:create announcement|edit announcement|delete announcement')->group(function () {
        Route::get('', [AnnouncementController::class, 'index'])->name('index');
        Route::get('create', [AnnouncementController::class, 'create'])->name('create')->middleware('permission:create announcement');
        Route::post('', [AnnouncementController::class, 'store'])->name('store')->middleware('permission:create announcement');
        Route::prefix('{id}')->group(function () {
            Route::get('edit', [AnnouncementController::class, 'edit'])->name('edit')->middleware('permission:edit announcement');
            Route::put('', [AnnouncementController::class, 'update'])->name('update')->middleware('permission:edit announcement');
            Route::delete('', [AnnouncementController::class, 'destroy'])->name('destroy')->middleware('permission:delete announcement');
        });
    });

    Route::prefix('passwords')->name('passwords.')->middleware('permission:create password|edit password|delete password')->group(function () {
        Route::get('', [PasswordController::class, 'index'])->name('index');
        Route::get('create', [PasswordController::class, 'create'])->name('create')->middleware('permission:create password');
        Route::post('', [PasswordController::class, 'store'])->name('store')->middleware('permission:create password');
        Route::prefix('{id}')->group(function () {
            Route::get('', [PasswordController::class, 'show'])->name('show')->middleware('check.password.access:{id}');
            Route::get('edit', [PasswordController::class, 'edit'])->name('edit')->middleware('permission:edit password');
            Route::put('', [PasswordController::class, 'update'])->name('update')->middleware('permission:edit password');
            Route::delete('', [PasswordController::class, 'destroy'])->name('destroy')->middleware('permission:delete password');
        });
    });

    Route::prefix('categories')->name('categories.')->middleware('permission:create category|edit category|delete category')->group(function () {
        Route::get('', [CategoryController::class, 'index'])->name('index');
        Route::get('create', [CategoryController::class, 'create'])->name('create')->middleware('permission:create category');
        Route::post('', [CategoryController::class, 'store'])->name('store')->middleware('permission:create category');
        Route::prefix('{id}')->group(function () {
            Route::get('edit', [CategoryController::class, 'edit'])->name('edit')->middleware('permission:edit category');
            Route::put('', [CategoryController::class, 'update'])->name('update')->middleware('permission:edit category');
            Route::delete('', [CategoryController::class, 'destroy'])->name('destroy')->middleware('permission:delete category');
        });
    });

    Route::prefix('cabinets')->name('cabinets.')->middleware('permission:create cabinet|edit cabinet|delete cabinet')->group(function () {
        Route::get('', [CabinetController::class, 'index'])->name('index');
        Route::get('create', [CabinetController::class, 'create'])->name('create')->middleware('permission:create cabinet');
        Route::post('', [CabinetController::class, 'store'])->name('store')->middleware('permission:create cabinet');
        Route::prefix('{cabinet}')->group(function () {
            Route::get('edit', [CabinetController::class, 'edit'])->name('edit')->middleware('permission:edit cabinet');
            Route::put('', [CabinetController::class, 'update'])->name('update')->middleware('permission:edit cabinet');
            Route::delete('', [CabinetController::class, 'destroy'])->name('destroy')->middleware('permission:delete cabinet');
        });
    });

    Route::prefix('devices')->name('devices.')->middleware('permission:create device|edit device|delete device')->group(function () {
        Route::get('', [DeviceController::class, 'index'])->name('index');
        Route::get('create', [DeviceController::class, 'create'])->name('create')->middleware('permission:create device');
        Route::post('', [DeviceController::class, 'store'])->name('store')->middleware('permission:create device');
        Route::prefix('{id}')->group(function () {
            Route::get('edit', [DeviceController::class, 'edit'])->name('edit')->middleware('permission:edit device');
            Route::put('', [DeviceController::class, 'update'])->name('update')->middleware('permission:edit device');
            Route::delete('', [DeviceController::class, 'destroy'])->name('destroy')->middleware('permission:delete device');
        });
    });

    Route::prefix('inventories')->name('inventories.')->middleware('permission:create inventory|edit inventory|delete inventory')->group(function () {
        Route::get('', [InventoryController::class, 'index'])->name('index');
        Route::get('create', [InventoryController::class, 'create'])->name('create')->middleware('permission:create inventory');
        Route::post('', [InventoryController::class, 'store'])->name('store')->middleware('permission:create inventory');
        Route::prefix('{id}')->group(function () {
            Route::get('edit', [InventoryController::class, 'edit'])->name('edit')->middleware('permission:edit inventory');
            Route::put('', [InventoryController::class, 'update'])->name('update')->middleware('permission:edit inventory');
            Route::delete('', [InventoryController::class, 'destroy'])->name('destroy')->middleware('permission:delete inventory');
        });
    });
});

Route::prefix('announcements')->name('announcements.')->group(function () {
    Route::get('{id}', [AnnouncementController::class, 'show'])->name('show')->middleware('permission:view announcement');
});

require __DIR__ . '/auth.php';
