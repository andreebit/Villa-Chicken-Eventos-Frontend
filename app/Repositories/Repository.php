<?php

namespace App\Repositories;


use App\Clients\RequestClient;
use GuzzleHttp\Psr7\Response as GuzzleResponse;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class Repository
 * @package App\Repositories
 */
abstract class Repository
{

    /**
     *
     */
    const RESPONSE_DATA_KEY = 'data';

    /**
     *
     */
    const RESPONSE_META_KEY = 'meta';

    /**
     * @var Client|null
     */
    protected $requestClient = null;

    /**
     * Repository constructor.
     */
    public function __construct()
    {
        $this->requestClient = new RequestClient([], ['Content-Type' => 'application/json']);
    }


    abstract public function endpoint();

    /**
     * @throws \Exception
     */
    protected function verifyEndpoint()
    {
        if (is_null($this->endpoint())) {
            throw new \Exception('$endpoint must not be null.');
        }
    }

    /**
     * @param array $filters
     * @return mixed|null|\stdClass
     */
    public function getAll($filters = [])
    {
        $this->verifyEndpoint();

        $endpoint = $this->endpoint() . '?rnd=' . rand();

        foreach ($filters as $key => $value) {
            $endpoint .= '&' . $key . '=' . $value;
        }

        $response = $this->requestClient->get($endpoint);

        return $this->formatResponse($response, self::RESPONSE_DATA_KEY, self::RESPONSE_META_KEY);
    }

    /**
     * @param $code
     * @return mixed|null
     */
    public function get($code)
    {
        $this->verifyEndpoint();

        $endpoint = $this->endpoint() . '/' . $code;
        $response = $this->requestClient->get($endpoint);

        return $this->formatResponse($response, self::RESPONSE_DATA_KEY);
    }

    /**
     * @param $response
     * @param null $key
     * @param null $metadataKey
     * @return mixed|null|\stdClass
     * @throws \Exception
     */
    protected function formatResponse($response, $key = null, $metadataKey = null)
    {
        if ($response instanceof GuzzleResponse) {
            $statusCode = $response->getStatusCode();
            if ($statusCode == Response::HTTP_OK || $statusCode == Response::HTTP_CREATED) { // no error | has content

                $content = $response->getBody()->getContents();
                $data = json_decode($content);

                if (!is_null($key)) {
                    if (isset($data->{$key})) {

                        $result = new \stdClass();
                        $result->data = $data->{$key};

                        if (!is_null($metadataKey) && isset($data->{$metadataKey})) { // add metadata
                            $result->meta = $data->meta;
                        }

                        return $result;

                    } else {
                        throw new \Exception('$response has no key "' . $key . '"');
                    }

                } else {
                    return $data;
                }

            } elseif ($statusCode == Response::HTTP_NO_CONTENT) { // no error | has no content
                return null;
            }
        } else {
            throw new \Exception('$response must be an instance of GuzzleHttp\Psr7\Response, ' . gettype($response) . ' given.');
        }
    }
}