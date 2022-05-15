<?php
session_start();

require __DIR__ . '/../vendor/autoload.php';

use App\Application\App;
use App\Application\Container;
use App\Application\Database;
use App\Http\Request;
use App\Http\Response;
use App\Controllers\HomeController;
use App\Controllers\MovieController;
use App\View\View;
use App\Middleware\Auth;

// Create app en service-container
$app = new App();
$c = $app->createContainer();

// External library for storing environment variables a .env file, accessible through array $_ENV
$dotenv = Dotenv\Dotenv::createImmutable('./');
$dotenv->load();

// Add database-connection (PDO) to service-container.
$db = new Database();
$c->add('db', $db->getConnection());

// Add view-object to service-container
$view = new View();
$c->add('view', $view);

$auth = new Auth($c);
$c->add('auth', $auth);

// Middleware examples
$mw =  function(Request $request, Response $response) {
    $content = (string) $response->get();
    $response->set("BEFORE - ".$content);
    return $response;
};


$mw2 = function(Request $request, Response $response) {
    $response->append("- AFTER");
    return $response;
};

/*
 * Middleware voor alle routes
 * $app->add($mw2);
*/


$app->get('/hallo', function(Request $request, Response $response) {
    $response->append("Dit is een andere route");
})->add($mw);

$app->get('/', HomeController::class, "index");
$app->get('/login', HomeController::class, "login");
$app->get('/logout', HomeController::class, "logout");
$app->get('/login/check', HomeController::class, "index")->add($c->get('auth'));
$app->get('/movies', MovieController::class, "index");
$app->get('/movie/detail/{id}', MovieController::class, "detail");
$app->get('/movie/add', MovieController::class, "add")->add($c->get('auth'));;
$app->get('/movie/store', MovieController::class, "store");
$app->get('/movie/delete/{id}', MovieController::class, "delete");

$app->run();

