<?php

declare(strict_types=1);

namespace Prestashop\ModuleLibGuzzleAdapter\Guzzle5;

class Config
{
    /**
     * When a client is created with the config of another version,
     * this method makes sure the keys match.
     */
    public static function fixConfig(array $config): array
    {
        if (isset($config['timeout'])) {
            $config['defaults']['timeout'] = $config['timeout'];
            unset($config['timeout']);
        }

        if (isset($config['base_uri'])) {
            $config['base_url'] = $config['base_uri'];

            unset($config['base_uri']);
        }
        return $config;
    }
}