<?php

namespace App\Controllers;


use App\Requests\CustomRequestHandler;
use App\CreateJwtToken\GenerateTokenController;


use \Slim\Views\Twig as view;

class JwtAuthController{

    protected $view;
    protected $GenerateTokenController;

    public function __construct($view)
    {
        $this->view = $view;
      
       
    }

    
    public function GenerateAuthToken($request, $response, $args)
    {
        
        //passing the values to the generate controller
        $this->GenerateTokenController=new GenerateTokenController($request, $response);
        return $this->GenerateTokenController->generateToken();
      
    }
}
