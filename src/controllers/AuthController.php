<?php

namespace App\controllers;

use App\Application;
use App\Request;
use App\Controller;
use App\Models\User;

class AuthController extends Controller
{

    public function login()
    {
        $this->setLayout('auth');

        return $this->render('login');
    }

    public function register(Request $request)
    {   
        $errors = [];

        $user = new User();

        if ($request->isPost()) {

            
            $user->loadData($request->getBody());
            

            if ($user->validate() && $user->save()) {
                
                Application::$app->session->setFlash('success', 'Thanks for registering');
                
                Application::$app->response->redirect("/");

                exit;
            }
            
            return $this->render('register', [
                
                'model' => $user

            ]);
        }

        $this->setLayout('auth');

        return $this->render('register', [
                
            'model' => $user

        ]);
    }
}
