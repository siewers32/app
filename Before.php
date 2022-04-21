<?php

class Before
{
    public function handleRequest(Request $request, Response $response) {
        $response->set("Hello hello - ".$response->get());
        return $response;
    }
}