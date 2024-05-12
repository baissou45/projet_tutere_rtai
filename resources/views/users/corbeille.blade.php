@extends('layouts.app')

@section("content")
<div class="row">
    <div class="col-12">
        <div class="card m-b-30">
            <div class="card-body">


                <h5>Liste des utilisateurs supprimés</h5>
                <p class="text-muted">Vous trouverez sur cette page, la liste des sécretaires que vous avez supprimé. Vous pourrez les rrestaurés ou les supprimés déffinitivemeent.</p>

                {{-- <div class="d-flex justify-content-between align-items-center mb-3 ml-3">
                    <div>
                        <p class="text-muted">
                            <strong class="text-success">Légende</strong> <br>
                            <strong class="text-primary">Copy</strong> : Copier les données du tableau en format text <br>
                            <strong class="text-primary">Excel</strong> : Exporter les données du tableau au format excels (xlsx) <br>
                            <strong class="text-primary">PDF</strong> : Exporter les données du tableau au format pdf
                        </p>
                    </div>

                    <div class="">
                        <div class="d-flex justify-content-end mt-3 mr-3 mb-5">
                            <a href="{{ route('users.create') }}" class="btn btn-primary">
                                <i class="fa fa-user-plus" aria-hidden="true"></i>
                                Nouvel utilisateur
                            </a>
                        </div>
                    </div>
                </div> --}}

                <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">

                    <thead>
                        <tr>
                            <th></th>
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
                        <form action="{{ route('users.trash_action') }}" method="post">
                           @csrf

                            @forelse ($users as $user)
                                <tr>
                                    <td>
                                        <input value="{{ $user->id }}" name="ids[]" type="checkbox">
                                    </td>
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
                                    </td>
                                </tr>
                            @empty
                                <td colspan="9" class="text-center">
                                    Aucune donnée
                                </td>
                            @endforelse
                            <tr>
                                <td colspan="9">
                                    <div class="pull-right d-flex">
                                        <select name="action" class="form-control col-7">
                                            <option value="r">Restaurer</option>
                                            <option value="s">Supprimer définitivement</option>
                                        </select>

                                        <input type="submit" class="btn btn-primary ml-3" value="Appliquer">
                                    </div>
                                </td>
                            </tr>

                        </form>
                    </tbody>
                </table>

            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->
@endsection