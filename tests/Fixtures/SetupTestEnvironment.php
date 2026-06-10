<?php

declare(strict_types=1);

namespace Tests\Fixtures;

use DI\Container;
use DI\ContainerBuilder;
use Slim\App;
use Slim\Factory\AppFactory;

class SetupTestEnvironment
{
    /**
     * Boot a completely fresh, isolated Slim application and container.
     *
     * @return array{0: App, 1: Container}
     */
    public static function boot(): array
    {
        $containerBuilder = new ContainerBuilder();

        $containerBuilder->addDefinitions(__DIR__ . '/../../config/container.php');

        /** @var Container $container */
        $container = $containerBuilder->build();

        AppFactory::setContainer($container);
        $app = AppFactory::create();

        (require __DIR__ . '/../../config/routes.php')($app);

        return [$app, $container];
    }
}
