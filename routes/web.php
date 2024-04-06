<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RapportController;
use App\Http\Controllers\TourneeController;
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

// Route::get('/rapports_zip/{ids}', [DashboardController::class, 'generer_rapport_ademe']);
// Route::get('/rapports_ademe', [DashboardController::class, 'generer_rapport_ademe']);
// Route::get('/rapports_doc/{rapport}', [DashboardController::class, 'generer_rapport']);


// Route::get('/', [AuthenticatedSessionController::class, 'create']);

Route::middleware('auth')->group(function () {

    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('inspecteur', [UserController::class, 'inspecteur'])->name('users.inspecteur');
    Route::get('inspecteur_trash', [UserController::class, 'trash'])->name('inspecteur.trash');
    Route::get('inspecteur/create', [UserController::class, 'create'])->name('inspecteur.create');
    Route::post('inspecteur/affectatiion', [UserController::class, 'inspecteur_affectatiion'])->name('inspecteur.affectatiion');


    // Liste des routes pour users
    Route::resource('users', UserController::class);
    Route::get('users_trash', [UserController::class, 'trash'])->name('users.trash');
    Route::post('trash-action', [UserController::class, 'trash_action'])->name('users.trash_action');


    Route::get('rapports', [RapportController::class, 'index'])->name('rapports.index');
    Route::get('/rapports_generate/{rapport}', [RapportController::class, 'generer_rapport'])->name('rapports.generate_pdf');
    Route::post('/rapports_ademe', [RapportController::class, 'generer_rapport_ademe'])->name('rapports.generate_pdf_ademe');


    // Route tournees
    Route::prefix('tournees')->group(function () {
        Route::get('/', [TourneeController::class, 'index'])->name('tournees.index');
    });

    // Liste des routes pour la gestion du profil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //liste des routes des statistiques
    Route::any('/statistiques-tournees', [StatistiquesTourneesController::class, 'index'])->name('statistiques.tournees');

    Route::any('/statistiques-rapports', [StatistiquesRapportsController::class, 'index'])->name('statistiques.rapports');

});

require __DIR__.'/auth.php';
