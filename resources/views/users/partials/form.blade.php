@section("css")
    <link href="{{ asset('template/back/assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />

    <style>
        .select2-selection__rendered {
            line-height: 33px !important;
        }
        .select2-container .select2-selection--single {
            height: 37px !important;
        }
        .select2-selection__arrow {
            height: 36px !important;
        }
    </style>
@endsection

<p class="d-flex justify-content-end my-3">
    <i>Tous les champs marqués d'un <span class="text-danger">(*)</span> sont obligatoires</i>
</p>

<div class="row">
    <x-input libelle="Nom" type="text" size="col-12 col-md-6" name="nom" required value="{{ $user?->nom }}" />
    <x-input libelle="Prénom" type="text" size="col-12 col-md-6" required name="prenom" value="{{ $user?->prenom }}" />

    <div class="form-group col-6">
        <label for="sexe">Sexe</label>
        <select name="sexe" id="sexe" class="form-control">
            <option value="h">Homme</option>
            <option value="f">Femme</option>
        </select>
    </div>

    <x-input libelle="Téléphone" type="text" size="col-12 col-md-6" required name="tel" value="{{ $user?->tel }}" />
</div>

<hr>

<div class="row">
    @php
        $row = $route != "user" ? "col-md-4" : "col-md-6";
    @endphp
    <x-input libelle="Email" type="text" required size="col-12 {{ $row }}" name="email" value="{{ $user?->email }}" />

    <div class="form-group col-12 {{ $route != "user" ? "col-md-4" : "col-md-6" }}">
        <label for="profile_img">Photo de profil</label>
        <input id="profile_img" class="form-control" type="file" name="profile_img">
        @error('profile_img')
            <small class="text-danger"> {{ $errors->first('profile_img') }} </small>
        @enderror
    </div>

    @if($route != "user")
        <div class="form-group col-md-4">
            <label for="secretaire">Secrétaire</label>
            <select id="secretaire" class="form-control select2" name="secretaire">
                <option>Veuillez choisir un secretaire</option>
                @foreach ($secretaires as $s)
                    <option value="{{ $s->id }}" {{ $s->id == $user?->secretaire_id ? "selected" : "" }} > {{ $s->nom . ' ' . $s->prenom }} </option>
                @endforeach
            </select>
        </div>
    @endif

    {{-- <x-input libelle="Mot de passe" type="password" required size="col-12 col-md-6" name="password"/>
    <x-input libelle="Confirmer votre mot de passe" type="password" size="col-12 col-md-6" name="password_confirmation"/> --}}
</div>


@section("script")
    <script src="{{ asset('template/back/assets/plugins/select2/js/select2.min.js') }}"></script>
    <script>
        $(".select2").select2();
    </script>
@endsection