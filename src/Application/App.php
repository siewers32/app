<?php
namespace App\Application;

use App\Http\Request;
use App\Http\Response;


class App
{
    private Request $request;
    private Response $response;
    private Container $c;
    public array $middleware;
    //public Route $route;
    public array $routes;


    public function __construct() {
        $this->request = new Request();
        $this->response = new Response();
        $this->middleware = [];
        $this->routes = [];
    }

    public function createContainer() {
        $this->c = new Container();
        return $this->c;
    }

    /**
     * Add middleware to the application
     *
     * @param  $func
     * @void
     */
    public function add($func) {
        $this->middleware[] = $func;
    }
    /**
     * Create and return new route object from uri and closure
     *
     * @param string $uri
     * @param  $closure
     * @return Route
     */
    public function get(string $uri, $closure, $action="") {
        $r = null;
        if(is_callable($closure)) {
            $r = new Route($uri, $closure, $args=[]);
        } else {
            if($obj = new $closure($this->c)) {
                $r = new Route($uri, function () {});
                $r->setClosure(function () use ($obj, $action, $r) {
                    $obj->$action($this->request, $this->response, $r->getArgs());
                });
            }
        }
        ($r instanceof Route) ? $this->routes[] = $r : null ;
        return $r;
    }

    /**
     * Run the application
     * @void
     */
    public function run() {
        foreach($this->routes as $r) {
            if ($r->getUri() == $r->getServerUri()) {
                $this->route = $r;
            }
        };

        if(isset($this->route)) {
            //Route-middleware
            foreach($this->route->getMiddleware() as $rmw) {
                call_user_func_array($rmw, [$this->request, $this->response, $this->c]);
            }
            //App-middleware
            foreach($this->middleware as $mw) {
                call_user_func_array($mw, [$this->request, $this->response, $this->c]);
            }
            call_user_func_array($this->route->getClosure(), [$this->request, $this->response, $this->route->getArgs()]);
            echo $this->response->get();
        } else {
            echo "Route undefined!";
        }
    }
}