<?php

if(!isset($route[1]))
{
    header('Location:' . site_url('404'));
}

$diff = time() - $_SESSION['last_mail_time'];

if($diff >= 60)
{
    try{
        $query = $db -> prepare('SELECT *  FROM users WHERE verify_hash=?');
        $query -> execute([ route(1) ]);
        $user = $query -> fetch(PDO::FETCH_ASSOC);
        if(isset($user['id']))
        {

            $hash = md5($user['name'] . $user['email'] . $user['verify_hash'] . $user['password']);
            try{
                $query = $db -> prepare('UPDATE users SET verify_hash=? WHERE id=?');
                $update = $query -> execute([ $hash,$user['id'] ]);
                if($update)
                {
                    $mailer = new Mailer($mailconfs);
                    $mailer -> subject = "Change Password Link:";
                    $mailer -> body = 'Here is a link to change password : <br> <b><a href="'. site_url('change-password/' . $hash) .'">CHANGE PASSWORD LINK</a></b>';
                    try{
                        $mailer -> toUser($user['email']);
                        $message = "The link to change password sent to your email.";
                        $_SESSION['last_mail_time'] = time();
                    }catch(Exception $e)
                    {
                        $error = "Something went wrong !";
                    }

                }else $error = "Something went wrong !";

            }catch(PDOException $e)
            {
                $error = "SOmething went wrong !";
            }






        }else $error = "Invalid token!";
    }catch(PDOException $e)
    {
        $error = "Something went wrong!";
    }

}else $error = "PLease try again in 1 minute.";
header('Refresh:3;url=' . site_url());
require view('send-password-mail');