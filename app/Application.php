<?php

declare(strict_types=1);

namespace App;

use Dotenv\Dotenv;
use function glob;
use function is_dir;
use function pathinfo;
use const PATHINFO_FILENAME;

class Application
{
    public static function boot(string $directory): void
    {
        $dotenv = Dotenv::createImmutable($directory);
        $dotenv->load();

        $config = Config::instance();
        if (is_dir(__DIR__ . '/../config/')) {
            foreach (glob(__DIR__ . '/../config/*.php') as $file) {
                $values = require $file;
                $config->set($values, pathinfo($file, PATHINFO_FILENAME));
            }
        }
    }
}