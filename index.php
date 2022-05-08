<?php

include('App.php');
include('AppFactory.php');
include('Response.php');
include('Request.php');
include('Route.php');


$app = AppFactory::createApp();

$mw =  function(Request $request, Response $response) {
    $content = (string) $response->get();
    $response->set("BEFORE - ".$content);
    return $response;
};

$mw2 = function(Request $request, Response $response) {
    $response->append("- AFTER");
    return $response;
};

$app->add($mw2);

$app->get('/', function(Request $request, Response $response) {
    $response->append("Dit is de route");
})->add($mw);

$app->get('/hallo', function(Request $request, Response $response) {
    $response->append("Dit is een andere route");
})->add($mw);

$app->run();

