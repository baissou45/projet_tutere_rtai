@extends('layouts.app')

@section("content")
<div class="row">
    <div class="col-12">
        <div class="card m-b-30">
            <div class="card-body">


                <h5>Liste des inspecteurs</h5>
                <p class="text-muted">Vous trouverez sur cette page, la liste des inspecteurs</p>

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
                            <a href="{{ route('inspecteur.trash') }}" class="btn btn-orange mr-2">
                                <i class="fa fa-trash" aria-hidden="true"></i>
                                Corbeille
                            </a>
                            <a href="{{ route('inspecteur.create') }}" class="btn btn-pink">
                                <i class="fa fa-user-plus" aria-hidden="true"></i>
                                Ajouter un inspecteur
                            </a>
                        </div>
                    </div>
                </div>

                <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">

                    <thead>
                        <tr>
                            <th class="col-1">Profil</th>
                            <th>Nom complet</th>
                            <th>Sexe</th>
                            <th>Contact</th>
                            <th>Adresse mail</th>
                            <th>Date création</th>
                            <th>Secrétaire</th>
                            <th>Action</th>
                        </tr>
                    </thead>


                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>
                                    <img src="{{ asset('template/back/assets/images/users/avatar-1.jpg') }}" class="rounded-circle" width="50%">
                                </td>
                                <td>{{ $user->nom . ' ' . $user->prenom }}</td>
                                <td>{{ $user->sexe == "h" ? "Homme" : "Femme" }}</td>
                                <td>{{ $user->tel }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->created_at }}</td>
                                <td>{{ $user->secretaire?->nom . ' ' . $user->secretaire?->prenom }}</td>
                                <td class="d-flex justify-content-around">
                                    <a href="{{ route('users.edit', $user->id) }}"> <i class="fa fa-pencil text-secondary" aria-hidden="true"></i> </a>
                                    <a onclick="show_alerte(`{{ route('users.destroy', $user->id) }}`)" class="waves-effect waves-light sa-warning"> <i class="fa fa-trash text-danger" aria-hidden="true"></i> </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->
@endsection