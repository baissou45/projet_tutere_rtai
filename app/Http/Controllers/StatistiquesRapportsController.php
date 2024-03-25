<?php

namespace App\Http\Controllers;

use App\Models\Rapport;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class StatistiquesRapportsController extends Controller
{
    public function index(Request $request)
    {
        // Récupérer les paramètres de filtrage
        $inspecteur_id = $request->input('inspecteur_id');
        $date_debut = $request->input('date_debut') ? Carbon::parse($request->input('date_debut')) : null;
        $date_fin = $request->input('date_fin') ? Carbon::parse($request->input('date_fin')) : null;

        // Construire la requête de base
        $query = Rapport::query();

        // Appliquer les filtres si au moins un filtre est présent
        if ($inspecteur_id || ($date_debut && $date_fin)) {
            if ($date_debut && $date_fin) {
                $query->whereBetween('created_at', [$date_debut, $date_fin]);
            }

            if ($inspecteur_id) {
                $query->where('inspecteur_id', $inspecteur_id);
            }
        }

        // Récupérer les données filtrées ou non
        $rapports = $query->get();

        // Calculer les statistiques pour chaque date
        $rapportsParDate = $rapports->groupBy(function ($rapport) {
            return $rapport->created_at->format('Y-m-d');
        })->map(function ($rapportsParDate) {
            $signes = $rapportsParDate->where('signature', true)->count();

            return [
                'signer' => $signes,
                'tourner' => $rapportsParDate->count() - $signes,
            ];
        });

        // Récupérer les 5 derniers rapports
        $latestRapports = Rapport::latest();

        // Appliquer les filtres sur les 5 derniers rapports si nécessaire
        if ($inspecteur_id || ($date_debut && $date_fin)) {
            if ($inspecteur_id) {
                $latestRapports->where('inspecteur_id', $inspecteur_id);
            }
            if ($date_debut && $date_fin) {
                $latestRapports->whereBetween('created_at', [$date_debut, $date_fin]);
            }
        }

        $latestRapports = $latestRapports->with('tournee', 'inspecteur')->take(5)->get();

        // Récupérer les inspecteurs pour le filtre dans la vue
        $inspecteurs = User::where('type', 'i')->orderBy('nom')->get();

        // Récupérer le total global des rapports signés
    $totalSignes = $query->where('signature', true)->count();

    // Récupérer le total global des rapports de tournée
    $totalTournees = $query->whereNotNull('tournee_id')->count();

    // Créer un tableau de données pour le graphique de type Doughnut
    $doughnutData = [
        'Signés' => $totalSignes,
        'Tournées' => $totalTournees,
    ];
        // dd(
        //     $rapports,
        //     $rapportsParDate,
        //     $latestRapports

        // );

        // Retourner la vue avec les données nécessaires
        return view('statistiques.rapports', [
            'rapports' => $rapports,
            'inspecteurs' => $inspecteurs,
            'date_debut' => $date_debut,
            'date_fin' => $date_fin,
            'inspecteur_id' => $inspecteur_id,
            'rapportsParDate' => $rapportsParDate,
            'latestRapports' => $latestRapports,
            'doughnutData' => $doughnutData,
        ]);
    }
}