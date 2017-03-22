<?php

namespace Bedrock\Testing\Stubs;

use Bedrock\Routing\Router;

class RouteDoesntExistStub extends Router
{
    public function __construct()
    {
        $this->get('/', function () {
            return 'something';
        });
    }
}
