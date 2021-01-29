<?php

namespace BeeDelivery\AtarB2B\Models;

use BeeDelivery\AtarB2B\Utils\Connection;

class Pix
{
    public $http;
    protected $pix;

    public function __construct()
    {
        $this->http = new Connection();
    }

    /**
     * Retrieves an account.
     *
     * @see https://baas-dot-wearatar-dev.appspot.com/docs/origination
     * @param String $atarId
     * @return Array
     */
    public function getPixKey($key)
    {
        return $this->http->get('/pix/keys/' . $key);
    }
}
