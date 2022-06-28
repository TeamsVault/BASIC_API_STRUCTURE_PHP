<?php

namespace  App\Validation;

use App\Requests\CustomRequestHandler;
use Respect\Validation\Validator as v;
use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Rules\Json;

class Validator
{
    public $errors = [];

    public function validate($request, $arrayObject)
    {

        foreach ($arrayObject as $key => $data) {


            try {

                $data->setName($key)->assert(CustomRequestHandler::getParam($request, $key));
            } catch (NestedValidationException $ex) {

                $coll = collect($ex->getMessages());

                $messages = $coll->flatten();

                foreach ($messages as $message) {
                    $this->errors[$key] = $message;
                }
            }
        }

       
    }

    public function ValidationFailed(){

        
        if (empty($this->errors)) {
            return false;
        } else {
            return true;
        }
    }
}
