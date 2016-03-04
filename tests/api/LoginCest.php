<?php

namespace Tests\Api;


class LoginCest {

    public function login(\Api $I) {
        $I->wantTo('perform actions and see result');
        $I->login('arnaud', 'azerty');
        $I->sendGET('/defaults/aa');
        $I->seeResponseCodeIs(401);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson([
            'error_code' => 401,
            'http_code' => 401
        ]);
    }

}