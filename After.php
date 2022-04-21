<?php

class After
{
    public function handleRequest(Request $request, Response $response) {
        $response->append(' - Goodbye');
        return $response;
    }
}