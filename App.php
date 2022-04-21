<?php

class App
{
    private Request $request;
    private Response $response;
    public array $middleware;
    public Route $route;
    public array $routes;


    public function __construct() {
        $this->request = new Request();
        $this->response = new Response();
        $this->middleware = [];
        $this->routes = [];
    }

    public function add($func) {
        $this->middleware[] = $func;
    }

    public function get($route, $function) {
        $r = new Route($route, $function);
        $this->routes[] = $r;
        return $r;
    }

    public function run() {
        foreach($this->routes as $r) {
            if ($r->getRoute() == $_SERVER['REQUEST_URI']) {
                $this->route = $r;
            }
        };

        if(isset($this->route)) {
            call_user_func_array($this->route->getClosure(), [$this->request, $this->response]);
            foreach($this->route->getMiddlware() as $rmw) {
                call_user_func_array($rmw, [$this->request, $this->response]);
            }
            foreach($this->middleware as $mw) {
                call_user_func_array($mw, [$this->request, $this->response]);
            }
            echo $this->response->get();
        } else {
            echo "Route undefined!";
        }
    }
}