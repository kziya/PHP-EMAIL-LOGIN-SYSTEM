<?php
try{
    $query = $db -> prepare('SELECT * FROM users WHERE verify_hash=?');
    $query -> execute([ route(1) ]);
    $user = $query -> fetch(PDO::FETCH_ASSOC);
    if($user)
    {
        if($user['email_verified_at'])
        {

            header('Location:' . site_url('404'));
            die();
        }
    }else{
        $errorMessage = 'Invalid key!';
    }
}catch(PDOException $e)
{
    $errorMessage = "Something went wrong !";
}

if(!isset($route[1]))
{
    header('Location:' . site_url('404'));
}

try{
    $query = $db -> prepare('UPDATE users SET email_verified_at=? WHERE verify_hash=? ');
    $update = $query -> execute([ date('Y-m-d H:i:s'), route(1) ]);
    if($update)
    {
        $message = "The email sucessfully confirmed.";
        $_SESSION['is_verified'] = true;
    }else{
        $errorMessage = "Something went wrong !";
    }

}catch(PDOException $e)
{
    $errorMessage = "Something went wrong 1!";
}

 header('Refresh:2;url=' . site_url());

require view('verify');