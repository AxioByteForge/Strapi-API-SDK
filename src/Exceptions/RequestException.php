<?php

namespace Axio\StrapiSDK\Exceptions;

use Axio\StrapiSDK\Exceptions\StrapiSDKException;

class RequestException extends StrapiSDKException
{
    public function __construct($message = "", $code = 0, \Throwable $previous = null)
    {
        // Format the message with additional context for better readability
        $formattedMessage = "Request Error [{$code}]: {$message}\n";
        
        // If the message is empty, use a default message based on the code
        if (empty($message)) {
            $formattedMessage = $this->getDefaultMessage($code);
        }

        parent::__construct($formattedMessage, $code, $previous);
    }

    // Method to provide default messages based on Strapi API HTTP status codes
    private function getDefaultMessage($code)
    {
        switch ($code) {
            case 400:
                return "Bad Request: The request was malformed or invalid.\n";
            case 401:
                return "Unauthorized: Check your credentials or access rights.\n";
            case 403:
                return "Forbidden: Access to the requested resource is forbidden.\n";
            case 404:
                return "Not Found: The requested resource does not exist.\n";
            case 405:
                return "Method Not Allowed: The HTTP method used is not allowed for this resource.\n";
            case 406:
                return "Not Acceptable: The requested resource is capable of generating only content not acceptable according to the Accept headers sent in the request.\n";
            case 409:
                return "Conflict: A conflict occurred while processing the request.\n";
            case 410:
                return "Gone: The requested resource is no longer available and will not be available again.\n";
            case 412:
                return "Precondition Failed: The server does not meet one of the preconditions specified by the requester.\n";
            case 422:
                return "Unprocessable Entity: The server understands the content type of the request entity but was unable to process the contained instructions.\n";
            case 429:
                return "Too Many Requests: Rate limit exceeded. Try again later.\n";
            case 500:
                return "Internal Server Error: There was an unexpected server error.\n";
            case 501:
                return "Not Implemented: The server does not support the functionality required to fulfill the request.\n";
            // Add more cases for other Strapi-specific HTTP status codes if needed
            default:
                return "An error occurred with status code {$code}.\n";
        }
    }
}
