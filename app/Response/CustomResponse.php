<?php

namespace  App\Response;

class CustomResponse
{

    public function is200Response($response,$responseMessage)
    {
        $responseMessage = json_encode(["success"=>true,"response"=>$responseMessage,"status"=>200]);
        $response->getBody()->write($responseMessage);
        return $response->withHeader("Content-Type","application/json")
            ->withStatus(200);
    }


    public function is400Response($response,$responseMessage)
    {
        $responseMessage = json_encode(["success"=>false,"response"=>$responseMessage,"status"=>400]);
        $response->getBody()->write($responseMessage);
        return $response->withHeader("Content-Type","application/json")
            ->withStatus(400);
    }

    public function is422Response($response,$responseMessage)
    {
        $responseMessage = json_encode(["success"=>true,"response"=>$responseMessage,"status"=>422]);
        $response->getBody()->write($responseMessage);
        return $response->withHeader("Content-Type","application/json")
            ->withStatus(422);
    }
    
    public function is401Response($response,$responseMessage)
    {
        $responseMessage = json_encode(["success"=>false,"response"=>$responseMessage,"status"=>401]);
        $response->getBody()->write($responseMessage);
        return $response->withHeader("Content-Type","application/json")
            ->withStatus(401);
    }
}