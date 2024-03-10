<div class="content-page">
    <div class="page">
        <div class="page-content-wrapper">
            <div class="container-fluid" wire:ignore.self>
                <div class="row">
                    <div class="col-md-6 col-xl-3">
                        <div class="text-center card m-b-30">
                            <div class="mb-2 card-body text-muted">
                                <h3 class="text-info">{{ $totalUsers }}</h3>
                                Utilisateurs
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-xl-3">
                        <div class="text-center card m-b-30">
                            <div class="mb-2 card-body text-muted">
                                <h3 class="text-purple">{{ $totalTournees }}</h3>
                                Tournees
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-xl-3">
                        <div class="text-center card m-b-30">
                            <div class="mb-2 card-body text-muted">
                                <h3 class="text-primary">{{ $totalWrittenReports }}</h3>
                                Rapport
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-xl-3">
                        <div class="text-center card m-b-30">
                            <div class="mb-2 card-body text-muted">
                                <h3 class="text-danger">{{ $totalTransfersMade }}</h3>
                                Transfer
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end row -->

                <div class="row" wire:ignore>
                    <div class="col-xl-4 text-end">
                        <div class="card m-b-30">
                            <div class="card-body text-end">
                                <h4 class="mt-0 header-title">Répartition par sexe</h4>
                                <div class="btn-group" wire:ignore>
                                    <button type="button" class="btn btn-secondary dropdown-toggle"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span class="text font-size-12">Filter:</span> <span
                                            class="fw-medium">{{ $userChoiceselectType }}</span>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a wire:click='selectType("i")' class="dropdown-item"
                                            href="#">Inspecteur(I)</a>
                                        <a wire:click='selectType("s")' class="dropdown-item"
                                            href="#">Sécretaire(S)</a>
                                        <a wire:click='selectType("a")' class="dropdown-item"
                                            href="#">Admin(A)</a>
                                        <a wire:click='selectType("tout")' class="dropdown-item"
                                            href="#">Tout(tout)</a>
                                    </div>
                                </div>
                                <div class="text-center row m-t-20" wire.ignore.self>
                                    @foreach ($piechartcomparingthesexedistributionofusers['seriesName'] as $index => $gender)
                                        <div class="col-6">
                                            <h5 class="{{ strtolower($gender) }}Count">
                                                {{ $piechartcomparingthesexedistributionofusers['seriesData'][$index] ?? 0 }}
                                            </h5>
                                            <p class="text-muted font-14">
                                                {{ $gender === 'Homme' ? 'Homme (h)' : 'Femme (f)' }}</p>
                                        </div>
                                    @endforeach
                                </div>

                                <div id="sexDistributionChart" wire:ignore></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-8">
                        <div class="card m-b-30">
                            <div class="card-body">
                                <h4 class="mt-0 header-title">Graphique Croisé : Distribution des tours par inspecteur
                                    et la durée du tour || Évolution du nombre total de tours au fil du temps</h4>
                                <div>
                                    <h4 class="mt-0 header-title">Filtres</h4>
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="mr-3">
                                            <label for="choix1">Filter 1:</label>
                                            <select id="choix1" wire:change='changechoix1($event.target.value)'
                                                class="form-control">
                                                <option value="i">Inspecteur(I)</option>
                                                <option value="s">Secrétaire(S)</option>
                                                <option value="a">Admin(A)</option>
                                                <option value="tout">Tout(tout)</option>
                                            </select>
                                        </div> &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;

                                        <div>
                                            <label for="choix2">Filter 2:</label>
                                            <select id="choix2" wire:change='changechoix2($event.target.value)'
                                                class="form-control">
                                                <option value="mois">Ce mois</option>
                                                <option value="semaine">Cette semaine</option>
                                            </select>
                                        </div>
                                    </div>

                                </div>

                                <div id="mergedGraph" wire:ignore></div>
                            </div>
                        </div>
                    </div>


                </div>
                <!-- end row -->

                <div class="card m-b-30">
                    <div class="card-body text-end">
                        <div class="row">
                            <h4 class="mt-0 m-b-30 header-title">Latest calendar</h4>
                            <div class="col-12" wire:ignore id='calendar'></div>
                        </div>
                    </div>
                </div>
                <!-- end row -->

            </div>

        </div> <!-- Page content Wrapper -->

    </div>
</div>

