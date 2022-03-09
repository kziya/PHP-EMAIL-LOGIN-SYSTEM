<?php


if(!isset($_SESSION['email']))
{
    header('Location:' . site_url());
}
try{
    $query = $db -> prepare('SELECT * FROM users WHERE email=?');
    $query -> execute([ $_SESSION['email'] ]);
    $user = $query -> fetch(PDO::FETCH_ASSOC);
    if(!isset($user['id']))
    {
        session_destroy();
        header('Location:' . site_url());
    }
    if($user['email_verified_at'])
    {
        $_SESSION['is_verified'] = true;
    }

}catch(PDOException $e)
{
    die(site_url('404'));
}

if(!$_SESSION['is_verified'] && route(1) !== 'send-verify')
{   
    header('Location:' . admin_url('send-verify'));
}

if(!isset($route[1]))
{
    $route[1] = 'index';
}

if(!file_exists(admin_controller(route(1))))
{

    header('Location:' . site_url('404'));
}


require admin_controller(route(1));