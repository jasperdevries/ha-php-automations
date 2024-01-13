<?php

declare(strict_types=1);

namespace App;

use App\HomeAssistant\HomeAssistant;
use Exception;
use function config;

abstract class Automation
{
    public HomeAssistant $ha;

    /**
     * @throws Exception
     */
    public final function __construct(public string $event)
    {
        $this->ha = new HomeAssistant(config('homeassistant.host'), config('homeassistant.token'));
    }

    abstract function execute(array $data): void;
}