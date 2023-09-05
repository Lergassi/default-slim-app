#!/usr/bin/env php
<?php
//todo: Только для dev.
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

require __DIR__ . '/../vendor/autoload.php';

use DI\ContainerBuilder;
use Dotenv\Dotenv;
use Source\Debug\InitCustomDumper;
use Source\Test\Command\TestCommand;
use Symfony\Component\Console\Application;

//----------------------------------------------------------------
// init app
//----------------------------------------------------------------
$dotenv = Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();

new InitCustomDumper();

$containerBuilder = new ContainerBuilder();
$containerBuilder
    ->addDefinitions(__DIR__ . '/../app/container.php')
    ->useAttributes(true)
;

$container = $containerBuilder->build();

$app = new Application(
    $_ENV['APP_NAME'] ?? '',
    $_ENV['APP_VERSION'] ?? '',
);

//----------------------------------------------------------------
// commands
//----------------------------------------------------------------

//----------------------------------------------------------------
// todo: Только для dev.
// sandbox commands
//----------------------------------------------------------------

//----------------------------------------------------------------
// todo: Только для dev.
// test commands
//----------------------------------------------------------------
$app->add($container->get(TestCommand::class));

//----------------------------------------------------------------
// run app
//----------------------------------------------------------------
$app->run();