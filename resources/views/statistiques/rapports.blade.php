@extends('layouts.app')

@section('content')
    <style>
        /* Ajoutez votre style personnalisé ici */
    </style>
    <div class="container-fluid">

        <!-- Formulaire de filtrage -->
        <div class="card shadow">
            <div class="card-header">
                <h2 class="mb-4">Statistiques des Rapports</h2>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('statistiques.rapports') }}" class="mb-4">
                    @csrf
                    <div class="row g-3 align-items-end">
                        <!-- Filtre par inspecteur -->
                        <div class="col-md">
                            <label for="inspecteur_id" class="form-label">Inspecteur :</label>
                            <select name="inspecteur_id" id="inspecteur_id" class="form-select form-control">
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
                            <a href="{{ route('statistiques.rapports') }}" class="btn btn-secondary">Réinitialiser</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>

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
                    <a href="{{ route('statistiques.rapports') }}" class="btn btn-secondary">Effacer les filtres</a>
                </div>
            </div>
        @endif

        <!-- Diagrammes -->

        <!-- Diagramme en ligne -->
        <div class="card shadow my-4">
            <div class="card-header">
                <h3>Evolution des tournées</h3>
            </div>
            <div class="card-body">
                <canvas id="diagramme-ligne"></canvas>
            </div>
        </div>

        <!-- doughnut-chart -->
        <div class="row">

            <div class="card col-4 shadow">
                <div class="card-body">
                    <canvas id="doughnut-chart"></canvas>
                </div>
            </div>

            <div class="col-lg-8">
                <!-- Tableau des rapports par date -->
                <div class="card shadow">
                    <div class="card-header">
                        <h3>Rapports par date</h3>
                    </div>
                    <table class="table table-striped table-inverse table-responsive p-2">
                        <thead class="thead-inverse">
                            <thead>
                                <tr>
                                    <th class="text-center">Inspecteur</th>
                                    <th class="text-center">Signés</th>
                                    <th class="text-center">Description</th>
                                    <th class="text-center">Date Tournée</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($latestRapports as $latestRapport)
                                    <tr>
                                        <td>{{ $latestRapport->inspecteur->nom }} {{ $latestRapport->inspecteur->prenom }}</td>
                                        <td class="text-center">
                                            @if ($latestRapport->signature == 1)
                                                <span class="text-white badge bg-success">Oui</span>
                                            @else
                                                <span class="text-white badge bg-danger">Non</span>
                                            @endif
                                        </td>
                                        <td>{{ $latestRapport->description }}</td>
                                        <td class="text-center">{{ $latestRapport->tournee->date }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts pour générer les graphiques -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Fonction pour générer le diagramme en ligne
        function generateLineChart() {
            var ctxLineChart = document.getElementById('diagramme-ligne');
            var labels = [];
            var signerCounts = [];
            var tournerCounts = [];

            // Parcourir les données pour extraire les informations nécessaires
            @foreach ($rapportsParDate as $date => $rapport)
                labels.push("{{ $date }}");
                signerCounts.push({{ $rapport['signer'] }});
                tournerCounts.push({{ $rapport['tourner'] }});
            @endforeach

            new Chart(ctxLineChart, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                            label: 'Tournées signées',
                            data: signerCounts,
                            fill: false,
                            borderColor: 'rgba(162, 200, 67, 1.5)',
                            tension: 0.1
                        },
                        {
                            label: 'Tournées non signées',
                            data: tournerCounts,
                            fill: false,
                            borderColor: 'rgba(192, 25, 191, 1.5)',
                            tension: 0.1
                        }
                    ]
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

        // Fonction pour générer le graphique de type Doughnut
        function generateDoughnutChart() {
            var ctxDoughnut = document.getElementById('doughnut-chart').getContext('2d');

            var doughnutData = @json($doughnutData);

            new Chart(ctxDoughnut, {
                type: 'doughnut',
                data: {
                    labels: Object.keys(doughnutData),
                    datasets: [{
                        label: 'Rapports',
                        data: Object.values(doughnutData),
                        backgroundColor: [
                            'rgba(162, 200, 67, 1.5)', // Couleur pour les rapports signés
                            'rgba(192, 25, 191, 1.5)' // Couleur pour les rapports de tournée
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    cutout: '50%',
                    plugins: {
                        legend: {
                            position: 'bottom'
                        },
                        title: {
                            display: true,
                            text: 'Répartition des rapports'
                        }
                    }
                }
            });
        }


        // Appel des fonctions pour générer les graphiques
        generateLineChart();
        // Appel de la fonction pour générer le graphique de type Doughnut
        generateDoughnutChart();
    </script>
@endsection
