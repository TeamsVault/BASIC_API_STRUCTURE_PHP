<?php

$capsule =new \Illuminate\Database\Capsule\Manager;

$database_config =[
    "driver"=>"mysql",
    "host"=>"localhost",
    "database"=>"hrms_timesheet",
    "username"=>"root",
    "password"=>"root",
    "charset"=>"utf8",
    "collation"=>"utf8_general_ci",
    "prefix"=>""
  ];
  
  

  
  $capsule->addConnection($database_config);
  
  $capsule->setAsGlobal();
  
  $capsule->bootEloquent();
  
  return $capsule;