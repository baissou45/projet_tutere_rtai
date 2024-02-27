@extends('layouts.app')

@section("content")
<div class="row">
    <div class="col-12">
        <div class="card m-b-30">
            <div class="card-body">


                {{-- <h5>Liste des artisants</h5> --}}
                <div class="d-flex justify-content-end mt-3 mr-3 mb-5">
                    <a href="{{ route('users.create') }}" class="btn btn-pink">
                        <i class="fa fa-user-plus" aria-hidden="true"></i>
                        Nouvel utilisateur
                    </a>
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
                                <td>{{ $user->sexe }}</td>
                                <td>{{ $user->tel }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->created_at }}</td>
                                <td class="d-flex justify-content-around">
                                    <a href="#"> <i class="fa fa-eye text-primary" aria-hidden="true"></i> </a>
                                    <a href="#"> <i class="fa fa-pencil text-secondary" aria-hidden="true"></i> </a>
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