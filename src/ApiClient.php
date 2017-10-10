<?php

namespace Arikin;

use GuzzleHttp\Client;

class ApiClient
{
    /**
     * API object
     */
    public $api;
    /**
     * Options for GuzzleHttp\Client
     */
    private $options;

    /**
     * Auth credentials
     */
    private $username;
    private $password;

    /**
     * Base URL
     */
    private $base_uri;

    /**
     * JSON data to send
     * If given type can be encoded
     */
    private $json;

    function __construct($config_in = [])
    {
        // Set default options and add given
        $this->setOptions($config_in);
        // Init a Guzzle client if options are good
        $this->setApi();
    }

    /**
     * Sets default guzzle options
     * and adds a limited number of given options
     * Credentials required.
     *
     * @param array $options_in
     */
    public function setOptions($options_in = [])
    {
        $this->options = [
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json'
            ],
            'auth' => [ 0 => FALSE, 1 => FALSE],
            'connect_timeout' => 5,
            'timeout' => 60,
            'http_errors' => FALSE
        ];
        if(is_array($options_in)) {
            foreach($options_in as $key => $value) {
                // Which options to allow
                switch($key) {
                    case 'base_uri':
                    case "uri":
                    case 'url':
                        $this->setBaseUri($value);
                        break;
                    case 'username':
                    case 'user':
                        $this->setUsername($value);
                        break;
                    case 'password':
                    case 'pass':
                        $this->setPassword($value);
                        break;
                    case 'json_data':
                    case 'json':
                        $this->setJson($value);
                        break;
                    // ToDo: Add more request options
                }
            }
        }
    }

    /**
     * Init API object of Guzzle
     */
    public function setApi() {
        if($this->checkOptions()) {
            $this->api = new Client($this->options);
        }
    }

    /**
     * Return API object of Guzzle
     * $api->get();
     * $api->post();
     * @return object
     */
    public function getApi()
    {
        return $this->api;
    }

    public function checkOptions()
    {
        $result = FALSE;
        if($this->options) {
            // Credentials set
            if($this->options['auth'][0] && $this->options['auth'][1]) {
                $result = TRUE;
            }
            // ToDo: add more checks here
        }
        return $result;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
        $this->options['auth'][0] = $this->username;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
        $this->options['auth'][1] = $this->password;
    }

    /**
     * @return string
     */
    public function getBaseUri()
    {
        return $this->base_uri;
    }

    /**
     * Set base URL.
     * No trailing slash
     *
     * @param mixed $base_uri
     */
    public function setBaseUri($base_uri)
    {
        $this->base_uri = $base_uri;
        $this->options['base_uri'] = $this->base_uri;
    }

    /**
     * @return mixed
     */
    public function getJson()
    {
        return $this->json;
    }

    /**
     * @param mixed $json
     */
    public function setJson($json)
    {
        $this->json = $json;
        $this->options['json'] = $this->json;
    }
}