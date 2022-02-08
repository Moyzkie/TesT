<?php
  if(!$this->session->has_userdata('authenticated'))
  {
    $userdata = $this->session->userdata('user_data');
    $authenticated =  $this->session->has_userdata('google_authenticated');
  }else {
    $authenticated  =$this->session->has_userdata('authenticated');
    $userdata = $this->session->userdata('auth_customer');
  }
?>

<h1><?=$userdata['Full_Name']?> hello world</h1>