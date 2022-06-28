<?php

namespace App\Controllers;

use App\Models\admin\jwtTokenCreateModel as jwtModel;
use App\Requests\CustomRequestHandler;
use App\Response\CustomResponse;


class AuthController
{

    public static function verifyUser($req, $res)
    {
        $CustomResponse = new CustomResponse();

        $token = $req->getAttribute("token");

        $jwtTokenId = $token["jti"];

        

        $count = jwtModel::where(["jwt_token_id" => $jwtTokenId])->count();
        if ($count == 0) {
            return $CustomResponse->is401Response($res, "Jwt Token Not Found");
        } else {
            $appData = jwtModel::where(["jwt_token_id" => $jwtTokenId])->get();
            if ($appData[0]['access_status'] == "expired") {
                return $CustomResponse->is401Response($res, "Jwt Token Is Expired");
            } else if ($appData[0]['access_status'] == "deactive") {
                return $CustomResponse->is401Response($res, "Jwt Token Is Deactivated");
            } else if ($appData[0]['access_status'] == "active") {
                return "true";
            }
        }
    }
}
