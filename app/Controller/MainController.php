<?php

namespace App\Controller;

use DI\Attribute\Inject;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Source\Render;

class MainController
{
    #[Inject] private ContainerInterface $container;
    #[Inject] private Render $render;

    public function homepage(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $response->getBody()->write($this->render->render('default-homepage.twig', [
            'appName' => $this->container->get('app.name'),
            'appVersion' => $this->container->get('app.version'),
            'appEnv' => $this->container->get('app.env'),
            'projectDir' => realpath(__DIR__ . '/../..'),
        ]));

        return $response;
    }
}