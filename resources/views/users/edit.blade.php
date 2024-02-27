@extends("layouts.app")

@section("title", "Modifier un Utilisateur")

@section("content")

<form action="{{ route('users.update', $user->id) }}" method="post">
    @method("PATCH")
    @csrf

    <div class="card shadow">
        <div class="card-header">
            Modification d'un nouvel utilisateur
        </div>
        <div class="card-body">

            @include("users.partials.form")

        </div>
        <div class="card-footer d-flex justify-content-end">
            <button class="btn btn-danger" type="reset"> Annuler </button>
            <button class="btn btn-primary mx-3" type="submit"> Enregistrer </button>
        </div>
    </div>

</form>

@endsection
