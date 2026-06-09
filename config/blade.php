<?php

declare(strict_types=1);

use function Rcalicdan\ConfigLoader\env;

$cachePath = __DIR__ . '/../var/cache/blade';

if (! is_dir($cachePath)) {
    mkdir($cachePath, 0755, true);
}

return [
    'templates_path' => __DIR__ . '/../templates',
    'cache_path' => $cachePath,
    'mode' => env('APP_ENV', 'production') === 'production'
        ? eftec\bladeone\BladeOne::MODE_FAST
        : eftec\bladeone\BladeOne::MODE_AUTO,
];