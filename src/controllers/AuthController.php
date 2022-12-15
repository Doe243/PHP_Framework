<?php

namespace App\controllers;

use App\Request;
use App\Response;
use App\Controller;
use App\Application;
use App\Models\User;
use App\models\LoginForm;
use App\middlewares\AuthMiddleware;

class AuthController extends Controller
{
    public function __construct() {
        
        $this->registerMiddleware(new AuthMiddleware(['profile']));
    }
    
    /**
     * This function help us to log in our user
     */

    public function login(Request $request, Response $response)
    {
        $loginForm = new LoginForm();

        if ($request->isPost()) {
            
            $loginForm->loadData($request->getBody());

            if ($loginForm->validate() && $loginForm->Login()) {
                
                $response->redirect('/');
                
                return;

            }

        }

        $this->setLayout('auth');

        return $this->render('login', [

            'model' => $loginForm
            
        ]);
    }


    /**
     * This function help us to display user profile
     */

    public function profile()
    {
        return $this->render('profile');
    }

    /**
     * This function helps us to register a user
     *
     * @param Request $request
     */

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

    /**
     * This function help user who are connected to logout
     *
     * @param Request $request
     * @param Response $response
     * @return void
     */
    
    public function logout(Request $request, Response $response)
    {
        Application::$app->logout();

        $response->redirect("/");
    }
}
