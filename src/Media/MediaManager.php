<?php

namespace Axio\StrapiSDK\Media;

use Axio\StrapiSDK\Requests\RequestManager;

class MediaManager
{
    private $requestManager;

    public function __construct()
    {
        $this->requestManager = new RequestManager();
    }

    public function uploadMedia($file)
    {
        return $this->requestManager->upload($file);
    }

    public function getMediaDetails($mediaId, $token)
    {
        // Retrieving details of a specific media file by its ID
        $endpoint = '/upload/' . $mediaId;
        $options = [
            'headers' => ['Authorization' => 'Bearer ' . $token],
        ];

        return $this->requestManager->get($endpoint, $options);
    }

    public function deleteMedia($mediaId, $token)
    {
        // Deleting a media file by its ID
        $endpoint = '/upload/' . $mediaId;
        $options = [
            'headers' => ['Authorization' => 'Bearer ' . $token],
        ];

        return $this->requestManager->delete($endpoint, $options);
    }

    // Add more methods as needed for media management operations

    // ... Additional functionality related to media management in Strapi API
}
