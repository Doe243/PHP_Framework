<?php

namespace App\controllers;

use App\Controller;
use App\Request;

class SiteController extends Controller
{

    public function home()
    {
        $params = [

            'controller' => 'BASE FRAMEWORK 👋'
        ];

        return $this->render('home', $params);
    }

    public function contact()
    {
        return $this->render('contact');
    }
    
    public function handleContact(Request $request)
    {
        $body = $request->getBody();
        
        return 'Handling submitted data';
    }

}