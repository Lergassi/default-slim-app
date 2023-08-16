<?php

namespace Source;

use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

abstract class AbstractSandboxController
{
    public abstract function run(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface;

    private ContainerInterface $container;

    public function getContainer(): ContainerInterface
    {
        return $this->container;
    }

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function main(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        return $this->run($request, $response);
    }
}