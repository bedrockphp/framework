<?php

use Bedrock\Container\Container;
use Bedrock\Helpers\ConfigHelper;

require __DIR__.'/vendor/autoload.php';

$container = Container::getInstance();

$container->share('config', new ConfigHelper);
// include_once __DIR__.'/src/helpers/helpers.php';
