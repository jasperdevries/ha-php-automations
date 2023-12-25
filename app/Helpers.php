<?php

declare(strict_types=1);

namespace App;

use function var_dump;

class Helpers
{
    public static function env(string $name, $default = null)
    {
        return $_ENV[$name] ?? $default;
    }
}