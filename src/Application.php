<?php

namespace App;

class Application 
{

    public static string $ROOT_DIR;

    public string $userClass;

    public Router $router;

    public Request $request;
    
    public Response $response;

    public Session $session;

    public ?DbModel $user;



    public Database $db;

    public static Application $app;

    public Controller $controller;


    public function __construct($roothPath, array $config)
    {
        
        $this->userClass = $config['userClass'];

        self::$ROOT_DIR = $roothPath;
        
        self::$app = $this;

        $this->request = new Request();
        
        $this->response = new Response();

        $this->session = new Session();
        
        $this->router = new Router($this->request, $this->response);

        $this->db = new Database($config['db']);

        $primaryValue = $this->session->get('user');

        if ($primaryValue) {
            
            $primaryKey = $this->userClass::primaryKey();

            $this->user = $this->userClass::findOne([$primaryKey => $primaryValue]);
        } else {

            $this->user = null;
        }

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
    
    public function login($user)
    {
        $this->user = $user;

        $primaryKey = $user->primaryKey();

        $primaryValue = $user->{$primaryKey};

        $this->session->set('user', $primaryValue);

        return true;
    }
    
    public function logout()
    {
        $this->user = null;

        $this->session->remove('user');
    }

    public static function isGuest()
    {
        return !self::$app->user;
    }

}
