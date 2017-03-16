<?php

namespace Bedrock\Routing;

use Bedrock\Exceptions\Routing\RouteNotFoundException;

class Router
{
    protected $routes;
    protected $methods;

    public function __construct()
    {
        $this->methods = [];
        $this->routes = [];
    }

    private function addRoute($verb, $uri, $callback)
    {
        $this->routes[] = [$verb, $uri, $callback];
        $this->methods[$verb][$uri] = $callback;
    }

    public function get($uri, $callback)
    {
        $this->addRoute("GET", $uri, $callback);
    }

    public function post($uri, $callback)
    {
        $this->addRoute("POST", $uri, $callback);
    }

    public function put($uri, $callback)
    {
        $this->addRoute("PUT", $uri, $callback);
    }

    public function patch($uri, $callback)
    {
        $this->addRoute("PATCH", $uri, $callback);
    }

    public function delete($uri, $callback)
    {
        $this->addRoute("DELETE", $uri, $callback);
    }

    public function dumpRoutes()
    {
        print_r($this->methods["GET"]);
    }

    public function serveRoute($requestDetails)
    {
        if (in_array($requestDetails[1], array_keys($this->methods[$requestDetails[0]]))) {
            $this->methods[$requestDetails[0]][$requestDetails[1]]();
            return;
        }

        throw new RouteNotFoundException;
    }
}
