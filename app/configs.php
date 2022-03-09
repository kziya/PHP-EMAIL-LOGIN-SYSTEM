<?php
define('SUBFOLDER',true);
define('PATH',realpath('.'));
define('URL','http://localhost/phplogin');
if(count($_POST) === 0)
{
    $_SESSION['_token'] = md5(time() + rand(0,9999));
}else $_SESSION['last_mail_time'] = 0;  

return [
    'db' => [
        'host' => 'localhost',
        'name' => 'phplogin',
        'user' => 'root',
        'pass' => 'root',
    ],
    'mail' => [
        'host'      => 'smtp.gmail.com',
        'port'      => 465,
        'smpt_auth' => true,
        'user'      => 'testmail3321@gmail.com',
        'pass'      => 'Test3321',
        'name'      => 'Test'
    ]
];