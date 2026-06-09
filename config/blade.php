<?php

declare(strict_types=1);

use function Rcalicdan\ConfigLoader\env;

return [
    'templates_path' => __DIR__ . '/../templates',
    'cache_path' => __DIR__ . '/../var/cache/blade',
    'mode' => env('APP_ENV', 'production') === 'production'
        ? eftec\bladeone\BladeOne::MODE_FAST
        : eftec\bladeone\BladeOne::MODE_AUTO,
];
