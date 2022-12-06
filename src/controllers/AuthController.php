<?php

namespace App\controllers;

use App\Request;
use App\Controller;
use App\Models\RegisterModel;

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

        $registerModel = new RegisterModel();

        if ($request->isPost()) {

            
            $registerModel->loadData($request->getBody());
            

            if ($registerModel->validate() && $registerModel->register()) {
                
                return 'Success';
            }
            
            return $this->render('register', [
                
                'model' => $registerModel

            ]);
        }

        $this->setLayout('auth');

        return $this->render('register', [
                
            'model' => $registerModel

        ]);
    }
}
