<?php

declare(strict_types=1);

use App\Services\ChatService;
use Hibla\Promise\Promise;
use Rcalicdan\GeminiClient\Interfaces\GeminiClientInterface;
use Rcalicdan\GeminiClient\Interfaces\GeminiPromptInterface;
use Rcalicdan\GeminiClient\Interfaces\GeminiSearchInterface;

it('retrieves relevant university context and configures the gemini prompt', function () {
    $query = 'freshman requirements';

    $mockSearch = mock(GeminiSearchInterface::class);
    $mockSearch->shouldReceive('documents')->andReturnSelf();
    $mockSearch->shouldReceive('send')->andReturn(Promise::resolved([
        [
            'text' => 'Freshman requirements are Form 138 and PSA Birth certificate.',
            'similarity' => 0.85,
            'index' => 0,
        ],
    ]));

    $mockPrompt = mock(GeminiPromptInterface::class);
    $mockPrompt->shouldReceive('system')->andReturnSelf();
    $mockPrompt->shouldReceive('balanced')->andReturnSelf();

    $mockGemini = mock(GeminiClientInterface::class);
    $mockGemini->shouldReceive('search')->with($query)->andReturn($mockSearch);
    $mockGemini->shouldReceive('prompt')->with($query)->andReturn($mockPrompt);

    $service = new ChatService($mockGemini);
    $result = $service->getChatPrompt($query);

    expect($result)->toBe($mockPrompt);
});
