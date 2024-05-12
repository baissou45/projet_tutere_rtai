<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Apihotel;
use App\Models\Hotel;

class ApihotelController extends Controller {
    public function index(){
        return response()->json([
            "message" => "Hôtels récupérer avex succès",
            "data" => Apihotel::all()
        ], 200);
    }

    public function find($id){
        return response()->json([
            "message" => "Hôtels récupérer avex succès",
            "data" => Apihotel::find($id)
        ], 200);
    }
}
