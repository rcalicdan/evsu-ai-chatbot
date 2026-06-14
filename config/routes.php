<?php

declare(strict_types=1);

use App\Controllers\ChatController;
use App\Controllers\PageController;
use Slim\App;

return function (App $app): void {
    $app->get('/', [PageController::class, 'home']);
    $app->get('/about', [PageController::class, 'about']);
    $app->get('/terms', [PageController::class, 'terms']);
    $app->get('/help', [PageController::class, 'help']);

    $app->get('/chat', [ChatController::class, 'index']);
    $app->get('/api/chat-stream', [ChatController::class, 'stream']);
};