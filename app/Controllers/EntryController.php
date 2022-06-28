<?php

namespace App\Controllers;

use App\views\Employee\Login\LoginCheck;
use App\Controllers\AuthController as authController;
use \Slim\Views\Twig as view;

class EntryController
{
    protected $view;

    public function __construct($view)
    {
        $this->view = $view;

    }


    public static function ScopeNotAllowed($response)
    {
        $responseMessage = json_encode(["success" => true, "response" => "scope not allowed", "status" => 401]);
        $response->getBody()->write($responseMessage);
        return $response->withHeader("Content-Type", "application/json")
            ->withStatus(401);
    }

    //controller for LoginCheck
    public function LoginCheck($request, $response, $args)
    {
        $authRes=authController::verifyUser($request,$response);
        if($authRes=="true"){
            $loginCheckObject = new LoginCheck($request, $response);
            return $loginCheckObject->__loginCheckCredintials();
        }
        return $authRes;
        
    }
}
