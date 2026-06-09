<?php

declare(strict_types=1);

use DI\ContainerBuilder;
use Integrations\View\BladeRenderer;
use Slim\Factory\AppFactory;

use function Rcalicdan\ConfigLoader\env;

require_once __DIR__ . '/../vendor/autoload.php';

$containerBuilder = new ContainerBuilder();
$containerBuilder->addDefinitions(__DIR__ . '/../config/container.php');
$container = $containerBuilder->build();

AppFactory::setContainer($container);
$app = AppFactory::create();

$container->get(BladeRenderer::class);

$app->addBodyParsingMiddleware();
$app->addRoutingMiddleware();
$app->addErrorMiddleware(
    displayErrorDetails: (bool) env('APP_DEBUG', false),
    logErrors: true,
    logErrorDetails: true,
);

(require __DIR__ . '/../config/routes.php')($app);

$app->run();
