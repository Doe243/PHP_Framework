<?php

namespace App\form;

use App\Model;

class Form 
{
    public static function start($action, $method)
    {
        echo sprintf('<form action="%s" method="%s">', $action, $method);
        
        return new Form(); 
    }   
    
    public static function end()
    {
        echo '</form>';
    }
    
    public function field(Model $model, $attribute) 
    {
        return new Field($model, $attribute);
    }
}