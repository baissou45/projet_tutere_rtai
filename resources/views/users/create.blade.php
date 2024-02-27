@extends("layouts.app")

@section("title", "Nouvel utilisateur")

@section("content")

<form action="{{ route('users.store') }}" method="post">
    @csrf

    <div class="card shadow">
        <div class="card-header">
            Création d'un nouvel utilisateur
        </div>
        <div class="card-body">

            @include("users.partials.form")

        </div>
        <div class="card-footer d-flex justify-content-end">
            <button class="btn btn-danger" type="reset"> Annuler </button>
            <button class="btn btn-pink mx-3" type="submit"> Enregistrer </button>
        </div>
    </div>

</form>

@endsection
