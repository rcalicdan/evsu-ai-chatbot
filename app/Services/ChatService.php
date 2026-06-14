<?php

declare(strict_types=1);

namespace App\Services;

use Rcalicdan\GeminiClient\Interfaces\GeminiClientInterface;
use Rcalicdan\GeminiClient\Interfaces\GeminiPromptInterface;

use function Hibla\await;
use function Rcalicdan\ConfigLoader\config;

class ChatService
{
    public function __construct(
        private readonly GeminiClientInterface $gemini
    ) {
    }

    public function getChatPrompt(string $query, array $history = []): GeminiPromptInterface
    {
        $documents = config('evsu-knowledge', []);

        $searchResults = await(
            $this->gemini->search($query)->documents($documents)->send()
        );

        $context = '';
        if (! empty($searchResults)) {
            $bestMatch = $searchResults[0];
            if ($bestMatch['similarity'] > 0.35) {
                $context = $bestMatch['text'];
            }
        }

        $systemInstruction = $this->buildSystemInstruction($context, $history);

        return $this->gemini
            ->prompt($query)
            ->system($systemInstruction)
            ->balanced();
    }

    private function buildSystemInstruction(string $context, array $history): string
    {
        $contextSource = $context !== ''
            ? $context
            : 'No specific document found. Rely on general verified EVSU info.';

        $historyText = "No previous conversation.";
        if (!empty($history)) {
            $historyText = "";
            foreach ($history as $msg) {
                $role = (isset($msg['role']) && $msg['role'] === 'user') ? 'USER' : 'ASSISTANT';
                $content = $msg['content'] ?? '';
                $historyText .= "{$role}: {$content}\n\n";
            }
        }

        return <<<PROMPT
        You are the official EVSU Virtual Campus Companion.

        ### LONG-TERM CONVERSATION HISTORY:
        (Use this to remember the user's name, previous questions, and context)
        {$historyText}

        ### VERIFIED UNIVERSITY FACTS CONTEXT:
        {$contextSource}

        ### INSTRUCTIONS:
        - Answer accurately using the verified context facts first.
        - Remember details the user told you previously based on the history above.
        - Keep answers professional, readable, and beautifully structured with bullet points where appropriate.
        PROMPT;
    }
}