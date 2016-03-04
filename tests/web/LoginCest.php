<?php

namespace Tests\Web;


class LoginCest {

    public function login(\Web $I) {
        $I->wantTo('perform actions and see result');
        $I->login('arnaud', 'azerty');
    }

}