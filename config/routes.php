<?php
//defining the custom routes

//==>Route for login authorization 
$app->post('/LoginCheck', 'EntryController:LoginCheck');


//==>ROute for generating the jwt token

$app->post('/Generatejwt','JwtAuthController:GenerateAuthToken');