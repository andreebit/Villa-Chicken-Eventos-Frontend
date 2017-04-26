<?php

namespace App\Clients;

use GuzzleHttp\Client;

class RequestClient
{

    /**
     * @var Client
     */
    private $client;
    /**
     * @var array
     */
    private $params = [];

    /**
     * @var array
     */
    private $headers = [];

    /**
     * RequestClient constructor.
     * @param array $params
     * @param array $headers
     */
    public function __construct($params = [], $headers = [])
    {
        $this->params = $params;
        $this->headers = $headers;
        $this->client = new Client();
    }

    /**
     * @param $key
     * @param $value
     * @return $this
     */
    public function addHeader($key, $value)
    {
        $this->headers[$key] = $value;
        return $this;
    }

    /**
     * @param $key
     * @param $value
     * @return $this
     */
    public function addParam($key, $value)
    {
        if (!is_null($value)) {
            $this->params[$key] = $value;
        }
        return $this;
    }


    /**
     * @param $endpoint
     * @return mixed|\Psr\Http\Message\ResponseInterface
     */
    public function get($endpoint)
    {
        return $this->client->request('GET', $endpoint, [
            'json' => $this->params,
            'headers' => $this->headers
        ]);
    }

    /**
     * @param $endpoint
     * @return mixed|\Psr\Http\Message\ResponseInterface
     */
    public function post($endpoint)
    {
        return $this->client->request('POST', $endpoint, [
            'json' => $this->params,
            'headers' => $this->headers
        ]);
    }

    /**
     * @param $endpoint
     * @return mixed|\Psr\Http\Message\ResponseInterface
     */
    public function put($endpoint)
    {
        return $this->client->request('PUT', $endpoint, [
            'json' => $this->params,
            'headers' => $this->headers
        ]);
    }

    /**
     * @param $endpoint
     * @return mixed|\Psr\Http\Message\ResponseInterface
     */
    public function patch($endpoint)
    {
        return $this->client->request('PATCH', $endpoint, [
            'json' => $this->params,
            'headers' => $this->headers
        ]);
    }

    /**
     * @param $endpoint
     * @return mixed|\Psr\Http\Message\ResponseInterface
     */
    public function delete($endpoint)
    {
        return $this->client->request('DELETE', $endpoint, [
            'json' => $this->params,
            'headers' => $this->headers
        ]);
    }

    /**
     * @return array
     */
    public function getParams()
    {
        return $this->params;
    }

    /**
     * @return array
     */
    public function getHeaders()
    {
        return $this->headers;
    }

}