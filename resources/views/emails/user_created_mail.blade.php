@component('mail::message')

Bonjour {{ $user->prenom }}.

Nous sommes ravis de vous informer que votre compte Agent Habitat a été créé avec succès.

Voici vos informations de connexion :

- Nom d'utilisateur : **{{ $user->email }}**
- Adresse e-mail associée : **{{ $pass }}**
- Lien de connexion : **{{ env('APP_URL') }}**

Veuillez penser à réinitialiser votre mot de passe en suivant le lien ci-dessous :

@component('mail::button', ['url' => env('APP_URL') . "/forgot-password"])
    Changer le mot de passe
@endcomponent

Cordialement, <br>
{{ config('app.name') }}
@endcomponent
