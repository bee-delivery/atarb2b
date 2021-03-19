<?php

namespace BeeDelivery\AtarB2B;

use BeeDelivery\AtarB2B\Pix;

class Atar
{
    public function pix($baas = null, $headers = array()) {
        return new Pix($baas, $headers);
    }

    public function origination($baas = null, $headers = array(), $baseUrl = null)
    {
        return new Origination($baas, $headers, $baseUrl);
    }
}
