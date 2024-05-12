<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HotelController extends Controller {

    function create() {
        return view('newHotel');
    }

    function store(Request $request) {
        $request->validate([
            "name" => "required",
            "address" => "required",
            "city" => "required",
            "country" => "required",
            "zip" => "required",
            "rate" => "required",
            "description" => "required",
        ]);

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

        return redirect()->route('dashboard');
    }

}