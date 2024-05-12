<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserRessource;
use App\Models\Hotel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HotelController extends Controller {
    public function index() {
        return response()->json([
            "message" => "Hoteles trouvés avec succès",
            "data" => auth()->user()->hotels
        ], 420);
    }

    public function store(Request $request) {
        $request->validate([
            "name" => "required",
            "address" => "required",
            "city" => "required",
            "country" => "required",
            "zip" => "required",
            "rate" => "required",
            "description" => "required",
        ]);

        try {
            DB::beginTransaction();

            Hotel::create([
                "name" => $request->name,
                "address" => $request->address,
                "city" => $request->city,
                "country" => $request->country,
                "zip" => $request->zip,
                "rate" => $request->rate,
                "description" => $request->description,
                "user_id" => $request->user_id,
                "tel" => $request->tel,
                "email" => $request->email,
                "user_id" => auth()->user()->id
            ]);

            DB::commit();

            return response()->json([
                "message" => "Hôtel créé avec succès",
                "token" => auth()->user()->createToken("admin")->plainTextToken,
                "data" => UserRessource::collection([auth()->user()])[0]
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                "message" => "Une erreur est survenue lors de l'enregistrement de l'hôtel",
                "erreur" => $th->getMessage(),
                "data" => null
            ], 520);
        }

    }

    public function show(Hotel $hotel) {
        return response()->json([
            "message" => "Hôtel trouvé avec succès",
            "data" => $hotel
        ], 420);
    }

    public function update(Request $request, Hotel $hotel) {
        $request->validate([
            "name" => "required",
            "address" => "required",
            "city" => "required",
            "country" => "required",
            "zip" => "required",
            "rate" => "required",
            "description" => "required",
            "user_id" => "required"
        ]);

        try {

            DB::beginTransaction();

            $hotel->update([
                "name" => $request->name,
                "address" => $request->address,
                "city" => $request->city,
                "country" => $request->country,
                "zip" => $request->zip,
                "rate" => $request->rate,
                "description" => $request->description,
                "tel" => $request->tel,
                "email" => $request->email,
            ]);

            DB::commit();

            return response()->json([
                "message" => "Hôtel modifié avec succès",
                "data" => $hotel
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                "message" => "Une erreur est survenue lors de la modification de l'hôtel",
                "erreur" => $th->getMessage(),
                "data" => null
            ], 520);
        }
    }

    public function destroy(Hotel $hotel) {
        try {
            DB::beginTransaction();

            $hotel->delete();

            DB::commit();

            return response()->json([
                "message" => "Hôtel supprimé avec succès",
                "data" => $hotel
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                "message" => "Une erreur est survenue lors de la suppression de l'hôtel",
                "erreur" => $th->getMessage(),
                "data" => null
            ], 520);
        }
    }
}
