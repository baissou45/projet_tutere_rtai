<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserRessource;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller {

    /**
     * @unauthenticated
     *
     * Connexion
     *
     * Il s'agit ici du endpoint à utiliser pour se connecter.
     *
     */
    public function login(Request $request){

        $request->validate([
            "login" => "required",
            "password"=> "required",
        ], [
            "required" => "Ce champ est obligatoire"
        ]);


        try {
            $user = User::where("email", $request->login)->orWhere("tel", $request->login)->first();

            if ($user->type != 'i') {
                return response()->json([
                    "message" => "Désolé !! Vous n'êtes pas habilité à accéder à ce contenu",
                    "data" => null
                ], 403);
            }

            if(password_verify($request->password, $user->password)){
                $user->tokens()->delete();

                return response()->json([
                    "message" => "Connexion établie avec succès",
                    "token" => $user->createToken("admin")->plainTextToken,
                    "data" => UserRessource::collection([$user])[0]
                ], 200);
            }
        } catch (\Throwable $th) {
            return response()->json([
                "message" => "Vérifier vos identifiants",
                "erreur" => $th->getMessage(),
                "data" => null
            ], 420);
        }
    }

    /**
     *
     * User Info
     *
     * Cet end point permet de récupérer les informations de l'utilisateur dont le token est passé à la requête.
     *
     */
    public function user(){
        return response()->json([
            "message" => "Connexion étan=blie avec succès",
            "data" => UserRessource::collection([auth()->user()])[0]
        ], 200);
    }
}
