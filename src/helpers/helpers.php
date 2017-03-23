<?php

use Bedrock\Container\Container;

function view()
{
    $container = Container::getInstance();
    return $container->get('view');
}

function config($value)
{
    $container = Container::getInstance();
    return $container->get('config')->config->$value ?: null;
    // return $container->has('config') ? $container->get('config')->$value : null;
}
