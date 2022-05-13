<?php
require __DIR__ . '/../vendor/autoload.php';

use App\Application\App;
use App\Http\Request;
use App\Http\Response;
use App\Middleware\Before;
use App\Controllers\HomeController;

$app = new App();

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

$app->get('/', function(Request $request, Response $response) {
    $response->append("Dit is de route");
})->add($mw)->add($mw3)->add(new Before);

$app->get('/hallo', function(Request $request, Response $response) {
    $response->append("Dit is een andere route");
});

$app->get('/home/hello/{bla}/{id}', HomeController::class, "index")->add($mw2);

$app->run();

