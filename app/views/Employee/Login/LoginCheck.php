<?php

namespace App\views\Employee\Login;

use App\Models\employee\User;
use App\Requests\CustomRequestHandler;
use App\Response\CustomResponse;

class LoginCheck
{

    protected $email;
    protected $password;
   
    private $request;
    private $response;

    public function __construct($request, $response)
    {
        //creating objecct for the custom response 
        $this->customResponse = new CustomResponse();
        //creating object for the user data model
        $this->user = new User();
        $this->request = $request;
        $this->response = $response;
    }

    public function __loginCheckCredintials()
    {
        $userEmail = CustomRequestHandler::getParam($this->request, "email");
        $userPassword = CustomRequestHandler::getParam($this->request, "password");

        //getting the reponse from the checkuser
        $CheckUserResponse = $this->CheckUser($userEmail, $userPassword);

        //printing the reponse according to the @CheckUserResponse object
        if ($CheckUserResponse == "success") {
            $data['response'] = $CheckUserResponse;
            $data['message'] = "user exists";

            return $this->customResponse->is200Response($this->response, $data);
        } else {

            return $this->customResponse->is401Response($this->response, $CheckUserResponse);
        }
    }

    public function CheckUser($email, $password)
    {
        $count =  $this->user->where(["email" => $email, "password" => $password])->count();
        $userStatus = $this->user->where(["email" => $email, "password" => $password])->get();

        if ($count == 0) {

            $data['response'] = "fail";
            $data['message'] = "user credintials failed to login";
            return $data;
        } else {
            if ($userStatus[0]['status'] == "deactive") {
                $data['response'] = "deactive";
                $data['message'] = "user account terminated";
                return $data;
            } else {
                return "success";
            }
        }
    }
}
