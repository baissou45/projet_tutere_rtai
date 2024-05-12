<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Client;
use App\Models\Rapport;
use App\Models\Room;
use App\Models\Tournee;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller {

    function index() {
        $bookings = Client::all();
        return view('booking.index', compact('bookings'));
    }

    function create() {
        $rooms = Room::all();
        $clients = Client::all();
        $selected_room = request()->room;

        return view('booking.create', compact('rooms', 'clients', 'selected_room'));
    }

    function store(Request $request) {

        $request->validate([
            "firstName" => "required",
            "lastName" => "required",
            "room" => "required",
            "startDate" => "required",
            "endDate" => "required",
        ]);

        DB::beginTransaction();

        $client = Client::create([
            "firstName" => request()->firstName,
            "lastName" => request()->lastName,
            "email" => request()->mail,
            "tel" => request()->tel
        ]);

        Booking::create([
            "client_id" => $client->id,
            "room_id" => request()->room,
            "start_at" => request()->startDate,
            "end_at" => request()->endDate,
            "user_id" => auth()->user()->id,
        ]);

        DB::commit();

        // return redirect()->route('bookings.index');
        return redirect()->route('rooms.index');
    }
}