<?php

namespace BeeDelivery\AtarB2B\Utils;

use Illuminate\Support\Facades\Http;

class Connection
{
    protected $baas;
    protected $headers;
    protected $baseUrl;
    protected $user;
    protected $pass;
    protected $apiKey;

    public function __construct($baas = false, $headers = array(), $baseUrl = null)
    {
        $this->baas = $baas;
        $this->headers = $headers;
        $this->baseUrl = empty($baseUrl) ? config('atar.base_url') : $baseUrl;
        $this->apiKey = config('atar.api_key');
        $this->user = config('atar.basic_user');
        $this->pass = config('atar.basic_password');
    }

    public function get($url, $key)
    {
        try {
            if($this->baas == true){
                $this->apiKey = config('atar.baas_api_key');
                $this->user = config('atar.baas_basic_user');
                $this->pass = config('atar.baas_basic_password');
            }
            $response = Http::withHeaders(
                array_merge([
                'Atar-ApiKey' => $this->apiKey,
                'Accept' => 'application/json'
            ], $this->headers))
            ->withBasicAuth($this->user, $this->pass)
            ->get($this->baseUrl . $url . '/' . $key);

            return [
                'code'     => $response->getStatusCode(),
                'response' => json_decode($response->getBody()->getContents(), true)
            ];
        } catch (\Exception $e){
            return [
                'code'     => $e->getCode(),
                'response' => $e->getMessage()
            ];
        }
    }

    public function post($url, $params)
    {
        try {
            if($this->baas == true){
                $this->apiKey = config('atar.baas_api_key');
                $this->user = config('atar.baas_basic_user');
                $this->pass = config('atar.baas_basic_password');
            }
            $response = Http::withHeaders(
                array_merge([
                'Atar-ApiKey' => $this->apiKey,
                'Accept' => 'application/json'
            ], $this->headers))
            ->withBasicAuth($this->user, $this->pass)
            ->post($this->baseUrl . $url, $params);

            return [
                'code'     => $response->getStatusCode(),
                'response' => json_decode($response->getBody()->getContents(), true)
            ];
        } catch (\Exception $e){
            return [
                'code'     => $e->getCode(),
                'response' => $e->getMessage()
            ];
        }
    }
}
