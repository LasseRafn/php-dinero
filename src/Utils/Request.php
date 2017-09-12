<?php

namespace LasseRafn\Dinero\Utils;

use GuzzleHttp\Client;

class Request
{
    public $curl;

    protected $baseUri = 'https://api.dinero.dk/v1';
    protected $authUri = 'https://authz.dinero.dk/dineroapi/oauth/token';

    public function __construct($clientId = '', $clientSecret = '', $token = null, $org = null, $clientConfig = [])
    {
        $encodedClientIdAndSecret = base64_encode("{$clientId}:{$clientSecret}");

        $headers = [];

        if ($token !== null) {
            $headers['Authorization'] = "Bearer {$token}";
            $headers['Content-Type'] = 'application/json';
        } else {
            $headers['Authorization'] = "Basic {$encodedClientIdAndSecret}";
            $headers['Content-Type'] = 'application/x-www-form-urlencoded';
        }

        $this->curl = new Client(array_merge_recursive([
            'base_uri' => $this->baseUri.($org !== null ? "/{$org}/" : ''),
            'headers'  => $headers,
        ], $clientConfig));
    }

    /**
     * Return a string with the oAuth url.
     *
     * @return string
     */
    public function getAuthUrl()
    {
        return $this->authUri;
    }
}
