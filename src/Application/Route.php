<?php
namespace App\Application;
use App\Http\Request;


class Route
{
    private array $middleware;
    private string $uri;
    private array $args;
    private \Closure $closure;

    public function __construct($uri, $closure) {
        $this->uri = $uri;
        $this->closure = $closure;
        $this->middleware = [];
        $this->args = [];
        $this->getUri();
    }

    /**
     * Add middleware to the route
     * @param  $mw
     * @return $this
     */
    public function add($mw): Route {
        $this->middleware[] = $mw;
        return $this;
    }

    /**
     * Get all middleware closures
     * @return array
     */
    public function getMiddleware() {
        return $this->middleware;
    }

    /**
     * get Uri from route
     * @return string
     */
    public function getUri() {
        $uri_parts = explode('/', $this->uri);
        $server_uri_parts = explode('/', $_SERVER['REQUEST_URI']);
        !isset($uri_parts[1]) ? $uri_parts[1] = "index" : null ;
        !isset($uri_parts[2]) ? $uri_parts[2] = "index" : null ;
        $stripped_uri = "/".$uri_parts[1]."/".$uri_parts[2];
        for($i = 2; $i < count($uri_parts); $i++) {
            $part = trim(trim($uri_parts[$i], "{"), "}");
            isset($server_uri_parts[$i]) ? $this->addArgs($part,  $server_uri_parts[$i]) : null ;
        }
        return $stripped_uri;
    }

    public function getServerUri() {
        $server_uri_parts = explode('/', $_SERVER['REQUEST_URI']);
        !isset($server_uri_parts[1]) ? $server_uri_parts[1] = "index" : null ;
        !isset($server_uri_parts[2]) ? $server_uri_parts[2] = "index" : null ;
        $stripped_server_uri = "/".$server_uri_parts[1]."/".$server_uri_parts[2];
        return $stripped_server_uri;
    }

    public function addArgs($key, $value) {
        $this->args[$key] = $value;
    }

    public function getArgs() {
        return $this->args;
    }

    /**
     * get Closure from route
     * @return \Closure
     */
    public function getClosure() {
        return $this->closure;
    }

    public function setClosure($closure) {
        $this->closure = $closure;
    }

}