<?php

namespace Axio\StrapiSDK\Auth;

use Axio\Session\Managers\Session;
use Axio\StrapiSDK\Requests\RequestManager;

class Authentication
{
    private $requestManager;

    public function __construct()
    {
        $this->requestManager = new RequestManager();
        Session::start();
    }

    public function login($username, $password)
    {

        $endpoint = '/auth/local';
        $data = [
            'identifier' => $username,
            'password' => $password,
        ];

        $loginResponse =  $this->requestManager->post($endpoint, $data);

        Session::set("auth_token", $loginResponse["jwt"]);
        Session::set("user", $loginResponse["user"]);

        return $loginResponse;

    }

    public function logout()
    {
        Session::destroy();
    }
}
