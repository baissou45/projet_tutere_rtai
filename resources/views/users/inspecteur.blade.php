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
                            @if (auth()->user()->type == 'a')
                                <a href="{{ route('inspecteur.trash') }}" class="btn btn-orange mr-2">
                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                    Corbeille
                                </a>
                            @endif
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
                            <th>Secrétaire</th>
                            <th>Nbr Inspection</th>
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
                                <td>{{ $user->nom . ' ' . $user->prenom }}</td>
                                <td>{{ $user->sexe == "h" ? "Homme" : "Femme" }}</td>
                                <td>{{ $user->tel }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    <span style="text-decoration: {{ $user->new_inspecteur() ? 'line-through' : 'none' }} " class="text-pink font-weight-bold">
                                        {{ $user->secretaire?->nom . ' ' . $user->secretaire?->prenom }}
                                    </span> <br>
                                    @if ($user->new_inspecteur())
                                        <span class="text-success font-weight-bold">
                                            {{ $user->new_inspecteur()?->nom . ' ' . $user->new_inspecteur()?->prenom . ' (' . $user->new_inspecteur()?->fin_transfert . ' jours)' }}
                                        </span>
                                    @endif
                                </td>
                                <td class="text-center text-pink text-bold">{{ $user->tournees->count() }}</td>
                                <td>{{ $user->created_at }}</td>
                                <td class="d-flex justify-content-around">
                                    <a href="{{ route('users.edit', $user->id) }}"> <i class="fa fa-pencil text-secondary" aria-hidden="true"></i> </a>
                                    <a onclick="show_alerte(`{{ route('users.destroy', $user->id) }}`)" class="waves-effect waves-light sa-warning"> <i class="fa fa-trash text-danger" aria-hidden="true"></i> </a>
                                    @if (auth()->user()->type == 'a')
                                        <a onclick="show_modal({{ $user }})" href="#"> <i class="fa fa-user-secret text-pink" aria-hidden="true"></i> </a>
                                    @endif
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
                <h4 class="modal-title" id="my-modal-title">Affectation d'inspecteur</h4>
            </div>
            <div class="modal-body">

                <form action="{{ route('inspecteur.affectatiion') }}" method="post">
                    @csrf

                    <input type="hidden" name="inspecteur" id="inspecteur" value="">

                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="my-select">Secretaire</label>
                            <select id="my-select" class="form-control" name="secretaire" required>
                                @foreach ($secretaires as $secretaire)
                                    <option value="{{ $secretaire->id }}">{{ $secretaire->nom . ' '. $secretaire->prenom }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="date_debut">Début du transfert</label>
                            <input id="date_debut" class="form-control" type="date" name="debut" required>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="date_fin">Fin du transfert</label>
                            <input id="date_fin" class="form-control" type="date" name="fin" required>
                        </div>

                        <div class="form-group col-md-12">
                            <label for="description">Motif</label>
                            <textarea id="description" class="form-control" name="description" rows="3"></textarea>
                        </div>

                    </div>

                    <div class="d-flex justify-content-end">
                        <input type="submit" class="btn btn-pink" value="Affecter">
                    </div>
                </form>

                <hr class="my-3">

                <h5 class="my-3">Historique d'affectation</h5>
                <table id="datatable" class="table table-striped table-bordered dt-responsive" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead class="thead-inverse">
                        <tr>
                            <th>Inspecteur</th>
                            <th>Date début</th>
                            <th>Date Fin</th>
                            <th>Motif</th>
                        </tr>
                        </thead>
                        <tbody class="modal_table"></tbody>
                </table>
            </div>
        </div>
    </div>
</div>


@endsection


@section("script")
    <script>
        show_modal = (user) => {
            console.log(user);

            $('#inspecteur').val(user.id);

            var t_body = '';
            user.inspecteur_tranferts.forEach(element => {
                console.log(element);

                if (element.new_secretaire) {
                    t_body += `
                        <tr>
                            <td>${element.new_secretaire.nom} ${element.new_secretaire.prenom}</td>
                            <td>${element.date_debut}</td>
                            <td>${element.date_fin}</td>
                            <td>${element.description}</td>
                        </tr>
                    `;
                }
            });

            $('.modal_table').html(t_body);
            $('#my-modal').modal('show');
        }
    </script>
@endsection