<?php

declare(strict_types=1);

namespace App\View;

use eftec\bladeone\BladeOne;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use RuntimeException;

class BladeRenderer
{
    private static ?self $instance = null;

    public function __construct(
        private readonly BladeOne $blade,
        private readonly ResponseFactoryInterface $responseFactory
    ) {
    }

    public static function init(self $instance): void
    {
        self::$instance = $instance;
    }

    public static function getInstance(): self
    {
        if (self::$instance === null) {
            throw new RuntimeException(
                'BladeRenderer not initialized. Ensure it is resolved from the container on boot.'
            );
        }

        return self::$instance;
    }

    public function render(
        string $template,
        array $data = [],
        ?ResponseInterface $response = null
    ): ResponseInterface {
        $response ??= $this->responseFactory->createResponse();
        $response->getBody()->write($this->blade->run($template, $data));

        return $response;
    }
}
