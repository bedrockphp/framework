<?php

namespace Bedrock\Response;

class Response
{
    protected $route;

    public function __construct($route)
    {
        $this->route = $route;
    }

    public function __toString()
    {
        return $this->getContent();
    }

    public function getContent()
    {
        $response = ($this->route)();
        return $response;
    }
}
