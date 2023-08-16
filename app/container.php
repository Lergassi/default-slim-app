<?php

use Source\ProjectPath;
use function DI\autowire;
use function DI\env;
use function DI\factory;

return [
    ProjectPath::class => autowire()->constructorParameter('projectDir', env('APP_PROJECT_DIR', __DIR__ . '/..')),
    PDO::class => factory(function (string $host, string $dbName, string $user, string $password) {
        return new PDO(
            sprintf('mysql:host=%s;dbname=%s', $host, $dbName),
            $user,
            $password,
            [
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_STRINGIFY_FETCHES => false,
            ]
        );
    })
        ->parameter('host', env('APP_DB_HOST', ''))
        ->parameter('dbName', env('APP_DB_NAME', ''))
        ->parameter('user', env('APP_DB_USER', ''))
        ->parameter('password', env('APP_DB_PASSWORD', ''))
    ,
];