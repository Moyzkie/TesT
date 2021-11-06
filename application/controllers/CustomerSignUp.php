<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class CustomerSignUp extends CI_Controller{
//niload ko dito yong ating form,form_validation at databse
public function __construct()
{
    parent::__construct();
    $this->load->helper('form');
    $this->load->library('form_validation');
}

//
public function SignUp_Form()
{
    $this->load->view('templates/header');
    $this->load->view('CustomerPages/'.'signup');
    $this->load->view('templates/footer');
}

public function SignUp()
{
    //nag set ako ng mga validation 
    $this->form_validation->set_rules('username','Username','trim|required');
    $this->form_validation->set_rules('fullname','Fullname','trim|required');
    $this->form_validation->set_rules('gender','Gender','required');
    $this->form_validation->set_rules('age','Age','trim|required');
    $this->form_validation->set_rules('mobile_number','Mobile number','trim|required');
    $this->form_validation->set_rules('email','Email','trim|required|valid_email');
    $this->form_validation->set_rules('password','Password','trim|required|md5');
    $this->form_validation->set_rules('confirm-password','confirm-Password','trim|required|matches[password]|md5');
 
    //kinuha ko ang  value  ng txtbox eamil
    $entered_email=$this->input->post('email');
    $cheak_email = new Signup_Model;

    $entered_number = $this->input->post('mobile_number');
    $cheak_number = new Signup_Model;

    //nilagay ko sa cheack_email() ang value 
    $emailcount = $cheak_email->cheack_email($entered_email);

    $number_count = $cheak_number->cheack_number($entered_number);

    if($this->form_validation->run()==FALSE)
    {
    $this->SignUp_Form();
    }else{
   
    if($emailcount->num_rows()<=0 && $number_count->num_rows()<=0)
    {
    $verify_token = md5(rand());
    $current_datetime = date('Y-m-d H:i:s');
    $data = array(
    'User_Name' => $this->input->post('username'),
    'Full_Name' => $this->input->post('fullname'),
    'Gender' => $this->input->post('gender'),
    'Age' => $this->input->post('age'),
    'Contact_No' => $this->input->post('mobile_number'),
    'Email' => $this->input->post('email'),
    'Password' => $this->input->post('password'),
    'Created_at' => $current_datetime,
    'verification_key' => $verify_token
    );
    $name =  $this->input->post('fullname');
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
    
    $mail->setFrom('pharmacyshop2021@gmail.com');
    // $mail->addReplyTo('');
    
     /* Add a recipient */
     $mail->addAddress($this->input->post('email'));
    
     /* Add cc or bcc */
     // $mail->addCC('cc@example.com');
     // $mail->addBCC('bcc@example.com');
    
     /* Email subject */
     $mail->Subject = 'Email Verification from Pharmacy OnlineShop';
    
     /* Set email format to HTML */
     $mail->isHTML(true);
    
     /* Email body content */
     $mailContent = "<p>Hi $name </p>
     <p>You have received your verification email to verify your account</p>
     <p >Link: <a href='http://192.168.1.13/PharmacyV.1/EmailVerify?token=$verify_token'>http://192.168.1.13/PharmacyV.1/EmailVerify?token=$verify_token </p>
     <p>Thanks </p> ";
     $mail->Body = $mailContent;
     /* Send email */
     if(!$mail->send()){
         echo 'Mail could not be sent.';
         echo 'Mailer Error: ' . $mail->ErrorInfo;
     }else{
        $this->session->set_flashdata('status','Check in your email for email verification mail!');
        $regiter_user = new Signup_Model;
        $regiter_user->signup($data);
        redirect(base_url('signup'));
     }
    
    }elseif($emailcount->num_rows()>0)
    {
    $this->session->set_flashdata('status','Your email address is alreaady register!');
     redirect(base_url('signup'));
     unset_flashdata($_SESSION['status']);
    
    }

  }
  
}

}