<?php
//todo: Только для dev.
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

use App\Controllers\MainController;
use App\Controllers\TestControllers\MainTestController;
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

$containerBuilder->addDefinitions([
    PDO::class => function (ContainerInterface $container) {
        return new \PDO(
            sprintf('mysql:host=%s;dbname=%s', $_ENV['APP_DB_HOST'] ?? '', $_ENV['APP_DB_NAME'] ?? ''),
            $_ENV['APP_DB_USER'] ?? '',
            $_ENV['APP_DB_PASSWORD'] ?? '',
            [
                \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
                \PDO::ATTR_STRINGIFY_FETCHES => false,
            ]
        );
    },
]);

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
$app->get('/test/container', MainTestController::class . ':testContainer');
$app->get('/test/pdo', MainTestController::class . ':testPdo');

$app->run();