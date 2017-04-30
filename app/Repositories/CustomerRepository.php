<?php

namespace App\Repositories;

class CustomerRepository extends Repository
{

    /**
     * @return string
     */
    public function endpoint()
    {
        return env('API_BASE_URL') . '/api/v1/customers';
    }

    /**
     * @param $type
     * @param $number
     * @return mixed|null|\stdClass
     */
    public function getByDocument($type, $number) {
        $this->verifyEndpoint();

        $endpoint = $this->endpoint() . '/document/' . $type . '/' . $number . '?rnd=' . rand();

        $response = $this->requestClient->get($endpoint);

        return $this->formatResponse($response, self::RESPONSE_DATA_KEY, self::RESPONSE_META_KEY);
    }

}