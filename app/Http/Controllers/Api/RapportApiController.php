<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\RapportResources;
use App\Models\Rapport;
use App\Models\Tournee;
use Illuminate\Http\Request;

class RapportApiController extends Controller {

    /**
     *
     * Liste des rapports
     *
     * Cet and point permet de récupérer la liste des rapports d'un inspecteur.
     *
     */
    function index() {
        try {
            $rapports = auth()->user()->rapports;

            return response()->json([
                "message" => "Connexion établie avec succès",
                "data" => RapportResources::collection($rapports)
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
     * Création de rapport
     *
     * Cet and point permet de créer un rapport
     *
     */
    function create(Request $request) {
        $request->validate([
            "tournee_id"  => 'required|integer',
            "signature"  => 'required|boolean',
            "fichier_joint"  => 'required',
            "description"  => 'required',
        ], [
            "required" => "Ce champ est obligatoire",
        ]);

        try {

            Rapport::create([
                "tournee_id" => $request->tournee_id,
                "signature" => $request->signature,
                "fichier_joint" => $request->fichier_joint,
                "description" => $request->description,
                'inspecteur_id' => auth()->user()->id
            ]);

            $rapports = auth()->user()->rapports;

            return response()->json([
                "message" => "Connexion établie avec succès",
                "data" => RapportResources::collection($rapports)
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
     * Récupérer un rapport
     *
     * Cet and point permet de récupérer les information sur un des rapports de l'utilisateur dont lé token est passé en paramettre
     *
     */
    function show(Rapport $rapport) {
        try {

            if ($rapport->inspecteur_id != auth()->user()->id) {
                return response()->json([
                    "message" => "Désolé !! Vous n'êtes pas habilité à accéder à ce contenu",
                    "data" => null
                ], 403);
            }

            return response()->json([
                "message" => "Connexion établie avec succès",
                "data" => RapportResources::collection([$rapport])
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                "message" => "Une erreur est survenue",
                "erreur" => $th->getMessage(),
                "data" => null
            ], 420);
        }
    }

    /**>
     *
     * Rapports d'une tounée
     *
     * Cet and point permet de récupérer les rapport attachés a une tournée. Notons que seul les tournées de l'inspecteur connecté peuvent être récupérés.
     *
     */
    function tournee_index(Tournee $tournee) {
        try {
            if ($tournee->inspecteur_id != auth()->user()->id) {
                return response()->json([
                    "message" => "Désolé !! Vous n'êtes pas habilité à accéder à ce contenu",
                    "data" => null
                ], 403);
            }

            $rapports = $tournee->rapports;

            return response()->json([
                "message" => "Connexion établie avec succès",
                "data" => RapportResources::collection($rapports)
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
