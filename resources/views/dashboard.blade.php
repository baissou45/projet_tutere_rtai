@extends('layouts.app')

@section("css")
<link rel="stylesheet" href="{{ asset('template/back/assets/plugins/morris/morris.css') }}">
@endsection

@section("content")
<div class="header-bg py-3 mb-3">
    <div class="container-fluid">
        <h5 class="text-white text-center">Evolution des inspections de cette année</h5>
        <div class="col-12 mb-4 pt-5">
            <div id="morris-bar-example" class="dash-chart"></div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6 col-xl-3">
        <div class="card text-center shadow m-b-30">
            <div class="mb-2 card-body text-muted">
                <h3 class="text-info"> {{ $nbr["secretaire"] }} </h3>
                Nombre de Secrétaire
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xl-3">
        <div class="card text-center shadow m-b-30">
            <div class="mb-2 card-body text-muted">
                <h3 class="text-purple"> {{ $nbr["inspecteur"] }} </h3>
                Nombre d'inspecteur
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xl-3">
        <div class="card text-center shadow m-b-30">
            <div class="mb-2 card-body text-muted">
                <h3 class="text-primary"> {{ $nbr["rapports"] }} </h3>
                Nombre de rapport
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xl-3">
        <div class="card text-center shadow m-b-30">
            <div class="mb-2 card-body text-muted">
                <h3 class="text-danger"> {{ $nbr["inspection"] }} </h3>
                Nombre d'inspection
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xl-7">
        <div class="card shadow m-b-30">
            <div class="card-header">
                <h5>Inspections de la semaine</h5>
            </div>
            <div class="card-body">
                <div id="morris-area-example" class="dash-chart"></div>
            </div>
        </div>
    </div>

    <div class="col-xl-5">
        <div class="card shadow">
            <div class="card-header">
                <h5>Les meilleurs inspecteurs</h5>
            </div>
            <div class="card-body px-3 pt-3 pb-2">
                <table class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">

                    <thead>
                        <tr>
                            <th>Inspecteur</th>
                            <th>Secrétairer</th>
                            <th>Nbr Inspection</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->nom . ' ' . $user->prenom }}</td>
                                <td>{{ $user->secretaire->nom . ' ' . $user->secretaire->prenom }}</td>
                                <td>{{ $user->nbr_tournees }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="card shadow">
    <div class="card-header">
        <h5>Rapports récents</h5>
    </div>
    <div class="card-body">
        <table class="table table-striped table-bordered dt-responsive" style="border-collapse: collapse; border-spacing: 0; width: 100%;">

            <thead>
                <tr>
                    <th> Inspecteur </th>
                    <th> Tournée </th>
                    <th> Signature </th>
                    <th class="col-4"> Description </th>
                    <th> Date Création </th>
                    <th> Action </th>
                </tr>
            </thead>

            <tbody>
                @foreach ($last_rapports as $rapport)
                    <tr>
                        <td > {{ $rapport->inspecteur?->nom . ' ' . $rapport->inspecteur?->prenom }} </td>
                        <td>
                            <i class="fa fa-calendar text-pink"></i> : {{ $rapport->tournee->date }} <br>
                            <i class="fa fa-home text-success"></i> : {{ $rapport->tournee->adresse_complet }}
                        </td>
                        <td> {{ $rapport->signature ? "Oui" : "Non" }} </td>
                        <td> {{ $rapport->description }} </td>
                        <td> {{ $rapport->created_at }} </td>
                        <td class="d-flex justify-content-center border-0">
                            <a target="_blanc" href="{{ route('rapports.generate_pdf', $rapport->id) }}"> <i class="fa fa-file-pdf-o fa-2x text-danger" aria-hidden="true"></i> </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection


@section("script")
    <script>
        var data = @json($data);
        var data_semaine = @json($data_semaine);
        console.log(data_semaine);
    </script>

    <!--Morris Chart-->
    <script src="{{ asset('template/back/assets/plugins/morris/morris.min.js') }}"></script>
    <script src="{{ asset('template/back/assets/plugins/raphael/raphael-min.js') }}"></script>
    <script src="{{ asset('js/dashboard.js') }}"></script>
@endsection