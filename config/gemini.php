<?php

declare(strict_types=1);

use function Rcalicdan\ConfigLoader\env;

return [
    'api_key' => env('GEMINI_API_KEY'),
    'model' => 'gemini-2.5-flash-lite',
    'embedding_model' => 'gemini-embedding-1.5',
];
