{{-- <div> --}}
<<div class="page-content-wrapper">

    <div class="header-bg">
        <div class="container-fluid">
            <div class="row">
                <div class="pt-5 mb-4 col-12">
                    <div id="morris-bar-example" class="dash-chart"></div>

                    <div class="mt-4 text-center">
                        <button type="button" class="ml-1 btn btn-outline-primary waves-effect waves-light">Year
                            2017</button>
                        <button type="button" class="ml-1 btn btn-outline-info waves-effect waves-light">Year
                            2018</button>
                        <button type="button" class="ml-1 btn btn-outline-primary waves-effect waves-light">Year
                            2019</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid-fluid">
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

        <div class="row">

            <div class="col-xl-4">
                <div class="card m-b-30">
                    <div class="card-body">
                        <h4 class="mt-0 header-title">Répartition par sexe</h4>

                        <div class="text-center row m-t-20">
                            <div class="col-6">
                                <h5 class="maleCount"></h5>
                                <p class="text-muted font-14">Homme (h)</p>
                            </div>
                            <div class="col-6">
                                <h5 class="femaleCount"></h5>
                                <p class="text-muted font-14">Femme (f)</p>
                            </div>
                        </div>

                        <div id="sexDistributionChart"></div>
                    </div>
                </div>
            </div>


            <div class="col-xl-8">
                <div class="card m-b-30">
                    <div class="card-body">
                        <h4 class="mt-0 header-title">Email Sent</h4>

                        <div class="text-center row m-t-20">
                            <div class="col-4">
                                <h5 class="">56241</h5>
                                <p class="text-muted font-14">Marketplace</p>
                            </div>
                            <div class="col-4">
                                <h5 class="">23651</h5>
                                <p class="text-muted font-14">Total Income</p>
                            </div>
                            <div class="col-4">
                                <h5 class="">23651</h5>
                                <p class="text-muted font-14">Last Month</p>
                            </div>
                        </div>

                        <div id="morris-area-example" class="dash-chart"></div>
                    </div>
                </div>
            </div>

        </div>
        <!-- end row -->

        <div class="row">
            <div class="col-xl-8">
                <div class="card m-b-30">
                    <div class="card-body">
                        <h4 class="mt-0 m-b-30 header-title">Latest Transactions</h4>

                        <div class="table-responsive">
                            <table class="table mb-0 m-t-20 table-vertical">

                                <tbody>
                                    <tr>
                                        <td>
                                            <img src="assets/images/users/avatar-2.jpg" alt="user-image"
                                                class="mr-2 thumb-sm rounded-circle" />
                                            Herbert C. Patton
                                        </td>
                                        <td><i class="mdi mdi-checkbox-blank-circle text-success"></i> Confirm</td>
                                        <td>
                                            $14,584
                                            <p class="m-0 text-muted font-14">Amount</p>
                                        </td>
                                        <td>
                                            5/12/2016
                                            <p class="m-0 text-muted font-14">Date</p>
                                        </td>
                                        <td>
                                            <button type="button"
                                                class="btn btn-secondary btn-sm waves-effect">Edit</button>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <img src="assets/images/users/avatar-3.jpg" alt="user-image"
                                                class="mr-2 thumb-sm rounded-circle" />
                                            Mathias N. Klausen
                                        </td>
                                        <td><i class="mdi mdi-checkbox-blank-circle text-warning"></i> Waiting
                                            payment</td>
                                        <td>
                                            $8,541
                                            <p class="m-0 text-muted font-14">Amount</p>
                                        </td>
                                        <td>
                                            10/11/2016
                                            <p class="m-0 text-muted font-14">Date</p>
                                        </td>
                                        <td>
                                            <button type="button"
                                                class="btn btn-secondary btn-sm waves-effect">Edit</button>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <img src="assets/images/users/avatar-4.jpg" alt="user-image"
                                                class="mr-2 thumb-sm rounded-circle" />
                                            Nikolaj S. Henriksen
                                        </td>
                                        <td><i class="mdi mdi-checkbox-blank-circle text-success"></i> Confirm</td>
                                        <td>
                                            $954
                                            <p class="m-0 text-muted font-14">Amount</p>
                                        </td>
                                        <td>
                                            8/11/2016
                                            <p class="m-0 text-muted font-14">Date</p>
                                        </td>
                                        <td>
                                            <button type="button"
                                                class="btn btn-secondary btn-sm waves-effect">Edit</button>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <img src="assets/images/users/avatar-5.jpg" alt="user-image"
                                                class="mr-2 thumb-sm rounded-circle" />
                                            Lasse C. Overgaard
                                        </td>
                                        <td><i class="mdi mdi-checkbox-blank-circle text-danger"></i> Payment
                                            expired</td>
                                        <td>
                                            $44,584
                                            <p class="m-0 text-muted font-14">Amount</p>
                                        </td>
                                        <td>
                                            7/11/2016
                                            <p class="m-0 text-muted font-14">Date</p>
                                        </td>
                                        <td>
                                            <button type="button"
                                                class="btn btn-secondary btn-sm waves-effect">Edit</button>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <img src="assets/images/users/avatar-6.jpg" alt="user-image"
                                                class="mr-2 thumb-sm rounded-circle" />
                                            Kasper S. Jessen
                                        </td>
                                        <td><i class="mdi mdi-checkbox-blank-circle text-success"></i> Confirm</td>
                                        <td>
                                            $8,844
                                            <p class="m-0 text-muted font-14">Amount</p>
                                        </td>
                                        <td>
                                            1/11/2016
                                            <p class="m-0 text-muted font-14">Date</p>
                                        </td>
                                        <td>
                                            <button type="button"
                                                class="btn btn-secondary btn-sm waves-effect">Edit</button>
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4">
                <div class="card m-b-30">
                    <div class="card-body">
                        <h4 class="mt-0 m-b-15 header-title">Recent Activity Feed</h4>

                        <ol class="mb-0 activity-feed">
                            <li class="feed-item">
                                <span class="date">Sep 25</span>
                                <span class="activity-text">Responded to need “Volunteer Activities”</span>
                            </li>

                            <li class="feed-item">
                                <span class="date">Sep 24</span>
                                <span class="activity-text">Added an interest “Volunteer Activities”</span>
                            </li>
                            <li class="feed-item">
                                <span class="date">Sep 23</span>
                                <span class="activity-text">Joined the group “Boardsmanship Forum”</span>
                            </li>
                            <li class="feed-item">
                                <span class="date">Sep 21</span>
                                <span class="activity-text">Responded to need “In-Kind Opportunity”</span>
                            </li>
                            <li class="feed-item">
                                <span class="date">Sep 18</span>
                                <span class="activity-text">Created need “Volunteer Activities”</span>
                            </li>
                            <li class="feed-item">
                                <span class="date">Sep 17</span>
                                <span class="activity-text">Attending the event “Some New Event”. Responded to
                                    needed.</span>
                            </li>
                            <li class="pb-1 feed-item">
                                <span class="activity-text">
                                    <a href="" class="text-primary">More Activities</a>
                                </span>
                            </li>
                        </ol>
                    </div>
                </div>
            </div>


        </div>
        <!-- end row -->

    </div>

    </div> <!-- Page content Wrapper -->
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        var options = {
            chart: {
                type: 'donut',
                height: 300,
            },
            series: [],
            labels: [],
            colors: [
                "#FF4500", // Red
                "#007BFF", // Blue
            ],
            responsive: [{
                breakpoint: 480,
                options: {
                    chart: {
                        width: 300
                    },
                    legend: {
                        position: 'bottom'
                    }
                }
            }],
            events: {
                dataPointSelection: function(event, chartContext, config) {
                    var type = config.w.config.labels[config.dataPointIndex];
                    console.log('Selected Type:', type);

                    // Implement your desired action upon selection
                    // For example, redirect the user to another page with the selected type as a URL parameter
                    // window.location.href = 'your-route?type=' + type;
                }
            }
        };

        // Process data from piechartcomparingthesexedistributionofusers
        <?php foreach ($piechartcomparingthesexedistributionofusers as $data) : ?>
        options.series.push(<?= $data['count'] ?>);
        options.labels.push("<?= $data['sexe'] === 'h' ? 'Homme' : 'Femme' ?>");
        <?php endforeach; ?>

        var chart = new ApexCharts(document.querySelector("#sexDistributionChart"), options);
        chart.render();

        // Update count elements after chart rendering is complete
        var maleCount = document.querySelector('.maleCount');
        var femaleCount = document.querySelector('.femaleCount');

        // Wait for chart to render using a callback function
        chart.addListener('afterRender', function() {
            maleCount.textContent = options.series[0];
            femaleCount.textContent = options.series[1];
        });
    </script>
    <script></script>
    {{-- </div> --}}
