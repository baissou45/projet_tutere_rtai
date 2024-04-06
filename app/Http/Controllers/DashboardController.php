<?php

namespace App\Http\Controllers;

use App\Models\Rapport;
use App\Models\Tournee;
use App\Models\User;
use Carbon\Carbon;

class DashboardController extends Controller {

    function index() {

        $inspections = Tournee::where('date', '>=', now()->startOfYear())->get(['date', "etat"])->groupBy(function($q){
            return Carbon::parse($q->date)->monthName;
        });

        $rapports = Tournee::where('date', '>=', now()->startOfYear())->get(['date', "etat"])->groupBy(function($q){
            return Carbon::parse($q->date)->monthName;
        });

        $data = [];
        for ($i=1; $i <= 12; $i++) {
            $nbrInspection = 0;
            $nbrRapport = 0;

            $nbrInspection = isset($inspections[now()->month($i)->monthName]) ? $inspections[now()->month($i)->monthName]->count() : 1;
            $nbrRapport = isset($rapports[now()->month($i)->monthName]) ? $rapports[now()->month($i)->monthName]->where('etat', 'Effectuer')->count() : 1;

            $data[] = [
                'y' => ucfirst(now()->month($i)->monthName),
                'a' => $nbrInspection,
                'b' => $nbrRapport
            ];
        }

        // Statistiques de la semaine
        $inspections = Tournee::where('date', '>=', now()->startOfWeek())->get(['date', "etat"])->groupBy(function($q){
            return Carbon::parse($q->date)->dayName;
        });

        $rapports = Tournee::where('date', '>=', now()->startOfWeek())->get(['date', "etat"])->groupBy(function($q){
            return Carbon::parse($q->date)->dayName;
        });

        $data_semaine = [];
        for ($i=1; $i <= 7; $i++) {
            $nbrInspection = 0;
            $nbrRapport = 0;

            $nbrInspection = isset($inspections[now()->day($i)->dayName]) ? $inspections[now()->day($i)->dayName]->count() : 0;
            $nbrRapport = isset($rapports[now()->day($i)->dayName]) ? $inspections[now()->day($i)->dayName]->where('etat', 'Effectuer')->count() : 0;

            $data_semaine[] = [
                'y' => now()->day($i),
                'a' => $nbrInspection,
                'b' => $nbrRapport,
            ];
        }

        $users = User::where('type', 'i')->get()
        ->map(function ($user) {
            $user->nbr_tournees = $user->tournees->count();
            return $user;
        })
        ->sortByDesc('nbr_tournees')
        ->take(5);

        $nbr = [];
        $nbr["inspection"] = Tournee::count();
        $nbr["secretaire"] = User::where('type', 's')->count();
        $nbr["inspecteur"] = User::where('type', 'i')->count();
        $nbr["rapports"] = Rapport::count();

        $last_rapports = Rapport::latest()->limit(5)->get();

        return view('dashboard', compact('data', 'data_semaine', "users", "nbr", "last_rapports"));
    }

}