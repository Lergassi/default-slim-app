<?php

use Source\ProjectPath;
use function DI\autowire;
use function DI\env;
use function DI\factory;

return [
    'app.name' => env('APP_NAME', null),
    'app.version' => env('APP_VERSION', null),
    'app.env' => env('APP_ENV', 'prod'),

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
        ->parameter('host', env('APP_DB_HOST', null))
        ->parameter('dbName', env('APP_DB_NAME', null))
        ->parameter('user', env('APP_DB_USER', null))
        ->parameter('password', env('APP_DB_PASSWORD', null))
    ,
];