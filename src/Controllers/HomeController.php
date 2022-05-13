<?php
namespace App\Controllers;
use App\Http\Request;
use App\Http\Response;


class HomeController
{
    public function __construct()
    {

    }

    public function index(Request $request, Response $response, $args) {
        extract($args);
        $response->append("Hello from HomeController - ".$id." en ".$bla);
    }

    public function hello(Request $request, Response $response, $args) {
        extract($args);
        $response->append("Hello from hello-action in HomeController - ".$id." en ".$bla);
    }
}