<?php

namespace App\Http\Controllers;

use App\Models\Tournee;
use Carbon\Carbon;

class DashboardController extends Controller {

    function index() {

        // $tournees = auth()->user()->tournees;
        // dd($tournees);

        // $tournees = Tournee::where('date', '>', now()->subDays(7))->where('date', '<', now()->addDay())->get()->groupBy(function($p){
        //     return Carbon::parse($p->date)->format('d/m/y');
        // });

        // $tournees_stats = [];
        // $tournees_stats['libelle'] = [];
        // $tournees_stats['data']= [];
        // foreach ($tournees as $key => $tournee_liste) {
        //     array_push($tournees_stats['libelle'], $key);

        //     $index = 0;
        //     $tournees_stats['data'][$index] = [];
        //     foreach ($tournee_liste as $tournee) {
        //         array_push($tournees_stats['data'][$index], $tournee);
        //     }
        //     $index ++;
        // }

        // dd($tournees_stats, $tournees);

        return view('dashboard');
    }

}