<?php

namespace Bedrock\Response;

class Response
{
    protected $route;
    protected $args;

    public function __construct($route, $args)
    {
        $this->route = $route;
        $this->args = $args;
    }

    public function __toString()
    {
        return $this->getContent();
    }

    public function getContent()
    {
        $response = ($this->route)(...$this->args);
        return $response;
    }
}
