<?php

declare(strict_types=1);

namespace App;

use App\Attributes\Event;
use ReflectionClass;
use ReflectionException;
use function basename;
use function in_array;

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
     * @throws ReflectionException
     */
    public function execute(): void
    {
        $eventsRan = [];
        $automationsFolder = implode('/', [Application::$applicationFolder, 'app/Automations']);
        foreach (glob($automationsFolder . '/*.php') as $file) {
            $automationClass = 'App\\Automations\\' . basename($file, '.php');
            $reflection = new ReflectionClass($automationClass);
            foreach ($reflection->getAttributes(Event::class) as $attribute) {
                if ($attribute->getArguments()[0] === $this->event && !in_array($automationClass, $eventsRan)) {
                    $eventsRan[] = $automationClass;
                    $reflection->newInstance($this->event)->execute($this->data);
                }
            }
        }
    }
}