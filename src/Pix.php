<?php

namespace BeeDelivery\AtarB2B;

use BeeDelivery\AtarB2B\Utils\Connection;
use BeeDelivery\AtarB2B\Utils\Helpers;
use Illuminate\Support\Facades\Validator;

class Pix
{
    use Helpers;

    public $http;

    public function __construct()
    {
        $this->http = new Connection();
    }

    public function transfer($data)
    {
        try {
            $data = $this->validatePixData($data);

            return $this->http->post('/pix/payment', $data);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function validateKey($key)
    {
        try {
            $this->validateKeyType($key);

            return $this->http->get('/pix/keys', $key);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function transferDetails($id)
    {
        try {
            return $this->http->get('/pix/detail', $id);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
