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

    public function getChatPrompt(string $query): GeminiPromptInterface
    {
        /** @var array<string> $documents */
        $documents = config('evsu-knowledge', []);

        $searchResults = await(
            $this->gemini->search($query)
                ->documents($documents)
                ->send()
        );

        $context = '';

        if (! empty($searchResults)) {
            $bestMatch = $searchResults[0];
            if ($bestMatch['similarity'] > 0.35) {
                $context = $bestMatch['text'];
            }
        }

        $systemInstruction = $this->buildSystemInstruction($context);

        return $this->gemini
            ->prompt($query)
            ->system($systemInstruction)
            ->balanced()
        ;
    }

    private function buildSystemInstruction(string $context): string
    {
        $contextSource = $context !== ''
            ? $context
            : 'No specific document found. Rely on general verified EVSU info or advise them to contact Admissions.';

        return <<<PROMPT
        You are the official EVSU Virtual Campus Companion, a helpful, polite, and friendly AI assistant for Eastern Visayas State University (EVSU). Your goal is to assist students, applicants, faculty, and visitors with academic, administrative, and general university processes.

        VERIFIED UNIVERSITY FACTS CONTEXT:
        {$contextSource}

        INSTRUCTIONS:
        - Answer accurately using the verified context facts first.
        - Answer queries regarding registrar documents, cashier services, NSTP policies, grades, graduation applications, and specific academic colleges when asked.
        - If details are missing, advise them to email the specific office (e.g., registrar@evsu.edu.ph, saso.sao@evsu.edu.ph) or visit Salazar Street (Archbishop Lino R. Gonzaga Avenue), Tacloban City, Leyte.
        - Keep answers professional, readable, and beautifully structured with bullet points where appropriate.
        PROMPT;
    }
}
