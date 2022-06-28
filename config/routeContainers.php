<?php


return function ($container) {
  $container['EntryController'] = function ($container) {
    return new \App\Controllers\EntryController($container->get('settings'));
  };
  
  $container['JwtAuthController'] = function ($container) {
    return new \App\Controllers\JwtAuthController($container->get('settings'));
  };
};
