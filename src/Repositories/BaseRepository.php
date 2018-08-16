<?php

namespace Bonnier\SiteManager\Repositories;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class BaseRepository
{
    /** @var Client */
    protected $client;

    /**
     * AppRepository constructor.
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    protected function get(string $uri, array $options = [])
    {
        try {
            $response = $this->client->get($uri, $options);
            $decodedResponse = json_decode($response->getBody()->getContents());
            if (json_last_error() === JSON_ERROR_NONE) {
                return $decodedResponse;
            }
        } catch (ClientException $exception) {
            return null;
        }

        return null;
    }
}
