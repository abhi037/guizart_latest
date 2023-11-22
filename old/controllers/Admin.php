<?php
  defined('BASEPATH') OR exit('No direct script access allowed');
  
  class Admin extends CI_Controller {
    public function __construct()
    {
      parent::__construct();
      
      $this->load->database();
      $this->load->library('session');
      /*cache control*/
      $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
      $this->output->set_header('Pragma: no-cache');
      
      $this->load->library('CKEditor');
      $this->load->library('CKFinder');
      $this->ckeditor->basePath = base_url().'assets/ckeditor/'; 
      
      if ($this->session->userdata('admin_login')) { 
        if($this->session->userdata('role_id') > 3) {
          $isaaceable=$this->user_model->GetAccess($this->input->server('REDIRECT_QUERY_STRING'), $this->session->userdata('role_id'));
          if($isaaceable->num_rows() <=0) {
            redirect(site_url('login'), 'refresh');
          } 
        }
      }else{
        redirect(site_url('login'), 'refresh');
      }
    }
    
    public function index() {
      $this->dashboard();
    }
    
    public function export_database() {
      $this->load->dbutil();
      
      // Backup your entire database and assign it to a variable
      $backup = $this->dbutil->backup();
      
      // Load the file helper and write the file to your server
      $this->load->helper('file');
      //write_file('/path/to/mybackup.gz', $backup);
      $dbname = 'crndb-on-' . date("Y-m-d-H-i-s") . '.zip';
      // Load the download helper and send the file to your desktop
      $this->load->helper('download');
      force_download($dbname, $backup);
    }
    
    public function dashboard() { 
      $this->session->set_userdata('last_page', 'dashboard');
      $page_data['page_name'] = 'dashboard';
      $page_data['page_title'] = get_phrase('dashboard');
      $page_data['course_wise'] = $this->crud_model->get_course_wise_students();
      $categories = $this->crud_model->get_sub_categories()->result_array();
      $attempted = $this->crud_model->last_day_attempted_quiz();
      $attempted_ids = array_column($attempted, 'id');
      $new_enroll = $this->crud_model->get_course_wise_students(7);
      $new_ids = array_column($new_enroll, 'id');
      foreach($categories as $cat){
        $key = array_search($cat['id'], $attempted_ids);
        $key1 = array_search($cat['id'], $new_ids);
        if($key1 !== false){
          $page_data['new_enroll'][]= array_merge($cat, $new_enroll[$key1]);
          }else{
          $page_data['new_enroll'][]= $cat;
        }
        if($key !== false){
          $page_data['attempted'][]= array_merge($cat, $attempted[$key]);
          }else{
          $page_data['attempted'][]= $cat;
        }
      }
      $this->load->view('backend/index.php', $page_data);
    }
    
    public function blank_template() { 
      $this->session->set_userdata('last_page', 'blank_template');
      $page_data['page_name'] = 'blank_template';
      $this->load->view('backend/index.php', $page_data);
    }
    
    public function lockscreen($status = "") {  
      if ($status == "lock") {
        $this->load->view('backend/admin/lockscreen.php');
        }else if($status == "unlock") {
        if ($this->user_model->unlock_screen_by_password($this->input->post('password'))) {
          redirect(site_url('admin/dashboard'), 'refresh');
          }else {
          $this->session->set_flashdata('error_message',get_phrase('invalid_password'));
          redirect(site_url('admin/lockscreen/lock'), 'refresh');
        }
      }
    }
    
    public function categories($param1 = "", $param2 = "") { 
      $this->session->set_userdata('last_page', 'categories');
      if ($param1 == 'add') {
        $this->crud_model->add_category();
        $this->session->set_flashdata('flash_message', get_phrase('data_added_successfully'));
        redirect(site_url('admin/categories'), 'refresh');
      }
      elseif ($param1 == "edit") {
        $this->crud_model->edit_category($param2);
        $this->session->set_flashdata('flash_message', get_phrase('data_updated_successfully'));
        redirect(site_url('admin/categories'), 'refresh');
      }
      elseif ($param1 == "delete") {
        $res = $this->crud_model->delete_category($param2);
        if($res){
          $this->session->set_flashdata('flash_message', get_phrase('data_deleted'));
          }else{
          $this->session->set_flashdata('error_message',get_phrase('cannot delete data'));
        }
        redirect(site_url('admin/categories'), 'refresh');
      }
      $page_data['page_name'] = 'categories';
      $page_data['page_title'] = get_phrase('categories');
      $page_data['categories'] = $this->crud_model->get_categories($param2);
      $this->load->view('backend/index', $page_data);
    }
    
    public function category_form($param1 = "", $param2 = "") { 
      if ($param1 == "add_category") {
        $page_data['page_name'] = 'category_add';
        $page_data['page_title'] = get_phrase('add_category');
      }
      if ($param1 == "edit_category") {
        $page_data['page_name'] = 'category_edit';
        $page_data['page_title'] = get_phrase('edit_category');
        $page_data['category_id'] = $param2;
      }
      
      $this->load->view('backend/index', $page_data);
    }
    public function sub_categories($selected_category_id = 0, $action = "", $sub_category_id = "") { 
      $this->session->set_userdata('last_page', 'sub_categories');
      if ($action == 'add') {
        if ($_FILES['image_name'] != "") {
          $ext = pathinfo($_FILES['image_name']['name'], PATHINFO_EXTENSION);
          move_uploaded_file($_FILES['image_name']['tmp_name'], 'uploads/subcategory/'.time().'.'.$ext);
          $config['image_library'] = 'gd2';
          $config['source_image'] = 'uploads/subcategory/'.time().'.'.$ext;
          $config['create_thumb'] = TRUE;
          $config['maintain_ratio'] = TRUE;
          $config['width']         = 300;
          $config['height']       = 300;
          $this->load->library('image_lib', $config);
          $this->image_lib->resize();
          $data['image_name'] = time().'_thumb.'.$ext;
        }
        
        $data['code']       = html_escape($this->input->post('code'));
        $data['name']       = html_escape($this->input->post('name'));
        $data['parent']     = html_escape($this->input->post('category_id'));
        $data['price']      = html_escape($this->input->post('price'));
        $data['half_price']      = html_escape($this->input->post('half_price'));
        $data['quart_price']      = html_escape($this->input->post('quart_price'));
        $data['description']      = urlencode($this->input->post('desc'));
        $data['rules']      = html_escape($this->input->post('rules'));
        $data['date_added'] = strtotime(date('D, d-M-Y'));
        
        
        $this->crud_model->add_sub_category($data);
        $this->session->set_flashdata('flash_message', get_phrase('data_added_successfully'));
        redirect(site_url('admin/sub_categories/'.$this->input->post('category_id')), 'refresh');
      }
      elseif ($action == 'edit') {
        if ($_FILES['image_name'] != "" && $_FILES['image_name']['name']!='') {
          $ext = pathinfo($_FILES['image_name']['name'], PATHINFO_EXTENSION);
          move_uploaded_file($_FILES['image_name']['tmp_name'], 'uploads/subcategory/'.time().'.'.$ext);
          $config['image_library'] = 'gd2';
          $config['source_image'] = 'uploads/subcategory/'.time().'.'.$ext;
          $config['create_thumb'] = TRUE;
          $config['maintain_ratio'] = TRUE;
          $config['width']         = 300;
          $config['height']       = 300;
          $this->load->library('image_lib', $config);
          $this->image_lib->resize();
          $data['image_name'] = time().'_thumb.'.$ext;
        }
        $data['code']       = html_escape($this->input->post('code'));
        $data['name']       = html_escape($this->input->post('name'));
        $data['parent']     = html_escape($this->input->post('category_id'));
        $data['price']      = html_escape($this->input->post('price'));
        $data['half_price']      = html_escape($this->input->post('half_price'));
        $data['quart_price']      = html_escape($this->input->post('quart_price'));
        $data['description']      = urlencode($this->input->post('desc'));
        $data['rules']      = html_escape($this->input->post('rules'));
        $data['last_modified'] = strtotime(date('D, d-M-Y'));
        $this->crud_model->edit_sub_category($sub_category_id, $data);
        $this->session->set_flashdata('flash_message', get_phrase('data_updated_successfully'));
        redirect(site_url('admin/sub_categories/'.$this->input->post('category_id')), 'refresh');
      }
      elseif ($action == 'delete') {
        $res= $this->crud_model->delete_category($sub_category_id);
        if($res){
          $this->session->set_flashdata('flash_message', get_phrase('data_deleted'));
          }else{
          $this->session->set_flashdata('error_message',get_phrase('cannot delete data'));
        }
        $this->session->set_flashdata('flash_message', get_phrase('data_deleted'));
        redirect(site_url('admin/sub_categories/'.$selected_category_id), 'refresh');
      }
      $page_data['page_name'] = 'sub_categories';
      $page_data['page_title'] = get_phrase('sub_categories');
      $page_data['selected_category_id']  = $selected_category_id;
      $page_data['sub_categories'] = $this->crud_model->get_sub_categories();
      $this->load->view('backend/index', $page_data);
    }
    
    public function sub_categories_by_category_id($category_id = 0) {
      $category_id = $this->input->post('category_id');
      redirect(site_url("admin/sub_categories/$category_id"), 'refresh');
    }
    
    public function sub_category_form($param1 = "", $param2 = "") {
      if ($param1 == 'add_sub_category') {
        $page_data['page_name'] = 'sub_category_add';
        $page_data['page_title'] = get_phrase('add_sub_category');
        $page_data['sub_category_id'] = $param2;
      }
      elseif ($param1 == 'edit_sub_category') {
        $page_data['page_name'] = 'sub_category_edit';
        $page_data['page_title'] = get_phrase('edit_sub_category');
        $page_data['sub_category_id'] = $param2;
        $page_data['data'] = $this->crud_model->getRow('category', array('id' => $param2));
      }
      $page_data['categories'] = $this->crud_model->get_categories();
      $this->load->view('backend/index', $page_data);
    }
    
    public function users($param1 = "", $param2 = "") {
      if ($param1 == "add") {
        $this->user_model->add_user();
        redirect(site_url('admin/users'), 'refresh');
      }
      elseif ($param1 == "edit") {
        $this->user_model->edit_user($param2);
        redirect(site_url('admin/users'), 'refresh');
      }
      elseif ($param1 == "delete") {
        $this->user_model->delete_user($param2);
        redirect(site_url('admin/users'), 'refresh');
      }
      
      $this->session->set_userdata('last_page', 'users');
      $page_data['page_name'] = 'users';
      $page_data['page_title'] = get_phrase('student');
      $page_data['users'] = $this->user_model->get_user_with_enroll_history($param2);
      $this->load->view('backend/index', $page_data);
    }
    
    public function user_form($param1 = "", $param2 = "") {
      if ($param1 == 'add_user_form') {
        $page_data['page_name'] = 'user_add';
        $page_data['page_title'] = get_phrase('student_add');
        $this->load->view('backend/index', $page_data);
      }
      elseif ($param1 == 'edit_user_form') {
        $page_data['page_name'] = 'user_edit';
        $page_data['user_id'] = $param2;
        $page_data['page_title'] = get_phrase('student_edit');
        $this->load->view('backend/index', $page_data);
      }
    }
    
    public function enroll_history($param1 = "") { 
      if ($param1 != "") {
        $date_range                   = $this->input->post('date_range');
        $date_range                   = explode(" - ", $date_range);
        $page_data['timestamp_start'] = date("Y-m-d", strtotime($date_range[0]));
        $page_data['timestamp_end']   = date("Y-m-d", strtotime($date_range[1]));
        }else {
        $page_data['timestamp_start'] = date("Y-m-d", strtotime('-29 days', time()));
        $page_data['timestamp_end']   = date("Y-m-d");
      }
      $this->session->set_userdata('last_page', 'enroll_history');
      $page_data['page_name'] = 'enroll_history';
      $page_data['enroll_history'] = $this->crud_model->enroll_history_by_date_range($page_data['timestamp_start'], $page_data['timestamp_end']);
      $page_data['page_title'] = get_phrase('enroll_history');
      $this->load->view('backend/index', $page_data);
    }
    
    public function enroll_student($param1 = "") {
      if ($param1 == 'enroll') {
        $this->crud_model->enroll_a_student_manually();
        redirect(site_url('admin/enroll_history'), 'refresh');
      }
      $this->session->set_userdata('last_page', 'enroll_student');
      $page_data['page_name'] = 'enroll_student';
      $page_data['page_title'] = get_phrase('enroll_a_student');
      $this->load->view('backend/index', $page_data);
    }
    public function admin_revenue($param1 = "") { 
      if ($param1 != "") {
        $date_range                   = $this->input->post('date_range');
        $date_range                   = explode(" - ", $date_range);
        $page_data['timestamp_start'] = strtotime($date_range[0]);
        $page_data['timestamp_end']   = strtotime($date_range[1]);
        }else {
        $page_data['timestamp_start'] = strtotime('-29 days', time());
        $page_data['timestamp_end']   = strtotime(date("m/d/Y"));
      }
      
      $this->session->set_userdata('last_page', 'admin_revenue');
      $page_data['page_name'] = 'admin_revenue';
      $page_data['enroll_history'] = $this->crud_model->get_revenue_by_user_type($page_data['timestamp_start'], $page_data['timestamp_end'], 'admin_revenue');
      $page_data['page_title'] = get_phrase('admin_revenue');
      $page_data['record'] = $this->crud_model->get_admin_revenue();
      $this->load->view('backend/index', $page_data);
    }
    
    public function instructor_revenue($param1 = "") { 
      if ($param1 != "") {
        $date_range                   = $this->input->post('date_range');
        $date_range                   = explode(" - ", $date_range);
        $page_data['timestamp_start'] = strtotime($date_range[0]);
        $page_data['timestamp_end']   = strtotime($date_range[1]);
        }else {
        $page_data['timestamp_start'] = strtotime('-29 days', time());
        $page_data['timestamp_end']   = strtotime(date("m/d/Y"));
      }
      $this->session->set_userdata('last_page', 'instructor_revenue');
      $page_data['page_name'] = 'instructor_revenue';
      $page_data['enroll_history'] = $this->crud_model->get_revenue_by_user_type($page_data['timestamp_start'], $page_data['timestamp_end'], 'instructor_revenue');
      $page_data['page_title'] = get_phrase('instructor_revenue');
      $this->load->view('backend/index', $page_data);
    }
    
    public function enroll_history_delete($param1 = "") { 
      $this->crud_model->delete_enroll_history($param1);
      $this->session->set_flashdata('flash_message', get_phrase('data_deleted_successfully'));
      redirect(site_url('admin/enroll_history'), 'refresh');
    }
    
    public function purchase_history() { 
      $this->session->set_userdata('last_page', 'purchase_history');
      $page_data['page_name'] = 'purchase_history';
      $page_data['purchase_history'] = $this->crud_model->purchase_history();
      $page_data['page_title'] = get_phrase('purchase_history');
      $this->load->view('backend/index', $page_data);
    }
    
    public function system_settings($param1 = "") { 
      if ($param1 == 'system_update') {
        $this->crud_model->update_system_settings();
        $this->session->set_flashdata('flash_message', get_phrase('system_settings_updated'));
        redirect(site_url('admin/system_settings'), 'refresh');
      }
      
      if ($param1 == 'logo_upload') {
        move_uploaded_file($_FILES['logo']['tmp_name'], 'assets/backend/logo.png');
        $this->session->set_flashdata('flash_message', get_phrase('backend_logo_updated'));
        redirect(site_url('admin/system_settings'), 'refresh');
      }
      
      if ($param1 == 'favicon_upload') {
        move_uploaded_file($_FILES['favicon']['tmp_name'], 'assets/favicon.png');
        $this->session->set_flashdata('flash_message', get_phrase('favicon_updated'));
        redirect(site_url('admin/system_settings'), 'refresh');
      }
      
      $this->session->set_userdata('last_page', 'system_settings');
      $page_data['page_name'] = 'system_settings';
      $page_data['page_title'] = get_phrase('system_settings');
      $this->load->view('backend/index', $page_data);
    }
    
    public function frontend_settings($param1 = "") { 
      if ($param1 == 'frontend_update') {
        $this->crud_model->update_frontend_settings();
        $this->session->set_flashdata('flash_message', get_phrase('frontend_settings_updated'));
        redirect(site_url('admin/frontend_settings'), 'refresh');
      }
      
      if ($param1 == 'banner_image_update') {
        $this->crud_model->update_frontend_banner();
        $this->session->set_flashdata('flash_message', get_phrase('banner_image_update'));
        redirect(site_url('admin/frontend_settings'), 'refresh');
      }
      
      if ($param1 == 'logo_upload') {
        move_uploaded_file($_FILES['logo']['tmp_name'], 'assets/frontend/img/logo.png');
        $this->session->set_flashdata('flash_message', get_phrase('frontend_logo_updated'));
        redirect(site_url('admin/frontend_settings'), 'refresh');
      }
      
      $this->session->set_userdata('last_page', 'frontend_settings');
      $page_data['page_name'] = 'frontend_settings';
      $page_data['page_title'] = get_phrase('frontend_settings');
      $this->load->view('backend/index', $page_data);
    }
    public function payment_settings($param1 = "") { 
      if ($param1 == 'update') {
        $this->crud_model->update_payment_settings();
        redirect(site_url('admin/payment_settings'), 'refresh');
      }
      $this->session->set_userdata('last_page', 'payment_settings');
      $page_data['page_name'] = 'payment_settings';
      $page_data['page_title'] = get_phrase('payment_settings');
      $this->load->view('backend/index', $page_data);
    }
    
    public function smtp_settings($param1 = "") { 
      if ($param1 == 'update') {
        $this->crud_model->update_smtp_settings();
        $this->session->set_flashdata('flash_message', get_phrase('smtp_settings_updated_successfully'));
        redirect(site_url('admin/smtp_settings'), 'refresh');
      }
      $this->session->set_userdata('last_page', 'smtp_settings');
      $page_data['page_name'] = 'smtp_settings';
      $page_data['page_title'] = get_phrase('smtp_settings');
      $this->load->view('backend/index', $page_data);
    }
    
    public function instructor_settings($param1 = "") { 
      if ($param1 == 'update') {
        $this->crud_model->update_instructor_settings();
        $this->session->set_flashdata('flash_message', get_phrase('instructor_settings_updated'));
        redirect(site_url('admin/instructor_settings'), 'refresh');
      }
      $this->session->set_userdata('last_page', 'instructor_settings');
      $page_data['page_name'] = 'instructor_settings';
      $page_data['page_title'] = get_phrase('instructor_settings');
      $this->load->view('backend/index', $page_data);
    }
    
    public function courses($default_category_id = "", $default_sub_category_id = "", $default_instructor_id = "") { 
      $this->session->set_userdata('last_page', 'courses');
      $page_data['page_name'] = 'courses';
      $page_data['categories'] = $this->crud_model->get_categories();
      if (isset($_POST['category_id']) && isset($_POST['sub_category_id'])) {
        
        $page_data['default_category_id'] = $this->input->post('category_id');
        $page_data['default_sub_category_id'] = $this->input->post('sub_category_id');
        
        if (isset($_POST['instructor_id'])) {
          $page_data['default_instructor_id'] = $this->input->post('instructor_id');
          }else {
          $page_data['default_instructor_id'] = "";
        }
        redirect(site_url('admin/courses/'.$this->input->post('category_id').'/'.$this->input->post('sub_category_id').'/'.$page_data['default_instructor_id']));
        }else {
        if($default_category_id == "" && $default_sub_category_id == ""){
          $page_data['default_category_id'] = $this->crud_model->get_default_category_id();
          $page_data['default_sub_category_id'] = $this->crud_model->get_default_sub_category_id($page_data['default_category_id']);
          }else {
          $page_data['default_category_id'] = $default_category_id;
          $page_data['default_sub_category_id'] = $default_sub_category_id;
        }
        
        if ($default_instructor_id == "")
        $page_data['default_instructor_id'] = "";
        else
        $page_data['default_instructor_id'] = $default_instructor_id;
      }
      
      $page_data['page_title'] = get_phrase('active_courses');
      $this->load->view('backend/index', $page_data);
    }
    
    public function pending_courses() { 
      $this->session->set_userdata('last_page', 'pending_courses');
      $page_data['page_name'] = 'pending_courses';
      $page_data['page_title'] = get_phrase('pending_courses');
      $this->load->view('backend/index', $page_data);
    }
    
    public function course_actions($param1 = "", $param2 = "") { 
      if ($param1 == "add") {
        $this->crud_model->add_course();
        redirect(site_url('admin/courses'), 'refresh');
        
      }
      elseif ($param1 == "edit") {
        $this->crud_model->update_course($param2);
        redirect(site_url('admin/courses'), 'refresh');
        
      }
      elseif ($param1 == 'delete') {
        $this->crud_model->delete_course($param2);
        redirect(site_url('admin/courses'), 'refresh');
      }
      elseif ($param1 == 'view_details') {
        $page_data['page_name'] = 'course_details';
        $page_data['page_title'] = get_phrase('course_details');
        $page_data['course_details'] = $this->crud_model->get_course_by_id($param2)->row_array();
        $this->load->view('backend/index', $page_data);
      }
    }
    
    
    public function course_form($param1 = "", $param2 = "") { 
      if ($param1 == 'add_course') {
        $page_data['page_name'] = 'course_add';
        $page_data['page_title'] = get_phrase('add_course');
        $this->load->view('backend/index', $page_data);
        
        }elseif ($param1 == 'course_edit') {
        $page_data['page_name'] = 'course_edit';
        $page_data['course_id'] =  $param2;
        $page_data['page_title'] = get_phrase('edit_course');
        $this->load->view('backend/index', $page_data);
        
      }
    }
    
    public function change_course_status($status = "") {
      $course_id               = $this->input->post('course_id');
      $default_category_id     = $this->input->post('default_category_id');
      $default_sub_category_id = $this->input->post('default_sub_category_id');
      if (isset($_POST['mail_subject']) && isset($_POST['mail_body'])) {
        $mail_subject = $this->input->post('mail_subject');
        $mail_body = $this->input->post('mail_body');
        $this->email_model->send_mail_on_course_status_changing($course_id, $mail_subject, $mail_body);
      }
      $this->crud_model->change_course_status($status, $course_id);
      $this->session->set_flashdata('flash_message', get_phrase('course_status_updated'));
      redirect(site_url('admin/courses/'.$default_category_id.'/'.$default_sub_category_id), 'refresh');
    }
    
    public function change_course_status_for_admin($status = "", $course_id = "") {
      $this->crud_model->change_course_status($status, $course_id);
      $this->session->set_flashdata('flash_message', get_phrase('course_status_updated'));
      if ($status == 'active') {
        redirect(site_url('admin/pending_courses'), 'refresh');
        }else {
        redirect(site_url('admin/courses'), 'refresh');
      }
    }
    
    public function sections($param1 = "", $param2 = "", $param3 = "") { 
      if ($param2 == 'add') {
        $this->crud_model->add_section($param1);
        redirect(site_url('admin/sections/'.$param1));
      }
      elseif ($param2 == 'edit') {
        $this->crud_model->edit_section($param3);
        redirect(site_url('admin/sections/'.$param1));
      }
      elseif ($param2 == 'delete') {
        $this->crud_model->delete_section($param1, $param3);
        redirect(site_url('admin/sections/'.$param1));
      }
      
      $page_data['page_name'] = 'sections';
      $page_data['course_id'] = $param1;
      $page_data['page_title'] = get_phrase('manage_sections');
      $this->load->view('backend/index', $page_data);
    }
    
    public function serialize_section($course_id = "", $action = "") { 
      if ($action == "serialize") {
        $container = array();
        $serialization = json_decode($this->input->post('serialization'));
        foreach ($serialization as $key) {
          array_push($container, $key->id);
        }
        $json = json_encode($container);
        $this->crud_model->serialize_section($course_id, $json);
        $this->session->set_flashdata('flash_message', get_phrase('sections_have_been_serialized'));
        redirect(site_url("admin/serialize_section/$course_id"));
      }
      
      $page_data['page_name'] = 'serialize_section';
      $page_data['course_id'] = $course_id;
      $page_data['page_title'] = get_phrase('serialize_section');
      $this->load->view('backend/index', $page_data);
    }
    
    public function section_form($param1 = "", $param2 = "", $param3 = "") { 
      if ($param1 == 'add_section') {
        
        $page_data['course_id'] = $param2;
        $page_data['page_name'] = 'section_add';
        $page_data['page_title'] = get_phrase('add_section');
        $this->load->view('backend/index', $page_data);
      }
      elseif ($param1 == 'edit_section') {
        
        $page_data['course_id'] = $param3;
        $page_data['section_id'] = $param2;
        $page_data['page_name'] = 'section_edit';
        $page_data['page_title'] = get_phrase('edit_section');
        $this->load->view('backend/index', $page_data);
      }
    }
    
    public function lessons($course_id = "", $param1 = "", $param2 = "") { 
      if ($param1 == 'add') {
        $this->crud_model->add_lesson();
        redirect('admin/lessons/'.$course_id);
      }
      elseif ($param1 == 'edit') {
        $this->crud_model->edit_lesson($param2);
        redirect('admin/lessons/'.$course_id);
      }
      elseif ($param1 == 'delete') {
        $this->crud_model->delete_lesson($param2);
        redirect('admin/lessons/'.$course_id);
      }
      elseif ($param1 == 'filter') {
        redirect('admin/lessons/'.$this->input->post('course_id'));
      }
      $page_data['page_name'] = 'lessons';
      $page_data['lessons'] = $this->crud_model->get_lessons('course', $course_id);
      $page_data['course_id'] = $course_id;
      $page_data['page_title'] = get_phrase('lessons');
      $this->load->view('backend/index', $page_data);
    }
    
    public function lesson_form($param1 = "", $param2 = "", $param3 = "") { 
      if ($param1 == 'add_lesson') {
        
        $page_data['course_id'] = $param2;
        $page_data['page_name']  = 'lesson_add';
        $page_data['page_title'] = get_phrase('add_lesson');
        $this->load->view('backend/index', $page_data);
      }
      elseif ($param1 == 'edit_lesson') {
        
        $page_data['lesson_id']  = $param2;
        $page_data['course_id']  = $param3;
        $page_data['page_name']  = 'lesson_edit';
        $page_data['page_title'] = get_phrase('edit_lesson');
        $this->load->view('backend/index', $page_data);
      }
    }
    
    public function watch_video($slugified_title = "", $lesson_id = "") { 
      $lesson_details          = $this->crud_model->get_lessons('lesson', $lesson_id)->row_array();
      $page_data['provider']   = $lesson_details['video_type'];
      $page_data['video_url']  = $lesson_details['video_url'];
      $page_data['lesson_id']  = $lesson_id;
      $page_data['page_name']  = 'video_player';
      $page_data['page_title'] = get_phrase('video_player');
      $this->load->view('backend/index', $page_data);
    }
    
    
    public function manage_language($param1 = '', $param2 = '', $param3 = '') { 
      if ($param1 == 'edit_phrase') {
        $page_data['edit_profile'] = $param2;
      }
      if ($param1 == 'update_phrase') {
        $language     = $param2;
        $total_phrase = $this->input->post('total_phrase');
        for ($i = 1; $i < $total_phrase; $i++) {
          //$data[$language]    =    $this->input->post('phrase').$i;
          $this->db->where('phrase_id', $i);
          $this->db->update('language', array(
          $language => $this->input->post('phrase' . $i)
          ));
        }
        $this->session->set_flashdata('flash_message', get_phrase('settings_updated'));
        redirect(site_url('admin/manage_language/edit_phrase/' . $language), 'refresh');
      }
      if ($param1 == 'do_update') {
        $language        = $this->input->post('language');
        $data[$language] = $this->input->post('phrase');
        $this->db->where('phrase_id', $param2);
        $this->db->update('language', $data);
        $this->session->set_flashdata('flash_message', get_phrase('settings_updated'));
        redirect(site_url('admin/manage_language'), 'refresh');
      }
      if ($param1 == 'add_phrase') {
        $data['phrase'] = html_escape($this->input->post('phrase'));
        $this->db->insert('language', $data);
        $this->session->set_flashdata('flash_message', get_phrase('phrase_added'));
        redirect(site_url('admin/manage_language'), 'refresh');
      }
      if ($param1 == 'add_language') {
        $language = $this->input->post('language');
        $this->load->dbforge();
        $fields = array(
        $language => array(
        'type' => 'LONGTEXT'
        )
        );
        $this->dbforge->add_column('language', $fields);
        
        $this->session->set_flashdata('flash_message', get_phrase('language_added'));
        redirect(site_url('admin/manage_language'), 'refresh');
      }
      if ($param1 == 'delete_language') {
        $language = $param2;
        $this->load->dbforge();
        $this->dbforge->drop_column('language', $language);
        $this->session->set_flashdata('flash_message', get_phrase('language_deleted'));
        
        redirect(site_url('admin/manage_language'), 'refresh');
      }
      $this->session->set_userdata('last_page', 'manage_language');
      $page_data['page_name']  = 'manage_language';
      $page_data['page_title'] = get_phrase('manage_language');
      $this->load->view('backend/index', $page_data);
    }
    
    function message($param1 = 'message_home', $param2 = '', $param3 = '')
    { 
      if ($param1 == 'send_new') {
        $message_thread_code = $this->crud_model->send_new_private_message();
        $this->session->set_flashdata('flash_message', get_phrase('message_sent!'));
        redirect(site_url('admin/message/message_read/' . $message_thread_code), 'refresh');
      }
      
      if ($param1 == 'send_reply') {
        $this->crud_model->send_reply_message($param2); //$param2 = message_thread_code
        $this->session->set_flashdata('flash_message', get_phrase('message_sent!'));
        redirect(site_url('admin/message/message_read/' . $param2), 'refresh');
      }
      
      if ($param1 == 'message_read') {
        $page_data['current_message_thread_code'] = $param2; // $param2 = message_thread_code
        $this->crud_model->mark_thread_messages_read($param2);
      }
      
      if ($param1 == 'quizStudents') {
        if($this->input->post('quiz_id')==0){
          $result = $this->user_model->get_user()->result_array();
          }else{
          $where = array('enroll.sub_category_id'=>$this->input->post('quiz_id'));
          $join[] = array('table'=>'users', 'condition'=>'enroll.user_id=users.id');
          $result = $this->crud_model->getResultData('enroll', $where, 'users.first_name, users.last_name, users.id, enroll.sub_category_id', $join);
        }
        echo json_encode($result); exit;
      }
      
      $this->session->set_userdata('last_page', 'message');
      $page_data['message_inner_page_name'] = $param1;
      $page_data['page_name']               = 'message';
      $page_data['page_title']              = get_phrase('private_messaging');
      $page_data['student_list'] = $this->user_model->get_user()->result_array();
      $page_data['sub_categories'] = $this->crud_model->get_sub_categories()->result_array();
      $this->load->view('backend/index', $page_data);
    }
    
    /******MANAGE OWN PROFILE AND CHANGE PASSWORD***/
    function manage_profile($param1 = '', $param2 = '', $param3 = '')
    { 
      if ($param1 == 'update_profile_info') {
        $this->user_model->edit_user($param2);
        redirect(site_url('admin/manage_profile'), 'refresh');
      }
      if ($param1 == 'change_password') {
        $this->user_model->change_password($param2);
        redirect(site_url('admin/manage_profile'), 'refresh');
      }
      $page_data['page_name']  = 'manage_profile';
      $page_data['page_title'] = get_phrase('manage_profile');
      $page_data['edit_data']  = $this->db->get_where('users', array(
      'id' => $this->session->userdata('user_id')
      ))->result_array();
      $this->load->view('backend/index', $page_data);
    }
    
    public function paypal_checkout_for_instructor_revenue() { 
      
      $page_data['amount_to_pay']         = $this->input->post('amount_to_pay');
      $page_data['payment_id']            = $this->input->post('payment_id');
      $page_data['course_title']          = $this->input->post('course_title');
      $page_data['instructor_name']       = $this->input->post('instructor_name');
      $page_data['production_client_id']  = $this->input->post('production_client_id');
      $this->load->view('backend/admin/paypal_checkout_for_instructor_revenue', $page_data);
    }
    
    public function stripe_checkout_for_instructor_revenue() { 
      
      $page_data['amount_to_pay']    = $this->input->post('amount_to_pay');
      $page_data['payment_id']       = $this->input->post('payment_id');
      $page_data['course_title']     = $this->input->post('course_title');
      $page_data['instructor_name']  = $this->input->post('instructor_name');
      $page_data['public_live_key']  = $this->input->post('public_live_key');
      $page_data['secret_live_key']  = $this->input->post('secret_live_key');
      $this->load->view('backend/admin/stripe_checkout_for_instructor_revenue', $page_data);
    }
    
    public function payment_success($payment_type = "", $payment_id = "") { 
      
      $this->crud_model->update_instructor_payment_status($payment_id);
      $this->session->set_flashdata('flash_message', get_phrase('instructor_payment_has_been_done'));
      redirect(site_url('admin/instructor_revenue'), 'refresh');
    }
    
    // AJAX PORTION
    public function ajax_get_sub_category($category_id) {
      $page_data['sub_categories'] = $this->crud_model->get_sub_categories($category_id);
      
      return $this->load->view('backend/admin/ajax_get_sub_category', $page_data);
    }
    
    public function ajax_get_section($course_id){
      $page_data['sections'] = $this->crud_model->get_section('course', $course_id)->result_array();
      return $this->load->view('backend/admin/ajax_get_section', $page_data);
    }
    
    public function ajax_get_video_details() {
      $video_details = $this->video_model->getVideoDetails($_POST['video_url']);
      echo $video_details['duration'];
    }
    
    public function update_phrase_with_ajax() {
      $checker['phrase_id']                = $this->input->post('phraseId');
      $updater[$this->input->post('currentEditingLanguage')] = $this->input->post('updatedValue');
      
      $this->db->where('phrase_id', $checker['phrase_id']);
      $this->db->update('language', $updater);
      
      echo $checker['phrase_id'].' '.$this->input->post('currentEditingLanguage').' '.$this->input->post('updatedValue');
    }
    
    // Code added by khushboo
    
    public function subjects($param1 = "", $param2 = "") { 
      $this->session->set_userdata('last_page', 'subjects');
      if ($param1 == 'add') {
        $this->crud_model->add_subject();
        $this->session->set_flashdata('flash_message', get_phrase('data_added_successfully'));
        redirect(site_url('admin/subjects'), 'refresh');
      }
      elseif ($param1 == "edit") {
        $this->crud_model->edit_subject($param2);
        $this->session->set_flashdata('flash_message', get_phrase('data_updated_successfully'));
        redirect(site_url('admin/subjects'), 'refresh');
      }
      elseif ($param1 == "delete") {
        $res = $this->crud_model->delete_subject($param2);
        if($res){
          $this->session->set_flashdata('flash_message', get_phrase('data_deleted'));
          }else{
          $this->session->set_flashdata('error_message',get_phrase('cannot delete data'));
        }
        redirect(site_url('admin/subjects'), 'refresh');
      }
      $page_data['page_name'] = 'subjects';
      $page_data['page_title'] = get_phrase('subjects');
      $page_data['subjects'] = $this->crud_model->get_subjects($param2); 
      $this->load->view('backend/index', $page_data);
    }
    
    public function subject_form($param1 = "", $param2 = "") { 
      $this->session->set_userdata('last_page', 'subjects');
      if ($param1 == "add_subject") {
        $page_data['page_name'] = 'subject_add';
        $page_data['page_title'] = get_phrase('add_subject');
      }
      if ($param1 == "edit_subject") {
        $page_data['page_name'] = 'subject_edit';
        $page_data['page_title'] = get_phrase('edit_subject');
        $page_data['subject_id'] = $param2;
        $data = $this->crud_model->get_subjects($param2)->row_array();
        $page_data['data'] = $data;
        $page_data['sub_categories'] = ($data['category_id']!='' ? $this->crud_model->get_sub_categories($data['category_id']) : array()); 
        $page_data['samesters'] = $this->Master_model->view_samester('', '', $data['sub_category_id']); 
      }
      $page_data['categories'] = $this->crud_model->get_categories(); 
      $this->load->view('backend/index', $page_data);
    }
    
    function get_all_questions($param1=1)
    {
      $record = $this->crud_model->get_all_questions($param1);
      $data = array();
      
      foreach($record as $key)
      {
        $sub_array['subject']=$key->name;
        $sub_array['chapter']=$key->chapter_name;
        $sub_array['samester']=$key->samester_name;
        $sub_array['subcategory']=$key->subcategory_name;
        $sub_array['category']=$key->category_name;
        $sub_array['question']=$key->question;
        $sub_array['correct_answer']=$key->correct_answer;
        $sub_array['action'] = '<div class="btn-group">
        <button class="btn btn-small btn-default btn-demo-space" data-toggle="dropdown"> <i class = "fa fa-ellipsis-v"></i> </button>
        <ul class="dropdown-menu dropdown-default" role="menu">
        <li>
        <a href="'.site_url('admin/question_form/question_edit/'.$key->id).'">
        '.get_phrase('edit').'</a>
        </li>
        <li class="divider"></li>
        <li>
        <a href="" onclick="confirm_modal('.site_url('admin/question_actions/delete/'.$key->id).')">
        '.get_phrase('delete').'</a>
        </li>';
        
        $data[] =$sub_array;
      }
      
      $output = array('draw' => intval($this->input->post('draw')),
      'recordsTotal' => $this->crud_model->count_total_question($param1),
      'recordsFiltered' =>$this->crud_model->count_filter_question($param1),
      'data'=>$data,
      'record'=>$record,
      // 'filter'=>$filter,
      'result' =>$this->db->last_query(),
      // 'course'=>$course_record
      );
      
      echo json_encode($output);
      // echo json_encode($this->input->post());
    }

    function get_all_pendingquestions($param1=0)
    { 
      $record = $this->crud_model->get_all_questions($param1);
      $data = array();
      
      foreach($record as $key)
      {
        $sub_array['id']=$key->id;
        $sub_array['teacher']=$key->teacher;
        $sub_array['subject']=$key->name;
        $sub_array['chapter']=$key->chapter_name;
        $sub_array['samester']=$key->samester_name;
        $sub_array['subcategory']=$key->subcategory_name;
        $sub_array['category']=$key->category_name;
        $sub_array['question']=$key->question;
        $sub_array['correct_answer']=$key->correct_answer;
        $sub_array['action'] = '<div class="btn-group">
        <button class="btn btn-small btn-default btn-demo-space" data-toggle="dropdown"> <i class = "fa fa-ellipsis-v"></i> </button>
        <ul class="dropdown-menu dropdown-default" role="menu">
        <li>
        <a href="'.site_url('admin/question_form/question_edit/'.$key->id).'">
        '.get_phrase('edit').'</a>
        </li>
        <li class="divider"></li>
        <li>
        <a href="'.site_url('admin/question_form/question_review/'.$key->id).'">
        '.get_phrase('review').'</a>
        </li>';
        
        $data[] =$sub_array;
      }
      
      $output = array('draw' => intval($this->input->post('draw')),
      'recordsTotal' => $this->crud_model->count_total_question($param1),
      'recordsFiltered' =>$this->crud_model->count_filter_question($param1),
      'data'=>$data,
      'record'=>$record,
      // 'filter'=>$filter,
      'result' =>$this->db->last_query(),
      // 'course'=>$course_record
      );
      
      echo json_encode($output);
      // echo json_encode($this->input->post());
    }
    
    public function questions($param1 = "", $param2 = "") { 
      $this->session->set_userdata('last_page', 'questions'); 
      $page_data['page_name'] = 'questions';
      $page_data['page_title'] = get_phrase('questions');
      $page_data['categories'] = $this->crud_model->get_categories(); 
      $page_data['subjects'] = $this->crud_model->get_subjects(); 
      $page_data['sub_categories'] = ($this->input->post('category_id')!='' ? $this->crud_model->get_sub_categories($this->input->post('category_id')) : array()); 
      $page_data['samesters'] = $this->Master_model->view_samester('', '', $this->input->post('sub_category_id'));
      $page_data['subjects'] = $this->crud_model->get_subjects('', $this->input->post('samester')); 
      $page_data['chapters'] = $this->Master_model->get_chapters('', $this->input->post('subject_id')); 
      $page_data['questions'] = $this->crud_model->get_questions($param2);
      
      // echo '<pre>';
      // print_r($page_data['questions']->result());
      // echo '</pre>'; die();
      $this->load->view('backend/index', $page_data);
    }

    public function approvequestions($param1 = "", $param2 = "") { 
      $this->session->set_userdata('last_page', 'approvequestions');

      $page_data['page_name'] = 'approvequestions';
      $page_data['page_title'] = get_phrase('approve_questions');
      $page_data['categories'] = $this->crud_model->get_categories(); 
      $page_data['subjects'] = $this->crud_model->get_subjects(); 
      $page_data['sub_categories'] = ($this->input->post('category_id')!='' ? $this->crud_model->get_sub_categories($this->input->post('category_id')) : array()); 
      $page_data['samesters'] = $this->Master_model->view_samester('', '', $this->input->post('sub_category_id'));
      $page_data['subjects'] = $this->crud_model->get_subjects('', $this->input->post('samester')); 
      $page_data['chapters'] = $this->Master_model->get_chapters('', $this->input->post('subject_id')); 
      $page_data['teacher'] = $this->user_model->get_user('', 3);
      $page_data['questions'] = array(); //$this->crud_model->get_questions($param2); 
      $this->load->view('backend/index', $page_data);
    }

    public function change_questionstatus($param1 = 0, $param2 = "") { 
      $this->session->set_userdata('last_page', 'questionsapprove'); 
      $id = array();
      foreach ($_POST AS $value) {
        $id[] = $value;
      } 
      $this->crud_model->change_questionstatus($param1, $id);
      echo 1;
    }
    
    public function question_form($param1 = "", $param2 = "") {  

      $page_data['categories'] = $this->crud_model->get_categories(); 
      if ($param1 == 'add_question') {
        //Add Ckfinder to Ckeditor
        $this->ckfinder->SetupCKEditor($this->ckeditor,'../../assets/ckfinder/');
        $page_data['page_name'] = 'question_add';
        $page_data['page_title'] = get_phrase('add_question');
        $page_data['subjects'] = $this->crud_model->get_subjects($param2);
        $this->load->view('backend/index', $page_data);
        
        } elseif ($param1 == 'question_edit') {
        
        //Add Ckfinder to Ckeditor
        $this->ckfinder->SetupCKEditor($this->ckeditor,'../../../assets/ckfinder/');
        $page_data['page_name'] = 'question_edit';
        $page_data['question_id'] =  $param2;
        $data = $this->crud_model->get_questions($param2)->row_array();
        $page_data['question_detail'] = $data;
        $page_data['sub_categories'] = ($data['category_id']!='' ? $this->crud_model->get_sub_categories($data['category_id']) : array()); 
        $page_data['samesters'] = $this->Master_model->view_samester('', '', $data['subcategory_id']);
        $page_data['subjects'] = $this->crud_model->get_subjects('', $data['samester_id']); 
        $page_data['chapters'] = $this->Master_model->get_chapters('', $data['subject_id']); 
        $page_data['page_title'] = get_phrase('edit_question');
        $this->load->view('backend/index', $page_data);
        
      } elseif ($param1 == 'question_review') {
        
        //Add Ckfinder to Ckeditor
        $this->ckfinder->SetupCKEditor($this->ckeditor,'../../../assets/ckfinder/');
        $page_data['page_name'] = 'question_review';
        $page_data['question_id'] =  $param2;
        $data = $this->crud_model->get_questions($param2)->row_array();
        $page_data['question_detail'] = $data;
        $page_data['sub_categories'] = ($data['category_id']!='' ? $this->crud_model->get_sub_categories($data['category_id']) : array()); 
        $page_data['samesters'] = $this->Master_model->view_samester('', '', $data['subcategory_id']);
        $page_data['subjects'] = $this->crud_model->get_subjects('', $data['samester_id']); 
        $page_data['chapters'] = $this->Master_model->get_chapters('', $data['subject_id']); 
        $page_data['page_title'] = get_phrase('edit_question');
        $this->load->view('backend/index', $page_data);
        
      }
    }
    
    public function question_actions($param1 = "", $param2 = "") { 
      if ($param1 == "add") {
        $this->crud_model->add_question();
        redirect(site_url('admin/questions'), 'refresh');
        
      }
      elseif ($param1 == "edit") {
        $this->crud_model->update_question($param2);
        redirect(site_url('admin/questions'), 'refresh');
        
      }
      elseif ($param1 == 'delete') {
        $where = array('id'=>$param2);
        $this->crud_model->delete_row('questions', $where);
        redirect(site_url('admin/questions'), 'refresh');
      }
      elseif ($param1 == 'approve') {  
        $this->crud_model->change_questionstatus(1, $param2);
        redirect(site_url('admin/approvequestions'), 'refresh');
      }
      elseif ($param1 == 'reject') { 
        $this->crud_model->change_questionstatus(2, $param2);
        redirect(site_url('admin/approvequestions'), 'refresh');
      }
    }
    
    public function matrix($param1 = "", $param2 = "") { 
      $this->session->set_userdata('last_page', 'matrix');
      
      if ($param1 == "add") {
        $this->crud_model->add_pattern();
        redirect(site_url('admin/matrix'), 'refresh');
        
      }
      elseif ($param1 == "edit") {
        $this->crud_model->add_pattern();
        redirect(site_url('admin/matrix'), 'refresh');
        
      }
      
      $page_data['page_name'] = 'matrix';
      $page_data['page_title'] = get_phrase('exam_pattern');
      $page_data['categories'] = $this->crud_model->get_categories();
      $this->load->view('backend/index', $page_data);
    }
    
    public function pattern_form($param1 = "", $param2 = "", $param3 = "") { 
      $page_data['subjects'] = $this->crud_model->get_subjects()->result_array();
      
      if ($param1 == 'add_pattern') {
        $page_data['page_name'] = 'add_pattern';
        $page_data['page_title'] = get_phrase('add_pattern');
        $page_data['category_id'] = $param2;
        $page_data['sub_category_id'] = $param3;
        $this->load->view('backend/index', $page_data);
        
        }elseif ($param1 == 'edit_pattern') {
        $page_data['page_name'] = 'edit_pattern';
        $page_data['exam_id'] =  $param2;
        $page_data['page_title'] = get_phrase('edit_pattern');
        $page_data['exam_detail'] = $this->crud_model->get_edit_exam_pattern($param2)->result_array();
        $this->load->view('backend/index', $page_data);
        
      }
    }
    
    public function pages($param1 = "", $param2 = "") { 
      $this->session->set_userdata('last_page', 'pages');
      
      if ($param1 == 'add') {
        $this->crud_model->add_page();
        $this->session->set_flashdata('flash_message', get_phrase('data_added_successfully'));
        redirect(site_url('admin/pages'), 'refresh');
      }
      elseif ($param1 == "edit") {
        $this->crud_model->edit_page($param2);
        $this->session->set_flashdata('flash_message', get_phrase('data_updated_successfully'));
        redirect(site_url('admin/pages'), 'refresh');
      }
      $page_data['page_name'] = 'pages';
      $page_data['page_title'] = get_phrase('pages');
      $page_data['pages'] = $this->crud_model->get_pages($param2);
      $this->load->view('backend/index', $page_data);
    }

    public function pages_slider($param1="",$param2="") { 
      $this->session->set_userdata('last_page', 'pages_slider');
      if($this->input->post(null,true))
      {
        
        $this->load->library('image_lib');
        $ext = pathinfo($_FILES['gallery']['name'], PATHINFO_EXTENSION);
        $name = time().$_FILES['gallery']['name'];
        $source_image = 'uploads/pages/slider/'.$name;   
        move_uploaded_file($_FILES['gallery']['tmp_name'], $source_image);
        $config['image_library'] = 'gd2';
        $config['source_image'] = $source_image;
        $config['maintain_ratio'] = TRUE;
        $config['width']         = 1385;
        $config['height']       = 925;
        $this->image_lib->initialize($config);
        $this->image_lib->resize();
        $data['image_name'] = $name;
        $data['type'] = $this->input->post('type');
        
        $data['page_name'] = str_replace(" ","_",strtolower($this->input->post('page_name')));
        
        // print_r($data);
        // exit();
        // $data['position'] = $this->input->post('position');
        // $data['ptext'] = $this->input->post('ptext');
        // $data['htext'] = $this->input->post('htext');
        // $data['blink'] = $this->input->post('blink');
        $data['status'] = $this->input->post('status');
        $this->crud_model->add_photo($data);
        $this->session->set_flashdata('flash_message', get_phrase('data_added_successfully'));
        
        // $this->crud_model->edit_page_slider($param2);
        // $this->session->set_flashdata('flash_message', get_phrase('data_updated_successfully'));
        redirect(site_url('admin/pages_slider'), 'refresh');
        
      }
      else
      {
        
        $page_data['page_name'] = 'pages_slider';
        $page_data['page_title'] = get_phrase('pages_slider');
        $page_data['pages_image'] = $this->crud_model->get_pages_image();
        
        $page_data['pages'] = $this->crud_model->get_pages($param2);
        $this->load->view('backend/index', $page_data);
        
      } 
    }
    
    
    public function page_form($param1 = "", $param2 = "") { 
      if ($param1 == 'add_page') {
        $this->ckfinder->SetupCKEditor($this->ckeditor,'../../../assets/ckfinder/');
        $page_data['page_name'] = 'page_add';
        $page_data['page_title'] = get_phrase('add_page');
        $this->load->view('backend/index', $page_data);
        
        }elseif ($param1 == 'page_edit') {  
        $this->ckfinder->SetupCKEditor($this->ckeditor,'../../../assets/ckfinder/');
        $page_data['page_name'] = 'page_edit';
        $page_data['page_id'] =  $param2;
        $page_data['page_detail'] = $this->crud_model->get_pages($param2)->row_array();
        $page_data['page_title'] = get_phrase('edit_page');
        $this->load->view('backend/index', $page_data);
        
      }
    }
    
    // for cron Job
    public function autoSubmission(){
      log_message('info' , 'cron start');
      $msg= "cron has been started";
      
      $to = "itmgaurav@gmail.com";
      $subject = "check cron for autosubmission";
      // log_message('info', 'The purpose of some variable is to provide testas value.');
      $this->email_model->send_smtp_mail($msg, $subject, $to);
      
      $this->crud_model->autoSubmission();
      // $quiz = $this->crud_model->create_quiz();
      $this->email_model->send_smtp_mail('cron end', $subject, $to);
      
      
    }
    
    public function quiz_creation(){
      log_message('info' , 'cron start');
      $msg= "cron has been started";
      
      $to = "itmgaurav@gmail.com";
      $subject = "check cron for quiz creation";
      // log_message('info', 'The purpose of some variable is to provide testas value.');
      $this->email_model->send_smtp_mail($msg, $subject, $to);
      
      // $this->crud_model->autoSubmission();
      $quiz = $this->crud_model->create_quiz();
      $this->email_model->send_smtp_mail('cron end', $subject, $to);
      
      
    }
    
    public function photogallery($param1="", $param2=""){ 
      $this->session->set_userdata('last_page', 'photogallery');
      
      if ($param1 == 'add') {
        $this->load->library('image_lib');
        if(count($_FILES['gallery']['name']) > 0){
          for($i=0; $i<count($_FILES['gallery']['name']); $i++) {
            $ext = pathinfo($_FILES['gallery']['name'][$i], PATHINFO_EXTENSION);
            $name = time().$_FILES['gallery']['name'][$i];
            $source_image = 'uploads/gallery/'.$name;
            move_uploaded_file($_FILES['gallery']['tmp_name'][$i], $source_image);
            $config['image_library'] = 'gd2';
            $config['source_image'] = $source_image;
            $config['maintain_ratio'] = TRUE;
            $config['width']         = 400;
            $config['height']       = 350;
            $this->image_lib->initialize($config);
            $this->image_lib->resize();
            $data['image_name'] = $name;
            $data['type'] = 'gallery';
            $this->crud_model->add_photo($data);
          }
        }
        $this->session->set_flashdata('flash_message', get_phrase('data_added_successfully'));
        redirect(site_url('admin/photogallery'), 'refresh');
      }
      
      elseif ($param1 == 'delete') {
        $this->crud_model->delete_photo($param2);
        $this->session->set_flashdata('flash_message', get_phrase('data_deleted_successfully'));
        redirect(site_url('admin/photogallery'), 'refresh');
      }
      $page_data['page_name'] = 'photogallery';
      $page_data['page_title'] = get_phrase('photogallery');
      // $page_data['pages'] = $this->crud_model->gallery();
      $this->load->view('backend/index', $page_data);
    }
    
    public function slider($param1="", $param2=""){ 
      $this->session->set_userdata('last_page', 'slider');
      
      if ($param1 == 'add') {
        $this->load->library('image_lib');
        $ext = pathinfo($_FILES['gallery']['name'], PATHINFO_EXTENSION);
        $name = time().$_FILES['gallery']['name'];
        $source_image = 'uploads/slider/'.$name;   
        move_uploaded_file($_FILES['gallery']['tmp_name'], $source_image);
        $config['image_library'] = 'gd2';
        $config['source_image'] = $source_image;
        $config['maintain_ratio'] = TRUE;
        $config['width']         = 1385;
        $config['height']       = 925;
        $this->image_lib->initialize($config);
        $this->image_lib->resize();
        $data['image_name'] = $name;
        $data['type'] = $this->input->post('type');
        $data['position'] = $this->input->post('position');
        $data['ptext'] = $this->input->post('ptext');
        $data['htext'] = $this->input->post('htext');
        $data['blink'] = $this->input->post('blink');
        $data['status'] = $this->input->post('status');
        $this->crud_model->add_photo($data);
        $this->session->set_flashdata('flash_message', get_phrase('data_added_successfully'));
        redirect(site_url('admin/slider'), 'refresh');
      }
      
      elseif ($param1 == 'delete') {
        $this->crud_model->delete_photo($param2);
        $this->session->set_flashdata('flash_message', get_phrase('data_deleted_successfully'));
        redirect(site_url('admin/slider'), 'refresh');
      }
      
      elseif($param1=='changeStatus'){
        $where = "where id = $param2";
        $this->crud_model->changeStatus('photos', $where);
        redirect(site_url('admin/slider'), 'refresh');
      }
      elseif($param1=='changePosition'){
        $where = array('id'=>$this->input->post('id'));
        $data['position'] = $this->input->post('position');
        $this->crud_model->edit_row('photos', $where, $data);
        redirect(site_url('admin/slider'), 'refresh');
      }
      $page_data['page_name'] = 'slider';
      $page_data['page_title'] = get_phrase('slider');
      $this->load->view('backend/index', $page_data);
    }
    
    public function coupon($param1 = "", $param2 = "") {  
      $this->session->set_userdata('last_page', 'coupon');
      if ($param1 == 'add') {
        $data = $this->input->post();
        $this->crud_model->add_row('coupon_codes', $data);
        $this->session->set_flashdata('flash_message', get_phrase('data_added_successfully'));
        redirect(site_url('admin/coupon'), 'refresh');
      }
      elseif ($param1 == "edit") {
        $where = array('id'=>$param2);
        $data = $this->input->post();
        $this->crud_model->edit_row('coupon_codes', $where, $data);
        $this->session->set_flashdata('flash_message', get_phrase('data_updated_successfully'));
        redirect(site_url('admin/coupon'), 'refresh');
      }
      elseif ($param1 == "delete") {
        $where = array('id'=>$param2);
        $this->crud_model->delete_row('coupon_codes', $where);
        $this->session->set_flashdata('flash_message', get_phrase('data_deleted'));
        redirect(site_url('admin/coupon'), 'refresh');
      }
      $page_data['page_name'] = 'coupon';
      $page_data['page_title'] = get_phrase('coupon_codes');
      $page_data['coupons'] = $this->crud_model->getResultData('coupon_codes');
      $this->load->view('backend/index', $page_data);
    }
    
    public function coupon_form($param1 = "", $param2 = "") { 
      if ($param1 == "add_coupon") {
        $page_data['page_name'] = 'coupon_add';
        $page_data['page_title'] = get_phrase('add_coupon');
      }
      if ($param1 == "edit_coupon") {
        $page_data['page_name'] = 'coupon_edit';
        $page_data['page_title'] = get_phrase('edit_coupon');
        $page_data['coupon_id'] = $param2;
        $where = array('id'=>$param2);
        $page_data['coupon'] = $this->crud_model->getRow('coupon_codes', $where);
      }
      
      $this->load->view('backend/index', $page_data);
    }
    
    public function faq($param1 = "", $param2 = "") { 
      $this->session->set_userdata('last_page', 'faq');
      if ($param1 == 'add') {
        $data = $this->input->post();
        $this->crud_model->add_row('faq', $data);
        $this->session->set_flashdata('flash_message', get_phrase('data_added_successfully'));
        redirect(site_url('admin/faq'), 'refresh');
      }
      elseif ($param1 == "edit") {
        $where = array('id'=>$param2);
        $data = $this->input->post();
        $this->crud_model->edit_row('faq', $where, $data);
        $this->session->set_flashdata('flash_message', get_phrase('data_updated_successfully'));
        redirect(site_url('admin/faq'), 'refresh');
      }
      elseif ($param1 == "delete") {
        $where = array('id'=>$param2);
        $this->crud_model->delete_row('faq', $where);
        $this->session->set_flashdata('flash_message', get_phrase('data_deleted'));
        redirect(site_url('admin/faq'), 'refresh');
      }
      $page_data['page_name'] = 'faq';
      $page_data['page_title'] = get_phrase('faqs');
      $page_data['faqs'] = $this->crud_model->getResultData('faq');
      $this->load->view('backend/index', $page_data);
    }
    
    public function faq_form($param1 = "", $param2 = "") { 
      if ($param1 == "add_faq") {
        $page_data['page_name'] = 'faq_add';
        $page_data['page_title'] = get_phrase('add_faq');
      }
      if ($param1 == "edit_faq") {
        $page_data['page_name'] = 'faq_edit';
        $page_data['page_title'] = get_phrase('edit_faq');
        $page_data['faq_id'] = $param2;
        $where = array('id'=>$param2);
        $page_data['faq'] = $this->crud_model->getRow('faq', $where);
      }
      
      $this->load->view('backend/index', $page_data);
    }
    
    public function databaseBackup(){
      $this->crud_model->databaseBackup();
    }
    
    // Ajax portion By khushboo
    
    public function ajax_get_exam_pattern($category_id) {
      $sub_categories = $this->crud_model->get_sub_categories($category_id);
      $exam_pattern = $this->crud_model->get_exam_pattern($category_id)->result_array();
      foreach($sub_categories as $k => $v){
        foreach($exam_pattern as $kk => $vv){
          if($v['id'] == $vv['sub_category_id']){
            foreach($vv as $key => $val){
              $sub_categories[$k]['right_'.$key] = $val; 
            }
          }
        }
      }
      
      $page_data['exam_pattern']= $sub_categories;
      
      return $this->load->view('backend/admin/ajax_get_exam_pattern', $page_data);
    }
    
    public function ajax_get_gallery() {
      $page_data['galleries'] = $this->crud_model->gallery('gallery');
      return $this->load->view('backend/admin/ajax_get_gallery', $page_data);
    }
    
    public function ajax_get_slider() {
      $page_data['galleries'] = $this->crud_model->gallery('slider', '','', 'slider1');
      return $this->load->view('backend/admin/ajax_get_slider', $page_data);
    }
    
    function change_user_status()
    {
      $output = $this->user_model->change_user_status();
      echo json_encode($output);
    }
    
    function enroll_list()
    {
      $page_data['page_name'] = 'enroll_list';
      $page_data['page_title'] = get_phrase('enroll_list_by_sub_category');
      $page_data['enroll_list'] = $this->user_model->get_enroll_list();
      $this->load->view('backend/index', $page_data);
    }
    
    function attempted_list()
    {
      $page_data['page_name'] = 'attempted_list';
      $page_data['page_title'] = get_phrase('attempted_list_by_sub_category');
      $page_data['attempted_list'] = $this->user_model->get_attempted_list();
      $this->load->view('backend/index', $page_data);
    }
    
    function total_question()
    {
      $page_data['page_name'] = 'total_question';
      $page_data['page_title'] = get_phrase('total_question_by_sub_category');
      $page_data['total_question'] = $this->user_model->get_total_question();
      $this->load->view('backend/index', $page_data);
    }
    
    /*Vipin Code*/
    function winners($param1="",$param2="")
    { 
      $this->session->set_userdata('last_page', 'winners');
      $page_data['page_name'] = 'winners';
      $page_data['page_title'] = get_phrase('winners');
      $page_data['categories'] = $this->crud_model->get_categories($param2);
      $this->load->view('backend/index', $page_data);
    }
    
    function get_sub_categories()
    {
      $id = $this->input->post('id');
      $output = $this->crud_model->get_sub_categories($id);
      echo json_encode($output);
    }
    
    function get_student()
    {
      $id = $this->input->post('id');
      $data = $this->crud_model->get_student($id);
      $where = array('w.sub_category_id'=>$id);
      $winner = $this->crud_model->get_winners($where);
      $output='<table class="table" id="myTable">
      <thead>
      <tr>
      <th>Image</th>
      <th>Name</th>
      <th>Email</th>
      
      <th>Position</th>
      <th>Action</th>
      </tr>
      </thead>
      <tbody>';
      if(!empty($data))
      {
        foreach($data as $key)
        {
          $position = null;
          foreach($winner as $key1)
          {
            if($key1->user_id == $key->id)
            {
              $position = $key1->position;
              break;
            }
            else
            {
              $position = null;
            }
            
          }
          
          $output.='<tr>
          <td>
          <img src="'.$this->user_model->get_user_image_url($key->id).'" alt="'.$this->user_model->get_user_image_url($key->id).'" height="50" width="50" class="img-fluid">
          <input type="hidden" name="image_url[]" value="'.$this->user_model->get_user_image_url($key->id).'">
          </td>
          <td>'.$key->first_name.' '.$key->last_name.'
          
          </td>
          <td>'.$key->email.'</td>
          <td class="position">
          <span class="hidden">'.$position.'</span>
          <input type="number" class="form-control" name="position" min=1 value="'.$position.'"></td>
          <td>';
          if(!empty($position))
          {
            $output.='<button type="button" class="btn btn-sm btn-success" data-id="'.$key->id.'" data-sub_category_id="'.$key->sub_category_id.'" data-image_url="'.$this->user_model->get_user_image_url($key->id).'">
            <i class="fa fa-check"></i>
            </button>
            <button type="button" class="btn btn-sm btn-danger clear_position" data-id="'.$key->id.'" data-sub_category_id="'.$key->sub_category_id.'">
            <i class="fa fa-times"></i>
            </button>';
          }
          else{
            $output.='<button type="button" class="btn btn-sm add_position" data-id="'.$key->id.'" data-sub_category_id="'.$key->sub_category_id.'" data-image_url="'.$this->user_model->get_user_image_url($key->id).'">
            <i class="fa fa-plus"></i>
            </button>';
          }
          
          $output.='</td>
          </tr>';
        }
      }
      $output.='</tbody>
      </table>';
      
      echo json_encode($output); 
    }
    
    function get_user_image_url()
    {
      $id = $this->input->post('id');
      $output = $this->user_model->get_user_image_url($id);
      echo json_encode($output);
    }
    
    function add_winners()
    {
      
      $output = $this->crud_model->add_winners();
      echo json_encode($output); 
    }
    
    function clear_winners()
    {
      $output = $this->crud_model->clear_winners();
      echo json_encode($output); 
    }
    
    function new_report($param1="",$param2="")
    { 
      $this->session->set_userdata('last_page', 'subjects');
      $page_data['page_name'] = 'new_report';
      $page_data['page_title'] = get_phrase('new_report');
      $page_data['categories'] = $this->crud_model->get_categories($param2);
      $this->load->view('backend/index', $page_data);
    }
    
    function get_new_report()
    {
      $data = $this->crud_model->get_new_report();
      $output='<table class="table" id="myTable">
      <thead>
      <tr>
      
      <th>Name</th>
      <th>Email</th>
      <th>Contact</th>
      <th>Total Marks</th>
      <th>Marks Obtained</th>
      <th>Auto Submission</th>
      <th>Total Attempt</th>
      </tr>
      </thead>
      <tbody>';
      if(isset($data) && !empty($data))
      {
        foreach($data as $key)
        {
          $output.='<tr>
          <td>'.$key->first_name.' '.$key->last_name.'</td>
          <td>'.$key->email.'</td>
          <td>'.$key->contact.'</td>
          <td>'.intval($key->total_marks).'</td>
          <td>'.$key->marks_obt.'</td>
          <td>'.$key->auto_submission.'</td>
          <td>'.$key->total_attempt.'</td>
          </tr>';
        }
      }
      
      $output.='</tbody>
      </table>';
      
      echo json_encode($output);
    }
    
    function clear_pages_slider()
    {
      $output = $this->crud_model->clear_pages_slider();
      echo json_encode($output);
    }

    //--- New Modules
    //---- Highlight Quiz

    function highlight_quiz($param1='', $param2='')
    { 
      $this->session->set_userdata('last_page', 'highlight_quiz');
      $page_data['page_name'] = 'highlight_quiz';
      $page_data['page_title'] = get_phrase('highlight_quiz'); 
      if ($param1 == 'add') {
        $this->crud_model->add_highlight_quiz();
        $this->session->set_flashdata('flash_message', get_phrase('data_added_successfully'));
        redirect(site_url('admin/highlight_quiz'), 'refresh');
      }
      if ($param1 == 'edit' && $param2!='') {
        $this->crud_model->update_highlight_quiz($param2);
        $this->session->set_flashdata('flash_message', get_phrase('data_updated_successfully'));
        redirect(site_url('admin/highlight_quiz'), 'refresh');
      } 
      if ($param1 == 'delete' && $param2!='') {
        $this->crud_model->delete_highlight_quiz($param2);
        redirect(site_url('admin/highlight_quiz'), 'refresh');
      }
      $this->load->view('backend/index', $page_data);
    }

    function get_all_highlight_quiz($param1='', $param2='')
    { 
      $this->session->set_userdata('last_page', 'highlight_quiz');
      $record = $this->crud_model->get_highlight_quiz($param1, $param2);
      $data = array(); 
      foreach($record as $key)
      {
        $sub_array['title']=$key->title;
        $sub_array['file']='<img src="' . base_url(). 'uploads/thumbnails/quiz_thumbnails/' . $key->file .' " class="img-thumbnail" style="height:100px; width:90px"/>';
        $sub_array['price']=$key->price; 
        $sub_array['action'] = '<div class="btn-group">
        <button class="btn btn-small btn-default btn-demo-space" data-toggle="dropdown"> <i class = "fa fa-ellipsis-v"></i> </button>
        <ul class="dropdown-menu dropdown-default" role="menu">
        <li>
        <a href="'.site_url('admin/highlight_quizform/edit/'.$key->id).'"> '.get_phrase('edit').' </a>
        </li>
        <li class="divider"></li> 
        <li>
        <a href="'.site_url('admin/highlight_quiz/delete/'.$key->id).'" onclick="return confirm(Are you sure to delete);">
        '.get_phrase('delete').'</a>
        </li>
        <li class="divider"></li> 
        <li>
        <a href="' . site_url('admin/enroll_user/'. $key->id .'/paid') . '" target="__blank">
        '.get_phrase('enroll_user_list').'</a>
        </li>
        </ul>
        </div>';
        
        $data[] =$sub_array;
      }
      
      $output = array(
        'draw' => intval($this->input->post('draw')),
        'recordsTotal' => $this->crud_model->count_total_quiz($param1, $param2),
        'recordsFiltered' =>$this->crud_model->count_filter_quiz($param1, $param2),
        'data'=>$data,
        'record'=>$record,
        'result' =>$this->db->last_query(),
      );
      
      echo json_encode($output);
    }

    function highlight_quizform($param1='', $param2='')
    { 
      $this->session->set_userdata('last_page', 'highlight_quiz');
      $page_data['page_name'] = 'highlight_quizform';
      $page_data['page_title'] = get_phrase('highlight_quiz_form'); 
      if($param1=='edit') {
        $page_data['formdata'] = $this->crud_model->get_highlight_quiz($param2);
      }
      $this->load->view('backend/index', $page_data);
    }

    function enroll_user($param1='', $param2='')
    { 
      $page_data['page_name'] = 'enroll_user';
      $page_data['page_title'] = get_phrase('enroll_user'); 
      $this->load->view('backend/index', $page_data);
    }


    function get_all_enroll_user($param1='', $param2='paid')
    { 
      $record = $this->crud_model->get_all_enroll_user($param1, '', $param2);
      $data = array(); 
      foreach($record as $key)
      {
        $sub_array['name']=$key->first_name . ' ' . $key->last_name;
        $sub_array['email']=$key->email;
        $sub_array['mobile']=$key->mobile; 
        $sub_array['payment_id']=$key->payment_id; 
        $sub_array['payment_date']=date('d-m-Y H:i:s', strtotime($key->payment_date)); 
        $data[] =$sub_array;
      }
      
      $output = array(
        'draw' => intval($this->input->post('draw')),
        'recordsTotal' => $this->crud_model->count_total_enroll_user($param1, '', $param2),
        'recordsFiltered' =>$this->crud_model->count_filter_enroll_user($param1, '', $param2),
        'data'=>$data,
        'record'=>$record,
        'result' =>$this->db->last_query(),
      );
      
      echo json_encode($output);
    }

    public function videos($param1 = '', $param2 = '', $param3 = '') { 

      $this->session->set_userdata('last_page', 'videos');
      $page_data['page_name'] = 'videos';
      $page_data['page_title'] = get_phrase('videos');
      $page_data['categories'] = $this->crud_model->get_categories(); 
      $page_data['subjects'] = $this->crud_model->get_subjects(); 
      $page_data['sub_categories'] = ($this->input->post('category_id')!='' ? $this->crud_model->get_sub_categories($this->input->post('category_id')) : array()); 
      $page_data['samesters'] = $this->Master_model->view_samester('', '', $this->input->post('sub_category_id'));
      $page_data['subjects'] = $this->crud_model->get_subjects('', $this->input->post('samester'));  
      $page_data['teacher'] = $this->user_model->get_user('', 3);
      $datas = [];
      if($this->input->post('category_id')) {
        $datas['c.id'] = $this->input->post('category_id');
      }
      if($this->input->post('sub_category_id')) {
        $datas['sc.id'] = $this->input->post('sub_category_id');
      }
      if($this->input->post('samester')) {
        $datas['sm.id'] = $this->input->post('samester');
      }
      if($this->input->post('subject_id')) {
        $datas['subject.id'] = $this->input->post('subject_id');
      }
      if($this->input->post('teacher')) {
        $datas['userID'] = $this->input->post('teacher');
      }
      $page_data['videos'] = $this->Master_model->get_videos('', $datas);  
      $this->load->view('backend/index', $page_data);
    }

    public function video_form($param1 = "", $param2 = "") { 

      $this->session->set_userdata('last_page', 'videos');
      $page_data['categories'] = $this->crud_model->get_categories(); 
      if ($param1 == 'add_video') { 
        //Add Ckfinder to Ckeditor
        $page_data['subjects'] = $this->crud_model->get_subjects();
        $this->ckfinder->SetupCKEditor($this->ckeditor,'../../assets/ckfinder/');
        $page_data['page_name'] = 'video_add';
        $page_data['page_title'] = get_phrase('add_video'); 
        $this->load->view('backend/index', $page_data);
        
        }elseif ($param1 == 'video_edit') {
        //Add Ckfinder to Ckeditor
        $this->ckfinder->SetupCKEditor($this->ckeditor,'../../../assets/ckfinder/');
        $page_data['page_name'] = 'video_edit';
        $page_data['video_id'] =  $param2; 
        $data = $this->Master_model->get_videos($param2)->row_array();
        //echo "<pre>"; print_r($data); die();
        $page_data['video_detail'] = $data;
        $page_data['sub_categories'] = ($data['category_id']!='' ? $this->crud_model->get_sub_categories($data['category_id']) : array()); 
        $page_data['samesters'] = $this->Master_model->view_samester('', '', $data['subcategory_id']);
        $page_data['subjects'] = $this->crud_model->get_subjects('', $data['samester_id']); 
        $page_data['chapters'] = $this->Master_model->get_chapters('', $data['subject_id']); 
        if(!is_array($page_data['video_detail'])) {
          redirect(site_url('admin/videos'), 'refresh');
        } 
        $page_data['page_title'] = get_phrase('edit_video');
        $this->load->view('backend/index', $page_data);
      }
    }

    public function video_actions($param1 = "", $param2 = "") { 
      if ($param1 == "add") {
        $this->Master_model->add_video();
        redirect(site_url('admin/videos'), 'refresh');
      }
      elseif ($param1 == "edit") {
        $this->Master_model->update_video($param2);
        redirect(site_url('admin/videos'), 'refresh');
      }
      elseif ($param1 == 'delete') {
        $where = array('id'=>$param2);
        $this->crud_model->delete_row('tr_videos', $where);
        redirect(site_url('admin/videos'), 'refresh');
      }
    }

    public function studymaterials($param1 = '', $param2 = '', $param3 = '') { 

      $this->session->set_userdata('last_page', 'studymaterials');
      $page_data['page_name'] = 'studymaterial';
      $page_data['page_title'] = get_phrase('study_materials');
      $page_data['categories'] = $this->crud_model->get_categories(); 
      $page_data['subjects'] = $this->crud_model->get_subjects(); 
      $page_data['sub_categories'] = ($this->input->post('category_id')!='' ? $this->crud_model->get_sub_categories($this->input->post('category_id')) : array()); 
      $page_data['samesters'] = $this->Master_model->view_samester('', '', $this->input->post('sub_category_id'));
      $page_data['subjects'] = $this->crud_model->get_subjects('', $this->input->post('samester'));  
      $page_data['teacher'] = $this->user_model->get_user('', 3);
      $datas = [];
      if($this->input->post('category_id')) {
        $datas['c.id'] = $this->input->post('category_id');
      }
      if($this->input->post('sub_category_id')) {
        $datas['sc.id'] = $this->input->post('sub_category_id');
      }
      if($this->input->post('samester')) {
        $datas['sm.id'] = $this->input->post('samester');
      }
      if($this->input->post('subject_id')) {
        $datas['subject.id'] = $this->input->post('subject_id');
      }
      if($this->input->post('teacher')) {
        $datas['userID'] = $this->input->post('teacher');
      }
      $page_data['videos'] = $this->Master_model->get_docs('', $datas);  
      $this->load->view('backend/index', $page_data);
    }

    public function studymaterial_form($param1 = "", $param2 = "") { 

      $this->session->set_userdata('last_page', 'studymaterials');
      $page_data['categories'] = $this->crud_model->get_categories(); 
      if ($param1 == 'add_studymaterial') { 
        //Add Ckfinder to Ckeditor
        $page_data['subjects'] = $this->crud_model->get_subjects();
        $this->ckfinder->SetupCKEditor($this->ckeditor,'../../assets/ckfinder/');
        $page_data['page_name'] = 'studymaterial_add';
        $page_data['page_title'] = get_phrase('add_studymaterial'); 
        $this->load->view('backend/index', $page_data);
        
        }elseif ($param1 == 'studymaterial_edit') {
        //Add Ckfinder to Ckeditor
        $this->ckfinder->SetupCKEditor($this->ckeditor,'../../../assets/ckfinder/');
        $page_data['page_name'] = 'studymaterial_edit';
        $page_data['video_id'] =  $param2; 
        $data = $this->Master_model->get_docs($param2)->row_array();
        //echo "<pre>"; print_r($data); die();
        $page_data['video_detail'] = $data;
        $page_data['sub_categories'] = ($data['category_id']!='' ? $this->crud_model->get_sub_categories($data['category_id']) : array()); 
        $page_data['samesters'] = $this->Master_model->view_samester('', '', $data['subcategory_id']);
        $page_data['subjects'] = $this->crud_model->get_subjects('', $data['samester_id']); 
        $page_data['chapters'] = $this->Master_model->get_chapters('', $data['subject_id']); 
        if(!is_array($page_data['video_detail'])) {
          redirect(site_url('admin/studymaterials'), 'refresh');
        } 
        $page_data['page_title'] = get_phrase('edit_studymaterial');
        $this->load->view('backend/index', $page_data);
      }
    }

    public function studymaterial_actions($param1 = "", $param2 = "") { 
      if ($param1 == "add") {
        $this->Master_model->add_doc();
        redirect(site_url('admin/studymaterials'), 'refresh');
      }
      elseif ($param1 == "edit") {
        $this->Master_model->update_doc($param2);
        redirect(site_url('admin/studymaterials'), 'refresh');
      }
      elseif ($param1 == 'delete') {
        $where = array('id'=>$param2);
        $this->crud_model->delete_row('tr_doc', $where);
        redirect(site_url('admin/studymaterials'), 'refresh');
      }
    }
 
  }         
  ?>