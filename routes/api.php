<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ContactController;
use App\Http\Controllers\Api\CreatureController;
use App\Http\Controllers\Api\GalleryController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Public routes
Route::post('/login', [AuthController::class, 'login']);
Route::post('/contact', [ContactController::class, 'store']);

// Protected routes (require authentication)
Route::middleware('auth:sanctum')->group(function () {
    // Auth routes
    Route::post('/logout', [AuthController::class, 'logout']);

    // Creature CRUD routes
    Route::apiResource('creatures', CreatureController::class);

    // Creature abilities routes
    Route::post('/creatures/{creature}/abilities', [CreatureController::class, 'attachAbility']);
    Route::delete('/creatures/{creature}/abilities/{abilityId}', [CreatureController::class, 'detachAbility']);

    // Creature gallery routes
    Route::get('/creatures/{creature}/gallery', [GalleryController::class, 'index']);
    Route::post('/creatures/{creature}/gallery', [GalleryController::class, 'store']);
});
