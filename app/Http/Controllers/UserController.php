<?php

namespace App\Http\Controllers;

use App\Mail\UserCreatedMail;
use App\Models\Transfert;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

class UserController extends Controller {

    public function index() {
        $users = User::where('type', 's')->get();
        return view("users.index", compact('users'));
    }

    public function inspecteur() {
        $users = User::query()->where('type', 'i');

        if (auth()->user()->type == 's') {
            $users->where('secretaire_id', auth()->user()->id)->orWhereHas('inspecteur_tranferts', function($s){
                return $s->where('secretaire_id', auth()->user()->id)->where('date_debut', '<=', now())->where('date_fin', '>=', now());
            });
        }

        $users = $users->get();

        $secretaires = User::where('type', 's')->get();
        return view("users.inspecteur", compact('users', 'secretaires'));
    }

    public function create() {
        $user = null;
        $secretaires = User::where('type', 's')->get();
        return view('users.create', compact('user', "secretaires"));
    }

    public function store(Request $request) {
        $request->validate([
            "nom" => "required",
            "prenom" => "required",
            "email" => "required",
            "tel" => "required",
        ], [
            "required" => "Ce champ est obligatoire",
        ]);

        DB::beginTransaction();

        $prenom = "";
        foreach (explode(' ', $request->prenom) as $prn) {
            $prenom .= Str::ucfirst($prn);
        }

        $pass = "Agen_" . random_int(12345, 99999) . '_' . Str::upper($request->nom[0]) . $prenom;

        $user = User::create([
            "nom" => $request->nom,
            "prenom" => $request->prenom,
            "password" => bcrypt($pass),
            "sexe" => $request->sexe,
            "tel" => $request->tel,
            "email" => $request->email,
            "type" => $request->secretaire ? 'i' : 's',
            "secretaire_id" => $request->secretaire
        ]);

        Mail::to($user->email)->send(new UserCreatedMail($user, $pass));

        $successMessage = $request->secretaire ? "Inspecteur créer avec succès" : "Utilisateur créer avec succès";
        $redirectRoute = $request->secretaire ? 'users.inspecteur' : 'users.index';

        DB::commit();
        return redirect()->route($redirectRoute)->with('success', $successMessage);
    }

    public function inspecteur_affectatiion(Request $request) {

        Transfert::create([
            "inspecteur_id" => $request->inspecteur,
            "secretaire_id" => $request->secretaire,
            "date_debut" => $request->debut,
            "date_fin" => $request->fin,
            "description" => $request->description,
        ]);

        return redirect()->back()->with("success", "Inspecteur tranférer avec succès");
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user) {
        $secretaires = User::where('type', 's')->get();
        return view('users.edit', compact('user', "secretaires"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user) {
        $request->validate([
            "nom" => "required",
            "prenom" => "required",
            "email" => "required",
            "tel" => "required",
        ], [
            "required" => "Ce champ est obligatoire",
        ]);
    
        if ($request->password) {
            $request->validate([
                "password" => "required|confirmed",
            ], [
                "required" => "Ce champ est obligatoire",
                "confirmed" => "Vous devez entrer des mots de passe identiques",
            ]);
    
            $user->update([
                "password" => bcrypt($request->password),
            ]);
        }
    
        // On vérifie si l'utilisateur est un inspecteur avant de mettre à jour
        if ($user->type === 'i') {
            $user->update([
                "nom" => $request->nom,
                "prenom" => $request->prenom,
                "sexe" => $request->sexe,
                "tel" => $request->tel,
                "email" => $request->email,
                // On ne change pas le type si c'est déjà un inspecteur
                "type" => $user->type,
            ]);
        } else {
            // Si l'utilisateur n'est pas un inspecteur, on met à jour le type
            $user->update([
                "nom" => $request->nom,
                "prenom" => $request->prenom,
                "sexe" => $request->sexe,
                "tel" => $request->tel,
                "email" => $request->email,
                "type" => 's',
            ]);
        }

        $successMessage = $user->type === 'i' ? "Inspecteur mis à jour avec succès" : "Utilisateur mis à jour avec succès";
        $redirectRoute = $user->type === 'i' ? 'users.inspecteur' : 'users.index';

        return redirect()->route($redirectRoute)->with('success', $successMessage);
    }

    public function destroy(User $user) {
        $user->delete();

        $successMessage = $user->type === 'i' ? "Inspecteur effacé avec succès" : "Utilisateur effacé avec succès";
        $redirectRoute = $user->type === 'i' ? 'users.inspecteur' : 'users.index';

        return redirect()->route($redirectRoute)->with('success', $successMessage);
    }

    public function trash() {
        // Routename
        if(Route::currentRouteName() == 'users.trash') {
            $users = User::onlyTrashed()->where('type', 's')->get();
        } else {
            $users = User::onlyTrashed()->where('type', 'i')->get();
        }

        return view("users.corbeille", compact('users'));
    }

    public function trash_action(Request $request) {

        if($request->ids == null) {
            return redirect()->back()->with('error', 'Aucun utilisateur sélectionné');
        }

        foreach ($request->ids as $id) {
            if ($request->action == 's') {
                 User::withTrashed()->find($id)->forceDelete();
                }

            if ($request->action == 'r'){
                User::withTrashed()->find($id)->restore();
            }
        }

        return redirect()->back()->with('success', 'Action effectuée avec succès');
    }
}
