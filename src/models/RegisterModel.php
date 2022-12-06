<?php

namespace App\models;

use App\Model;



class RegisterModel extends Model
{
    public $firstName = '';

    public $lastName = '';
    
    public $email = '';
    
    public $password = '';
    
    public $confirmPassword = '';

    public function register()
    {
        return "Creating new user";
    }

    public function rules(): array
    {
        return [

            'firstName' => [self::RULE_REQUIRED],
            
            'lastName' => [self::RULE_REQUIRED],
            
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL],
            
            'password' => [
                
                self::RULE_REQUIRED, [

                    self::RULE_MIN,

                    'min' => 8
                ],
                [
                    self::RULE_MAX,

                    'max' => 24
                ]

            ],
            
            'confirmPassword' => [
                
                self::RULE_REQUIRED, [
                    
                    self::RULE_MATCH, 
                    
                    'match' => 'password'
                    
                    ]
                ],
        ];
    }

}