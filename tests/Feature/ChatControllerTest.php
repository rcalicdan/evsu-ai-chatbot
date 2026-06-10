<?php

declare(strict_types=1);

use App\Services\ChatService;
use Hibla\HttpClient\Http;
use Hibla\HttpClient\Testing\TestingHttpHandler;
use Rcalicdan\GeminiClient\GeminiClient;
use Rcalicdan\GeminiClient\Interfaces\GeminiClientInterface;
use Slim\Psr7\Factory\ServerRequestFactory;
use Tests\Fixtures\SetupTestEnvironment;

it('renders the campus companion homepage successfully', function () {
    [$app] = SetupTestEnvironment::boot();

    $request = (new ServerRequestFactory())->createServerRequest('GET', '/');
    $response = $app->handle($request);

    expect($response->getStatusCode())->toBe(200);
    expect((string) $response->getBody())->toContain('EVSU Campus Companion');
});

it('fails with 400 Bad Request if the message query parameter is missing', function () {
    [$app] = SetupTestEnvironment::boot();

    $request = (new ServerRequestFactory())->createServerRequest('GET', '/api/chat-stream');
    $response = $app->handle($request);

    expect($response->getStatusCode())->toBe(400);
    expect((string) $response->getBody())->toContain('Message parameter is required');
});

it('emits streaming headers and resolves the sse pipeline using a real gemini client under HTTP mocking', function () {
    [$app, $container] = SetupTestEnvironment::boot();

    $handler = new TestingHttpHandler();
    $httpClient = Http::client()->withHandler($handler);
    $realGeminiClient = new GeminiClient('fake-api-key', 'gemini-2.0-flash', $httpClient);
    $container->set(GeminiClientInterface::class, $realGeminiClient);
    $realChatService = new ChatService($realGeminiClient);
    $container->set(ChatService::class, $realChatService);

    $handler->mock('POST')
        ->url('https://generativelanguage.googleapis.com/v1beta/models/gemini-embedding-001:embedContent')
        ->persistent()
        ->respondJson(['embedding' => ['values' => array_fill(0, 3072, 0.15)]])
        ->register()
    ;

    $handler->mock('GET')
        ->url('https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:streamGenerateContent?alt=sse')
        ->respondWithSSE(
            [
                [
                    'event' => 'message',
                    'data' => json_encode(['candidates' => [['content' => ['parts' => [['text' => 'EVSU ']]]]]]),
                ],
                [
                    'event' => 'message',
                    'data' => json_encode(['candidates' => [['content' => ['parts' => [['text' => 'Companion!']]], 'finishReason' => 'STOP']]]),
                ],
            ]
        )
        ->register()
    ;

   $request = (new ServerRequestFactory())
        ->createServerRequest('GET', '/api/chat-stream')
        ->withQueryParams(['message' => 'graduation requirements']);

    ob_start(fn() => '');
    $response = @$app->handle($request);
    ob_end_clean();

    expect($response->getStatusCode())->toBe(200);
    expect($response->getHeaderLine('Content-Type'))->toBe('text/event-stream');
    $handler->assertRequestMade('POST', 'https://generativelanguage.googleapis.com/v1beta/models/gemini-embedding-001:embedContent');
    $handler->assertSSEConnectionMade('https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:streamGenerateContent?alt=sse');
    $handler->assertSSEConnectionRequestedWithProperHeaders('https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:streamGenerateContent?alt=sse');
});
