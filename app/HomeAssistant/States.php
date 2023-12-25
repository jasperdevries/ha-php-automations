<?php

declare(strict_types=1);

namespace App\HomeAssistant;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\RequestOptions;
use function is_null;
use function json_decode;
use function json_validate;

readonly class States
{
    public function __construct(private Client $client) {}

    /**
     * @throws GuzzleException
     * @throws Exception
     */
    public function get(?string $entity = null): array|object
    {
        $response = $this->client->get(is_null($entity) ? 'states' : "states/$entity");
        $body = $response->getBody()->getContents();
        if (!json_validate($body)) {
            throw new Exception('Json not valid');
        }

        return json_decode($body);
    }

    /**
     * @param array $data [state: string, attributes: []]
     *
     * @throws GuzzleException
     * @throws Exception
     */
    public function set(string $entity, array $data): object
    {
        $response = $this->client->post(
            uri: "states/$entity",
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