<?php



function admin_controller($name)
{
    return PATH . '/admin/controllers/' . strtolower($name) . '.php';
}

function admin_view($name)
{
    return PATH . '/admin/views/' .  strtolower($name) . '.php';
}



function admin_url($url = '')
{
    return URL . '/admin/' . $url;
}