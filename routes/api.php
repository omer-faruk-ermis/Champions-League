<?php

use App\Http\Controllers\API\FixtureController;
use App\Http\Controllers\API\StandingController;
use App\Http\Controllers\API\TeamController;
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

Route::prefix('team')->group(function () {
    Route::get('/', [TeamController::class, 'index']);
});

Route::prefix('standing')->group(function () {
    Route::get('/', [StandingController::class, 'index']);
});

Route::prefix('fixture')->group(function () {
    Route::get('/', [FixtureController::class, 'index']);
    Route::get('/create_fixture', [FixtureController::class, 'createFixture']);
    Route::get('/play_week_matches', [FixtureController::class, 'playWeekMatches']);
    Route::put('/{id}', [FixtureController::class, 'update']);
    Route::get('/{id}', [FixtureController::class, 'show']);
});
