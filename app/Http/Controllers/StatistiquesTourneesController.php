<?php

namespace App\Http\Controllers;

use App\Models\Tournee;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class StatistiquesTourneesController extends Controller
{
    public function index(Request $request)
    {
        // Récupérer les paramètres de filtrage
        $inspecteur_id = $request->input('inspecteur_id');
        $date_debut = $request->input('date_debut') ? Carbon::parse($request->input('date_debut')) : null;
        $date_fin = $request->input('date_fin') ? Carbon::parse($request->input('date_fin')) : null;

        // Construire la requête de base
        $query = Tournee::query();

        // Appliquer les filtres si au moins un filtre est présent
        if ($inspecteur_id || ($date_debut && $date_fin)) {
            if ($date_debut && $date_fin) {
                $query->whereBetween('date', [$date_debut, $date_fin]);
            }

            if ($inspecteur_id) {
                $query->where('inspecteur_id', $inspecteur_id);
            }
        }

        // Récupérer les données filtrées ou non
        // Récupérer les données filtrées ou non
        $histogramData = $query->selectRaw('DATE(date) as date, etat, COUNT(*) as count')
            ->groupBy('date', 'etat')
            ->orderBy('date')
            ->get();

        $formattedHistogramData = [];

        // Formatage des données pour l'histogramme
        foreach ($histogramData as $data) {
            $date = $data->date;
            $etat = $data->etat;
            $count = $data->count;

            // Vérifier si la date existe déjà dans le tableau
            if (! isset($formattedHistogramData[$date])) {
                // Si la date n'existe pas, initialiser un tableau vide pour cette date
                $formattedHistogramData[$date] = [];
            }

            // Ajouter les données de l'état pour cette date
            $formattedHistogramData[$date][$etat] = $count;
        }

        $pieChartData = $query->selectRaw('etat, COUNT(*) as count')
            ->groupBy('etat')
            ->get()
            ->pluck('count', 'etat');

        $tableData = $query->latest('date')->get();

        // Récupérer les 5 dernières prospections
        $prospections = Tournee::latest('date')->take(5)->get();

        // Récupérer les inspecteurs pour le filtre dans la vue
        $inspecteurs = User::where('type', 'i')->orderBy('nom')->get();

        // dd([
        // 'histogramData' => $formattedHistogramData,
        // 'pieChartData' => $pieChartData,
        //     'tableData' => $tableData,
        //  'inspecteurs' => $inspecteurs,
        //     'prospections' => $prospections,
        //     'date_debut' => $date_debut,
        //     'date_fin' => $date_fin,
        //     'inspecteur_id' => $inspecteur_id,
        // ]);

        // Retourner la vue avec les données nécessaires
        return view('statistiques.tournees', [
            'histogramData' => $formattedHistogramData,
            'pieChartData' => $pieChartData,
            'tableData' => $tableData,
            'inspecteurs' => $inspecteurs,
            'prospections' => $prospections,
            'date_debut' => $date_debut,
            'date_fin' => $date_fin,
            'inspecteur_id' => $inspecteur_id,
        ]);
    }
}
