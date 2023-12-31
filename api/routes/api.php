<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\ApiPublicAvailbleDevises;
use App\Http\Controllers\ApiPublicStateController;
use Illuminate\Http\Request;
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

Route::middleware("auth:sanctum")->group(function () {
  Route::apiResource("paire", \App\Http\Controllers\PaireController::class);
  Route::get("/devises/all", [App\Http\Controllers\DevisesController::class, "index"]);
});

Route::post("/login", [LoginController::class, "index"]);
Route::get("/logout", [LogoutController::class, "index"]);
Route::get("/devises/available", [\App\Http\Controllers\PaireController::class, "index"]);
Route::get("/{from}/{amount}/{to}", [ApiPublicAvailbleDevises::class, "conversion"]);
Route::get("/state", [ApiPublicStateController::class, "state"]);
