<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ForgotPassword extends CI_Controller
{
    public function __construct()
    {
        parent:: __construct();
        $this->load->helper('form');
        $this->load->library('form_validation');
   
    }
   
    public function forgotpass_form()
    {
        $this->load->view('templates/header');
        $this->load->view('CustomerPages/forgotpassword');
        $this->load->view('templates/footer');
    }

    public function sendrecovery_token()
    {
        $this->form_validation->set_rules('email','Email Address','trim|required|valid_email');

        if($this->form_validation->run()==FALSE)
        {
            $this->forgotpass_form();

        }else {

            $recovery_token = md5(rand());

            $email = $this->input->post('email');

            $account_recovery = new ForgotPassword_Model();
            
            $found_email = $account_recovery->check_email($email); 


            if($found_email->num_rows() > 0)
            {
                $result = $account_recovery->update_token($recovery_token,$email);

                if($result == TRUE)
                {   
                    /* Load PHPMailer library */
                    $this->load->library('phpmailer_lib');
           
                    /* PHPMailer object */
                    $mail = $this->phpmailer_lib->load();
       
                    /* SMTP configuration */
                    $mail->isSMTP();
                    $mail->Host     = 'smtp.gmail.com';
                    $mail->SMTPAuth = true;
                    $mail->Username = 'pharmacyshop2021@gmail.com';
                    $mail->Password = 'zuhtksxuytllwhoe';
                    $mail->SMTPSecure = 'ssl';
                    $mail->Port     = 465;
       
                    $mail->setFrom('pharmacyshop2021@gmail.com');
                    // $mail->addReplyTo('');
       
                    /* Add a recipient */
                    $mail->addAddress($this->input->post('email'));
       
                    /* Add cc or bcc */
                    // $mail->addCC('cc@example.com');
                    // $mail->addBCC('bcc@example.com');
       
                    /* Email subject */
                    $mail->Subject = 'Your recovery token ';
       
                    /* Set email format to HTML */
                    $mail->isHTML(true);
                    
                    $link = "http://localhost:8000/PharmacyV.1/ChangePassword?recovery_token=$recovery_token";
                    /* Email body content */
                    $mailContent = "<p>Hi $email </p>
                    <p>You have received your recovery token you are now able to recover your account</p>

                    <p >Link: <a href='$link'>$link</p>
                    <p>Thanks </p> ";
                    $mail->Body = $mailContent;
                    /* Send email */
                    if(!$mail->send()){
                    echo 'Mail could not be sent.';
                    echo 'Mailer Error: ' . $mail->ErrorInfo;
                    }else{
                        $verify_status =2;
                         $account_recovery->update_verify_status($verify_status,$recovery_token);
                        // $this->session->set_flashdata('status','Check in your email for email verification mail!');
                        // $regiter_user = new Signup_Model;
                        // $regiter_user->signup($data);
                        // redirect(base_url('signup'));
                        $this->session->set_flashdata('r_status','Recovey token has been send on your email!');
                        redirect('forgotpassword');
                    }
                }
    
            }else {
               $this->session->set_flashdata('r_status','This email are not exist!');
               redirect('forgotpassword');
            }
            
        }
    }

    public function newpassword_form()
    {
         $this->load->view('templates/header');
         $this->load->view('CustomerPages/changepassword');
         $this->load->view('templates/footer');
       

    }

    
    public function get_recovery_token()
    {   
        
        $forgotpass =new ForgotPassword_Model();
        
        if(isset($_GET['recovery_token']))
        {    
              
             $recovery_token = $_GET['recovery_token'];
             $data ['recovery_token'] = $recovery_token;
             $check_verify = $forgotpass->check_verify($recovery_token);
             if($check_verify)
             {
                if($check_verify->Verify==3)
                {
                   $this->session->set_flashdata('r_status','Your recovery token is already use!'); 
                   redirect('forgotpassword');
                }
                elseif($check_verify->Verify==1){
                   $forgotpass->update_verify_status($recovery_token);
                 }
             }else{
                show_404();
             }
             $this->form_validation->set_rules('password','Password','trim|required|md5');
             $this->form_validation->set_rules('con-password','confirm-Password','trim|required|matches[password]|md5');
             if ($this->form_validation->run()==FALSE)
             {
               
                $this->load->view('templates/header');
                $this->load->view('CustomerPages/changepassword',$data);
                $this->load->view('templates/footer');

             }else{ 
                $newpassword = $this->input->post('password');
                $result=$forgotpass->update_password($newpassword,$recovery_token);
                if($result)
                {
                  $verify_status = 3;
                  $check_verify = $forgotpass->update_verify_status($verify_status,$recovery_token);
                  $this->session->set_flashdata('statuss','Your password is successfuly change!'); 
                  redirect('login');
                }else {
                    echo "error";
                }

             } 
            
        }
        
       
    }


}

?>