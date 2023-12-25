<?php

declare(strict_types=1);

namespace App;

use Exception;
use function array_key_exists;
use function explode;

class Config
{
    private static Config $instance;

    private array $config = [];

    public static function instance(): self
    {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * @throws Exception
     */
    public function get($name)
    {
        $path = explode('.', $name);
        $config = $this->config;
        foreach ($path as $item) {
            if (!is_array($config) || !array_key_exists($item, $config)) {
                throw new Exception('Config value not found: ' . $name);
            }
            $config = $config[$item];
        }

        return $config;
    }

    public function set(array $values, string $name): void
    {
        $this->config[$name] = $values;
    }
}