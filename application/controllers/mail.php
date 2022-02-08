<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mail extends CI_Controller{
   
    function  __construct(){
        parent::__construct();
    }
   
   public function send(){
        /* Load PHPMailer library */
        $this->load->library('phpmailer_lib');
       
        /* PHPMailer object */
        $mail = $this->phpmailer_lib->load();
       
        /* SMTP configuration */
        $mail->isSMTP();
        $mail->Host     = 'mail.smtp2go.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'spcc.edu.ph';
        $mail->Password = 'Spcc1978';
        $mail->SMTPSecure = 'tls';
        $mail->Port     = 2525;
       
        $mail->setFrom('lykarose422@gmail.com','Mail');
        $mail->addReplyTo('lykarose422@gmail.com','Mail');
       
        /* Add a recipient */
        $mail->addAddress('rockyelicana@gmail.com');
       
        /* Add cc or bcc */
        // $mail->addCC('cc@example.com');
        // $mail->addBCC('bcc@example.com');
       
        /* Email subject */
        $mail->Subject = 'Send Email via SMTP using PHPMailer in CodeIgniter';
       
        /* Set email format to HTML */
        $mail->isHTML(true);
       
        /* Email body content */
        $mailContent = "<h1>Send HTML Email using SMTP in CodeIgniter</h1>
        <p>This is a test email sending using SMTP mail server with PHPMailer.</p>";
        $mail->Body = $mailContent;
        var_dump($mail->send());
        /* Send email */
        if(!$mail->send()){
            echo 'Mail could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        }else{
            echo 'Mail has been sent';
        }
    }
   
}
