<?php

namespace BeeDelivery\AtarB2B\Models;

use BeeDelivery\AtarB2B\Utils\Connection;

class Pix
{
    public $http;

    public function __construct()
    {
        $this->http = new Connection();
    }

    public function transfer($data)
    {
        try {
            if ( ! $this->pix_data_is_valid($data) ) {
                throw new \Exception('Dados inválidos.');
            }

            return $this->http->post('/pix/payment/', $data);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function pix_data_is_valid($data)
    {
        return ! (
            empty($pixData['amount']) OR
            empty($pixData['identifier']) OR
            empty($pixData['description']) OR
            empty($pixData['to']['key']) OR
            empty($pixData['to']['type']) OR
            empty($pixData['to']['timestamp']) OR
            empty($pixData['to']['isFavorite']) OR
            empty($pixData['to']['status']) OR
            empty($pixData['to']['statusResolutionTimestamp']) OR
            empty($pixData['to']['institution']) OR
            empty($pixData['to']['institutionName']) OR
            empty($pixData['to']['branch']) OR
            empty($pixData['to']['accountNumber']) OR
            empty($pixData['to']['accountType']) OR
            empty($pixData['to']['name']) OR
            empty($pixData['to']['document'])
        );
    }
}
