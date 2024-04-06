{{-- <x-guest-layout>
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
                <p class="text-center"> Une erreure est survenue </p>
            </div>
        @endif

        @if (session('status'))
            <div class="alert alert-success" role="alert">
                <p class="text-center"> {{ session('status') }} </p>
            </div>
        @endif

        <form method="POST" action="{{ route('password.store') }}">
            @csrf

            <!-- Password Reset Token -->
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <!-- Email Address -->
            <x-input libelle="Email" type="text" required size="col-12" name="email" value="{{ old('email', $request->email) }}" required autofocus autocomplete="username" readonly />

            <!-- Password -->
            <x-input libelle="Nouveeau mot de passe" type="password" required size="col-12" name="password" value="{{ old('password') }}" />

            <!-- Confirm Password -->
            <x-input libelle="Nouveeau mot de passe" type="password" required size="col-12" name="password_confirmation" />

            <div class="flex items-center justify-end mt-4">
                <center>
                    <input type="submit" value="Changer le mot de passe" class="btn btn-pink">
                </center>
            </div>
        </form>
    </div>
</div>

@endsection
