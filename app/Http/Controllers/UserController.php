<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller {

    public function index() {
        $users = User::all();
        return view("users.index", compact('users'));
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
            "type" => 'i',
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
