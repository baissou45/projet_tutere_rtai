@extends('layouts.app')

@section('content')
    <style>
        #histogramme {
            height: 30%;
            /* Ajustez cette valeur selon vos besoins */
        }
    </style>
    <div class="container-fluid">

        <div class="card shadow">
            <div class="card-header">
                <h1 class="mb-4">Statistiques des Tournées</h1>
            </div>
            <div class="card-body">

                 <!-- Résumé des filtres appliqués -->
        @if ($inspecteur_id || $date_debut || $date_fin)
        <div class="alert alert-info row g-3 align-items-end" role="alert">
            Filtres appliqués :
            <div class="col-md">

                @if ($inspecteur_id)
                    Inspecteur : {{ $inspecteurs->where('id', $inspecteur_id)->first()->nom }}
                    {{ $inspecteurs->where('id', $inspecteur_id)->first()->prenom }},
                @endif
            </div>
            <div class="col-md">
                @if ($date_debut)
                    Date de début : {{ $date_debut }},
                @endif
            </div>
            <div class="col-md">
                @if ($date_fin)
                    Date de fin : {{ $date_fin }},
                @endif
            </div>
            <div class="col-md">
                <a href="{{ route('statistiques.tournees') }}" class="btn btn-secondary">Effacer les filtres</a>
            </div>
        </div>
    @endif
                
        <!-- Formulaire de filtrage -->
        <form method="POST" action="{{ route('statistiques.tournees') }}" class="mb-4">
            @csrf
            <div class="row g-3 align-items-end">
                <!-- Filtre par inspecteur -->
                <div class="col-md">
                    <label for="inspecteur_id" class="form-label">Inspecteur :</label>
                    <select name="inspecteur_id" id="inspecteur_id" class="form-control">
                        <option value="">Tous les inspecteurs</option>
                        @foreach ($inspecteurs as $inspecteur)
                            <option value="{{ $inspecteur->id }}" {{ $inspecteur->id == $inspecteur_id ? 'selected' : '' }}>
                                {{ $inspecteur->nom }} {{ $inspecteur->prenom }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Filtre par date de début -->
                <div class="col-md">
                    <label for="date_debut" class="form-label">Date de début :</label>
                    <input type="date" name="date_debut" id="date_debut" class="form-control"
                        value="{{ $date_debut }}">
                </div>

                <!-- Filtre par date de fin -->
                <div class="col-md">
                    <label for="date_fin" class="form-label">Date de fin :</label>
                    <input type="date" name="date_fin" id="date_fin" class="form-control" value="{{ $date_fin }}">
                </div>

                <!-- Bouton de soumission -->
                <div class="col-md-auto">
                    <button type="submit" class="btn btn-primary">Filtrer</button>
                    <a href="{{ route('statistiques.tournees') }}" class="btn btn-secondary">Réinitialiser</a>
                </div>
            </div>
        </form>
            </div>
        </div>

        <!-- Histogramme -->
        <div class="card mt-3 shadow">
            <div class="card-header">
                <h2>Evolution des tournées</h2>
            </div>
            <div class="card-body">
                <canvas id="histogramme" data-histogramme="{{ json_encode($histogramData) }}"></canvas>
            </div>
        </div>

        <!-- Camembert et Tableau -->
        <div class="row mt-3">
            <!-- Camembert -->
            <div class="card shadow col-4">
                <div class="card-header">
                    <h2>Statistiques des signatures</h2>
                </div>
                <div class="card-body">
                    <canvas id="camembert" data-piechart="{{ json_encode($pieChartData) }}"></canvas>
                </div>
            </div>

            <!-- Tableau des 5 dernières prospections -->
            <div class="card shadow col-lg-8">
                <div class="card-header">
                    <h2>5 dernières prospections</h2>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Adresse</th>
                                <th>État</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($prospections as $prospection)
                                <tr>
                                    <td>{{ $prospection->adresse_complet }}</td>
                                    <td>{{ $prospection->etat }}</td>
                                    <td>{{ $prospection->date }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

    <!-- Scripts pour générer les graphiques -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Fonction pour générer l'histogramme
        function generateHistogram() {
            var ctxHistogramme = document.getElementById('histogramme');
            var histogramData = JSON.parse(ctxHistogramme.dataset.histogramme);
            var labels = Object.keys(histogramData);
            var programmerCounts = [];
            var effectuerCounts = [];
    
            // Parcourir les données pour extraire les compteurs de chaque état
            labels.forEach(function(date) {
                var programmerCount = histogramData[date]['Programmer'] || 0;
                var effectuerCount = histogramData[date]['Effectuer'] || 0;
    
                programmerCounts.push(programmerCount);
                effectuerCounts.push(effectuerCount);
            });
    
            new Chart(ctxHistogramme, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Tournées programmées',
                        data: programmerCounts,
                        backgroundColor: '#C019BF',
                        borderColor: '#C019BF',
                        borderWidth: 1
                    },
                    {
                        label: 'Tournées effectuées',
                        data: effectuerCounts,
                        backgroundColor: '#A2C843',
                        borderColor: '#A2C843',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }
    
        // Fonction pour générer le camembert
        function generatePieChart() {
            var ctxCamembert = document.getElementById('camembert');
            var pieChartData = JSON.parse(ctxCamembert.dataset.piechart);
    
            var pieData = Object.values(pieChartData); // Convertir les valeurs de pieChartData en tableau
    
            new Chart(ctxCamembert, {
                type: 'pie',
                data: {
                    labels: Object.keys(pieChartData), // Utiliser les clés de pieChartData comme étiquettes
                    datasets: [{
                        data: pieData, // Utiliser les valeurs converties en tableau
                        backgroundColor: [
                            'rgba(162, 200, 67, 0.5)', // Couleur pour l'état "Programmé"
                            'rgba(192, 25, 191, 0.5)' // Couleur pour l'état "Effectué"
                        ],
                        borderColor: [
                            'rgba(162, 200, 67, 1.5)', // Couleur pour l'état "Programmé"
                            'rgba(192, 25, 191, 1.5)' // Couleur pour l'état "Effectué"
                        ],
                        borderWidth: 1
                    }]
                }
            });
        }
    
        // Appel des fonctions pour générer les graphiques
        generateHistogram();
        generatePieChart();
    </script>
    
@endsection
