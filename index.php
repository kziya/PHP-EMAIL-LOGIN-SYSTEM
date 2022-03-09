<?php
require __DIR__ . '/app/init.php';
$route = array_values(array_filter(explode('/',$_SERVER['REQUEST_URI'])));
if(SUBFOLDER)
{
    array_shift($route);
}



if(!isset($route[0]))
{
    $route[0] = 'sign-in';
}


if(!file_exists(controller(route(0))))
{
    $route[0] = '404';
}

 require controller(route(0));