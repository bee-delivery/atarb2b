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
            if ( ! $this->pixDataIsValid($data) ) {
                throw new \Exception('Dados inválidos.');
            }

            return $this->http->post('/pix/payment', $data);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function pixDataIsValid($data)
    {
        return ! (
            empty($data['amount']) OR
            empty($data['identifier']) OR
            empty($data['description']) OR
            empty($data['to']['key']) OR
            empty($data['to']['type']) OR
            empty($data['to']['timestamp']) OR
            empty($data['to']['isFavorite']) OR
            empty($data['to']['status']) OR
            empty($data['to']['statusResolutionTimestamp']) OR
            empty($data['to']['institution']) OR
            empty($data['to']['institutionName']) OR
            empty($data['to']['branch']) OR
            empty($data['to']['accountNumber']) OR
            empty($data['to']['accountType']) OR
            empty($data['to']['name']) OR
            empty($data['to']['document'])
        );
    }
}
