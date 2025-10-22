<?php

use App\Http\Controllers\FarmController;
use App\Http\Controllers\PlantController;
use App\Http\Controllers\PublicController;
use Illuminate\Support\Facades\Route;

// Public routes
Route::get('/', [PublicController::class, 'home'])->name('home');
Route::get('/farms', [PublicController::class, 'farms'])->name('public.farms');
// Prevent the public slug route from capturing resource action names like
// 'create' or 'edit' so that the authenticated resource routes (e.g. /farms/create)
// can be matched properly. This uses a negative lookahead to exclude common
// resource action names from being treated as a farm slug.
Route::get('/farms/{slug}', [PublicController::class, 'showFarm'])
    ->where('slug', '^(?!create$|edit$|store$|update$|destroy$|my-farms$)[A-Za-z0-9\-_]+')
    ->name('public.farms.show');
// Prevent the public plant slug route from capturing resource action names like
// 'create' or 'edit' so that the authenticated resource routes (e.g. /plants/create)
// can be matched properly. Exclude common resource action names with a negative
// lookahead on the slug segment.
Route::get('/plants/{plant_code}', [PublicController::class, 'showPlant'])
    ->where('plant_code', '^(?!create$|edit$|store$|update$|destroy$)[A-Za-z0-9\-_]+')
    ->name('public.plants.show');

// Authentication routes
require __DIR__.'/auth.php';

// Authenticated routes
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return redirect()->route('farms.index');
    })->name('dashboard');

    // Owner farm management
    Route::resource('farms', FarmController::class)->except(['show']);
    Route::get('/my-farms/{farm}', [FarmController::class, 'show'])->name('farms.show');

    // Owner plant management
    Route::resource('plants', PlantController::class)->except(['show']);
    Route::get('/my-plants/{plant:plant_code}', [PlantController::class, 'show'])->name('plants.show');
});

// Note: public '/farms' route is already defined above as 'public.farms'.
// Avoid re-defining '/farms' here because it would overwrite resource routes (including 'farms.index').

// Minimal fallback for Google OAuth callback route used in the layout (if OAuth isn't configured).
// This prevents Blade from throwing a 'Route [auth.google.callback] not defined' error.
if (!\Illuminate\Support\Facades\Route::has('auth.google.callback')) {
    \Illuminate\Support\Facades\Route::get('/auth/google/callback', function () {
        return redirect()->route('home');
    })->name('auth.google.callback');
}

// Ensure a named farms.index exists to avoid 'Route [farms.index] not defined' in views/redirects.
if (!\Illuminate\Support\Facades\Route::has('farms.index')) {
    \Illuminate\Support\Facades\Route::get('/farms', function () {
        // Prefer public listing if available, otherwise fall back to home
        if (\Illuminate\Support\Facades\Route::has('public.farms')) {
            return redirect()->route('public.farms');
        }

        return redirect()->route('home');
    })->name('farms.index');
}
