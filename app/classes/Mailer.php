<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

//Create an instance; passing `true` enables exceptions


class Mailer{
    private $mail;
    private $admin_mail;
    private $admin_name;
    public  $isHtml = true;
    public  $subject = '';
    public  $body = '';
    public  $altBody = '';
    function __construct($mailConf)
    {
        $this->mail = new PHPMailer(true);
        $this->initSettings($mailConf);
        $this->admin_mail = $mailConf['user'];
        $this->admin_name = $mailConf['name'];
    } 
    private function initSettings($mailConf)
    {
        $this->mail->SMTPDebug = SMTP::DEBUG_SERVER;                      
        $this->mail->isSMTP();                                            
        $this->mail->Host       = $mailConf['host'];                      
        $this->mail->SMTPAuth   = $mailConf['smpt_auth'];                                   
        $this->mail->Username   = $mailConf['user'];                      
        $this->mail->Password   = $mailConf['pass'];                      
        $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            
        $this->mail->Port       = $mailConf['port'];  
    }
    public function toUser($userMail,$userName = '')
    {
        $this->initValues();
        $this->mail->addAddress($userMail,$userName);
        try{
            ob_start();
            $this->mail->send();
            ob_clean();
            return true;
        }catch(Exception $e)
        {
            return false;
        }
    }
    private function initValues()
    {
        $this->mail->isHTML($this->isHtml);
        $this->mail->Subject = $this->subject;
        $this->mail->Body = $this->body;
        $this->mail->AltBody = $this->altBody;
        
    }
    public function toUsers($usersMail,$usersName)
    {
        $this->initValues();
        $length = count($usersMail);
        for($i = 0;$i < $length; $i++)
        {
            $this->mail->addAddress($usersMail[$i],$usersName[$i]);
        }
        try{
            ob_start();
            $this->mail->send();
            ob_clean();
            return true;
        }catch(Exception $e)
        {
            return false;
        }
    
    }
    
}