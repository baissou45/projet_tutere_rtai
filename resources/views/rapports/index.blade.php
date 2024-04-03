@extends('layouts.app')

@section("content")
<div class="row">
    <div class="col-12">
        <div class="card m-b-30">
            <div class="card-body">


                <h5>Liste des utilisateurs</h5>
                <p class="text-muted">Vous trouverez sur cette page, la liste des sécretaires</p>

                <div class="d-flex justify-content-between align-items-center mb-3 ml-3">
                    <div>
                        <p class="text-muted">
                            <strong class="text-success">Légende</strong> <br>
                            <strong class="text-pink">Copy</strong> : Copier les données du tableau en format text <br>
                            <strong class="text-pink">Excel</strong> : Expoeter les données du tableau au format excels (xlsx) <br>
                            <strong class="text-pink">PDF</strong> : Expoeter les données du tableau au format pdf
                        </p>
                    </div>

                    <div class="">
                        <div class="d-flex justify-content-end mt-3 mr-3 mb-5">
                            <a href="{{ route('users.trash') }}" class="btn btn-orange mr-2">
                                <i class="fa fa-trash" aria-hidden="true"></i>
                                Corbeille
                            </a>
                            <a href="{{ route('users.create') }}" class="btn btn-pink">
                                <i class="fa fa-rapport-plus" aria-hidden="true"></i>
                                Nouvel utilisateur
                            </a>
                        </div>
                    </div>
                </div>

                <form action="{{ route('rapports.generate_pdf_ademe') }}" method="post">
                    @csrf

                    <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive" style="border-collapse: collapse; border-spacing: 0; width: 100%;">

                        <thead>
                            <tr>
                                <th></th>
                                <th> Inspecteur </th>
                                <th> Tournée </th>
                                <th> Signature </th>
                                <th class="col-4"> Description </th>
                                <th> Date </th>
                                <th> Action </th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($rapports as $rapport)
                                <tr>
                                    <td>
                                        <input value="{{ $rapport->id }}" name="ids[]" type="checkbox">
                                    </td>
                                    <td > {{ $rapport->inspecteur?->nom . ' ' . $rapport->inspecteur?->prenom }} </td>
                                    <td>
                                        <i class="fa fa-calendar text-pink"></i> : {{ $rapport->tournee->date }} <br>
                                        <i class="fa fa-home text-success"></i> : {{ $rapport->tournee->adresse_complet }}
                                    </td>
                                    <td> {{ $rapport->signature ? "Oui" : "Non" }} </td>
                                    <td> {{ $rapport->description }} </td>
                                    <td>{{ $rapport->created_at }}</td>
                                    <td class="d-flex justify-content-around">
                                        <a target="_blanc" href="{{ route('rapports.generate_pdf', $rapport->id) }}"> <i class="fa fa-file-pdf-o fa-2x text-danger" aria-hidden="true"></i> </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tr>
                            <td colspan="7">
                                <div class="pull-right d-flex">
                                    <input type="submit" class="btn btn-pink ml-3" value="Générer rapport ADEME">
                                </div>
                            </td>
                        </tr>
                    </table>
                </form>

            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->

@endsection
