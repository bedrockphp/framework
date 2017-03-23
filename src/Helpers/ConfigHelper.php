<?php

namespace Bedrock\Helpers;

use Bedrock\Container\Container;
use Bedrock\Services\DefaultService;

class ConfigHelper
{
    public $config;

    public function __construct($configPath = null)
    {
        $config = isset($configPath) ? $configPath : 'config.php';

        $this->config = include($config);
    }

    public function bootServices()
    {
        $this->config->services = array_merge($this->config->services, [
            DefaultService::class
        ]);

        $container = Container::getInstance();
        foreach ($this->config->services as $service) {
            (new $service)->init($container);
        }
    }
}
