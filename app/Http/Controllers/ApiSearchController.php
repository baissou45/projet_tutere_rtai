<?php

namespace App\Http\Controllers;

use App\Http\FechHotelTrait;
use App\Http\FechHotelWithGeoTrait;
use App\Http\RefreshTrait;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ApiSearchController extends Controller {
    use RefreshTrait, FechHotelTrait, FechHotelWithGeoTrait;

    private $headers;

    public function __construct() {
        $this->headers = [
            'Accept' => 'application/vnd.amadeus+json',
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . file_get_contents("perso.txt")
        ];
    }

    public function index() {
        $data = [];
        if (request()->type != null) {
            $data = $this->search(request());
        }

        $data = collect($data);
        return view('search', compact('data'));
    }

    public function search(Request $request) {

        if (request()->type == "city") {
            $hotels = $this->fechHotel($request->ville, $request->ratings);
        }

        if (request()->type == "geo") {
            $hotels = $this->fechHotelWithGeo($request->latitude, $request->longitude);
        }


        $hotelsIds = "";
        foreach ($hotels as $key => $hotel) {
            if($key > 20) break;
            $hotelsIds .=  ( $key != 0  ? "," : "" ) . $hotel["hotelId"];
        }

        try {
            return $this->fechData($hotelsIds);
        } catch (\Throwable $th) {
            throw $th;
        }

    }

    private function fechData($hotelsIds){

        $req = "";

        // if (request()->hotelIds) {
            // $req .= "&hotelIds=" . request()->hotelIds;
            $req .= "&hotelIds=" . $hotelsIds;
        // }

        if (request()->adults) {
            $req .= "&adults=". request()->adults;
        }

        if (request()->checkInDate) {
            $req .= "&checkInDate=". request()->checkInDate;
        }

        if (request()->checkOutDate) {
            $req .= "&checkOutDate=". request()->checkOutDate;
        }

        if (request()->minPrice) {
            $req .= "&priceRange=". request()->minPrice;
        }

        if (request()->maxPrice) {
            $req .= (request()->minPrice ? "-" : "&priceRange=-") . request()->maxPrice;
        }

        if (request()->boardType) {
            $req .= "&boardType=". request()->boardType;
        }

        $req .= "&includeClosed=yes&lang=en";

        $client = new Client();
        $response = $client->request('GET', 'https://test.api.amadeus.com/v3/shopping/hotel-offers?'. $req, [
            'headers' => $this->headers,
            'http_errors' => false,
        ]);

        if ($response->getStatusCode() == 200) {
            return json_decode($response->getBody(), true)["data"];
        } else if ($response->getStatusCode() == 401) {
            $this->refresh();
            $this->fechData($hotelsIds);
        } else {
            dd(json_decode($response->getBody(), true), $response->getStatusCode());
            throw (json_decode($response->getBody(), true)[0]['detail']);
        }
    }

}
