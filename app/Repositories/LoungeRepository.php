<?php

namespace App\Repositories;

class LoungeRepository extends Repository
{

    /**
     * @return string
     */
    public function endpoint()
    {
        return env('API_BASE_URL') . '/api/v1/lounges';
    }


    /**
     * @param $localId
     * @return mixed|null|\stdClass
     */
    public function getAllByLocal($localId) {
        $this->verifyEndpoint();

        $endpoint = $this->endpoint() . '/local/' . $localId . '?rnd=' . rand();

        $response = $this->requestClient->get($endpoint);

        return $this->formatResponse($response, self::RESPONSE_DATA_KEY, self::RESPONSE_META_KEY);
    }

    /**
     * @return array
     */
    public function getPairIdNameByLocal($localId) {
        $data = $this->getAllByLocal($localId);
        $items = $data->data;

        $array = [];
        foreach ($items as $item) {
            $array[$item->id] = $item->name . "(capacidad: {$item->capacity}, precio: {$item->price})";
        }

        return $array;
    }

}