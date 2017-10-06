<?php

use GuzzleHttp\Client;
use GuzzleHttp\Command\Guzzle\Description;
use GuzzleHttp\Command\Guzzle\GuzzleClient;

namespace Arikin\RestApi;

class ApiClient extends GuzzleClient
{
    public static function create($config_in = []) {
        // Load service description file for defaults
        $_config = json_decode(file_get_contents(
            __DIR__ . '/../client_config.json'
            ), TRUE
        );
        $_config['baseUrl'] = $config_in['base_uri'];
        $service_desc = new Description($_config);

        // Client and headers to init Client
        $_client = [
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json'
            ],
            'auth' =>  [$config_in['api_user'], $config_in['api_pass']]
        ];
        $client = new Client($_client);

        return new static($client, $service_desc, NULL, NULL, NULL, $config_in);
    }
}