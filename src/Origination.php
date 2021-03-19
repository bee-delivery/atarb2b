<?php

namespace BeeDelivery\AtarB2B;

use BeeDelivery\AtarB2B\Utils\Connection;
use BeeDelivery\AtarB2B\Utils\Helpers;
use Illuminate\Support\Facades\Validator;

class Origination
{
    use Helpers;

    public $http;

    public function __construct($baas = false, $headers = array(), $baseUrl = null)
    {
        $this->http = new Connection($baas, $headers, $baseUrl);
    }
    
    public function create($data)
    {
        try {
            $data = $this->validateEntitieData($data);
            return $this->http->post('/entities', $data);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

}
