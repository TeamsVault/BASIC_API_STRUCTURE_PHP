<?php


namespace App\Models\employee;


use Illuminate\Database\Eloquent\Model;

class User extends Model
{

    protected  $table = "login_auth";

    protected $fillable =["email","password","status"];

}