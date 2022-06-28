<?php

use \Slim\App as Slim;

require __DIR__.'/../app/Controllers/EntryController.php';

require_once __DIR__. "/../vendor/autoload.php";

$settings=require __DIR__.'/./settings.php';



$app = new Slim($settings);

$container = $app->getContainer();



//defing our own error handlers
require_once   __DIR__.'/./errHandler.php';

//defining the route container
$routeContainers=require __DIR__.'/./routeContainers.php';
$routeContainers($container);

//defining the routes
require __DIR__.'/./routes.php';

//defing the database 
require __DIR__.'/DatabaseConnection.php';

//defining the middle ware
$middleware = require_once __DIR__."/middleware.php";

$middleware($app);

// Run app
$app->run();