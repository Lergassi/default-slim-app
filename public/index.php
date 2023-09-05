<?php
//todo: Только для dev.
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

use App\Controller\MainController;
use App\Controller\Sandbox\MainSandboxController;
use DI\ContainerBuilder;
use Dotenv\Dotenv;
use Slim\Factory\AppFactory;
use Source\Debug\InitCustomDumper;
use Source\Test\Controller\MainTestController;

require __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();

new InitCustomDumper();

$containerBuilder = new ContainerBuilder();
$containerBuilder
    ->addDefinitions(__DIR__ . '/../app/container.php')
    ->useAttributes(true)
;

$app = AppFactory::createFromContainer($containerBuilder->build());

//todo: Только для dev.
$app->addErrorMiddleware(true, false, false);

//----------------------------------------------------------------
// main routes
//----------------------------------------------------------------
$app->get('/', [MainController::class, 'homepage']);

//----------------------------------------------------------------
// todo: Только для dev.
// sandbox routes
//----------------------------------------------------------------
$app->get('/sandbox', [MainSandboxController::class, 'main']);

//----------------------------------------------------------------
// todo: Только для dev.
// test routes
//----------------------------------------------------------------
//todo: В phpunit.
$app->get('/test/dump', [MainTestController::class, 'dump']);
$app->get('/test/env', [MainTestController::class, 'env']);
$app->get('/test/project_path', [MainTestController::class, 'projectPath']);
$app->get('/test/container/inject', [MainTestController::class, 'inject']);
$app->get('/test/pdo', [MainTestController::class, 'inject']);
$app->get('/test/render', [MainTestController::class, 'render']);

$app->run();