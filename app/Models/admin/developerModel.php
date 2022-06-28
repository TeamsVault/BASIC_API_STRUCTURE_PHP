<?php


namespace App\Models\admin;


use Illuminate\Database\Eloquent\Model;

class developerModel extends Model
{

    protected  $table = "developer_auth";

    protected $fillable =["dev_id","dev_email","dev_password","dev_status"];

}