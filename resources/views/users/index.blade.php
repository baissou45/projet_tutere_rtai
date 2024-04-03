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
                                <i class="fa fa-user-plus" aria-hidden="true"></i>
                                Nouvel utilisateur
                            </a>
                        </div>
                    </div>
                </div>

                <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">

                    <thead>
                        <tr>
                            <th class="col-1">Profile</th>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Sexe</th>
                            <th>Contact</th>
                            <th>Adresse mail</th>
                            <th>Date création</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>
                                    <img src="{{ asset('template/back/assets/images/users/avatar-1.jpg') }}" class="rounded-circle" width="50%">
                                </td>
                                <td>{{ $user->nom }}</td>
                                <td>{{ $user->prenom }}</td>
                                <td>{{ $user->sexe == "h" ? "Homme" : "Femme" }}</td>
                                <td>{{ $user->tel }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->created_at }}</td>
                                <td class="d-flex justify-content-around">
                                    <a href="{{ route('users.edit', $user->id) }}"> <i class="fa fa-pencil text-secondary" aria-hidden="true"></i> </a>
                                    <a onclick="show_alerte(`{{ route('users.destroy', $user->id) }}`)" class="waves-effect waves-light sa-warning"> <i class="fa fa-trash text-danger" aria-hidden="true"></i> </a>
                                    <a onclick="show_inspecteurs({{ json_encode($user->inspecteurs) }})" class="waves-effect waves-light sa-warning"> <i class="fa fa-list" aria-hidden="true"></i> </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->

<div id="my-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="my-modal-title">Liste des inspecteurs</h5>
            </div>
            <div class="modal-body">
                <table class="table table-striped table-hover align-middle my_table datatable">
                    <thead class="thead-inverse">
                        <tr>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Sexe</th>
                            <th>Contact</th>
                        </tr>
                        </thead>
                        <tbody class="inspecteurs"></tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection

@section("script")
    <script>
        show_inspecteurs = (inspecteurs) => {
            let liste = "";
            inspecteurs.forEach(element => {
                liste += `
                    <tr>
                        <td>${element.nom}</td>
                        <td>${element.prenom}</td>
                        <td>${element.sexe == "h" ? "Homme" : "Femme" }</td>
                        <td>${element.tel}</td>
                    </tr>
                `
            });
            $('.inspecteurs').html(liste);
            $('#my-modal').modal('show');
        }
    </script>
@endsection