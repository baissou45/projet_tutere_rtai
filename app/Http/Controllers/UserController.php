<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

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
            "password" => "required|confirmed",
        ], [
            "required" => "Ce champ est obligatoire",
            "confirmed" => "Vous devez entrer des mots de passe identiques",
        ]);

        User::create([
            "nom" => $request->nom,
            "prenom" => $request->prenom,
            "password" => $request->password,
            "sexe" => $request->sexe,
            "tel" => $request->tel,
            "email" => $request->email,
            "type" => 's',
        ]);

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
                "password" => $request->password,
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
