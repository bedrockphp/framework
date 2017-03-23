<?php

namespace Bedrock\Views;

use Jenssegers\Blade\Blade;
use Bedrock\Exceptions\Views\NullViewException;

class View
{
    protected $viewPath;
    protected $compiledPath;

    public function __construct($viewPath, $compiledPath = null)
    {
        $this->viewPath = $viewPath;
        $this->compiledPath = isset($compiledPath) ? $compiledPath : $viewPath . '../compiled';
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

        $blade = new Blade($this->viewPath, $this->compiledPath);

        try {
            return $blade->make($viewFile);
        } catch (\InvalidArgumentException $e) {
            $message = $e->getMessage();
            $message .= "\n\nLooking in [".$this->viewPath."]";
            throw new \InvalidArgumentException($message);
        }
    }
}
