<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StatistiquesRapportsController;
use App\Http\Controllers\StatistiquesTourneesController;
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

Route::get('/', [AuthenticatedSessionController::class, 'create']);

Route::middleware('auth')->group(function () {

    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('inspecteur', [UserController::class, 'inspecteur'])->name('users.inspecteur');

    // Liste des routes pour users
    Route::resource('users', UserController::class)->middleware('auth');

    // Liste des routes pour la gestion du profil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //liste des routes des statistiques
    Route::any('/statistiques-tournees', [StatistiquesTourneesController::class, 'index'])->name('statistiques.tournees');

    Route::any('/statistiques-rapports', [StatistiquesRapportsController::class, 'index'])->name('statistiques.rapports');

});

require __DIR__.'/auth.php';
