<?php

use App\Http\Controllers\FarmController;
use App\Http\Controllers\PlantController;
use App\Http\Controllers\PublicController;
use Illuminate\Support\Facades\Route;

// Public routes
Route::get('/', [PublicController::class, 'home'])->name('home');
Route::get('/publicfarms', [PublicController::class, 'farms'])->name('public.farms');

Route::get('/farms/{slug}', [PublicController::class, 'showFarm'])
    ->where('slug', '^(?!create$|edit$|store$|update$|destroy$|my-farms$)[A-Za-z0-9\-_]+')
    ->name('public.farms.show');

Route::get('/plants/{plant_code}', [PublicController::class, 'showPlant'])
    ->where('plant_code', '^(?!create$|edit$|store$|update$|destroy$)[A-Za-z0-9\-_]+')
    ->name('public.plants.show');

Route::get('/blogs/{slug}', [PublicController::class, 'showBlog'])
    ->name('public.blogs.show');


// Authentication routes
require __DIR__.'/auth.php';

// Authenticated routes
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return redirect()->route('farms.index');
    })->name('dashboard');

    // Owner farm management
    Route::resource('farms', FarmController::class)->except(['show']);
    Route::patch('/farms/{farm}/toggle-public', [FarmController::class, 'togglePublic'])->name('farms.toggle-public');
    Route::get('/my-farms/{farm}', [FarmController::class, 'show'])->name('farms.show');

    // Owner plant management
    Route::resource('plants', PlantController::class)->except(['show']);
    Route::get('/my-plants/{plant:plant_code}', [PlantController::class, 'show'])->name('plants.show');
});


if (!Route::has('auth.google.callback')) {
    Route::get('/auth/google/callback', function () {
        return redirect()->route('home');
    })->name('auth.google.callback');
}

// Ensure a named farms.index exists to avoid 'Route [farms.index] not defined' in views/redirects.
if (!Route::has('farms.index')) {
    Route::get('/farms', function () {
        if (Route::has('public.farms')) {
            return redirect()->route('public.farms');
        }

        return redirect()->route('home');
    })->name('farms.index');
}
