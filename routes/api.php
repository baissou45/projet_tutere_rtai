<?php

use App\Http\Controllers\Api\AmadeusHotelList;
use App\Http\Controllers\Api\ApihotelController;
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

// Route::middleware('auth:sanctum')->group(function() {

    Route::get('hotel-list', [AmadeusHotelList::class, "index"]);

// });

// include __DIR__ .'/api/auth.php';
