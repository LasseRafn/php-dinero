<?php

namespace LasseRafn\Dinero;

use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;
use LasseRafn\Dinero\Builders\ContactBuilder;
use LasseRafn\Dinero\Builders\CreditnoteBuilder;
use LasseRafn\Dinero\Builders\InvoiceBuilder;
use LasseRafn\Dinero\Builders\ProductBuilder;
use LasseRafn\Dinero\Exceptions\DineroRequestException;
use LasseRafn\Dinero\Exceptions\DineroServerException;
use LasseRafn\Dinero\Requests\ContactRequestBuilder;
use LasseRafn\Dinero\Requests\CreditnoteRequestBuilder;
use LasseRafn\Dinero\Requests\InvoiceRequestBuilder;
use LasseRafn\Dinero\Requests\ProductRequestBuilder;
use LasseRafn\Dinero\Utils\Request;

class Dinero
{
    protected $request;

    private $clientId;
    private $clientSecret;

    private $authToken;
    private $org;

    public function __construct($clientId, $clientSecret, $token = null, $org = null, $clientConfig = [])
    {
        $this->clientId = $clientId;
        $this->clientSecret = $clientSecret;
        $this->authToken = $token;
        $this->org = $org;

        $this->request = new Request($clientId, $clientSecret, $this->authToken, $this->org, $clientConfig);
    }

    public function setAuth($token, $org = null)
    {
        $this->authToken = $token;
        $this->org = $org;

        $this->request = new Request($this->clientId, $this->clientSecret, $this->authToken, $this->org);
    }

    public function getAuthToken()
    {
        return $this->authToken;
    }

    public function getAuthUrl()
    {
        return $this->request->getAuthUrl();
    }

    public function getOrgId()
    {
        return $this->org;
    }

    public function auth($apiKey, $orgId = null)
    {
        try {
            $response = json_decode($this->request->curl->post($this->request->getAuthUrl(), [
                'form_params' => [
                    'grant_type' => 'password',
                    'scope'      => 'read write',
                    'username'   => $apiKey,
                    'password'   => $apiKey,
                ],
            ])->getBody()->getContents());

            $this->setAuth($response->access_token, $orgId);

            return $response;
        } catch (ClientException $exception) {
            throw new DineroRequestException($exception);
        } catch (ServerException $exception) {
            throw new DineroServerException($exception);
        }
    }

    public function contacts()
    {
        return new ContactRequestBuilder(new ContactBuilder($this->request));
    }

    public function invoices()
    {
        return new InvoiceRequestBuilder(new InvoiceBuilder($this->request));
    }

    public function products()
    {
        return new ProductRequestBuilder(new ProductBuilder($this->request));
    }

    public function creditnotes()
    {
        return new CreditnoteRequestBuilder(new CreditnoteBuilder($this->request));
    }
}
