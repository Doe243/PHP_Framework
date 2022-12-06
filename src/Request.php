<?php

namespace App;

class Request 
{

    public function getPath() {
        
        //On récupère le path s'il existe sinon on retourne '/'

        $path = $_SERVER['REQUEST_URI'] ?? '/';

        //On vérifie s'il y a des paramètres (?) ou pas dans l'url

        $position = strpos($path, '?');


        if ($position === false) {
            
            return $path;
        }

        //On retourne le path en partant de 0 jusqu'au point d'intérrogation

        return substr($path, 0, $position);

    }

    /**
     * Cette fonction nous retourne la méthode exemple: POSt ou GET
     *
     * @return void
     */
    public function method() 
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }


    public function isGet() 
    {
        return $this->method() === 'get';
    }


    public function isPost() 
    {
        return $this->method() === 'post';
    }

    public function getBody()
    {
        $body = [];

        if ($this->method() === 'get') {
            
            foreach ($_GET as $key => $value) {
                
                $body[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }

        if ($this->method() === 'post') {
            
            foreach ($_POST as $key => $value) {
                
                $body[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }

        return $body;
    }
}
