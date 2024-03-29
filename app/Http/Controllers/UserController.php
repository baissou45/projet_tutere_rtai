<?php

namespace App\Http\Controllers;

use App\Mail\UserCreatedMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class UserController extends Controller {

    public function index() {
        $users = User::where('type', 's')->get();
        return view("users.index", compact('users'));
    }

    public function inspecteur() {
        $users = User::where('type', 'i')->get();
        return view("users.inspecteur", compact('users'));
    }

    public function create() {
        $user = null;
        return view('users.create', compact('user'));
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
            "type" => 's',
        ]);

        Mail::to($user->email)->send(new UserCreatedMail($user, $pass));

        DB::commit();

        return redirect()->route('users.index')->with('success', "Utilisateur ajouter avec succès");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user) {
        return view('users.edit', compact('user'));
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
        // On modifie la redirection en fonction de la page actuelle
        $redirectRoute = $user->type === 'i' ? 'users.inspecteur' : 'users.index';

        return redirect()->route($redirectRoute)->with('success', $successMessage);
    }

    public function destroy(User $user) {
        $user->delete();
        return redirect()->route('users.index')->with('success', "Utilisateur effacé avec succès");
    }

    public function trash() {
        $users = User::onlyTrashed()->get();
        return view("users.corbeille", compact('users'));
    }

    public function trash_action(Request $request) {

        foreach ($request->ids as $id) {
            if ($request->action == 's') {
                 User::withTrashed()->find($id)->forceDelete();
                }

            if ($request->action == 'r'){
                User::withTrashed()->find($id)->restore();
            }
        }

        return redirect()->route('users.trash')->with('success', 'Action effectuée avec succès');
    }
}
