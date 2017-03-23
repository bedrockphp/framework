<?php

namespace Bedrock\Services;

use Bedrock\Views\View;

class DefaultService
{
    public function init(&$container)
    {
        $container->share('view', new View(\config('view_path')));
    }
}
