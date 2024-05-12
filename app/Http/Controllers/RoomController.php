<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoomController extends Controller {

    public function index() {
        $rooms = Room::query()->whereHas('hotel', function($h){
            $h->where('user_id', auth()->user()->id);
        });

        if (request()->has('type') && request()->type != '') {
            $rooms = $rooms->where('type', request()->type);
        }

        if (request()->has('nbrRoom') && request()->nbrRoom != '') {
            $rooms = $rooms->where('number', request()->nbrRoom);
        }

        if (request()->has('price') && request()->price != '') {
            $rooms = $rooms->where('price', request()->price);
        }

        if (request()->has('booked') && request()->booked == true) {
            $rooms = $rooms->whereHas('bookings', function ($bookings){
                return $bookings->where('start_at', '<', now())->where('end_at', '>', now());
            });
        }

        $rooms = $rooms->orDerByDesc('id')->get();
        return view('rooms.index', compact('rooms'));
    }

    public function create() {
        return view('rooms.create');
    }

    public function store(Request $request) {

        $request->validate([
            "number" => "required",
            "type" => "required",
            "price" => "required",
            "description" => "nullable",
            "image" => "nullable",
        ]);

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

        return redirect()->route('rooms.index');
    }

    public function show(Room $room) {
        return view('rooms.show', compact('room'));
    }

}
