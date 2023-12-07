<?php

declare(strict_types=1);

namespace App;

use function array_key_exists;
use function is_array;

class Router
{
    public string $event;

    public array $data = [];

    public function __construct()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->event = $_POST['event'];
            $this->data = $_POST['data'] ?? [];
        } else {
            $this->event = $_GET['event'];
            $this->data = $_GET['data'] ?? [];
        }
    }

    /**
     * Check if the event is listened to, if not then just continue, otherwise run the automations
     * @return void
     */
    public function execute(): void
    {
        $routes = require __DIR__ . '/../automations.php';
        if (array_key_exists($this->event, $routes)) {
            $automations = $routes[$this->event];
            if (!is_array($automations)) {
                $automations = [$automations];
            }

            foreach ($automations as $automation) {
                $executable = new $automation($this->event);
                $executable($this->data);
            }
        }
    }
}