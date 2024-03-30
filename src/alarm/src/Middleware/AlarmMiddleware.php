<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf Component.
 */

namespace HyperfComponent\Alarm\Middleware;

use Hyperf\HttpServer\Contract\RequestInterface;
use HyperfComponent\Alarm\Alarm;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Throwable;

class AlarmMiddleware implements MiddlewareInterface
{
    public function __construct(
        protected ContainerInterface $container,
        protected RequestInterface $request
    ) {
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $start = microtime(true);
        $e = null;

        try {
            $response = $handler->handle($request);
        } catch (Throwable $exception) {
            $e = $exception;
            throw $exception;
        } finally {
            $end = microtime(true);
            $this->container->get(Alarm::class)->send($this->request, $e, $start, $end);
        }

        return $response;
    }
}
