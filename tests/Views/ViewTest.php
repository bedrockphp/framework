<?php

use Bedrock\Views\View;
use Bedrock\Routing\Router;
use Bedrock\Testing\TestCase;
use Bedrock\Container\Container;
use Bedrock\Testing\Stubs\RouteDoesntExistStub;
use Bedrock\Testing\Stubs\MethodDoesntExistStub;

class ViewTest extends TestCase
{
    /** @test */
    function can_use_a_view()
    {
        $this->router = new Router;
        $this->router->get('/', function () {
            return view()->render('test');
        });

        $container = Container::getInstance();
        $container->share('view', new View(__DIR__.'/../../src/Testing/views'));

        $this->get('/')
            ->see('test response');
    }
}
