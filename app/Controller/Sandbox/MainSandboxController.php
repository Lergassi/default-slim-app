<?php

namespace App\Controller\Sandbox;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Source\AbstractSandboxController;

class MainSandboxController extends AbstractSandboxController
{
    public function main(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $response->getBody()->write(__FILE__);

        return $response;
    }
}