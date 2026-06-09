<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Services\ChatService;
use Integrations\View\BladeRenderer;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use function Hibla\await;

class ChatController
{
    public function __construct(
        private readonly BladeRenderer $renderer,
        private readonly ChatService $chatService
    ) {}

    public function index(Request $request, Response $response): Response
    {
        $data = [
            'title' => 'EVSU Virtual Campus Companion'
        ];

        return $this->renderer->render(
            template: 'home',
            data: $data,
            response: $response
        );
    }

    public function stream(Request $request, Response $response): Response
    {
        $queryParams = $request->getQueryParams();
        $query = $queryParams['message'] ?? '';

        if (empty($query)) {
            $response->getBody()->write((string) json_encode(['error' => 'Message parameter is required']));
            return $response->withHeader('Content-Type', 'application/json')->withStatus(400);
        }

        $prompt = $this->chatService->getChatPrompt($query);

        $response = $response
            ->withHeader('Content-Type', 'text/event-stream')
            ->withHeader('Cache-Control', 'no-cache')
            ->withHeader('Connection', 'keep-alive')
            ->withHeader('X-Accel-Buffering', 'no');

        foreach ($response->getHeaders() as $name => $values) {
            foreach ($values as $value) {
                header(sprintf('%s: %s', $name, $value), false);
            }
        }

        await(
            $prompt->streamWithEvents(
                messageEvent: 'message',
                doneEvent: 'done',
                includeMetadata: false
            )
        );

        return $response;
    }
}
