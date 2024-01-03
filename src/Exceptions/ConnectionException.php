<?php

namespace Axio\StrapiSDK\Exceptions;

use Axio\StrapiSDK\Exceptions\StrapiSDKException;

/**
 * Exception class for handling connection-related errors in the Strapi SDK.
 *
 * This exception class extends the base StrapiSDKException class and provides
 * specific handling for various HTTP status codes commonly encountered during
 * interactions with the Strapi API.
 *
 * @package Axio\StrapiSDK\Exceptions
 */
class ConnectionException extends StrapiSDKException
{

    /**
     * Constructor for ConnectionException.
     *
     * @param string $message The error message. Defaults to an empty string.
     * @param int $code The HTTP status code associated with the error. Defaults to 0.
     * @param \Throwable|null $previous The previous throwable used for the exception chaining.
     */
    public function __construct($message = "", $code = 0, \Throwable $previous = null)
    {
        // Format the message with additional context for better readability
        $formattedMessage = "Connection Error [{$code}]: {$message}\n";

        // If the message is empty, use a default message based on the code
        if (empty($message)) {
            $formattedMessage = $this->getDefaultMessage($code);
        }

        parent::__construct($formattedMessage, $code, $previous);
    }

    /**
     * Provides default error messages based on HTTP status codes.
     *
     * This method returns a default error message corresponding to the provided
     * HTTP status code commonly encountered during interactions with the Strapi API.
     *
     * @param int $code The HTTP status code.
     * @return string The default error message corresponding to the HTTP status code.
     */
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
            case 429:
                return "Too Many Requests: Rate limit exceeded. Try again later.\n";
            case 500:
                return "Internal Server Error: There was an unexpected server error.\n";
            default:
                return "An error occurred with status code {$code}.\n";
        }
    }
}
