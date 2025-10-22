<?php

use App\Http\Controllers\Api\FarmController;
use App\Http\Controllers\Api\PlantController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Public API routes
Route::prefix('v1')->group(function () {
    // Farms
    Route::get('/farms', [FarmController::class, 'index']);
    Route::get('/farms/{slug}', [FarmController::class, 'show']);
    Route::get('/farms/{slug}/plants', [FarmController::class, 'plants']);

    // Plants
    Route::get('/plants', [PlantController::class, 'index']);
    Route::get('/plants/{plant_code}', [PlantController::class, 'show']);
    Route::get('/plants/{plant_code}/updates', [PlantController::class, 'updates']);
});

// Authenticated API routes
Route::middleware('auth:sanctum')->prefix('v1')->group(function () {
    // Add authenticated API endpoints here if needed
});
