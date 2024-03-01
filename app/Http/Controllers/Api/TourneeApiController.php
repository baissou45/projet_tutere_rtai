<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TourneeResources;
use App\Models\Tournee;
use Illuminate\Http\Request;

class TourneeApiController extends Controller {

    /**
     *
     * Liste des tournées
     *
     * Cet and point permet de récupérer la liste des tournées crées ou associées à un inspecteur.
     *
     */
    function index() {
        try {
            $tournees = auth()->user()->tournees;

            return response()->json([
                "message" => "Connexion établie avec succès",
                "data" => TourneeResources::collection($tournees)
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                "message" => "Une erreur est survenue",
                "erreur" => $th->getMessage(),
                "data" => null
            ], 420);
        }
    }

    /**
     *
     * Création de tournés
     *
     * Cet and point permet de créer une tournée
     *
     */
    function create(Request $request) {
        $request->validate([
            "inspecteur_id" => 'required|integer',
            "adresse_complet" => 'required',
            "date" => 'required',
        ], [
            "required" => "Ce champ est obligatoire",
        ]);

        try {

            Tournee::create([
                "inspecteur_id" => $request->inspecteur_id,
                "adresse_complet" => $request->adresse_complet,
                "date" => $request->date,
                "etat" => "Programmer",
            ]);

            $tournees = auth()->user()->tournees;

            return response()->json([
                "message" => "Connexion établie avec succès",
                "data" => TourneeResources::collection($tournees)
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                "message" => "Une erreur est survenue",
                "erreur" => $th->getMessage(),
                "data" => null
            ], 420);
        }
    }

     /**
     *
     * Récupérer une tournées
     *
     * Cet and point permet de récupérer les information sur une des tournées de l'utilisateur dont lé token est passé en paramettre
     *
     */
    function show(Tournee $tournee) {
        try {

            if ($tournee->inspecteur_id != auth()->user()->id) {
                return response()->json([
                    "message" => "Désolé !! Vous n'êtes pas habilité à accéder à ce contenu",
                    "data" => null
                ], 403);
            }

            return response()->json([
                "message" => "Connexion établie avec succès",
                "data" => TourneeResources::collection([$tournee])
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                "message" => "Une erreur est survenue",
                "erreur" => $th->getMessage(),
                "data" => null
            ], 420);
        }
    }

}
