<?php


function controller($name)
{
    return PATH . '/app/controllers/' . strtolower($name) . '.php';
}
function view($name)
{
    return PATH . '/app/views/' . strtolower($name) . '.php';
}
function route($index)
{
    global $route;
    return $route[$index];
}
function site_url($url = '')
{
    return URL .'/' . $url;
}
function public_url($url)
{
    return URL . '/public/' . $url;
}