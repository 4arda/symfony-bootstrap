<?php
namespace Helper;

// here you can define custom actions
// all public methods declared in helper class will be available in $I


use Codeception\Module\Db;
use Codeception\Module\REST;

class Api extends \Codeception\Module
{
    protected $oAuthToken;

    protected $clientId;

    protected $clientSecret;

    public function generateOAuthClient()
    {
        /**
         * @var $db Db
         */
        $db = $this->getModule('Db');

        $this->clientId = substr(md5(microtime() . 'random') . md5(time()), 0, 51);
        $this->clientSecret = substr(md5(microtime() . 'secret') . md5(time()), 0, 51);

        $data = [
            'secret' => $this->clientSecret,
            'name'   => 'Test client ' . microtime(),
            'random_id' => $this->clientId,
            'allowed_grant_types' => serialize(['password', 'authorization_code']),
            'redirect_uris' => serialize([])
        ];

        $db->driver->executeQuery($db->driver->insert('client', $data), array_values($data));

        $this->clientId = $db->driver->lastInsertId('client') . '_' . $this->clientId;
    }

    public function login($username, $password)
    {
        // try to create oAuthClient
        if (is_null($this->clientId) || is_null($this->clientSecret)) {
            $this->generateOAuthClient();
        }

        $this->sendPOST('/oauth/v2/token', [
            'client_id' => $this->clientId,
            'client_secret' => $this->clientSecret,
            'username' => $username,
            'password' => $password,
            'grant_type' => 'password'
        ]);

        /**
         * @var $rest REST
         */
        $rest = $this->getModule('REST');

        $rest->seeResponseCodeIs(200);
        $rest->seeResponseIsJson();
        $this->oAuthToken = json_decode($rest->grabResponse(), true);
    }

    public function isLogged()
    {
        return !is_null($this->oAuthToken);
    }

    public function prepareApiUrl($url)
    {
        if (substr($url, 0, 1) != '/') {
            $url = '/' . $url;
        }

        if ($url !== '/oauth/v2/token') {
            $url = '/api' . $url;
        }

        if ($this->isLogged()) {

            if (strpos($url, '?') === FALSE) {
                $url .= '?';
            } else {
                $url .= '&';
            }

            $url .= http_build_query([
                'access_token' => $this->oAuthToken['access_token']
            ]);
        }


        return substr($url, 1);
    }


    public function sendPOST($url, $params = [], $files = []) {

        $this->getModule('REST')->sendPOST($this->prepareApiUrl($url), $params, $files);
    }

    public function sendHEAD($url, $params = [])
    {

        $this->getModule('REST')->sendHEAD($this->prepareApiUrl($url), $params);
    }

    public function sendOPTIONS($url, $params = [])
    {

        $this->getModule('REST')->sendOPTIONS($this->prepareApiUrl($url), $params);
    }

    public function sendGET($url, $params = [])
    {

        $this->getModule('REST')->sendGET($this->prepareApiUrl($url), $params);
    }

    public function sendPUT($url, $params = [], $files = [])
    {

        $this->getModule('REST')->sendPUT($this->prepareApiUrl($url), $params, $files);
    }

    public function sendPATCH($url, $params = [], $files = [])
    {

        $this->getModule('REST')->sendPATCH($this->prepareApiUrl($url), $params, $files);
    }

    public function sendDELETE($url, $params = [], $files = [])
    {

        $this->getModule('REST')->sendDELETE($this->prepareApiUrl($url), $params, $files);
    }




    /**
     * @return mixed
     */
    public function getClientId()
    {
        return $this->clientId;
    }

    /**
     * @param mixed $clientId
     */
    public function setClientId($clientId)
    {
        $this->clientId = $clientId;
    }

    /**
     * @return mixed
     */
    public function getClientSecret()
    {
        return $this->clientSecret;
    }

    /**
     * @param mixed $clientSecret
     */
    public function setClientSecret($clientSecret)
    {
        $this->clientSecret = $clientSecret;
    }
}
