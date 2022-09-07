<?php
namespace App\Middleware;
use App\Http\Request;
use App\Http\Response;

class After
{
    public function handleRequest(Request $request, Response $response) {
        $response->append(' - Goodbye');
        return $response;
    }
}