<?php

use App\Config;
use App\Helpers;

if (!function_exists('dd')) {
    function dd(...$values): void
    {
        Helpers::dd(...$values);
    }
}

if (!function_exists('env')) {
    function env(string $name, $default = null)
    {
        return Helpers::env($name, $default);
    }
}

if (!function_exists('config')) {
    /**
     * @throws Exception
     */
    function config(string $name, $default = null)
    {
        $config = Config::instance();
        return $config->get($name) ?? $default;
    }
}
