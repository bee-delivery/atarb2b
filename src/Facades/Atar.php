<?php

namespace BeeDelivery\AtarB2B\Facades;

use Illuminate\Support\Facades\Facade;

class Atar extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'atar';
    }
}
