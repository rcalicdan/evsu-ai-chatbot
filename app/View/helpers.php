<?php

declare(strict_types=1);

namespace App\View;

use Psr\Http\Message\ResponseInterface;

/**
 * Render a Blade template into a PSR-7 response.
 * Pass $response to reuse an existing one, or omit it to get a fresh 200.
 */
function blade_view(
    string $template,
    array $data = [],
    ?ResponseInterface $response = null
): ResponseInterface {
    return BladeRenderer::getInstance()->render($template, $data, $response);
}
