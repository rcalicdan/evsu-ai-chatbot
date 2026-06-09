<?php

declare(strict_types=1);

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;

use function Integrations\View\blade_view;

return function (App $app): void {
    $app->get('/', function (Request $request, Response $response) {
        return blade_view('home', [
            'title' => 'EVSU Enrollment Assistant',
        ], $response);
    });
};
