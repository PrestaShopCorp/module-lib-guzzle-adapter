<?php

declare(strict_types=1);

namespace Prestashop\ModuleLibGuzzleAdapter\Guzzle5;

use Prestashop\ModuleLibGuzzleAdapter\ConfigInterface;

class Config implements ConfigInterface
{
    /**
     * {@inheritdoc}
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
