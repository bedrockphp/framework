<?php

namespace Bedrock\Testing;

use App\Router;
use PHPUnit\Framework\TestCase as PHPUnitTestCase;

class TestCase extends PHPUnitTestCase {
    protected $uri;
    protected $router;
    protected $method;

    public function __construct()
    {
        $this->router = new Router();
    }

    public function get($uri)
    {
        $this->method = "GET";
        $this->uri = $uri;
        return $this;
    }

    public function post($uri)
    {
        $this->method = "POST";
        $this->uri = $uri;
        return $this;
    }

    public function put($uri)
    {
        $this->method = "PUT";
        $this->uri = $uri;
        return $this;
    }

    public function patch($uri)
    {
        $this->method = "PATCH";
        $this->uri = $uri;
        return $this;
    }

    public function delete($uri)
    {
        $this->method = "DELETE";
        $this->uri = $uri;
        return $this;
    }

    public function executeRequest()
    {
        return $this->router->serveRoute([$this->method, $this->uri]);
    }

    public function see($content)
    {
        $response = $this->router->serveRoute([$this->method, $this->uri]);

        $responseContent = $response->getContent();
        $this->assertTrue(strpos($responseContent, $content) !== false);
    }
}
