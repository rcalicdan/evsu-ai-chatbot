<?php

declare(strict_types=1);

use Integrations\View\BladeRenderer;
use eftec\bladeone\BladeOne;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseFactoryInterface;
use Slim\Psr7\Factory\ResponseFactory;

use function Rcalicdan\ConfigLoader\config;

return [
    ResponseFactoryInterface::class => function () {
        return new ResponseFactory();
    },

    BladeOne::class => function () {
        return new BladeOne(
            config('blade.templates_path'),
            config('blade.cache_path'),
            config('blade.mode')
        );
    },

    BladeRenderer::class => function (ContainerInterface $c) {
        $renderer = new BladeRenderer(
            $c->get(BladeOne::class),
            $c->get(ResponseFactoryInterface::class)
        );

        BladeRenderer::init($renderer);

        return $renderer;
    },
];