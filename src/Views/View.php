<?php

namespace Bedrock\Views;

use Bedrock\Exceptions\Views\NullViewException;

class View
{
    protected $viewPath;

    public function __construct($viewPath = '.')
    {
        $this->viewPath = $viewPath;
    }

    public function __toString()
    {
        return $this->render();
    }

    public function render($viewFile = null)
    {
        if (is_null($viewFile)) {
            throw new NullViewException;
        }

        $viewStatus = file_get_contents(__DIR__);
        return __DIR__.'/'.$this->viewPath;
    }
}
