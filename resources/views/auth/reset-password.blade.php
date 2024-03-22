<x-guest-layout>
    <form method="POST" action="{{ route('password.store') }}">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Reset Password') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>

@extends("layouts.guest")

@section("content")

<div class="card">
    <div class="card-body">

        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <h3 class="text-center my-3">
            <a href="index.html" class="logo logo-admin"><img
                    src="{{ asset('logo.png') }}"  alt="logo"></a>
        </h3>


        @if ($errors->any())
            <div class="alert alert-danger" role="alert">
                <h4 class="text-center"> Une erreure est survenue </h4>
            </div>
        @endif

        @if (session('status'))
            <div class="alert alert-success" role="alert">
                <h4 class="text-center"> {{ session('status') }} </h4>
            </div>
        @endif

        <div class="p-3">
            <div class="my-4">
                Mot de passe oublié ? Aucun problème. <br>
                Faites-nous savoir votre adresse e-mail et nous vous enverrons un lien de réinitialisation de mot de passe qui vous permettra d'en choisir un nouveau.
            </div>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <x-input libelle="Email" type="text" size="" required name="email"  />

                <input type="submit" class="btn btn-primary" value="Réinitialisation">
            </form>
        </div>

    </div>
</div>

@endsection
