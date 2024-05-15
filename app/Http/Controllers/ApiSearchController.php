<?php

namespace App\Http\Controllers;

use App\Http\FechHotelTrait;
use App\Http\FechHotelWithGeoTrait;
use App\Http\RefreshTrait;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ApiSearchController extends Controller {
    // use RefreshTrait, FechHotelTrait, FechHotelWithGeoTrait;

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

    public function fechHotelWithGeo($latitude = null, $longitude = null) {

        $url = "https://test.api.amadeus.com/v1/reference-data/locations/hotels/by-geocode?";

        if ($latitude != null) {
            $url.= "&latitude=". $latitude;
        }

        if ($longitude != null) {
            $url.= "&longitude=". $longitude . "";
        }

        $url .= "&radiusUnit=KM&hotelSource=ALL";

        $client = new Client();
        $response = $client->request('GET', $url, [
            'headers' => [
                'Accept' => 'application/vnd.amadeus+json',
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer '. file_get_contents("perso.txt")
            ],
            'http_errors' => false,
        ]);

        // dd(json_decode($response->getBody(), true));

        if ($response->getStatusCode() == 200) {
            return json_decode($response->getBody(), true)["data"];
        } else if ($response->getStatusCode() == 401) {
            $this->refresh();
            $this->fechHotel($latitude, $longitude);
        } else {
            dd(json_decode($response->getBody(), true));
            throw ("Invalid response");
        }
    }

    public function fechHotel($ville, $ratings = null, $radius = null) {

        $url = "https://test.api.amadeus.com/v1/reference-data/locations/hotels/by-city?cityCode=". $ville;
        // $url.= "&radius=10&radiusUnit=KM";

        if ($radius != null) {
            $url.= "&radius=". $radius . "&radiusUnit=KM";
        }

        if ($ratings != null) {
            $url.= "&ratings=". $ratings . "";
        }

        $url .= "&hotelSource=ALL";

        $client = new Client();
        $response = $client->request('GET', $url, [
            'headers' => [
                'Accept' => 'application/vnd.amadeus+json',
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer '. file_get_contents("perso.txt")
            ],
            'http_errors' => false,
        ]);

        // dd(json_decode($response->getBody(), true));

        if ($response->getStatusCode() == 200) {
            return json_decode($response->getBody(), true)["data"];
        } else if ($response->getStatusCode() == 401) {
            $this->refresh();
            $this->fechHotel($ville, $ratings);
        } else {
            dd(json_decode($response->getBody(), true));
            throw ("Invalid response");
        }
    }

    public function refresh() {

        $client = new Client();

        $response = $client->post('https://test.api.amadeus.com/v1/security/oauth2/token', [
            'form_params' => [
                'grant_type' => 'client_credentials',
                'client_id' => 'roPL7jwvW0oAgFRVTbxk3zeh5mXvEVyS',
                'client_secret' => '1TsFr9hSvtI8yBuf',
            ]
        ]);

        $body = $response->getBody();
        $data = json_decode($body, true);

        file_put_contents("perso.txt", $data["access_token"]);

    }
}
