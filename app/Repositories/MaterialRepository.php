<?php

namespace App\Repositories;

class MaterialRepository extends Repository
{

    /**
     * @return string
     */
    public function endpoint()
    {
        return env('API_BASE_URL') . '/api/v1/materials';
    }


    /**
     * @param $eventTypeId
     * @return mixed|null|\stdClass
     */
    public function getAllByEventType($eventTypeId) {
        $this->verifyEndpoint();

        $endpoint = $this->endpoint() . '/event-type/' . $eventTypeId . '?rnd=' . rand();

        $response = $this->requestClient->get($endpoint);

        return $this->formatResponse($response, self::RESPONSE_DATA_KEY, self::RESPONSE_META_KEY);
    }

}