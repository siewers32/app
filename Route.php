<?php

class Route
{
    private array $middleware;
    private string $route;
    private Closure $closure;

    public function __construct($route, $closure) {
        $this->route = $route;
        $this->closure = $closure;
        $this->middleware = [];
    }

    public function add($mw) {
        $this->middleware[] = $mw;
    }

    public function getMiddlware() {
        return $this->middleware;
    }

    public function getRoute() {
        return $this->route;
    }

    public function getClosure() {
        return $this->closure;
    }
}