<?php

namespace Source\Test\Controller;

use DI\Attribute\Inject;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Source\ProjectPath;
use Source\Render;

class MainTestController
{
    #[Inject] private ContainerInterface $container;
    #[Inject] private ProjectPath $projectPath;
    #[Inject] private \PDO $pdo;
    #[Inject] private Render $render;

    public function dump(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        dump('Hello, World!');
        dd('Hello, World!');

        return $response;
    }

    public function inject(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        dump([
            $this->container instanceof ContainerInterface,
            $this->projectPath instanceof ProjectPath,
            $this->pdo instanceof \PDO,
            $this->render instanceof Render,
        ]);

        return $response;
    }

    public function projectPath(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        dump([
            $this->projectPath instanceof ProjectPath,
            $this->projectPath->build(),
            $this->projectPath->build(''),
            $this->projectPath->build(0),
            $this->projectPath->build('/'),
            $this->projectPath->build('42'),
        ]);

        return $response;
    }

    public function env(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        dump(
            $this->container->get('app.name'),
            $this->container->get('app.version'),
            $this->container->get('app.env'),
        );

        return $response;
    }

    public function render(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $response->getBody()->write($this->render->render('test/main.twig'));

        return $response;
    }
}