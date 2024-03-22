<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TourneeController;
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

// Route::get('/rapports_doc/{ids}', [DashboardController::class, 'generer_rapport_ademe']);


// Route::get('/', [AuthenticatedSessionController::class, 'create']);


Route::middleware('auth')->group(function () {

    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('inspecteur', [UserController::class, 'inspecteur'])->name('users.inspecteur');

    // Liste des routes pour users
    Route::resource('users', UserController::class);
    Route::get('users_trash', [UserController::class, 'trash'])->name('users.trash');
    Route::post('trash-action', [UserController::class, 'trash_action'])->name('users.trash_action');


    Route::get('/rapports_generate/{rapport}', [DashboardController::class, 'generer_rapport'])->name('generer_rapport_ademe');
    Route::get('/rapports_ademe', [DashboardController::class, 'generer_rapport_ademe'])->name('generer_rapport_ademe');


    // Route tournees
    Route::prefix('tournees')->group(function () {
        Route::get('/trash', [TourneeController::class, 'index'])->name('tournees.index');
    });

    // Liste des routes pour la gestion du profil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
