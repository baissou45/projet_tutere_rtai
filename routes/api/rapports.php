<?php

use App\Http\Controllers\Api\RapportApiController;
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

Route::get("rapports/liste", [RapportApiController::class, "index"])->middleware(["auth:sanctum"])->name("tournees.index");
Route::get("rapports/list/{tournee}", [RapportApiController::class, "tournee_index"])->middleware(["auth:sanctum"])->name("tournees.show");
Route::get("rapports/show/{rapport}", [RapportApiController::class, "show"])->middleware(["auth:sanctum"])->name("tournees.show");

Route::post("rapports/create", [RapportApiController::class, "create"])->middleware(["auth:sanctum"])->name("tournees.create");