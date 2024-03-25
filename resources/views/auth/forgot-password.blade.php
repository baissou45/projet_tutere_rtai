{{-- <x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Email Password Reset Link') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}


@extends("layouts.guest")

@section("content")

<div class="card">
    <div class="card-body">

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
