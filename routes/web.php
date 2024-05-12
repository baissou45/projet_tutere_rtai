<?php

use App\Http\Controllers\ApiSearchController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware(['auth'])->group(function () {

    // Route::middleware('hasHotel')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::get('/search', [ApiSearchController::class, 'index'])->name('apiSearch');
        Route::post('/search', [ApiSearchController::class, 'search'])->name('apiSearch.post');

        Route::resources([
            'users' => UserController::class,
            'rooms' => RoomController::class,
            'bookings' => BookingController::class,
        ]);

        // Liste des routes pour users
        Route::get('users_trash', [UserController::class, 'trash'])->name('users.trash');
        Route::post('trash-action', [UserController::class, 'trash_action'])->name('users.trash_action');
    // });

    Route::get('/newhotel', [HotelController::class, 'create'])->name('hotels.create');
    Route::post('/newhotel', [HotelController::class, 'store'])->name('hotels.store');
});

require __DIR__.'/auth.php';

