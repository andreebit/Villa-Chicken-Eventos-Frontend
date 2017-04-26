<?php

namespace App\Repositories\Traits;


Trait CrudRepositoryTrait
{
    /**
     * @param $data
     * @return mixed
     */
    public function create($data)
    {
        $this->verifyEndpoint();

        foreach ($data as $key => $value) {
            $this->requestClient->addParam($key, $value);
        }
        $response = $this->requestClient->post($this->endpoint());

        return $this->formatResponse($response, self::RESPONSE_DATA_KEY);
    }

    /**
     * @param $id
     * @param $data
     * @return mixed
     */
    public function update($id, $data)
    {
        $this->verifyEndpoint();

        $endpoint = $this->endpoint() . '/' . $id;
        foreach ($data as $key => $value) {
            $this->requestClient->addParam($key, $value);
        }
        $response = $this->requestClient->patch($endpoint);

        return $this->formatResponse($response, self::RESPONSE_DATA_KEY);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        $this->verifyEndpoint();

        $endpoint = $this->endpoint() . '/' . $id;
        $response = $this->requestClient->delete($endpoint);

        return $this->formatResponse($response);
    }
}