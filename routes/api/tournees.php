<?php

use App\Http\Controllers\Api\TourneeApiController;
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

Route::get("tournes/liste", [TourneeApiController::class, "index"])->middleware(["auth:sanctum"])->name("tournees.index");
Route::get("tournes/show/{tournee}", [TourneeApiController::class, "show"])->middleware(["auth:sanctum"])->name("tournees.show");

Route::post("tournes/create", [TourneeApiController::class, "create"])->middleware(["auth:sanctum"])->name("tournees.create");