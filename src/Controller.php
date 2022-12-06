<?php

namespace App;

class Controller 
{
    public string $layout = 'base';
    
    public function setLayout($layout) 
    {
        $this->layout = $layout;
    }

    public function render($view, $params = []) 
    {
        return Application::$app->router->renderView($view, $params);
    }
}