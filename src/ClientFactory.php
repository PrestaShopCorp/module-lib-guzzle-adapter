<?php

declare(strict_types=1);

namespace Prestashop\ModuleLibGuzzleAdapter;

use Prestashop\ModuleLibGuzzleAdapter\Guzzle5\Client as Guzzle5Client;
use Prestashop\ModuleLibGuzzleAdapter\Guzzle7\Client as Guzzle7Client;
use PrestaShop\ModuleLibGuzzleAdapter\VersionDetection;
use Psr\Http\Client\ClientInterface;

class ClientFactory
{
    /**
     * @var VersionDetection
     */
    private $versionDetection;

    public function __construct(VersionDetection $versionDetection = null)
    {
        $this->versionDetection = $versionDetection ?: new VersionDetection();
    }

    /**
     * @param array<string, mixed> $config
     */
    public function getClient(array $config = []): ClientInterface
    {
        if ($this->versionDetection->getGuzzleMajorVersionNumber() >= 7) {
            return Guzzle7Client::createWithConfig($config);
        }

        return Guzzle5Client::createWithConfig($config);
    }
}
