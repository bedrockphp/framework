<?php

use Bedrock\Testing\TestCase;

class RouterTest extends TestCase
{
    /** @test */
    function an_exception_is_thrown_if_the_method_doesnt_exist()
    {
        $this->router = new class extends Bedrock\Routing\Router {
            public function __construct()
            {
                $this->put('/test-route', function () {
                    return 'test response';
                });
            }
        };

        try {
            $this->post('testing');
            $this->executeRequest();
        } catch (Bedrock\Exceptions\Routing\MethodNotAllowedException $e) {
            return;
        }

        $this->fail("Failed catching expected Bedrock\Exceptions\Routing\MethodNotAllowedException");
    }

    /** @test */
    function an_exception_is_thrown_if_the_same_route_is_added_twice()
    {
        $this->router = new class extends Bedrock\Routing\Router {};
        try {
            $this->router->put('/test-route', function () {
                return 'test response';
            });
            $this->router->put('/test-route', function () {
                return 'somethingelse';
            });
            $this->router->dumpRoutes();
        } catch (Bedrock\Exceptions\Routing\RouteAlreadyExistsException $e) {
            return;
        }

        $this->fail("Failed catching expected Bedrock\Exceptions\Routing\RouteAlreadyExistsException");
    }

    /** @test */
    function an_exception_is_thrown_if_the_route_doesnt_exist()
    {
        $this->router = new class extends Bedrock\Routing\Router {
            public function __construct () {
                $this->get('/', function () {
                    return 'something';
                });
            }
        };
        try {
            $this->get('/')
                ->see('response');
        }  catch (Bedrock\Exceptions\Routing\RouteNotFoundException $e) {
            return;
        }
        
        $this->fail("Failed catching expected Bedrock\Exceptions\Routing\RouteNotFoundException");
    }

    /** @test */
    function can_perform_a_get_request()
    {
        $this->router = new class extends Bedrock\Routing\Router {
            public function __construct()
            {
                $this->get('/', function () {
                    return 'test response';
                });
            }
        };

        $this->get('/')
            ->see('response');
    }

    /** @test */
    function can_perform_a_post_request()
    {
        $this->router = new class extends Bedrock\Routing\Router {
            public function __construct()
            {
                $this->post('/', function () {
                    return 'test response';
                });
            }
        };

        $this->post('/')
            ->see('test response');
    }

    /** @test */
    function can_perform_a_put_request()
    {
        $this->router = new class extends Bedrock\Routing\Router {
            public function __construct()
            {
                $this->put('/test-route', function () {
                    return 'test response';
                });
            }
        };

        $this->put('/test-route')
            ->see('test response');
    }

    /** @test */
    function can_perform_a_patch_request()
    {
        $this->router = new class extends Bedrock\Routing\Router {
            public function __construct()
            {
                $this->patch('/test-route', function () {
                    return 'test response';
                });
            }
        };

        $this->patch('/test-route')
            ->see('test response');
    }

    /** @test */
    function can_perform_a_delete_request()
    {
        $this->router = new class extends Bedrock\Routing\Router {
            public function __construct()
            {
                $this->delete('/route', function () {
                    return 'test response';
                });
            }
        };

        $this->delete('/route')
            ->see('test response');
    }
}
