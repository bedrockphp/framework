<?php

namespace Bedrock\Routing;

use Bedrock\Exceptions\Routing\MethodNotAllowedException;
use Bedrock\Exceptions\Routing\RouteAlreadyExistsException;
use Bedrock\Exceptions\Routing\RouteNotFoundException;
use Bedrock\Response\Response;

class Router
{
    protected $routes = [];
    protected $methods = [];

    private function addRoute($verb, $uri, $callback)
    {
        $this->routes[] = [$verb, $uri, $callback];
        if (array_key_exists($verb, $this->methods) && array_key_exists($uri, $this->methods[$verb])) {
            throw new RouteAlreadyExistsException;
        }
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
        print_r($this->routes);
    }

    public function serveRoute($requestDetails)
    {
        if (!array_key_exists($requestDetails[0], $this->methods)) {
            throw new MethodNotAllowedException;
        }

        if (in_array($requestDetails[1], array_keys($this->methods[$requestDetails[0]]))) {
            return new Response($this->methods[$requestDetails[0]][$requestDetails[1]]);
        }
        throw new RouteNotFoundException;
    }
}
