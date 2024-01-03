<?php

namespace Axio\StrapiSDK\Auth;

use Axio\StrapiSDK\Requests\RequestManager;

class User
{
    private $requestManager;

    public function __construct()
    {
        $this->requestManager = new RequestManager();
    }

    public function getUserDetails($userId, $token)
    {
        $endpoint = '/users/' . $userId;

        $options = [
            'headers' => ['Authorization' => 'Bearer ' . $token],
        ];

        return $this->requestManager->get($endpoint, $options);
    }

    public function updateUserDetails($userId, $token, $userData)
    {
        $endpoint = '/users/' . $userId;

        $options = [
            'headers' => ['Authorization' => 'Bearer ' . $token],
            'json' => $userData,
        ];

        return $this->requestManager->put($endpoint, $userData, $options);
    }

    public function deleteUser($userId, $token)
    {
        $endpoint = '/users/' . $userId;

        $options = [
            'headers' => ['Authorization' => 'Bearer ' . $token],
        ];

        return $this->requestManager->delete($endpoint, $options);
    }
}
