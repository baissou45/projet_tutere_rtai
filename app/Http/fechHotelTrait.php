<?php

    namespace App\Http;

    use GuzzleHttp\Client;

    trait FechHotelTrait {
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
    }

?>