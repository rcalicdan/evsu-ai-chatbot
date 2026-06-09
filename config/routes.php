<?php

declare(strict_types=1);

use App\Controllers\ChatController;
use Slim\App;

return function (App $app): void {
    $app->get('/', [ChatController::class, 'index']);
    $app->get('/api/chat-stream', [ChatController::class, 'stream']);
};
