<?php

    namespace App\Http;

    use GuzzleHttp\Client;

    trait FechHotelWithGeoTrait {
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
    }

?>