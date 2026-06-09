
<?php

declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

use App\View\BladeRenderer;
use eftec\bladeone\BladeOne;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseFactoryInterface;

use function Rcalicdan\ConfigLoader\config;

return [
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
