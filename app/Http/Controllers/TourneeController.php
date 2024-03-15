<?php

namespace App\Http\Controllers;

use App\Models\Tournee;
use Illuminate\Http\Request;

class TourneeController extends Controller {

    public function index() {
        $tournees = Tournee::all()->map(function($tournee){
            $color = "";
            if (now()->parse($tournee->date)->isBefore(now())){
                $color = $tournee->etat == "Effectuer" ? "#28a745" : "#e83e8c";
            } else if (now()->parse($tournee->date)->isToday()){
                $color = "blue";
            }

            return [
                "start" => now()->parse($tournee->date)->format("Y-m-d"), // a property!
                "color" => $color,
                "extendedProps" => [
                   "auteur" => $tournee->inspecteur->nom . ' ' . $tournee->inspecteur->prenom,
                   "maison" => $tournee->adresse_complet,
                   "heure" => now()->parse($tournee->date)->format("h:m"),
                ]
            ];
        });
        // dd($tournees);
        return view('tournees.index', compact('tournees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Tournee $tournee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tournee $tournee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tournee $tournee)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tournee $tournee)
    {
        //
    }
}
