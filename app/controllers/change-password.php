<?php
$hash = route(1);

if(!isset($hash))
{
    header('Location:'.site_url('404'));
}
try{
    $query = $db -> prepare('SELECT * FROM users WHERE verify_hash=?');
    $query -> execute([ $hash ]);
    $user = $query -> fetch(PDO::FETCH_ASSOC);
    if(!isset($user['id']))
    {
        header('Location:' . site_url('404'));
    }



}catch(PDOException $e)
{
    $error = "SOmething went wrong !";
}

if(isset($_POST['_token']))
{
    if(strlen(post('password')) >= 8)
    {   
        if(post('password') === post('confirm_password'))
        {
            if(!password_verify(post('password'),$user['password']))
            {
                try{
                    $query = $db -> prepare('UPDATE users SET password=?,verify_hash=? WHERE id=?');
                    $update = $query -> execute([ password_hash(post('password'),PASSWORD_DEFAULT), md5($user['email'] . time() . rand(0,1000)) ,$user['id'] ]);
                    if($update)
                    {
                        header('Location:'.site_url());
                        die();
                    }else{
                        $error = "Something went wrong !";
                    }
                }catch(PDOException $e)
                {
                    $error = "Something went wrong !";
                }

            }else{
                $error = "New password can't be equal to old password!";
            }

            





        }else{
            $error = "Confirm password is wrong !";
        }

    }else{
        $error = "Password must be longer than 8.";
    }
}




require view('change-password');