<?php

if(isset($_POST['_token']))
{
    if($_POST['_token'] === $_SESSION['_token'])
    {
        $email = strtolower(post('email'));
        try{
            $query = $db -> prepare('SELECT * FROM users WHERE email=?');
            $query -> execute([ $email ]);
            $user = $query -> fetch(PDO::FETCH_ASSOC);
            if(isset($user['id']))
            {
                header('Location:' . site_url('send-password-mail/' . $user['verify_hash']));
                die();
            }else{
                $error = "Email is wrong!";
            }


        }catch(PDOException $e)
        {
            $error = "Something went wrong !";
        }





    }else{
        $error = "Invalid token!";
    }
}


require view('forget-password');