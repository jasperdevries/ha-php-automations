<?php

declare(strict_types=1);

namespace App;

use function var_dump;

class Helpers
{
    public static function dd(...$values)
    {
        ob_clean();
        foreach ($values as $value) {
            echo '<pre>';var_dump($value);echo '</pre>';
        }
        die();
    }

    public static function env(string $name, $default = null)
    {
        return $_ENV[$name] ?? $default;
    }
}