<script>
    
    document.addEventListener('livewire:load', function() {
        var chart;

        Livewire.on('dataChanged', function(chartData) {
            if (chart) {
                chart.updateSeries(chartData.seriesData);
                chart.updateOptions({
                    labels: chartData.seriesName
                });
            } else {
                chart = new ApexCharts(document.querySelector("#sexDistributionChart"), {
                    chart: {
                        type: 'pie',
                        height: 450,
                        width: 450
                    },
                    series: chartData.seriesData,
                    labels: chartData.seriesName,
                    colors: ["#007BFF", "#FF4500"],
                    responsive: [{
                        breakpoint: 380,
                        options: {
                            width: 450
                        },
                        legend: {
                            position: 'bottom'
                        }
                    }]
                });
                chart.render();
            }
        });
    });
</script>


<script>
    document.addEventListener('livewire:load', function() {
        Livewire.on('dataChanged', function(dataGraph1, dataGraph2) {
            // Fusionner les données des deux graphiques
            var mergedData = {
                graph1: dataGraph1,
                graph2: dataGraph2
            };

            // Configuration des options du graphique fusionné
            var options = {
                chart: {
                    height: 400,
                    type: 'bar',
                    stacked: false,
                    toolbar: {
                        show: true,
                        tools: {
                            download: false,
                            selection: false,
                            zoom: false,
                            zoomin: false,
                            zoomout: false,
                            pan: false,
                            reset: false
                        }
                    }
                },
                plotOptions: {
                    bar: {
                        horizontal: false,
                        columnWidth: '45%',
                        endingShape: 'flat'
                    },
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    show: true,
                    width: 2,
                    colors: ['transparent']
                },
                series: [{
                    name: 'Distribution des tours par inspecteur',
                    data: mergedData.graph1.map(item => item.count)
                }, {
                    name: 'Évolution du nombre total de tours',
                    data: mergedData.graph2.map(item => item.count)
                }],
                xaxis: {
                    categories: mergedData.graph1.map(item => item.inspecteur_id),
                    labels: {
                        show: true,
                        rotate: -45,
                        rotateAlways: true,
                        hideOverlappingLabels: true,
                        trim: true,
                        minHeight: undefined,
                        maxHeight: 120,
                        style: {
                            colors: [],
                            fontSize: '12px',
                            fontFamily: 'Helvetica, Arial, sans-serif',
                            fontWeight: 400,
                            cssClass: 'apexcharts-xaxis-label'
                        },
                        offsetX: 0,
                        offsetY: 0,
                        format: undefined,
                        formatter: undefined,
                        datetimeFormatter: {
                            year: 'yyyy',
                            month: "MMM 'yy",
                            day: 'dd MMM',
                            hour: 'HH:mm'
                        },
                    },
                },
                yaxis: [{
                    axisTicks: {
                        show: true,
                    },
                    axisBorder: {
                        show: true,
                        color: '#FEB019'
                    },
                    labels: {
                        style: {
                            color: '#FEB019',
                        }
                    },
                    title: {
                        text: "Nombre de Tours",
                        style: {
                            color: '#FEB019',
                        }
                    }
                }, {
                    opposite: true,
                    axisTicks: {
                        show: true,
                    },
                    axisBorder: {
                        show: true,
                        color: '#00E396'
                    },
                    labels: {
                        style: {
                            color: '#00E396',
                        }
                    },
                    title: {
                        text: "Évolution",
                        style: {
                            color: '#00E396',
                        }
                    }
                }],
                tooltip: {
                    shared: true,
                    intersect: false,
                },
                legend: {
                    horizontalAlign: 'left',
                    offsetX: 40
                }
            };

            // Initialiser ou mettre à jour le graphique fusionné
            var mergedGraph = new ApexCharts(document.querySelector("#mergedGraph"), options);
            mergedGraph.render();
        });
    });
</script>
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.9/index.global.min.js'></script>
<script>
    document.addEventListener('livewire:load', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'timeGridWeek',
            timeZone: 'UTC',
            editable: true,
            selectable: true,
            events: {!! $tournees !!},
            select: function(data) {
                var adresse_complet = prompt('Nom de la tournee:');
                if (!adresse_complet) {
                    return;
                }
                @this.newTournee(adresse_complet, data.startStr, data.endStr)
                    .then(function(id) {
                        calendar.addEvent({
                            id: id,
                            adresse_complet: adresse_complet,
                            date: data.date,
                            etat: data.etat,
                        });
                        calendar.unselect();
                    });
            },
            eventDrop: function(data) {
                @this.updateTournee(
                    data.event.id,
                    data.event.adresse_complet,
                    data.event.dateStr,
                    data.event.etatStr
                ).then(function() {
                    alert('Tournee déplacée');
                })
            },
        });
        calendar.render();
    });
</script>
