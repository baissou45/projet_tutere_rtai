<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\RefreshTrait;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class AmadeusHotelList extends Controller {
    use RefreshTrait;

    public function index(Request $request){

        $request->validate([
            "cityCode" => "required",
            "radius" =>  "nullable|integer",
            "ratings"  => "nullable|integer|between:1,5"
        ]);

        // dd($request->all());

        $url = "https://test.api.amadeus.com/v1/reference-data/locations/hotels/by-city?cityCode=". $request->cityCode;
        $url.= "&radius=" . ($request->radius ?? 5)  .  "&radiusUnit=KM";

        if ($request->ratings) {
            $url.= "&ratings=". $request->ratings . "";
        }

        $url .= "hotelSource=ALL";

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
            $this->index($request);
        } else {
            throw ("Invalid response");
        }
    }
}
