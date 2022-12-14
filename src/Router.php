<?php


namespace App;

use App\Controller;

class Router 
{
    public Request $request;

    public Response $response;

    protected array $routes = [];

    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;

        $this->response = $response;
    }

    public function get($path, $callback) {

        $this->routes['get'][$path] = $callback;
        
    }

    public function post($path, $callback) {

        $this->routes['post'][$path] = $callback;
        
    }

    public function resolve() 
    {
        $path = $this->request->getPath();

        $method = $this->request->method();

        $callback = $this->routes[$method][$path] ?? false;

        if ($callback === false) {

            $this->response->setStatusCode(404);

            return $this->renderViewException('404_not_found');
            
        }

        if (is_string($callback)) {
            
            return $this->renderView($callback);
        }

        if (is_array($callback)) {

            /**
             * @var Controller $controller
             */

            $controller = new $callback[0]();
            
            Application::$app->controller = $controller ;

            $controller->action = $callback[1];

            $callback[0] = $controller;

            foreach ($controller->getMiddlewares() as $middleware) {
                
                $middleware->execute();
            }
  
        }

        return call_user_func($callback, $this->request, $this->response);
        
    }
    /**
     * Cette fonction renvoit la navbar et le contenu de la page
     */

    public function renderView($view, $params = []) 
    {
        $layoutContent = $this->layoutContent();

        $viewContent   = $this->renderOnlyView($view, $params);

        return str_replace('{{content}}', $viewContent, $layoutContent);
    }
    
    /**
     * Cette fonction nous renvoit le message "Not found" lorsque le contenu n'existe pas
     */

    public function renderViewException($viewContent) 
    {
        $layoutContent = $this->layoutContent();

        $layoutContentNotFound = $this->layoutContentNotfound($viewContent);

        return str_replace('{{content}}',$layoutContentNotFound, $layoutContent);

    }

    /**
     * Cette fonction nous renvoit le contenu du template de base.php
     */

    protected function layoutContent() 
    {

        $layout = Application::$app->layout;

        if (Application::$app->controller) {
            
            $layout = Application::$app->controller->layout;

        }

        ob_start();

        include_once Application::$ROOT_DIR."/views/layouts/$layout.php";

        return ob_get_clean();
    }
    
    /**
     * Cette fonction nous renvoit le contenu du template de "not found"
     */

    protected function layoutContentNotfound($viewContent) 
    {
        ob_start();

        include_once Application::$ROOT_DIR."/views/layouts/$viewContent.php";

        return ob_get_clean();
    }
    
    /**
     * Cette fonction nous renvoit le contenu d'une vue
     */

    protected function renderOnlyView($view, $params) 
    {

        foreach ($params as $key => $value) {
            /**
             * On v??rifit si $name = $value
             * $key = "name";
             * $$key c'est la m??me chose que $name
             * Exemple $key = "name"; 
             *         $$key = "Black SOSA" 
             *         revient ?? ??crire 
             *         $name = "Black SOSA" 
             */
            $$key = $value;
        }

        ob_start();

        include_once Application::$ROOT_DIR."/views/$view.php";

        return ob_get_clean();
    }
}
