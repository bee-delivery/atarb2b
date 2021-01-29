<?php

namespace BeeDelivery\AtarB2B\Models;

use BeeDelivery\AtarB2B\Utils\Connection;

class Account
{
    public $http;
    protected $account;

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
    public function getAccount($atarId)
    {
        return $this->http->get('/accounts/' . $atarId);
    }
}
