<?php

namespace App;

class Application 
{

    public static string $ROOT_DIR;

    public Router $router;

    public Request $request;
    
    public Response $response;

    public Database $db;

    public static Application $app;

    public Controller $controller;

    public function __construct($roothPath, array $config)
    {
        
        self::$ROOT_DIR = $roothPath;
        
        self::$app = $this;

        $this->request = new Request();
        
        $this->response = new Response();
        
        $this->router = new Router($this->request, $this->response);

        $this->db = new Database($config['db']);

    }

    public function run() {

        echo $this->router->resolve();
    } 


    /**
     * Get the value of controller
     */ 
    public function getController(): Controller
    {
        return $this->controller;
    }

    /**
     * Set the value of controller
     *
     * @return  self
     */ 
    public function setController(Controller $controller)
    {
        $this->controller = $controller;

        return $this;
    }
}