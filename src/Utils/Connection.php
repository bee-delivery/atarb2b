<?php

namespace BeeDelivery\AtarB2B\Utils;

use GuzzleHttp\Client;

class Connection {

    protected $http;
    protected $base_url;

    public function __construct()
    {
        $this->base_url = config('atar.base_url');

        $headers = [
            'Content-Type'  => 'application/json',
            'Authorization' => 'Basic ' . base64_encode(config('atar.basic_user') . ':' . config('atar.basic_password')),
            'Atar-ApiKey' => config('atar.api_key')
        ];

        $this->http = new Client([
            'headers' => $headers
        ]);

        return $this->http;
    }

    public function get($url)
    {

        try {
            $response = $this->http->get($this->base_url . $url);

            return [
                'code'     => $response->getStatusCode(),
                'response' => json_decode($response->getBody()->getContents())
            ];

        } catch (\Exception $e){
            return [
                'code'     => $e->getCode(),
                'response' => $e->getResponse()->getBody()->getContents()
            ];
        }
    }

    public function post($url, $params)
    {
        try {
            $response = $this->http->post($this->base_url . $url, $params);

            return [
                'code'     => $response->getStatusCode(),
                'response' => json_decode($response->getBody()->getContents())
            ];

        } catch (\Exception $e){
            return [
                'code'     => $e->getCode(),
                'response' => $e->getResponse()->getBody()->getContents()
            ];
        }
    }

    public function put($url, $params)
    {

        try {
            $response = $this->http->put($this->base_url . $url, $params);

            return [
                'code'     => $response->getStatusCode(),
                'response' => json_decode($response->getBody()->getContents())
            ];

        } catch (\Exception $e){

            return [
                'code'     => $e->getCode(),
                'response' => $e->getResponse()->getBody()->getContents()
            ];
        }
    }
}