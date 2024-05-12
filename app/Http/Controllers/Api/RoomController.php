<?php

namespace App\Http\Controllers\Api;

use App\Models\Room;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\RoomResource;
use Illuminate\Support\Facades\DB;

class RoomController extends Controller {

    public function index() {
        $rooms = Room::query()->where('hotel_id', auth()->user()->hotel->id);

        if (request()->has('type') && request()->type != '') {
            $rooms = $rooms->where('type', request()->type);
        }

        if (request()->has('nbrRoom') && request()->nbrRoom != '') {
            $rooms = $rooms->where('number', request()->nbrRoom);
        }

        if (request()->has('price') && request()->price != '') {
            $rooms = $rooms->where('price', request()->price);
        }

        if (request()->has('booked') && request()->booked != '') {
            $rooms = $rooms->where('price', request()->price);
        }

        return response()->json([
            "message" => "Hôtel récupérer avec succès",
            // "data" => RoomResource::collection($rooms->latest()->get())
        ], 200);
    }

    public function store(Request $request) {

        $request->validate([
            "number" => "required",
            "type" => "required",
            "price" => "required",
            "description" => "nullable",
            "image" => "nullable",
        ]);

        try {
            DB::beginTransaction();

            $img = null;

            if (request()->hasFile('image')) {
                $file = request()->file('image');
                $name = $file->getClientOriginalName();
                $file->move(public_path('rooms_img'), $name);

                $img = 'rooms_img/' . $name;
            }

            Room::create([
                "number" => $request->number,
                "type" => $request->type,
                "price" => $request->price,
                "description" => $request->description,
                "hotel_id" => auth()->user()->hotel->id,
                "image" => $img
            ]);

            DB::commit();

            return response()->json([
                "message" => "Hôtel créé avec succès",
                "data" => null
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                "message" => "Une erreur est survenue lors de l'enregistrement de la chambre",
                "erreur" => $th->getMessage(),
                "data" => null
            ], 520);
        }
    }

    public function show(Room $room) {
        return response()->json([
            "message" => "Hôtel créé avec succès",
            // "data" => RoomResource::collection([$room])[0]
        ], 200);
    }

    public function update(Request $request, Room $room) {
        $request->validate([
            "number" => "required",
            "type" => "required",
            "price" => "required",
            "description" => "nullable",
        ]);

        try {
            DB::beginTransaction();

            $room->update([
                "number" => $request->number,
                "type" => $request->type,
                "price" => $request->price,
                "description" => $request->description,
            ]);

            DB::commit();
        } catch (\Throwable $th) {
            return response()->json([
                "message" => "Une erreur est survenue lors de l'enregistrement de la chambre",
                "erreur" => $th->getMessage(),
                "data" => null
            ], 520);
        }
    }

    public function destroy(Room $room) {
        try {
            DB::beginTransaction();

            $room->delete();

            DB::commit();
        } catch (\Throwable $th) {
            return response()->json([
                "message" => "Une erreur est survenue lors de la suppression de la chambre",
                "erreur" => $th->getMessage(),
                "data" => null
            ], 520);
        }
    }

}
