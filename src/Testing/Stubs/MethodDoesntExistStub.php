<?php

namespace Bedrock\Testing\Stubs;

use Bedrock\Routing\Router;

class MethodDoesntExistStub extends Router
{
    public function __construct()
    {
        $this->put('/test-route', function () {
            return 'test response';
        });
    }
}
