<?php

    namespace App\Http;

    use GuzzleHttp\Client;

    trait RefreshTrait {
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

?>