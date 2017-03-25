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
}

if (!function_exists('dd')) {
    function dd($value)
    {
        var_dump($value);
        die();
    }
}
