<?php

namespace App;

use App\middlewares\BaseMiddleware;

class Controller 
{
    public string $layout = 'base';

    public string $action = '';

    /**
     * This variable it's our middleware array
     *
     * @var BaseMiddleware[]
     */
    
    protected array $middlewares = [];
    
    public function setLayout($layout) 
    {
        $this->layout = $layout;
    }

    public function render($view, $params = []) 
    {
        return Application::$app->router->renderView($view, $params);
    }

    public function registerMiddleware(BaseMiddleware $middleware)
    {
        $this->middlewares[] = $middleware;
    }

    /**
     * Get the value of middlewares
     */ 
    
    public function getMiddlewares(): array
    {
        return $this->middlewares;
    }
}
