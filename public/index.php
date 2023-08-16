<?php
//todo: Только для dev.
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

use App\Controller\MainController;
use App\Controller\TestController\MainTestController;
use DI\ContainerBuilder;
use Dotenv\Dotenv;
use Psr\Container\ContainerInterface;
use Slim\Factory\AppFactory;
use Source\Debug\InitCustomDumper;

require __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();

new InitCustomDumper();

$containerBuilder = new ContainerBuilder();
$containerBuilder->addDefinitions(__DIR__ . '/../app/container.php');

$app = AppFactory::createFromContainer($containerBuilder->build());

//todo: Только для dev.
$app->addErrorMiddleware(true, false, false);

//----------------------------------------------------------------
// main routes
//----------------------------------------------------------------
$app->get('/', MainController::class . ':homepage');

//----------------------------------------------------------------
// todo: Только для dev.
// test routes
//----------------------------------------------------------------
$app->get('/test/dump', MainTestController::class . ':testDump');
$app->get('/test/container/file_definitions', \App\Controller\TestController\ContainerTestController::class . ':testFileDefinitions');
$app->get('/test/pdo', MainTestController::class . ':testPdo');

$app->run();