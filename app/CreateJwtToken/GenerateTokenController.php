<?php


namespace App\CreateJwtToken;


use App\Requests\CustomRequestHandler;
use App\CreateJwtToken\CheckDeveloper;
use App\Interfaces\SecretKeyInterface;
use \Firebase\JWT\JWT;

class GenerateTokenController 
{

  private $request;
  private $response;
  
  

  public function __construct($request, $response)
  {
    $this->request = $request;
    $this->response = $response;
  

  }

  public  function generateToken()
  {
    $issuerId = "70323B534244";
    $id = uniqid('int');
    $userId = uniqid('u');
    $jtiToken = uniqid('jti');
    $secret = SecretKeyInterface::SecretKey();



    $payload = [
      "id" => $id,
      "jti" => $jtiToken,
      "sub" => $userId,
      "iss" => $issuerId,
      "token_type" => "bearer",
      "scope" => CustomRequestHandler::getParam($this->request, "scope")
    ];

    $BearerToken = JWT::encode($payload, $secret, "HS256");
    
    //creating ew object for cheking and creating the developer id for api acccess
    
    $CheckDeveloper=new CheckDeveloper($this->request,$this->response,$BearerToken,$payload);
    $Response=$CheckDeveloper->CheckDeveloperId();
    return $Response;
    
  }
}
