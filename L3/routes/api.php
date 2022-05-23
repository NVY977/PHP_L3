<?php

use App\Http\ApiV1\Modules\Players\Controllers\PlayerController;
use App\Http\ApiV1\Modules\Teams\Controllers\TeamController;
use App\Http\ApiV1\Modules\Tournaments\Controllers\TournamentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get("/v1/players", [PlayerController::class, 'getList']);

Route::get("/v1/players/{id}", [PlayerController::class, 'get']);

Route::post("/v1/players", [PlayerController::class, 'post']);

Route::delete("/v1/players/{id}", [PlayerController::class, 'delete']);

Route::patch("/v1/players/{id}", [PlayerController::class, 'patch']);

Route::put("/v1/players/{id}", [PlayerController::class, 'put']);


Route::get("/v1/teams", [TeamController::class, 'getList']);

Route::get("/v1/teams/{id}", [TeamController::class, 'get']);

Route::post("/v1/teams", [TeamController::class, 'post']);

Route::delete("/v1/teams/{id}", [TeamController::class, 'delete']);

Route::patch("/v1/teams/{id}", [TeamController::class, 'patch']);

Route::put("/v1/teams/{id}", [TeamController::class, 'put']);


Route::get("/v1/tournaments", [TournamentController::class, 'getList']);

Route::get("/v1/tournaments/{id}", [TournamentController::class, 'get']);

Route::post("/v1/tournaments", [TournamentController::class, 'post']);

Route::delete("/v1/tournaments/{id}", [TournamentController::class, 'delete']);

Route::patch("/v1/tournaments/{id}", [TournamentController::class, 'patch']);

Route::put("/v1/tournaments/{id}", [TournamentController::class, 'put']);
