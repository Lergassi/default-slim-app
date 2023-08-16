<?php

namespace Source\Test\Controller;

use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Source\ProjectPath;

class MainTestController
{
    private ContainerInterface $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function testDump(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        dump('Hello, World!');
        dd('Hello, World!');

        return $response;
    }

    public function testContainer(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        dump([
            $this->container instanceof ContainerInterface,
            'container was injected',
        ]);

        return $response;
    }

    public function testPdo(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        dump($this->container->get(\PDO::class));

        return $response;
    }

    public function testProjectDir(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        /** @var ProjectPath $projectPath */
        $projectPath = $this->container->get(ProjectPath::class);

        dump([
            $projectPath instanceof ProjectPath,
            $projectPath->build(),
            $projectPath->build(''),
            $projectPath->build(0),
            $projectPath->build('/'),
            $projectPath->build('42'),
        ]);

        return $response;
    }
}