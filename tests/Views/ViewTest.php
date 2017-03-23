<?php

use Bedrock\Routing\Router;
use Bedrock\Testing\TestCase;
use Bedrock\Testing\Stubs\RouteDoesntExistStub;
use Bedrock\Testing\Stubs\MethodDoesntExistStub;

class ViewTest extends TestCase
{
    /** @test */
    function can_use_a_view()
    {
        $this->router = new Router;
        $this->router->get('/', function () {
            return view('test');
        });

        $this->get('/')
            ->see('test response');
    }
}
