<?php

if($_SESSION['is_verified'])
{
    header('Location:' . site_url());
    die();
}
$diff = time() - $_SESSION['last_mail_time'];

if($diff >= 60)
{
    $hash = md5($_SESSION['email'] . time() . rand(0,99999));
    try{
        $query = $db -> prepare('UPDATE users SET verify_hash=? WHERE email=?');
        $add = $query -> execute([ $hash,$_SESSION['email']  ]);
        if(!$add)
        {
            $errorMessage = 'Something went wrong!';
            die($hash . '<br>' . $_SESSION['email'] );
        }
    }catch(PDOException $e)
    {
        $errorMessage = "Something went wrong!";
    }
    
    $mailer = new Mailer($mailconfs);
    $mailer -> isHtml = true;
    $mailer -> subject = 'Verify Link';
    $mailer -> body = '<h1>Here is a verify link:<br><b><a href="'. site_url('verify/' . $hash ) .'">VERIFY LINK</a></b></h1>';
    try{
        $mailer -> toUser($_SESSION['email']);
        $message = "We have just sent verify link yo your email adress.";
        $_SESSION['last_mail_time'] = time();    
    }catch(Exception $e)
    {
        $errorMessage = "Something went wrong,try again later.";
    }

}else $message = "Wait a minute to get another verify link.";