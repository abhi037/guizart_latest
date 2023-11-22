<?php
  defined('BASEPATH') OR exit('No direct script access allowed');
  
  class User_model extends CI_Model {
    
    function __construct()
    {
      parent::__construct();
      /*cache control*/
      $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
      $this->output->set_header('Pragma: no-cache');
    }
    
    public function get_admin_details() {
      return $this->db->get_where('users', array('role_id' => 1));
    }
    
    public function get_user($user_id = 0, $role=2) {
      if ($user_id > 0) {
        $this->db->where('id', $user_id);
      }
      $this->db->where('role_id', $role);
      return $this->db->get('users');
    }
    
    public function get_all_user($user_id = 0) {
      $this->db->select('users.*, b.bank_name, b.user_name, b.account_number, b.ifsc, b.branch_address')
        ->from('users')
        ->join('bank_details b','b.user_id = users.id', 'left');
      if ($user_id > 0) {
        $this->db->where('users.id', $user_id);
      }
      return $this->db->get();
    }
    
    public function add_user() {
      $validity = $this->check_duplication('on_create', $this->input->post('email'));
      if ($validity == false && !$this->input->post('email')) {
        $this->session->set_flashdata('error_message', get_phrase('email_duplication'));
      }else {
        $data['first_name'] = html_escape($this->input->post('first_name'));
        $data['last_name'] = html_escape($this->input->post('last_name'));
        if($this->input->post('contact')) {
          $data['contact'] = html_escape($this->input->post('contact'));
        }
        $data['email'] = html_escape($this->input->post('email'));
        $data['password'] = sha1(html_escape($this->input->post('password')));
        $social_link['facebook'] = html_escape($this->input->post('facebook_link'));
        $social_link['twitter'] = html_escape($this->input->post('twitter_link'));
        $social_link['linkedin'] = html_escape($this->input->post('linkedin_link'));
        $data['social_links'] = json_encode($social_link);
        $data['biography'] = $this->input->post('biography');
        if($this->input->post('role')) {
          $data['role_id'] = html_escape($this->input->post('role'));
        } else {
          $data['role_id'] = 2;
        }
        
        $data['date_added'] = strtotime(date("Y-m-d H:i:s"));
        $data['wishlist'] = json_encode(array());
        $data['watch_history'] = json_encode(array());
        $data['status'] = 1;
        // Add paypal keys
        $paypal_info = array();
        $paypal['production_client_id'] = html_escape($this->input->post('paypal_client_id'));
        array_push($paypal_info, $paypal);
        $data['paypal_keys'] = json_encode($paypal_info);
        // Add Stripe keys
        $stripe_info = array();
        $stripe_keys = array(
          'public_live_key' => html_escape($this->input->post('stripe_public_key')),
          'secret_live_key' => html_escape($this->input->post('stripe_secret_key'))
        );
        array_push($stripe_info, $stripe_keys);
        $data['stripe_keys'] = json_encode($stripe_info);
        
        $this->db->insert('users', $data);
        $user_id = $this->db->insert_id();
        $bank = array();
        $bank['user_id'] = $user_id;
        $this->db->insert('bank_details', $bank);
        $this->upload_user_image($user_id);
        $this->session->set_flashdata('flash_message', get_phrase('user_added_successfully'));
      }
    }
    
    public function check_duplication($action = "", $email = "", $user_id = "") {
      $duplicate_email_check = $this->db->get_where('users', array('email' => $email));
      if ($action == 'on_create') {
        if ($duplicate_email_check->num_rows() > 0 && $email!='') {
          $duplicate_email_check = $this->db->get_where('users', array('email' => $email, 'status'=> 0));
          if($duplicate_email_check->num_rows() > 0) {
            $this->db->where(array('email' => $email, 'status'=> 0))->delete('users');
            return true;
          } else {
            return false;
          } 
        } else {
          return true;
        }
      }elseif ($action == 'on_update') {
        if ($duplicate_email_check->num_rows() > 0 && $email!='') {
          if ($duplicate_email_check->row()->id == $user_id) {
            return true;
            }else {
            return false;
          }
          }else {
          return true;
        }
      }
    }
    
    public function edit_user($user_id = "") { // Admin does this editing
      $validity = 1;
      if($this->input->post('email')) {
        $validity = $this->check_duplication('on_update', $this->input->post('email'), $user_id);
      }
      
      if ($validity) {
        $data['first_name'] = html_escape($this->input->post('first_name'));
        $data['last_name'] = html_escape($this->input->post('last_name'));
        
        if (isset($_POST['email']) && $this->input->post('email')) {
          $data['email'] = html_escape($this->input->post('email'));
          $data['password']  = SHA1(html_escape($this->input->post('password')));
        }
        if($this->input->post('contact')) {
          $data['contact'] = html_escape($this->input->post('contact'));
        }
        $social_link['facebook'] = html_escape($this->input->post('facebook_link'));
        $social_link['twitter'] = html_escape($this->input->post('twitter_link'));
        $social_link['linkedin'] = html_escape($this->input->post('linkedin_link'));
        $data['social_links'] = json_encode($social_link);
        $data['biography'] = $this->input->post('biography');
        $data['title'] = html_escape($this->input->post('title'));
        $data['last_modified'] = strtotime(date("Y-m-d H:i:s"));
        if($this->input->post('role')) {
          $data['role_id'] = html_escape($this->input->post('role'));
        }
        // Update paypal keys
        $paypal_info = array();
        $paypal['production_client_id'] = html_escape($this->input->post('paypal_client_id'));
        array_push($paypal_info, $paypal);
        $data['paypal_keys'] = json_encode($paypal_info);
        // Update Stripe keys
        $stripe_info = array();
        $stripe_keys = array(
          'public_live_key' => html_escape($this->input->post('stripe_public_key')),
          'secret_live_key' => html_escape($this->input->post('stripe_secret_key'))
        );
        array_push($stripe_info, $stripe_keys);
        $data['stripe_keys'] = json_encode($stripe_info);
        
        $this->db->where('id', $user_id);
        $this->db->update('users', $data);
        $this->upload_user_image($user_id);
        $this->session->set_flashdata('flash_message', get_phrase('user_update_successfully'));
      }else {
        $this->session->set_flashdata('error_message', get_phrase('email_duplication'));
      }
      
      $this->upload_user_image($user_id);
    }

    public function delete_user($user_id = "") {
      $this->db->where('id', $user_id);
      $this->db->delete('users');
      $this->session->set_flashdata('flash_message', get_phrase('user_deleted_successfully'));
    }
    
    public function unlock_screen_by_password($password = "") {
      $password = sha1($password);
      return $this->db->get_where('users', array('id' => $this->session->userdata('user_id'), 'password' => $password))->num_rows();
    }
    
    public function register_user($data) {
      $this->db->insert('users', $data);
      $user_id = $this->db->insert_id();
      $this->db->where('id', $user_id);
      $this->db->set('referral_code', 'CONCAT(\'QZRF\',FLOOR(100000 + (RAND() * 99999)))' , FALSE);
      $this->db->update('users');
      $bank = array();
      $bank['user_id'] = $user_id;
      $this->db->insert('bank_details', $bank);
      return $user_id;
    }
    
    public function my_courses() {
      return $this->db->get_where('enroll', array('user_id' => $this->session->userdata('user_id')));
    }
    
    public function upload_user_image($user_id) {
      if (isset($_FILES['user_image']) && $_FILES['user_image']['name'] != "") {
        move_uploaded_file($_FILES['user_image']['tmp_name'], 'uploads/user_image/'.$user_id.'.jpg');
        $this->session->set_flashdata('flash_message', get_phrase('user_update_successfully'));
      }
    }
    
    public function update_account_settings($user_id) {
      $validity = $this->check_duplication('on_update', $this->input->post('email'), $user_id);
      if ($validity) {
        if (!empty($_POST['current_password']) && !empty($_POST['new_password']) && !empty($_POST['confirm_password'])) {
          $user_details = $this->get_user($user_id)->row_array();
          
          $current_password = $this->input->post('current_password');
          $new_password = $this->input->post('new_password');
          $confirm_password = $this->input->post('confirm_password');
          if ($user_details['password'] == sha1($current_password) && $new_password == $confirm_password) {
            $data['password'] = sha1($new_password);
            }else {
            $this->session->set_flashdata('error_message', get_phrase('mismatch_password'));
            return;
          }
        }
        $data['contact'] = html_escape($this->input->post('contact'));
        $data['email'] = html_escape($this->input->post('email'));
        $this->db->where('id', $user_id);
        $this->db->update('users', $data);
        $this->session->set_flashdata('flash_message', get_phrase('updated_successfully'));
        }else {
        $this->session->set_flashdata('error_message', get_phrase('email_duplication'));
      }
    }
    
    public function change_password($user_id) {
      $data = array(); 
      if (!empty($_POST['current_password']) && !empty($_POST['new_password']) && !empty($_POST['confirm_password'])) {
        $user_details = $this->get_all_user($user_id)->row_array();
        $current_password = $this->input->post('current_password');
        $new_password = $this->input->post('new_password');
        $confirm_password = $this->input->post('confirm_password'); 
        if ($user_details['password'] == sha1($current_password) && $new_password == $confirm_password) {
          $data['password'] = sha1($new_password);
          }else {
          $this->session->set_flashdata('error_message', get_phrase('mismatch_password'));
          return;
        }
      }
      
      $this->db->where('id', $user_id);
      $this->db->update('users', $data);
      $this->session->set_flashdata('flash_message', get_phrase('password_updated'));
    }
    
    
    public function get_instructor($id = 0) {
      if ($id > 0) {
        return $this->db->get_all_user($id);
        }else {
        if ($this->check_if_instructor_exists()) {
          $this->db->select('user_id');
          $this->db->distinct('user_id');
          $query_result =  $this->db->get('course');
          $ids = array();
          foreach ($query_result->result_array() as $query) {
            if ($query['user_id']) {
              array_push($ids, $query['user_id']);
            }
          }
          
          $this->db->where_in('id', $ids);
          return $this->db->get('users')->result_array();
        }
        else {
          return array();
        }
      }
    }
    
    public function check_if_instructor_exists() {
      $this->db->where('user_id >', 0);
      $result = $this->db->get('course')->num_rows();
      if ($result > 0) {
        return true;
        }else {
        return false;
      }
    }
    
    public function get_user_image_url($user_id) {
      
      if (file_exists('uploads/user_image/'.$user_id.'.jpg'))
      return base_url().'uploads/user_image/'.$user_id.'.jpg';
      else
            return base_url().'uploads/user_image/placeholder.png';
    }
    public function get_instructor_list() {
      $query1 = $this->db->get_where('course', array('status' => 'active'))->result_array();
      $instructor_ids = array();
      foreach ($query1 as $row1) {
        if (!in_array($row1['user_id'], $instructor_ids) && $row1['user_id'] != "") {
          array_push($instructor_ids, $row1['user_id']);
        }
      }
      $this->db->where_in('id', $instructor_ids);
      $query_result = $this->db->get('users');
      return $query_result;
    }
    
    public function update_instructor_payment_settings($user_id = '') {
      // Update paypal keys
      $paypal_info = array();
      $paypal['production_client_id'] = html_escape($this->input->post('paypal_client_id'));
      array_push($paypal_info, $paypal);
      $data['paypal_keys'] = json_encode($paypal_info);
      // Update Stripe keys
      $stripe_info = array();
      $stripe_keys = array(
            'public_live_key' => html_escape($this->input->post('stripe_public_key')),
            'secret_live_key' => html_escape($this->input->post('stripe_secret_key'))
      );
      array_push($stripe_info, $stripe_keys);
      $data['stripe_keys'] = json_encode($stripe_info);
      
      $this->db->where('id', $user_id);
      $this->db->update('users', $data);
    }
    
    public function get_user_with_enroll_history(){
      $this->db->select('users.*, b.user_name, b.bank_name,b.account_number,b.ifsc,b.branch_address, u1.referral_code as refered_by_code ,u1.email as refered_by_email ,group_concat(category.name) as sub_category');
      $this->db->join('enroll', 'users.id=enroll.user_id', 'left');
      $this->db->join('category', 'category.id=enroll.sub_category_id');
      $this->db->join('bank_details b', 'b.user_id=users.id');
      $this->db->join('users u1', 'u1.referral_code =users.reffered_by','LEFT');
      $this->db->group_by('users.id');
      $this->db->where('users.role_id', 2);
      return $this->db->get('users');
    }

    public function get_employee(){
      $this->db->select('users.*, b.user_name, b.bank_name,b.account_number,b.ifsc,b.branch_address, u1.referral_code as refered_by_code ,u1.email as refered_by_email , group_concat(category.name) as sub_category, r.name AS role_name');
      $this->db->join('enroll', 'users.id=enroll.user_id', 'left')
        ->join('role r', 'r.id=users.role_id', 'left')
        ->join('category', 'category.id=enroll.sub_category_id', 'left')
        ->join('bank_details b', 'b.user_id=users.id', 'left')
        ->join('users u1', 'u1.referral_code =users.reffered_by', 'left')
        ->group_by('users.id');
      $this->db->where('users.role_id !=', 2);
      return $this->db->get('users');
    }
    
    function change_user_status()
    {
      $id = $this->input->post('id',true);
      
      $query = $this->db->select('status')
      ->from('users')
      ->where('id',$id)
      ->get();
      if($query->row()->status == 0)
      {
        $obj = array('status'=>1);
      }
      else
      {
        $obj = array('status'=>0);
      }
      
      $this->db->where('id',$id);
      $this->db->update('users',$obj);
      
      if($this->db->affected_rows()>0)
      {
        $output = array('result'=>true,'message'=>'Status Change Successfully');
        return $output;
      }
      
    }
    
    function get_enroll_list()
    {
      $query = $this->db->select("c.name as category_name,CONCAT(u.first_name,' ',u.last_name) as user_name, u.email")
      ->from('enroll e')
      ->join('category c','c.id = e.sub_category_id')
      ->join('users u','u.id = e.user_id')
      ->get();
      return $query->result();
    }
    
    function get_attempted_list()
    {
      $today = date('Y-m-d'); 
      
      $query = $this->db->select("q.quiz_id,CONCAT(u.first_name,' ',u.last_name) as user_name, u.email, q.submitted_time,q1.sub_category_id,c.name as category_name")
      ->from('quiz_result q')
      ->join('users u','u.id = q.student_id')
      ->join('quiz q1','q1.id = q.quiz_id')
      ->join('category c','c.id = q1.sub_category_id')
      ->where('date(submitted_time)',$today)
      
      ->get();
      return $query->result();
    }
    
    function get_total_question()
    {
      $sql="SELECT c.name as category_name ,e.subject_id,s.name as subject_name, COUNT(q.question) as total_question FROM `category` c 
            JOIN exam_pattern e ON c.id = e.sub_category_id
            JOIN subject s ON s.id = e.subject_id
            JOIN questions q on q.subject_id = s.id
            GROUP BY c.id,s.id";
      
      $query = $this->db->select("s.name as subject_name, COUNT(q.question) as total_question")
      ->from('subject s')
      ->join('questions q','q.subject_id = s.id')
      ->group_by('s.id')
      ->get();
      return $query->result();
    }

    public function get_role($param1='') {
      $this->db->select('role.*');
      if($param1!='') {
        $this->db->where('id', $param1);
      } 
      $data = $this->db->get('role');
      return $data;
    }

    public function userpermission() {
      $data = $this->db->group_by('permission')->get('user_permissions');
      return $data;
    }

    public function add_role() {
      $roledata=[ 
        'name'=>html_escape($this->input->post('name')),
        'date_added'=>strtotime(date("Y-m-d H:i:s")),
        'last_modified'=>strtotime(date("Y-m-d H:i:s")),
      ];
      $this->db->insert('role', $roledata);
      $last_id = $this->db->insert_id(); 
      $acl=array();
      if(!empty($this->input->post('permission'))) {
        foreach ($this->input->post('permission') as $key => $value) {
          $acl[]=[
            'role_id'=>$last_id,
            'permission_id'=>$value
          ];
        }
      }
      
      $this->db->delete('user_acl', array('role_id'=>$last_id));
      $this->db->insert_batch('user_acl', $acl); 
    }

    public function update_role($param1='') {
      $roledata=[ 
        'name'=>html_escape($this->input->post('name')), 
        'last_modified'=>strtotime(date("Y-m-d H:i:s")),
      ];
      $this->db->where('id', $param1);
      $this->db->update('role', $roledata); 
      $acl=array();
      if(!empty($this->input->post('permission'))) {
        foreach ($this->input->post('permission') as $key => $value) {
          $acl[]=[
            'role_id'=>$param1,
            'permission_id'=>$value
          ];
        }
      }
      
      $this->db->delete('user_acl', array('role_id'=>$param1));
      $this->db->insert_batch('user_acl', $acl); 
    }

    public function delete_role($param1='') {
      $this->db->where('id', $param1);
      $this->db->delete('role');
      $this->db->delete('user_acl', array('role_id'=>$param1));
    }

    public function getAcl($param1='') {
      if($param1!='') {
        $this->db->where('role_id', $param1);
      }
      $data = $this->db->get('user_acl');
      return $data;
    }

    public function GetAccess($url='', $role='') {
      $this->db->select('user_acl.*, user_permissions.action')
        ->from('user_acl')
        ->join('user_permissions', 'user_acl.permission_id=user_permissions.id');
      if($url!='') {
        $this->db->where('user_permissions.action', $url);
      }
      
      if($role!='') {
        $this->db->where('user_acl.role_id', $role);
      }
      return $this->db->get();
    }

    public function updatePremium(){
      $data = array('is_premium'=>1, 'status'=>1);
      $this->db->where('id', $this->session->userdata('user_id'));
      $this->db->update('users', $data);
    }

    public function contributor_report(){
      $data = $this->db->select("SUM(1) AS total, SUM(IF(q.status=0, 1, 0)) AS sent, SUM(IF(q.status=1, 1, 0)) AS approve, SUM(IF(q.status=2, 1, 0)) AS rejected, SUM(IF(q.status=3, 1, 0)) AS pending, CONCAT(u.first_name, ' ', u.last_name) AS username, s.name AS subject_name, DATE_FORMAT(q.created_at, '%M, %Y') AS month")
        ->join('users AS u', 'u.id=q.userID AND u.role_id=3')
        ->join('subject AS s', 's.id=q.subject_id')
        ->group_by("q.subject_id, q.userID, DATE_FORMAT(q.created_at, '%M, %Y')")
        ->get('questions AS q');
      return $data;
    }

    public function daily_score($param1='0') {
      $data = $this->db->query("SELECT DATE_FORMAT(`submitted_time`, '%d-%m') AS submitted_time, IFNULL(SUM(`marks_obt`), 0) AS marks FROM `quiz_result` WHERE `student_id`='". $param1 ."' AND DATE(`submitted_time`) BETWEEN date(DATE_SUB(NOW(), INTERVAL 15 DAY)) AND date(NOW()) GROUP BY DATE(`submitted_time`)");
      return $data->result_array();
    }

  }
