<?php

declare(strict_types=1);

namespace Prestashop\ModuleLibGuzzleAdapter\Guzzle7;

class Config
{
    /**
     * When a client is created with the config of another version,
     * this method makes sure the keys match.
     */
    public static function fixConfig(array $config): array
    {
        if (isset($config['defaults'])) {
            if (isset($config['defaults']['timeout'])) {
                $config['timeout'] = $config['defaults']['timeout'];
                $config['defaults']['timeout'];
            }

            unset($config['defaults']);
        }

        if (isset($config['base_url'])) {
            $config['base_uri'] = $config['base_url'];

            unset($config['base_url']);
        }
        return $config;
    }
}