<?php

namespace App\Views;

use App\Application;

abstract class ViewAbstract
{
    protected $params;

    public function __construct(...$params)
    {
        $this->params = $params;
    }

    public function getPath()
    {
        return Application::getInstance()->getPath(
            $this->path
        );
    }

    public function __toString()
    {
        extract($this->params);
        
        ob_start();
        require $this->getPath();
        return ob_get_clean();
    }
}
