<?php

namespace Source\Test\Controller;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class ContainerTestController
{
    private \PDO $pdo;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function testFileDefinitions(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        dump([
            $this->pdo instanceof \PDO
        ]);

        return $response;
    }
}