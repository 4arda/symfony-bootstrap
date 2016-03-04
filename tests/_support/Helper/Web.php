<?php
namespace Helper;

// here you can define custom actions
// all public methods declared in helper class will be available in $I

use Codeception\Module\WebDriver;

class Web extends \Codeception\Module
{

    public function login($username, $password)
    {
        /**
         * @var $driver WebDriver
         */
        $driver = $this->getModule('WebDriver');


        $driver->amOnPage('/login');
        $driver->fillField('_username', 'arnaud');
        $driver->fillField('_password', 'azerty');
        $driver->click('#_submit');
    }
}
