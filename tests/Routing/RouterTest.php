<?php

use PHPUnit\Framework\TestCase;

    class RouterTest extends TestCase
{
    /** @test */
    function can_use_router()
    {
        $router = new Bedrock\Routing\Router();
        $this->assertNotNull($router);
    }
}
