<?php

namespace BeeDelivery\AtarB2B\Utils;

use Illuminate\Support\Facades\Http;

class Connection {

    public function post($url, $params)
    {
        try {
            $response = Http::withHeaders([
                'Atar-ApiKey' => config('atar.api_key'),
                'Atar-ID' => config('atar.atar_id')
            ])->withBasicAuth(config('atar.basic_user'), config('atar.basic_password'))
            ->post(config('atar.base_url') . $url, $params);

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
