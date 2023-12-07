<?php

declare(strict_types=1);

namespace App\Automations;

abstract class Automation
{
    public final function __construct(public string $event) {}

    abstract function __invoke(array $data): void;
}