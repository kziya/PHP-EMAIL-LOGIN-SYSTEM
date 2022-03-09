<?php


function post($name)
{
    if(isset($_POST[$name]) && !empty($name))
    {
        return htmlspecialchars(trim($_POST[$name]));
    }
    return false;
}

function get($name)
{
    if(isset($_GET[$name]) && !empty($_GET[$name]))
    {
        return htmlspecialchars(trim($_GET[$name]));
    }
    return false;
}