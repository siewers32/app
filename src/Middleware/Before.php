<?php
namespace App\Middleware;
use App\Http\Request;
use App\Http\Response;

class Before
{
    public function __invoke(Request $request, Response $response) {
        $response->set("Hello hello - ".$response->get());
        return $response;
    }
}