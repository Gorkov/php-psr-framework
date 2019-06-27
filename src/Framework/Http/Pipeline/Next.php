<?php

namespace Framework\Http\Pipeline;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use SplQueue;

class Next
{
    /**
     * @var SplQueue
     */
    private $queue;

    /**
     * @var callable
     */
    private $default;

    /**
     * Next constructor.
     *
     * @param SplQueue $queue
     * @param callable $default
     */
    public function __construct(SplQueue $queue, callable $default)
    {
        $this->queue = $queue;
        $this->default = $default;
    }

    /**
     * @param ServerRequestInterface $request
     *
     * @return ResponseInterface
     */
    public function __invoke(ServerRequestInterface $request): ResponseInterface
    {
        if ($this->queue->isEmpty()) {
            return ($this->default)($request);
        }

        $middleware = $this->queue->dequeue();

        return $middleware($request, function (ServerRequestInterface $request) {
            return $this($request);
        });
    }
}
