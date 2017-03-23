<?php

namespace Bedrock\Container;

use League\Container\Container as LeagueContainer;

class Container extends LeagueContainer
{
    protected static $instance;

    public static function getInstance()
    {
        if (is_null(static::$instance)) {
            static::$instance = new static;
        }

        return static::$instance;
    }

    public function dumpShared()
    {
        print_r($this->shared);
    }
}
