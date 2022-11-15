<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

/**
 * Class PushAll
 * @package App\Services
 */
class PushAll
{
    protected string $url = 'https://pushall.ru/api.php';
    protected string $type = 'self';
    protected string $id;
    protected string $key;
    protected Client $client;

    /**
     * @param string $id
     * @param string $key
     */
    public function __construct(string $id, string $key)
    {
        $this->id = $id;
        $this->key = $key;
        $this->client = new Client();
    }

    /**
     * @param string $title
     * @param string $text
     * @return string
     * @throws GuzzleException
     */
    public function sendRequest(string $title, string $text): string
    {
        $response = $this->client->request('POST', $this->url, [
            'form_params' => [
                'type' => $this->type,
                'id' => $this->id,
                'key' => $this->key,
                'title' => $title,
                'text' => $text,
            ],
        ]);

        return $response->getBody()->getContents();
    }
}
