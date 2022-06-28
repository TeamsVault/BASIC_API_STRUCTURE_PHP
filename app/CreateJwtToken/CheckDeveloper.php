<?php


namespace App\CreateJwtToken;



use App\Models\admin\jwtTokenCreateModel as jwtModel;
use App\Models\admin\developerModel as devModel;
use App\Requests\CustomRequestHandler;
use App\Response\CustomResponse;
use Respect\Validation\Validator as v;
use App\Validation\Validator;
use Respect\Validation\Rules\Json;

class CheckDeveloper
{

    private $bearerToken;
    private $request;
    private $response;
    private $CustomResponse;
   
    private  $validator;

    private $jwtTokenArray = [];


    public function __construct($request, $response, $bearerToken, $payload)
    {
        $this->request = $request;
        $this->response = $response;
        $this->bearerToken = $bearerToken;
        $this->jwtTokenArray = $payload;

        //creating object for the custom response 
        $this->CustomResponse = new CustomResponse();
      

        //creating new object for validator
        $this->validator = new Validator();
    }

    public function CheckDeveloperId()
    {


        $arrayObject = [
            "email" => v::notEmpty()->email(),
            "password" => v::notEmpty()
        ];

        $this->validator->validate($this->request, $arrayObject);
        if ($this->validator->ValidationFailed()) {
            return $this->CustomResponse->is400Response($this->response, $this->validator->errors);
        }

        return $this->CheckDeveloper();
    }

    

    //function for checking the user
    public function CheckDeveloper()
    {

        $userEmail = CustomRequestHandler::getParam($this->request, "email");
        $userPassword = CustomRequestHandler::getParam($this->request, "password");
        $count = devModel::where(["dev_email" => $userEmail, "dev_password" => $userPassword])->count();
        $userData = devModel::where(["dev_email" => $userEmail, "dev_password" => $userPassword])->get();
        if ($count > 0) {
            $devId=$userData[0]['dev_id'];
            $count = jwtModel::where('dev_id', $devId)->count();
            if ($count == 0) {
                return $this->createApp($devId);
            } else {
                $responsemessage = "Bearer Token already exists";
                return $this->CustomResponse->is401Response($this->response, $responsemessage);
            }
        } else {
            $responsemessage = "User Not found";
            return $this->CustomResponse->is401Response($this->response, $responsemessage);
        }
    }

    //function for creating new app 
    public function createApp($devId)
    {
        $createObject = [
            "dev_id" => $devId,
            "internal_id" => $this->jwtTokenArray['id'],
            "issuer_id" =>  $this->jwtTokenArray['iss'],
            "scope" =>  json_encode($this->jwtTokenArray['scope']),
            "jwt_token_id" =>  $this->jwtTokenArray['jti'],
            "bearer_token" => $this->bearerToken,
            "access_status" => 1

        ];
        jwtModel::insert($createObject);
        $data["response"] = "App created successfully";
        $data["data"] = $createObject;
        return $this->CustomResponse->is200Response($this->response, $data);
    }
}
