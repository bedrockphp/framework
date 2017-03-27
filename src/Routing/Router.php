<?php

namespace Bedrock\Routing;

use Bedrock\Response\Response;
use Bedrock\Exceptions\Routing\RouteNotFoundException;
use Bedrock\Exceptions\Routing\UnexpectedRouteException;
use Bedrock\Exceptions\Routing\MethodNotAllowedException;
use Bedrock\Exceptions\Routing\RouteAlreadyExistsException;

class Router
{
    protected $routes = [];
    protected $methods = [];
    protected $uris = [];

    private function addRoute($verb, $uri, $callback)
    {
        if (array_key_exists($verb, $this->methods) && array_key_exists($uri, $this->methods[$verb])) {
            throw new RouteAlreadyExistsException;
        }

        $uri = str_replace("*", "\*", $uri);

        $this->routes[] = [$verb, $uri, $callback];
        $this->methods[$verb][$uri] = $callback;
        $this->uris[$uri][] = $verb;
    }

    public function get($uri, $callback)
    {
        $this->addRoute("GET", $uri, $callback);
        $this->addRoute("HEAD", $uri, function () {
            // do nothing
        });
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
        dd($this->methods);
    }

    public function serveRoute($method, $uri)
    {
        if (!array_key_exists($method, $this->methods)) {
            throw new MethodNotAllowedException;
        }

        if (strpos($uri, '?') !== false) {
            $uri = substr($uri, 0, strpos($uri, '?'));
        }

        if (array_key_exists("\*", $this->methods[$method])) {
            $response = (new Response($this->methods[$method]["\*"]))->getContent();
        }

        foreach ($this->methods[$method] as $route => $callback) {
            $newRoute = preg_replace("/\/{\?.+?}/", "/?([^/]+)?", $route);
            $newRoute = preg_replace("/{.+?}/", "([^/]+)", $newRoute);
            $escapedRoute = str_replace('/', '\/', $newRoute);

            if (preg_match("/^$escapedRoute$/", $uri, $segments)) {
                $args = array_slice($segments, 1);
                return new Response($callback, $args, $response);
            }
        }

        throw new RouteNotFoundException;
    }
}
