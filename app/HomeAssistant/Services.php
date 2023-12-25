<?php

declare(strict_types=1);

namespace App\HomeAssistant;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\RequestOptions;
use function json_decode;
use function json_validate;

readonly class Services
{
    public function __construct(private Client $client) {}

    /**
     * @throws GuzzleException
     * @throws Exception
     */
    public function get(): array
    {
        $response = $this->client->get('services');
        $body = $response->getBody()->getContents();
        if (!json_validate($body)) {
            throw new Exception('Json not valid');
        }

        return json_decode($body);
    }

    /**
     * @throws GuzzleException
     * @throws Exception
     */
    public function call(string $domain, string $name, array $data = []): object
    {
        $response = $this->client->post(
            uri: "services/$domain/$name",
            options: [
                RequestOptions::JSON => $data,
            ],
        );
        $body = $response->getBody()->getContents();
        if (!json_validate($body)) {
            throw new Exception('Json not valid');
        }

        return json_decode($body);
    }
}