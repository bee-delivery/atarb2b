<?php

namespace BeeDelivery\AtarB2B;

use BeeDelivery\AtarB2B\Models\Entity;
use BeeDelivery\AtarB2B\Models\Account;

class Atar
{
    public function entity($userKey, $atarApiKey) {
        return new Entity($userKey, $atarApiKey);
    }

    public function account($userKey, $atarApiKey) {
        return new Account($userKey, $atarApiKey);
    }
}
