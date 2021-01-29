<?php

namespace BeeDelivery\AtarB2B;

use BeeDelivery\AtarB2B\Models\Account;
use BeeDelivery\AtarB2B\Models\Entity;
use BeeDelivery\AtarB2B\Models\Pix;

class Atar
{
    public function entity() {
        return new Entity();
    }

    public function account() {
        return new Account();
    }

    public function pix($atarId = null) {
        return new Pix($atarId);
    }
}
