<?php

declare(strict_types=1);

namespace App\Controllers;

use Integrations\View\BladeRenderer;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class PageController
{
    public function __construct(private readonly BladeRenderer $renderer) {}

    public function home(Request $request, Response $response): Response
    {
        return $this->renderer->render('pages.home', ['title' => 'EVSU Campus Companion | Home'], $response);
    }

    public function about(Request $request, Response $response): Response
    {
        return $this->renderer->render('pages.about', ['title' => 'About | EVSU Companion'], $response);
    }

    public function terms(Request $request, Response $response): Response
    {
        return $this->renderer->render('pages.terms', ['title' => 'Terms & Conditions'], $response);
    }

    public function help(Request $request, Response $response): Response
    {
        return $this->renderer->render('pages.help', ['title' => 'System Help'], $response);
    }
}