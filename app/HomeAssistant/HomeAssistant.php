<?php

declare(strict_types=1);

namespace App\HomeAssistant;

use GuzzleHttp\Client;

readonly class HomeAssistant
{
    public Client $client;

    public Events $events;

    public Services $services;

    public States $states;

    public function __construct(string $host, string $token)
    {
        $this->client = new Client([
            'base_uri' => $host . '/api/',
            'headers' => [
                'Authorization' => 'Bearer ' . $token,
                'Content-Type' => 'application/json',
            ],
        ]);

        $this->events = new Events($this->client);
        $this->services = new Services($this->client);
        $this->states = new States($this->client);
    }
}