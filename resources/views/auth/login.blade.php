@extends("layouts.guest")

@section("content")

<div class="card">
    <div class="card-body">

        <h3 class="text-center m-0">
            <a href="#" class="logo logo-admin">
                <img src="{{ asset('template/back/assets/images/logo_dark.png') }}" class="w-25" alt="logo">
            </a>
        </h3>

        @if ($errors->any())
            <div class="alert alert-danger" role="alert">
                <p class="text-center"> A mistake occurred </p>
            </div>
        @endif

        <div class="p-3">
            <p class="text-muted font-18 m-b-5 text-center">Welcome back !</p>
            <p class="text-muted text-center">Veuillez vous connecter</p>

            <form class="form-horizontal m-t-30" action="{{ route('login') }}" method="POST">
                @csrf

                <x-input libelle="Email" type="text" size="col-12" name="email" />
                <x-input libelle="Mot de passe" type="password" size="col-12" name="password" />

                <div class="form-group row m-t-20 d-flex justify-content-center">
                    <button class="btn btn-primary w-md waves-effect waves-light" type="submit">Log In</button>
                </div>

                {{-- <div class="form-group m-t-10 mb-0 row">
                    <div class="col-12 m-t-20 d-flex justify-content-center">
                        <a href="{{ route('password.email') }}" class="text-primary"> Forgot your password ?</a>
                    </div>
                </div> --}}
            </form>
        </div>

        <div className="m-t-40 text-center">
            <p>Don't have an account ? <a href="{{ route('register') }}" className="font-500 font-14 text-primary font-secondary"> Signup Now </a> </p>
        </div>

    </div>
</div>

@endsection
