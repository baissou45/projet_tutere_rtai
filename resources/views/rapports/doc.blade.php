<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <style>
        .header {
            width: 100vw
        }

        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
            text-align: center;
        }

        td {
            padding: 10px;
        }

    </style>

</head>

<body>

    <div style="position: absolute; top: 0; left: 0;">
        <img src="{{ public_path('logo.png') }}">
    </div>
    <h1 style="position: absolute; top: 0; right: 50;">Agen Habitat</h1>

    <h2 style="text-align: center; margin-top: 30%; margin-bottom: 10%">Rapport d'audit energetique</h2>

    <table style="width: 100%;">
        <tbody>
            <tr>
                <td> Inspecteur </td>
                <td> {{ $rapport->inspecteur->nom . ' ' . $rapport->inspecteur->prenom }} </td>
            </tr>
            <tr>
                <td>Client</td>
                <td></td>
            <tr>
            </tr>
            <tr>
                <td>Date rapport</td>
                <td> {{ $rapport->created_at }} </td>
            <tr>
            </tr>
            <tr>
                <td>Adresse</td>
                <td> {{ $tournee->adresse_complet }} </td>
            <tr>
            </tr>
            <tr>
                <td>Signé</td>
                <td style="color: {{ $rapport->signature ? "green" : "red" }}; font-weight: bold">
                    {{ $rapport->signature ? 'Rapport signé' : 'Rapport non signé' }}
                </td>
            <tr>
            </tr>
            <tr>
                <td>Commentaire</td>
                <td> {{ $rapport->description }} </td>
            </tr>
        </tbody>
    </table>

</body>

</html>
