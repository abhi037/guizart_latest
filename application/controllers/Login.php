<?php
  defined('BASEPATH') OR exit('No direct script access allowed');
  
  class Login extends CI_Controller {
    
    public function __construct()
    {
      parent::__construct();
      // Your own constructor code
      $this->load->database();
      $this->load->library('session');
      $this->load->helper('cookie');
      $this->load->library('form_validation');
      /*cache control*/
      $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
      $this->output->set_header('Pragma: no-cache');
    }
    
    public function index() {
      if ($this->session->userdata('admin_login') == true && $this->session->userdata('role_id')==1) {
        redirect(site_url('admin/dashboard'), 'refresh');
        }else {
        $this->load->view('backend/login.php');
      }
    }
    
    public function validate_login($from = "") {
      $email = $this->input->post('email');
      $password = $this->input->post('password');
     $credential = array('email' => $email, 'password' => sha1($password), 'status' => 1);

     //$credential = array('email' => $email,'status' => 1);
      
      // Checking login credential for admin
      $query = $this->db->get_where('users', $credential); 
      if ($query->num_rows() > 0) {
        $row = $query->row();
        
        
        $this->session->set_userdata('user_id', $row->id);
        set_cookie('user', md5($row->id.APP_KEY), '86400'); 
        $this->session->set_userdata('role_id', $row->role_id);
        $this->session->set_userdata('role', get_user_role('user_role', $row->id));
        $this->session->set_userdata('name', $row->first_name.' '.$row->last_name);
        if ($row->role_id == 1 || $row->role_id > 3) {
          $this->session->set_userdata('admin_login', '1');
          $access_url = array();
          if($row->role_id > 3) {
            $access = $this->user_model->GetAccess('', $row->role_id);
            foreach ($access->result_array() as $key => $value) {
              $access_url[]=$value['action'];
            } 
            $this->session->set_userdata('access_url', $access_url);
          }
          redirect(site_url('admin/dashboard'), 'refresh');
          }else if($row->role_id == 2){
          $this->session->set_userdata('user_login', '1');
          if ($this->session->userdata('last_page') == 'paymentReg'){
            $subcategory_id = $this->session->userdata('subcategory_id');
            $this->session->unset_userdata('paymentReg');
            if($this->uri->segment('4')=='trial' || $this->uri->segment('3')=='trial') {
              header("Location:" . site_url('Checkout/trail/'.$subcategory_id)); 
            } else {
              header("Location:" . site_url('home/checkout/'.$subcategory_id)); 
            } 
          }
          redirect(site_url('home/user'), 'refresh');
          } else if($row->role_id == 3) {

          $this->session->set_userdata('teacher_login', '1');
          redirect(site_url('teacher/dashboard'), 'refresh');
           
        }
        }else {
        $this->session->set_flashdata('error_message',get_phrase('invalid_login_credentials'));
        if ($from == "user")
        redirect(site_url('home'), 'refresh');
        else
        redirect(site_url('login'), 'refresh');
        
      }
      
    }
    

    public function validate_captcha() { 
      $google_recaptcha = trim($this->input->post('g-recaptcha-response'));
      $google_userIp = $this->input->ip_address();
      // Add your secret key here
      $google_secret = '6LeldpYoAAAAAPLqvg_O1Qg1ORT2Kj2iBjuuuPjs';
      $captcha_data = array(
          'secret' => $google_secret,
          'response' => $google_recaptcha,
          'remoteip' => $google_userIp
      );
  
      $captcha_verify = curl_init();
      curl_setopt($captcha_verify, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
      curl_setopt($captcha_verify, CURLOPT_POST, true);
      curl_setopt($captcha_verify, CURLOPT_POSTFIELDS, http_build_query($captcha_data));
      curl_setopt($captcha_verify, CURLOPT_SSL_VERIFYPEER, false);
      curl_setopt($captcha_verify, CURLOPT_RETURNTRANSFER, true);
      $captcha_response = curl_exec($captcha_verify); 
      $captcha_status = json_decode($captcha_response, true);
      if (empty($captcha_status['success'])) {
          // CAPTCHA validation failed
          $this->session->set_flashdata('error_message', 'CAPTCHA validation failed. Please try again.');  
          redirect(site_url('home'), 'refresh');
          return FALSE;
      }else {
        return TRUE;
      }
    }

    public function register() {

      $this->validate_captcha();
     
      $data['role_id'] = html_escape($this->input->post('role_id'));
      $data['first_name'] = html_escape($this->input->post('first_name'));
      $data['last_name']  = html_escape($this->input->post('last_name'));
      $data['email']  = html_escape($this->input->post('email'));
      $data['contact']  = html_escape($this->input->post('contact'));
      $data['password']  = sha1($this->input->post('password'));
      $data['reffered_by']  = html_escape($this->input->post('referral_code'));
      
      $verification_code =  md5(rand(100000000, 200000000));
      $data['verification_code'] = $verification_code;
      $data['status'] = 0;
      $data['wishlist'] = json_encode(array());
      $data['watch_history'] = json_encode(array());
      $data['date_added'] = strtotime(date("Y-m-d H:i:s"));
      $social_links = array(
            'facebook' => "",
            'twitter'  => "",
            'linkedin' => ""
      );
      $data['social_links'] = json_encode($social_links);
      //$data['role_id']  = (html_escape($this->input->post('usertype'))!='' ? html_escape($this->input->post('usertype')) : 2);
      
      // Add paypal keys
      $paypal_info = array();
      $paypal['production_client_id'] = "";
      array_push($paypal_info, $paypal);
      $data['paypal_keys'] = json_encode($paypal_info);
      // Add Stripe keys
      $stripe_info = array();
      $stripe_keys = array(
            'public_live_key' => "",
            'secret_live_key' => ""
      );
      array_push($stripe_info, $stripe_keys);
      $data['stripe_keys'] = json_encode($stripe_info);
      
      $validity = $this->user_model->check_duplication('on_create', $data['email']);
      if ($validity && $data['email']) {
        $user_id = $this->user_model->register_user($data);
        if($this->input->post('referral_code')){
          $this->crud_model->refDetail($this->input->post('referral_code'), $user_id);
        } 
        $this->email_model->send_email_verification_mail($data['email'], $verification_code);
        $this->session->set_flashdata('flash_message', get_phrase('your_registration_has_been_successfully_done').'. '.get_phrase('please_check_your_mail_inbox_to_verify_your_email_address').'.');

        /*
        if(!($this->IsNullOrEmptyString($this->input->post('teach_frm_enroll'))))
        { 
            if($this->input->post('teach_frm_enroll')=='1' && $data['role_id']=='3') {
            redirect(site_url('home'), 'refresh');
            }  
        }

        if(($this->uri->segment('3')=='premium' || $this->uri->segment('4')=='premium') && $data['role_id']=='3') {
          $this->session->set_userdata('teacher_login', '1');
          $this->session->set_userdata('user_id', $user_id);
          //set_cookie('user', md5($row->id.APP_KEY), '86400');
          $this->session->set_userdata('role_id', 3);
          $this->session->set_userdata('role', get_user_role('user_role', $user_id));
          $this->session->set_userdata('name', $data['first_name'].' '.$data['last_name']);
          redirect(site_url('teacher/becomepremium/'), 'refresh');
          //header("Location:" . site_url('teacher/becomepremium/')); 
        }  
        if ($this->session->userdata('last_page') == 'paymentReg'){
          $subcategory_id = $this->session->userdata('subcategory_id');
          $this->session->unset_userdata('paymentReg');
          $this->session->set_userdata('user_login', '1');
          $this->session->set_userdata('user_id', $user_id);
          //set_cookie('user', md5($row->id.APP_KEY), '86400');
          $this->session->set_userdata('role_id', 2);
          $this->session->set_userdata('role', get_user_role('user_role', $user_id));
          $this->session->set_userdata('name', $data['first_name'].' '.$data['last_name']);
          if($this->uri->segment('3')=='trial' || $this->uri->segment('4')=='trial') {
            header("Location:" . site_url('Checkout/trail/'.$subcategory_id)); 
          } else {
            header("Location:" . site_url('home/checkout/'.$subcategory_id)); 
          } 
          //header("Location:" . site_url('home/checkout/'.$subcategory_id)); 
        }
       */
      }else {
        $this->session->set_flashdata('error_message', get_phrase('verification_mail_already_sent._please_check_your_inbox.'));
      } 
      //redirect(site_url('home'), 'refresh');
      redirect(site_url('login'), 'refresh');
    }
    function IsNullOrEmptyString($str){
      return ($str === null || trim($str) === '');
   }
    public function logout($from = "") {
      //destroy sessions of specific userdata. We've done this for not removing the cart session
      $this->session_destroy();
      
      if ($from == "user")
      redirect(site_url('home'), 'refresh');
      else
      redirect(site_url('login'), 'refresh');
    }
    
    public function session_destroy() {
      $this->session->unset_userdata('user_id');
      delete_cookie('user');
      $this->session->unset_userdata('role_id');
      $this->session->unset_userdata('role');
      $this->session->unset_userdata('name');
      if ($this->session->userdata('admin_login') == 1) {
        $this->session->unset_userdata('admin_login');
      }else {
        $this->session->unset_userdata('user_login');
        $this->session->unset_userdata('teacher_login');
      }
      session_destroy();
    }
    
    function forgot_password($from = "") { //echo $from;
      $email = $this->input->post('email');
      //resetting user password here
      $new_password = substr( md5( rand(100000000,20000000000) ) , 0,7);
      
      // Checking credential for admin
      $query = $this->db->get_where('users' , array('email' => $email));
     // print_r($query->num_rows()); die();
      if ($query->num_rows() > 0)
      {
        $this->db->where('email' , $email);
        $this->db->update('users' , array('password' => sha1($new_password)));
        // send new password to user email
        $this->email_model->password_reset_email($new_password, $email);
        $this->session->set_flashdata('flash_message', get_phrase('please_check_your_email_for_new_password'));
        if ($from == 'backend') {
          redirect(site_url('login'), 'refresh');
          }else {
          redirect(site_url('home'), 'refresh');
        }
        }else {
        $this->session->set_flashdata('error_message', get_phrase('password_reset_failed'));
        if ($from == 'backend') {
          redirect(site_url('login'), 'refresh');
          }else {
          redirect(site_url('home'), 'refresh');
        }
      }
    }
    
    public function verify_email_address($verification_code = "") {
      $user_details = $this->db->get_where('users', array('verification_code' => $verification_code));
      if($user_details->num_rows() == 0) {
        $this->session->set_flashdata('error_message', get_phrase('verification_mail_already_sent._please_check_your_inbox.'));
        }else {
        $user_details = $user_details->row_array();
        $updater = array(
          'status' => 1
        );
        $this->db->where('id', $user_details['id']);
        $this->db->update('users', $updater);
        $this->session->set_flashdata('flash_message', get_phrase('congratulations').'!'.get_phrase('your_email_address_has_been_successfully_verified').'.');
      }
      redirect(site_url('home'), 'refresh');
    }

    public function testemail(){ 
      if($this->input->post('email')) {
        echo $to = $this->input->post('email') ? $this->input->post('email') : "visham.sharma@mailinator.com";
        $redirect_url = site_url('login/verify_email_address/');
        $subject    = "Verify Email Address";
        $email_msg  = "<b>Hello,</b>";
        $email_msg  .=  "<p>Please click the link below to verify your email address.</p>";
        echo $email_msg  .=  "<a href = ".$redirect_url." target = '_blank'>Verify Your Email Address</a>";
        echo $to;
        echo $this->email_model->send_smtp_mail($email_msg, $subject, $to);
      }
      echo '<form method="post"> <input type="email" name="email" required="required"/><input type="submit" value="Send Test Email"/></form>';
      
    }
  }
