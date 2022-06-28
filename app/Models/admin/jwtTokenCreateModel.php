<?php


namespace App\Models\admin;


use Illuminate\Database\Eloquent\Model;

class jwtTokenCreateModel extends Model
{
    

        protected $table = "api_auth";

        protected $fillable = ["dev_id", "internal_id", "issuer_id", "scope", "jwt_token_id", "bearer_token", "created_at", "updated_at", "access_status"];
       
}
