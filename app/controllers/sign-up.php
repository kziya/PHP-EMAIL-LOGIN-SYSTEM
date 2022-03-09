<?php
if(isset($_SESSION['email']))
{
    header('Location:' . admin_url());
}
if(isset($_POST['email']))
{
    $email = strtolower(post('email'));
    if(filter_var($email,FILTER_VALIDATE_EMAIL)){
    
        try{
            $query = $db -> prepare('SELECT * FROM users WHERE email=?');
            $query -> execute([ $email ]);
            $isExistsEmail = $query -> fetch(PDO::FETCH_ASSOC);

            if($isExistsEmail)
            {
                $error = "The email  already exists in the system !";
            }else{
                $name = post('name');
                if($name){
                    $password = post('password');
                    if($password)
                    {
                        if(strlen($password) >= 8)
                        {
                            $confirm_password = post('confirm_password');
                            if($password === $confirm_password)
                            {
                                $query = $db -> prepare('INSERT INTO users SET name=?,email=?,password=?');
                                $add = $query -> execute([ $name, $email, password_hash($password,PASSWORD_DEFAULT)]);
                                if($add)
                                {
                                    $_SESSION['email'] = $email;
                                    $_SESSION['is_verified'] = false;
                                    $_SESSION['last_mail_time'] = 0;
                                    header('Location:' . admin_url());
                                }else{
                                    $error = "Something went wrong !";
                                }
                            }else{
                                $error = "Confirm password is wrong!";
                            }
                        }else{
                            $error = "Password must be longer than 8!";
                        }
                    }else{
                        $error = "Password is empty!";
                    }


                }else{
                    $error = "Name is empty!";
                }

            }

        }catch(Exception $e)
        {
            $error = "Something went wrong !";
        }
    }else{
        $error = "Email format is wrong!";
    }
}

require view('sign-up');