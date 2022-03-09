<?php
if(isset($_SESSION['email']))
{
    header('Location:' . admin_url());
    die();
}
if(isset($_POST['_token']))
{
    if($_POST['_token'] === $_SESSION['_token'])
    {   
        $email = strtolower(post('email'));
        try{
            $query = $db -> prepare('SELECT * FROM users WHERE email=?');
            $query -> execute([ $email ]);
            $user = $query -> fetch(PDO::FETCH_ASSOC);
            if($user)
            {
                if(password_verify(post('password'),$user['password']))
                {
                    $_SESSION['email'] = $email;
                    $_SESSION['last_mail_time'] = 0;
                    $_SESSION['is_verified'] = $user['email_verified_at'] ? true : false;
                    header('Location:' . admin_url());
                    die();
                }else{
                    $error = 'Password is wrong!';
                }
            }else{
                $error = "Email is wrong!";
            }
            



        }catch(PDOException $e)
        {
            $error = "Something went wrong!";

        }






    }else{
        $error = 'Invalid token !';
    }

}







require view('sign-in');