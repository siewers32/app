<?php
require __DIR__ . '/../vendor/autoload.php';

use App\Application\App;
use App\Application\Container;
use App\Application\Database;
use App\Http\Request;
use App\Http\Response;
use App\Middleware\Before;
use App\Controllers\HomeController;
use App\Controllers\MovieController;
use App\View\View;

$app = new App();
$c = $app->createContainer();
//$c = new Container();

$dotenv = Dotenv\Dotenv::createImmutable('./');
$dotenv->load();

$db = new Database();
$c->add('db', $db->getConnection());

$view = new View();
$c->add('view', $view);

// Middleware
$mw =  function(Request $request, Response $response) {
    $content = (string) $response->get();
    $response->set("BEFORE - ".$content);
    return $response;
};

$mw3 =  function(Request $request, Response $response) {
    $content = (string) $response->get();
    $response->set("Nog een keer before - ".$content);
    return $response;
};

$mw2 = function(Request $request, Response $response) {
    $response->append("- AFTER");
    return $response;
};

$app->add($mw3);


$app->get('/hallo', function(Request $request, Response $response) {
    $response->append("Dit is een andere route");
})->add($mw);

$app->get('/', HomeController::class, "index");
$app->get('/movies', MovieController::class, "index")->add($mw2);
$app->get('/movie/detail/{id}', MovieController::class, "detail")->add($mw2);

$app->run();

