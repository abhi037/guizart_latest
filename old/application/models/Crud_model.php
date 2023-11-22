<?php
  defined('BASEPATH') OR exit('No direct script access allowed');
  
  class Crud_model extends CI_Model {
    
    function __construct()
    {
      parent::__construct();
      /*cache control*/
      $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
      $this->output->set_header('Pragma: no-cache');
    }
    
    public function get_categories($param1 = "") {
      if ($param1 != "") {
        $this->db->where('id', $param1);
      }
      $this->db->where('parent', 0);
      $this->db->order_by('id', 'asc');
      return $this->db->get('category');
    }
    
    public function get_category_details_by_id($id) {
      return $this->db->get_where('category', array('id' => $id));
    }
    
    public function add_category() {
      $data['code'] = html_escape($this->input->post('code'));
      $data['name'] = html_escape($this->input->post('name'));
      $data['font_awesome_class'] = 'fa '.html_escape($this->input->post('font_awesome_class'));
      $data['date_added'] = strtotime(date('D, d-M-Y'));
      $this->db->insert('category', $data);
    }
    
    public function edit_category($param1) {
      $data['name'] = html_escape($this->input->post('name'));
      if (isset($_POST['font_awesome_class']) && !empty($_POST['font_awesome_class'])) {
        $data['font_awesome_class'] = 'fa '.html_escape($this->input->post('font_awesome_class'));
      }
      $data['last_modified'] = strtotime(date('D, d-M-Y'));
      $this->db->where('id', $param1);
      $this->db->update('category', $data);
    }
    
    public function delete_category($category_id) {
      $this->db->where('parent', $category_id);
      $id_exist = $this->db->get('category');
      //print_r($this->db->last_query()) ;
      if($id_exist->num_rows()>0){
        return false;
      }
      $this->db->where('id', $category_id);
      $checkdelete = $this->db->delete('category');
      if($checkdelete){
        return true;
        }else{
        return false;
      }
    }
    
    public function add_sub_category($data) {
      $this->db->insert('category', $data);
    }
    
    public function edit_sub_category($sub_category_id, $data) {
      $this->db->where('id', $sub_category_id);
      $this->db->update('category', $data);
    }

    public function get_sub_categories($parent_id = "") {
      if($parent_id==""){
        $this->db->select('sc.*, c.name AS category_name')
          ->from('category AS sc')
          ->join('category AS c', 'sc.parent=c.id', 'left');
        $this->db->where('sc.parent != 0')->order_by('date_added, id', 'asc');
        return $this->db->get();
      }
      return $this->db->order_by('date_added, id', 'asc')->get_where('category', array('parent' => $parent_id))->result_array();
    }
    
    public function enroll_history($course_id = "") {
      if ($course_id > 0) {
        return $this->db->get_where('enroll', array('course_id' => $course_id));
        }else {
        return $this->db->get('enroll');
      }
    }
    
    public function enroll_history_by_user_id($user_id = "") {
      return $this->db->get_where('enroll', array('user_id' => $user_id, 'enroll_type'=>'Normal'));
    }
    
    public function all_enrolled_student() {
      $this->db->select('user_id');
      $this->db->distinct('user_id');
      return $this->db->get('enroll');
    }
    
    public function enroll_history_by_date_range($timestamp_start = "", $timestamp_end = "") {
      $this->db->select('enroll.*, category.name as sub_category, users.first_name, users.last_name, users.email');
      $this->db->join('category', 'category.id=enroll.sub_category_id');
      $this->db->join('users', 'users.id=enroll.user_id');
      $this->db->order_by('enroll.date_added' , 'desc');
      $this->db->where('enroll.date_added >=' , $timestamp_start);
      $this->db->where('enroll.date_added <=' , $timestamp_end);
      return $this->db->get('enroll');
    }
    
    public function get_revenue_by_user_type($timestamp_start = "", $timestamp_end = "", $revenue_type = "") {
      $course_ids = array();
      $courses    = array();
      $admin_details = $this->user_model->get_admin_details()->row_array();
      if ($revenue_type == 'admin_revenue') {
        //$this->db->where('user_id', $admin_details['id']);
        }elseif ($revenue_type == 'instructor_revenue') {
        $this->db->where('user_id !=', $admin_details['id']);
        $this->db->select('id');
        $courses = $this->db->get('course')->result_array();
        foreach ($courses as $course) {
          if (!in_array($course['id'], $course_ids)) {
            array_push( $course_ids, $course['id'] );
          }
        }
        if (sizeof($course_ids)) {
          $this->db->where_in('course_id', $course_ids);
          }else {
          return array();
        }
      }
      
      $this->db->order_by('date_added' , 'desc');
      $this->db->where('date_added >=' , $timestamp_start);
      $this->db->where('date_added <=' , $timestamp_end);
      return $this->db->get('payment')->result_array();
    }
    
    public function delete_enroll_history($param1) {
      $this->db->where('id', $param1);
      $this->db->delete('enroll');
    }
    
    public function purchase_history($user_id) {
      $this->db->select('payment.*, category.name, category.image_name');
      $this->db->join('category', 'category.id= payment.sub_category_id');
      if ($user_id > 0) {
        $this->db->where('user_id', $user_id);
      }
      return $this->db->get('payment');
    }
    
    public function get_payment_details_by_id($payment_id = "") {
      return $this->db->get_where('payment', array('id' => $payment_id))->row_array();
    }
    
    public function update_instructor_payment_status($payment_id = "") {
      $updater = array(
            'instructor_payment_status' => 1
      );
      $this->db->where('id', $payment_id);
      $this->db->update('payment', $updater);
    }
    
    public function update_system_settings() {
      $data['value'] = html_escape($this->input->post('system_name'));
      $this->db->where('key', 'system_name');
      $this->db->update('settings', $data);
      
      $data['value'] = html_escape($this->input->post('system_title'));
      $this->db->where('key', 'system_title');
      $this->db->update('settings', $data);
      
      $data['value'] = html_escape($this->input->post('author'));
      $this->db->where('key', 'author');
      $this->db->update('settings', $data);
      
      $data['value'] = html_escape($this->input->post('slogan'));
      $this->db->where('key', 'slogan');
      $this->db->update('settings', $data);
      
      $data['value'] = html_escape($this->input->post('language'));
      $this->db->where('key', 'language');
      $this->db->update('settings', $data);
      
      $data['value'] = html_escape($this->input->post('text_align'));
      $this->db->where('key', 'text_align');
      $this->db->update('settings', $data);
      
      $data['value'] = html_escape($this->input->post('system_email'));
      $this->db->where('key', 'system_email');
      $this->db->update('settings', $data);
      
      $data['value'] = html_escape($this->input->post('address'));
      $this->db->where('key', 'address');
      $this->db->update('settings', $data);
      
      $data['value'] = html_escape($this->input->post('phone'));
      $this->db->where('key', 'phone');
      $this->db->update('settings', $data);
      
      $data['value'] = html_escape($this->input->post('youtube_api_key'));
      $this->db->where('key', 'youtube_api_key');
      $this->db->update('settings', $data);
      
      $data['value'] = html_escape($this->input->post('vimeo_api_key'));
      $this->db->where('key', 'vimeo_api_key');
      $this->db->update('settings', $data);
      
      $data['value'] = html_escape($this->input->post('purchase_code'));
      $this->db->where('key', 'purchase_code');
      $this->db->update('settings', $data);
      
      $data['value'] = html_escape($this->input->post('footer_text'));
      $this->db->where('key', 'footer_text');
      $this->db->update('settings', $data);
      
      $data['value'] = html_escape($this->input->post('footer_link'));
      $this->db->where('key', 'footer_link');
      $this->db->update('settings', $data);
      
      $data['value'] = html_escape($this->input->post('website_keywords'));
      $this->db->where('key', 'website_keywords');
      $this->db->update('settings', $data);
      
      $data['value'] = html_escape($this->input->post('website_description'));
      $this->db->where('key', 'website_description');
      $this->db->update('settings', $data);
    }
    
    public function update_smtp_settings() {
      $data['value'] = html_escape($this->input->post('protocol'));
      $this->db->where('key', 'protocol');
      $this->db->update('settings', $data);
      
      $data['value'] = html_escape($this->input->post('smtp_host'));
      $this->db->where('key', 'smtp_host');
      $this->db->update('settings', $data);
      
      $data['value'] = html_escape($this->input->post('smtp_port'));
      $this->db->where('key', 'smtp_port');
      $this->db->update('settings', $data);
      
      $data['value'] = html_escape($this->input->post('smtp_user'));
      $this->db->where('key', 'smtp_user');
      $this->db->update('settings', $data);
      
      $data['value'] = html_escape($this->input->post('smtp_pass'));
      $this->db->where('key', 'smtp_pass');
      $this->db->update('settings', $data);
    }
    
    public function update_payment_settings() {
      // update paypal keys
      $paypal_info = array();
      
      $paypal['active'] = $this->input->post('paypal_active');
      $paypal['mode'] = $this->input->post('paypal_mode');
      $paypal['sandbox_client_id'] = $this->input->post('sandbox_client_id');
      $paypal['production_client_id'] = $this->input->post('production_client_id');
      
      array_push($paypal_info, $paypal);
      
      $data['value']    =   json_encode($paypal_info);
      $this->db->where('key', 'paypal');
      $this->db->update('settings', $data);
      
      $data['value'] = html_escape($this->input->post('paypal_currency'));
      $this->db->where('key', 'paypal_currency');
      $this->db->update('settings', $data);
      
      // update stripe keys
      $stripe_info = array();
      
      $stripe['active'] = $this->input->post('stripe_active');
      $stripe['testmode'] = $this->input->post('testmode');
      $stripe['public_key'] = $this->input->post('public_key');
      $stripe['secret_key'] = $this->input->post('secret_key');
      $stripe['public_live_key'] = $this->input->post('public_live_key');
      $stripe['secret_live_key'] = $this->input->post('secret_live_key');
      
      
      array_push($stripe_info, $stripe);
      
      $data['value']    =   json_encode($stripe_info);
      $this->db->where('key', 'stripe_keys');
      $this->db->update('settings', $data);
      
      $data['value'] = html_escape($this->input->post('stripe_currency'));
      $this->db->where('key', 'stripe_currency');
      $this->db->update('settings', $data);
      
      $data['value'] = html_escape($this->input->post('system_currency'));
      $this->db->where('key', 'system_currency');
      $this->db->update('settings', $data);
      
      $data['value'] = html_escape($this->input->post('currency_position'));
      $this->db->where('key', 'currency_position');
      $this->db->update('settings', $data);
    }
    
    public function update_instructor_settings() {
      $data['value'] = html_escape($this->input->post('allow_instructor'));
      $this->db->where('key', 'allow_instructor');
      $this->db->update('settings', $data);
      
      $data['value'] = html_escape($this->input->post('instructor_revenue'));
      $this->db->where('key', 'instructor_revenue');
      $this->db->update('settings', $data);
    }
    
    public function get_lessons($type = "", $id = "") {
      if($type == "course"){
        return $this->db->get_where('lesson', array('course_id' => $id));
      }
      elseif ($type == "section") {
        return $this->db->get_where('lesson', array('section_id' => $id));
      }
      elseif ($type == "lesson") {
        return $this->db->get_where('lesson', array('id' => $id));
      }
      else {
        return $this->db->get('lesson');
      }
    }
    
    public function add_course($param1 = "") {
      $outcomes = $this->trim_and_return_json($this->input->post('outcomes'));
      $requirements = $this->trim_and_return_json($this->input->post('requirements'));
      
      $data['title'] = html_escape($this->input->post('title'));
      $data['short_description'] = $this->input->post('short_description');
      $data['description'] = $this->input->post('description');
      $data['outcomes'] = $outcomes;
      $data['language'] = $this->input->post('language_made_in');
      $data['category_id'] = $this->input->post('category_id');
      $data['sub_category_id'] = $this->input->post('sub_category_id');
      $data['requirements'] = $requirements;
      $data['price'] = $this->input->post('price');
      $data['discount_flag'] = $this->input->post('discount_flag');
      $data['discounted_price'] = $this->input->post('discounted_price');
      $data['level'] = $this->input->post('level');
      $data['is_free_course'] = $this->input->post('is_free_course');
      $data['video_url'] = html_escape($this->input->post('course_overview_url'));
      
      if ($this->input->post('course_overview_url') != "") {
        $data['course_overview_provider'] = html_escape($this->input->post('course_overview_provider'));
        }else {
        $data['course_overview_provider'] = "";
      }
      
      $data['date_added'] = strtotime(date('D, d-M-Y'));
      $data['section'] = json_encode(array());
      $data['is_top_course'] = $this->input->post('is_top_course');
      $data['user_id'] = $this->session->userdata('user_id');
      $data['meta_description'] = $this->input->post('meta_description');
      $data['meta_keywords'] = $this->input->post('meta_keywords');
      $admin_details = $this->user_model->get_admin_details()->row_array();
      if ($admin_details['id'] == $data['user_id']) {
        $data['is_admin'] = 1;
        }else {
        $data['is_admin'] = 0;
      }
      if ($param1 == "save_to_draft") {
        $data['status'] = 'draft';
        }else{
        $data['status'] = 'pending';
      }
      $this->db->insert('course', $data);
      
      $course_id = $this->db->insert_id();
      if ($_FILES['course_thumbnail']['name'] != "") {
        move_uploaded_file($_FILES['course_thumbnail']['tmp_name'], 'uploads/thumbnails/course_thumbnails/'.$course_id.'.jpg');
      }
      if ($data['status'] == 'approved') {
        $this->session->set_flashdata('flash_message', get_phrase('course_added_successfully'));
        }elseif ($data['status'] == 'pending') {
        $this->session->set_flashdata('flash_message', get_phrase('course_added_successfully').'. '.get_phrase('please_wait_untill_Admin_approves_it'));
        }elseif ($data['status'] == 'draft') {
        $this->session->set_flashdata('flash_message', get_phrase('your_course_has_been_added_to_draft'));
      }
    }
    
    function trim_and_return_json($untrimmed_array) {
      $trimmed_array = array();
      if(sizeof($untrimmed_array) > 0){
        foreach ($untrimmed_array as $row) {
          if ($row != "") {
            array_push($trimmed_array, $row);
          }
        }
      }
      return json_encode($trimmed_array);
    }
    
    public function update_course($course_id, $type = "") {
      $outcomes = $this->trim_and_return_json($this->input->post('outcomes'));
      $requirements = $this->trim_and_return_json($this->input->post('requirements'));
      $data['title'] = $this->input->post('title');
      $data['short_description'] = $this->input->post('short_description');
      $data['description'] = $this->input->post('description');
      $data['outcomes'] = $outcomes;
      $data['language'] = $this->input->post('language_made_in');
      $data['category_id'] = $this->input->post('category_id');
      $data['sub_category_id'] = $this->input->post('sub_category_id');
      $data['requirements'] = $requirements;
      $data['is_free_course'] = $this->input->post('is_free_course');
      $data['price'] = $this->input->post('price');
      $data['discount_flag'] = $this->input->post('discount_flag');
      $data['discounted_price'] = $this->input->post('discounted_price');
      $data['level'] = $this->input->post('level');
      $data['video_url'] = $this->input->post('course_overview_url');
      
      if ($this->input->post('course_overview_url') != "") {
        $data['course_overview_provider'] = html_escape($this->input->post('course_overview_provider'));
        }else {
        $data['course_overview_provider'] = "";
      }
      
      $data['meta_description'] = $this->input->post('meta_description');
      $data['meta_keywords'] = $this->input->post('meta_keywords');
      $data['last_modified'] = strtotime(date('D, d-M-Y'));
      
      if ($this->input->post('is_top_course') != 1) {
        $data['is_top_course'] = 0;
        }else {
        $data['is_top_course'] = 1;
      }
      
      
      if ($type == "save_to_draft") {
        $data['status'] = 'draft';
        }else{
        $data['status'] = 'pending';
      }
      $this->db->where('id', $course_id);
      $this->db->update('course', $data);
      
      if ($_FILES['course_thumbnail']['name'] != "") {
        move_uploaded_file($_FILES['course_thumbnail']['tmp_name'], 'uploads/thumbnails/course_thumbnails/'.$course_id.'.jpg');
      }
      if ($data['status'] == 'approved') {
        $this->session->set_flashdata('flash_message', get_phrase('course_updated_successfully'));
        }elseif ($data['status'] == 'pending') {
        $this->session->set_flashdata('flash_message', get_phrase('course_updated_successfully').'. '.get_phrase('please_wait_untill_Admin_approves_it'));
        }elseif ($data['status'] == 'draft') {
        $this->session->set_flashdata('flash_message', get_phrase('your_course_has_been_added_to_draft'));
      }
    }
    
    public function change_course_status($status = "", $course_id = "") {
      $updater = array(
      'status' => $status
      );
      $this->db->where('id', $course_id);
      $this->db->update('course', $updater);
    }
    
    public function get_courses($category_id = "", $sub_category_id = "", $instructor_id = 0) {
      if ($category_id > 0 && $sub_category_id > 0 && $instructor_id > 0) {
        return $this->db->get_where('course', array('category_id' => $category_id, 'sub_category_id' => $sub_category_id, 'user_id' => $instructor_id));
        }elseif ($category_id > 0 && $sub_category_id > 0 && $instructor_id == 0) {
        return $this->db->get_where('course', array('category_id' => $category_id, 'sub_category_id' => $sub_category_id));
        }else {
        return $this->db->get('course');
      }
    }
    
    public function get_course_thumbnail_url($course_id) {
      
      if (file_exists('uploads/thumbnails/course_thumbnails/'.$course_id.'.jpg'))
      return base_url().'uploads/thumbnails/course_thumbnails/'.$course_id.'.jpg';
      else
            return base_url().'uploads/thumbnails/thumbnail.png';
    }
    public function get_lesson_thumbnail_url($lesson_id) {
      
      if (file_exists('uploads/thumbnails/lesson_thumbnails/'.$lesson_id.'.jpg'))
      return base_url().'uploads/thumbnails/lesson_thumbnails/'.$lesson_id.'.jpg';
      else
            return base_url().'uploads/thumbnails/thumbnail.png';
    }
    
    public function get_my_courses_by_category_id($category_id) {
      $this->db->select('course_id');
      $course_lists_by_enroll = $this->db->get_where('enroll', array('user_id' => $this->session->userdata('user_id')))->result_array();
      $course_ids = array();
      foreach ($course_lists_by_enroll as $row) {
        if (!in_array($row['course_id'], $course_ids)) {
          array_push($course_ids, $row['course_id']);
        }
      }
      $this->db->where_in('id', $course_ids);
      $this->db->where('category_id', $category_id);
      return $this->db->get('course');
    }
    
    public function get_my_courses_by_search_string($search_string) {
      $this->db->select('course_id');
      $course_lists_by_enroll = $this->db->get_where('enroll', array('user_id' => $this->session->userdata('user_id')))->result_array();
      $course_ids = array();
      foreach ($course_lists_by_enroll as $row) {
        if (!in_array($row['course_id'], $course_ids)) {
          array_push($course_ids, $row['course_id']);
        }
      }
      $this->db->where_in('id', $course_ids);
      $this->db->like('title', $search_string);
      return $this->db->get('course');
    }
    
    public function get_courses_by_search_string($search_string) {
      $this->db->like('title', $search_string);
      $this->db->where('status', 'active');
      return $this->db->get('course');
    }
    
    
    public function get_course_by_id($course_id = "") {
      return $this->db->get_where('course', array('id' => $course_id));
    }
    
    public function delete_course($course_id) {
      $this->db->where('id', $course_id);
      $this->db->delete('course');
    }
    
    public function get_top_courses() {
      return $this->db->get_where('course', array('is_top_course' => 1, 'status' => 'active'));
    }
    
    public function get_default_category_id() {
      $categories = $this->get_categories()->result_array();
      foreach ($categories as $category) {
        return $category['id'];
      }
    }
    
    public function get_courses_by_user_id($param1 = "") {
      $courses['draft'] = $this->db->get_where('course', array('user_id' => $param1, 'status' => 'draft'));
      $courses['pending'] = $this->db->get_where('course', array('user_id' => $param1, 'status' => 'pending'));
      $courses['active'] = $this->db->get_where('course', array('user_id' => $param1, 'status' => 'active'));
      return $courses;
    }
    
    public function get_status_wise_courses($status = "") {
      if ($status != "") {
        $courses = $this->db->get_where('course', array('status' => $status));
        }else {
        $courses['draft'] = $this->db->get_where('course', array('status' => 'draft'));
        $courses['pending'] = $this->db->get_where('course', array('status' => 'pending'));
        $courses['active'] = $this->db->get_where('course', array('status' => 'active'));
      }
      
      return $courses;
    }
    
    public function get_default_sub_category_id($default_cateegory_id) {
      $sub_categories = $this->get_sub_categories($default_cateegory_id);
      foreach ($sub_categories as $sub_category) {
        return $sub_category['id'];
      }
    }
    
    public function get_instructor_wise_courses($instructor_id = "", $return_as = "") {
      $courses = $this->db->get_where('course', array('user_id' => $instructor_id));
      if ($return_as == 'simple_array') {
        $array = array();
        foreach ($courses->result_array() as $course) {
          if (!in_array($course['id'], $array)) {
            array_push($array, $course['id']);
          }
        }
        return $array;
        }else {
        return $courses;
      }
    }
    
    public function get_instructor_wise_payment_history($instructor_id = "") {
      $courses = $this->get_instructor_wise_courses($instructor_id, 'simple_array');
      if (sizeof($courses) > 0) {
        $this->db->where_in('course_id', $courses);
        return $this->db->get('payment')->result_array();
        }else {
        return array();
      }
    }
    
    public function add_section($course_id) {
      $data['title'] = html_escape($this->input->post('title'));
      $data['course_id'] = $course_id;
      $this->db->insert('section', $data);
      $section_id = $this->db->insert_id();
      
      $course_details = $this->get_course_by_id($course_id)->row_array();
      $previous_sections = json_decode($course_details['section']);
      
      if (sizeof($previous_sections) > 0) {
        array_push($previous_sections, $section_id);
        $updater['section'] = json_encode($previous_sections);
        $this->db->where('id', $course_id);
        $this->db->update('course', $updater);
        }else {
        $previous_sections = array();
        array_push($previous_sections, $section_id);
        $updater['section'] = json_encode($previous_sections);
        $this->db->where('id', $course_id);
        $this->db->update('course', $updater);
      }
    }
    
    public function edit_section($section_id) {
      $data['title'] = $this->input->post('title');
      $this->db->where('id', $section_id);
      $this->db->update('section', $data);
    }
    
    public function delete_section($course_id, $section_id) {
      $this->db->where('id', $section_id);
      $this->db->delete('section');
      
      $course_details = $this->get_course_by_id($course_id)->row_array();
      $previous_sections = json_decode($course_details['section']);
      
      if (sizeof($previous_sections) > 0) {
        $new_section = array();
        for ($i = 0; $i < sizeof($previous_sections); $i++) {
          if ($previous_sections[$i] != $section_id) {
            array_push($new_section, $previous_sections[$i]);
          }
        }
        $updater['section'] = json_encode($new_section);
        $this->db->where('id', $course_id);
        $this->db->update('course', $updater);
      }
    }
    
    public function get_section($type_by, $id){
      $this->db->order_by("id", "asc");
      if ($type_by == 'course') {
        return $this->db->get_where('section', array('course_id' => $id));
        }elseif ($type_by == 'section') {
        return $this->db->get_where('section', array('id' => $id));
      }
    }
    
    public function serialize_section($course_id, $serialization) {
      $updater = array(
            'section' => $serialization
      );
      $this->db->where('id', $course_id);
      $this->db->update('course', $updater);
    }
    
    public function add_lesson() {
      $data['course_id'] = html_escape($this->input->post('course_id'));
      $data['title'] = html_escape($this->input->post('title'));
      $data['section_id'] = html_escape($this->input->post('section_id'));
      
      $lesson_type_array = explode('-', $this->input->post('lesson_type'));
      $lesson_type = $lesson_type_array[0];
      
      $data['attachment_type'] = $lesson_type_array[1];
      $data['lesson_type'] = $lesson_type;
      
      if($lesson_type == 'video') {
        $lesson_provider = $this->input->post('lesson_provider');
        if ($lesson_provider == 'youtube' || $lesson_provider == 'vimeo') {
          if ($this->input->post('video_url') == "" || $this->input->post('duration') == "") {
            $this->session->set_flashdata('error_message',get_phrase('invalid_lesson_url_and_duration'));
            if(strtolower($this->session->userdata('role')) == 'user') {
              redirect(site_url('home/edit_course/'.$data['course_id'].'/manage_lesson'), 'refresh');
              }else {
              redirect(site_url('admin/lesson_form/add_lesson/'.$data['course_id']), 'refresh');
            }
            
          }
          $data['video_url'] = html_escape($this->input->post('video_url'));
          
          $duration_formatter = explode(':', $this->input->post('duration'));
          $hour = sprintf('%02d', $duration_formatter[0]);
          $min = sprintf('%02d', $duration_formatter[1]);
          $sec = sprintf('%02d', $duration_formatter[2]);
          $data['duration'] = $hour.':'.$min.':'.$sec;
          
          $video_details = $this->video_model->getVideoDetails($data['video_url']);
          $data['video_type'] = $video_details['provider'];
          }elseif ($lesson_provider == 'html5') {
          if ($this->input->post('html5_video_url') == "" || $this->input->post('html5_duration') == "") {
            $this->session->set_flashdata('error_message',get_phrase('invalid_lesson_url_and_duration'));
            if(strtolower($this->session->userdata('role')) == 'user') {
              redirect(site_url('home/edit_course/'.$data['course_id'].'/manage_lesson'), 'refresh');
              }else {
              redirect(site_url('admin/lesson_form/add_lesson/'.$data['course_id']), 'refresh');
            }
          }
          $data['video_url'] = html_escape($this->input->post('html5_video_url'));
          $duration_formatter = explode(':', $this->input->post('html5_duration'));
          $hour = sprintf('%02d', $duration_formatter[0]);
          $min = sprintf('%02d', $duration_formatter[1]);
          $sec = sprintf('%02d', $duration_formatter[2]);
          $data['duration'] = $hour.':'.$min.':'.$sec;
          $data['video_type'] = 'html5';
          }else {
          $this->session->set_flashdata('error_message',get_phrase('invalid_lesson_provider'));
          if(strtolower($this->session->userdata('role')) == 'user') {
            redirect(site_url('home/edit_course/'.$data['course_id'].'/manage_lesson'), 'refresh');
            }else {
            redirect(site_url('admin/lesson_form/add_lesson/'.$data['course_id']), 'refresh');
          }
        }
        }else {
        if ($_FILES['attachment']['name'] == "") {
          $this->session->set_flashdata('error_message',get_phrase('invalid_attachment'));
          if(strtolower($this->session->userdata('role')) == 'user') {
            redirect(site_url('home/edit_course/'.$data['course_id'].'/manage_lesson'), 'refresh');
            }else {
            redirect(site_url('admin/lesson_form/add_lesson/'.$data['course_id']), 'refresh');
          }
          }else {
          $fileName           = $_FILES['attachment']['name'];
          $tmp                = explode('.', $fileName);
          $fileExtension      = end($tmp);
          $uploadable_file    =  md5(uniqid(rand(), true)).'.'.$fileExtension;
          $data['attachment'] = $uploadable_file;
          move_uploaded_file($_FILES['attachment']['tmp_name'], 'uploads/lesson_files/'.$uploadable_file);
        }
      }
      
      $data['date_added'] = strtotime(date('D, d-M-Y'));
      $data['summary'] = $this->input->post('summary');
      
      $this->db->insert('lesson', $data);
      $inserted_id = $this->db->insert_id();
      move_uploaded_file($_FILES['thumbnail']['tmp_name'], 'uploads/thumbnails/lesson_thumbnails/'.$inserted_id.'.jpg');
    }
    
    public function edit_lesson($lesson_id) {
      
      $previous_data = $this->db->get_where('lesson', array('id' => $lesson_id))->row_array();
      // unlinking previous attachments
      if ($previous_data['attachment'] != "") {
        unlink('uploads/lesson_files/'.$previous_data['attachment']);
      }
      
      
      $data['course_id'] = html_escape($this->input->post('course_id'));
      $data['title'] = html_escape($this->input->post('title'));
      $data['section_id'] = html_escape($this->input->post('section_id'));
      
      $lesson_type_array = explode('-', $this->input->post('lesson_type'));
      $lesson_type = $lesson_type_array[0];
      
      $data['attachment_type'] = $lesson_type_array[1];
      $data['lesson_type'] = $lesson_type;
      
      if($lesson_type == 'video') {
        $lesson_provider = $this->input->post('lesson_provider');
        if ($lesson_provider == 'youtube' || $lesson_provider == 'vimeo') {
          if ($this->input->post('video_url') == "" || $this->input->post('duration') == "") {
            $this->session->set_flashdata('error_message',get_phrase('invalid_lesson_url_and_duration'));
            redirect(site_url('admin/lesson_form/add_lesson/'.$data['course_id']), 'refresh');
          }
          $data['video_url'] = html_escape($this->input->post('video_url'));
          
          $duration_formatter = explode(':', $this->input->post('duration'));
          $hour = sprintf('%02d', $duration_formatter[0]);
          $min = sprintf('%02d', $duration_formatter[1]);
          $sec = sprintf('%02d', $duration_formatter[2]);
          $data['duration'] = $hour.':'.$min.':'.$sec;
          
          $video_details = $this->video_model->getVideoDetails($data['video_url']);
          $data['video_type'] = $video_details['provider'];
          }elseif ($lesson_provider == 'html5') {
          if ($this->input->post('html5_video_url') == "" || $this->input->post('html5_duration') == "") {
            $this->session->set_flashdata('error_message',get_phrase('invalid_lesson_url_and_duration'));
            redirect(site_url('admin/lesson_form/add_lesson/'.$data['course_id']), 'refresh');
          }
          $data['video_url'] = html_escape($this->input->post('html5_video_url'));
          
          $duration_formatter = explode(':', $this->input->post('html5_duration'));
          $hour = sprintf('%02d', $duration_formatter[0]);
          $min = sprintf('%02d', $duration_formatter[1]);
          $sec = sprintf('%02d', $duration_formatter[2]);
          $data['duration'] = $hour.':'.$min.':'.$sec;
          
          $data['video_type'] = 'html5';
          }else {
          $this->session->set_flashdata('error_message',get_phrase('invalid_lesson_provider'));
          redirect(site_url('admin/lesson_form/add_lesson/'.$data['course_id']), 'refresh');
        }
        $data['attachment'] = "";
        }else {
        if ($_FILES['attachment']['name'] == "") {
          $this->session->set_flashdata('error_message',get_phrase('invalid_attachment'));
          redirect(site_url('admin/lesson_form/add_lesson/'.$data['course_id']), 'refresh');
          }else {
          $fileName           = $_FILES['attachment']['name'];
          $tmp                = explode('.', $fileName);
          $fileExtension      = end($tmp);
          $uploadable_file    =  md5(uniqid(rand(), true)).'.'.$fileExtension;
          $data['attachment'] = $uploadable_file;
          $data['video_type'] = "";
          $data['duration'] = "";
          $data['video_url'] = "";
          
          move_uploaded_file($_FILES['attachment']['tmp_name'], 'uploads/lesson_files/'.$uploadable_file);
        }
      }
      
      $data['last_modified'] = strtotime(date('D, d-M-Y'));
      $data['summary'] = $this->input->post('summary');
      
      $this->db->where('id', $lesson_id);
      $this->db->update('lesson', $data);
      
      if ($_FILES['thumbnail']['name'] != "") {
        move_uploaded_file($_FILES['thumbnail']['tmp_name'], 'uploads/thumbnails/lesson_thumbnails'.$lesson_id.'.jpg');
      }
    }
    public function delete_lesson($lesson_id) {
      $this->db->where('id', $lesson_id);
      $this->db->delete('lesson');
    }
    
    public function update_frontend_settings() {
      $data['value'] = html_escape($this->input->post('banner_title'));
      $this->db->where('key', 'banner_title'); 
      $this->db->update('frontend_settings', $data);
      
      
      $data['value'] = html_escape($this->input->post('banner_sub_title'));
      $this->db->where('key', 'banner_sub_title');
      $this->db->update('frontend_settings', $data);
      
      $data['value'] = $this->input->post('about_us');
      $this->db->where('key', 'about_us');
      $this->db->update('frontend_settings', $data);
      
      $data['value'] = $this->input->post('terms_and_condition');
      $this->db->where('key', 'terms_and_condition');
      $this->db->update('frontend_settings', $data);
      
      $data['value'] = $this->input->post('privacy_policy');
      $this->db->where('key', 'privacy_policy');
      $this->db->update('frontend_settings', $data);
      
      $data['value'] = html_escape($this->input->post('que_inc_per'));
      $this->db->where('key', 'que_inc_per'); 
      $this->db->update('frontend_settings', $data);
      
      $data['value'] = html_escape($this->input->post('que_ask_per'));
      $this->db->where('key', 'que_ask_per'); 
      $this->db->update('frontend_settings', $data);
      
      $data['value'] = html_escape($this->input->post('real_topper'));
      $this->db->where('key', 'real_topper'); 
      $this->db->update('frontend_settings', $data);
      
      $data['value'] = html_escape($this->input->post('user_amount'));
      $this->db->where('key', 'user_amount'); 
      $this->db->update('frontend_settings', $data);
      
      $data['value'] = html_escape($this->input->post('referral_amount'));
      $this->db->where('key', 'referral_amount'); 
      $this->db->update('frontend_settings', $data);
    }
    
    public function update_frontend_banner() {
      move_uploaded_file($_FILES['banner_image']['tmp_name'], 'uploads/frontend/home-banner.jpg');
    }
    
    public function handleWishList($course_id) {
      $wishlists = array();
      $user_details = $this->user_model->get_user($this->session->userdata('user_id'))->row_array();
      if ($user_details['wishlist'] == "") {
        array_push($wishlists, $course_id);
        }else {
        $wishlists = json_decode($user_details['wishlist']);
        if (in_array($course_id, $wishlists)) {
          $container = array();
          foreach ($wishlists as $key) {
            if ($key != $course_id) {
              array_push($container, $key);
            }
          }
          $wishlists = $container;
          // $key = array_search($course_id, $wishlists);
          // unset($wishlists[$key]);
          }else {
          array_push($wishlists, $course_id);
        }
      }
      
      $updater['wishlist'] = json_encode($wishlists);
      $this->db->where('id', $this->session->userdata('user_id'));
      $this->db->update('users', $updater);
    }
    
    public function is_added_to_wishlist($course_id = "") {
      if ($this->session->userdata('user_login') == 1) {
        $wishlists = array();
        $user_details = $this->user_model->get_user($this->session->userdata('user_id'))->row_array();
        $wishlists = json_decode($user_details['wishlist']);
        if (in_array($course_id, $wishlists)) {
          return true;
          }else {
          return false;
        }
        }else {
        return false;
      }
    }
    
    public function getWishLists() {
      $user_details = $this->user_model->get_user($this->session->userdata('user_id'))->row_array();
      return json_decode($user_details['wishlist']);
    }
    
    public function get_latest_10_course() {
      $this->db->order_by("id", "desc");
      $this->db->limit('10');
      $this->db->where('status', 'active');
      return $this->db->get('course')->result_array();
    }
    
    public function enroll_student($user_id, $sub_category_id, $enroll_type='Normal'){
      
      $query = $this->db->select('*')
      ->from('enroll')
      ->where('user_id',$user_id)
      ->where('sub_category_id',$sub_category_id)
      ->get();
      
      if($query->num_rows()>0 && $enroll_type=='Normal')
      {
        $result = $query->row();
        if(!isset($result->end_date))
        {
          $result->end_date = date('Y-m-d');
        }
        $data['enroll_type'] = $enroll_type;
        if(!isset($result->start_date))
        {
          $data['start_date'] = date('Y-m-d');
        }
        if($this->session->userdata('posted')['subscription_type'] == 'yearly')
        {
          $data['end_date'] = date('Y-m-d',strtotime('+1 year',strtotime($result->end_date)));
        }
        else if($this->session->userdata('posted')['subscription_type'] == 'half_yearly')
        {
          $data['end_date'] = date('Y-m-d',strtotime('+6 month',strtotime($result->end_date)));
        }
        else if($this->session->userdata('posted')['subscription_type'] == 'quarterly')
        {
          $data['end_date'] = date('Y-m-d',strtotime('+3 month',strtotime($result->end_date)));
        }
        
        
        $this->db->where('id', $result->id);
        $this->db->update('enroll',$data);
        return $result->id;
      }
      elseif($enroll_type=='Normal' || $query->num_rows()==0)
      {
        $data['user_id'] = $user_id;
        $data['sub_category_id'] = $sub_category_id;
        $data['date_added'] = date('Y-m-d-H-i-s');
        $data['start_date'] = date('Y-m-d');
        $data['enroll_type'] = $enroll_type;
        if($this->session->userdata('posted')['subscription_type'] == 'yearly')
        {
          $data['end_date'] = date('Y-m-d',strtotime('+1 year'));
        }
        else if($this->session->userdata('posted')['subscription_type'] == 'half_yearly')
        {
          $data['end_date'] = date('Y-m-d',strtotime('+6 month'));
        }
        else if($this->session->userdata('posted')['subscription_type'] == 'quarterly')
        {
          $data['end_date'] = date('Y-m-d',strtotime('+3 month'));
        }
        if($enroll_type=='Trial') {
          $data['end_date'] = date('Y-m-d', strtotime('+5 day'));
        }
        
        $this->db->insert('enroll', $data);
        return $this->db->insert_id();
      } else {
        return 0;
      }
    }

    public function getenroll_student($user_id, $sub_category_id){
      $query = $this->db->select('*')
      ->from('enroll')
      ->where('user_id',$user_id)
      ->where('sub_category_id',$sub_category_id)
      ->get();
      return $query;
    }

    public function enroll_a_student_manually() {
      $data['course_id'] = $this->input->post('course_id');
      $data['user_id']   = $this->input->post('user_id');
      if ($this->db->get_where('enroll', $data)->num_rows() > 0) {
        $this->session->set_flashdata('error_message', get_phrase('student_has_already_been_enrolled_to_this_course'));
        }else {
        $data['date_added'] = strtotime(date('D, d-M-Y'));
        $this->db->insert('enroll', $data);
        $this->session->set_flashdata('flash_message', get_phrase('student_has_been_enrolled_to_that_course'));
      }
    }
    
    public function enroll_to_free_course($course_id = "", $user_id = "") {
      $data['course_id'] = $course_id;
      $data['user_id']   = $user_id;
      if ($this->db->get_where('enroll', $data)->num_rows() > 0) {
        $this->session->set_flashdata('error_message', get_phrase('student_has_already_been_enrolled_to_this_course'));
        }else {
        $data['date_added'] = strtotime(date('D, d-M-Y'));
        $this->db->insert('enroll', $data);
        $this->session->set_flashdata('flash_message', get_phrase('successfully_enrolled'));
      }
    }
    public function course_purchase($user_id, $method, $amount_paid) {
      $purchased_courses = $this->session->userdata('cart_items');
      foreach ($purchased_courses as $purchased_course) {
        $data['user_id'] = $user_id;
        $data['payment_type'] = $method;
        $data['course_id'] = $purchased_course;
        $course_details = $this->get_course_by_id($purchased_course)->row_array();
        if ($course_details['discount_flag'] == 1) {
          $data['amount'] = $course_details['discounted_price'];
          }else {
          $data['amount'] = $course_details['price'];
        }
        if (get_user_role('role_id', $course_details['user_id']) == 1) {
          $data['admin_revenue'] = $data['amount'];
          $data['instructor_revenue'] = 0;
          $data['instructor_payment_status'] = 1;
          }else {
          if (get_settings('allow_instructor') == 1) {
            $instructor_revenue_percentage = get_settings('instructor_revenue');
            $data['instructor_revenue'] = ceil(($data['amount'] * $instructor_revenue_percentage) / 100);
            $data['admin_revenue'] = $data['amount'] - $data['instructor_revenue'];
            }else {
            $data['instructor_revenue'] = 0;
            $data['admin_revenue'] = $data['amount'];
          }
          $data['instructor_payment_status'] = 0;
        }
        $data['date_added'] = strtotime(date('D, d-M-Y'));
        $this->db->insert('payment', $data);
      }
    }
    
    public function quiz_purchase($user_id, $method, $amount_paid, $sub_category_id , $coupon_amount, $coupon_code, $enroll_id) {
            
            $data['user_id'] = $user_id;
            $data['order_id'] = $this->input->post('orderId');
            $data['reference_id'] = $this->input->post('referenceId');
            $data['payment_status'] = $this->input->post('txStatus');
            
            $data['payment_type'] = $method;
            $data['amount'] = $amount_paid;
            $data['sub_category_id'] = $sub_category_id;
            $data['coupon_amount'] = $coupon_amount;
            $data['coupon_code'] = $coupon_code;
            $data['enroll_id'] = $enroll_id;
            
            $data['date_added'] = strtotime(date('D, d-M-Y'));
            $this->db->insert('payment', $data);
      
    }
    
    public function update_enroll_status($user_id){
      $data['enroll_status'] = 1;
      $data['payment_status'] = 1;
      $this->db->where('user_id', $user_id);
      $this->db->where('type', 'user');
      $this->db->update('referral', $data);
      
      $datar['enroll_status'] = 1;
      $datar['payment_status'] = 1;
      $this->db->where('referral_id', $user_id);
      $this->db->where('type', 'referral'); 
      $this->db->update('referral', $datar);
    }
    
    public function get_default_lesson($section_id) {
      $this->db->order_by('id',"asc");
      $this->db->limit(1);
      $this->db->where('section_id', $section_id);
      return $this->db->get('lesson');
    }
    
    public function get_courses_by_wishlists() {
      $wishlists = $this->getWishLists();
      if (sizeof($wishlists) > 0) {
        $this->db->where_in('id', $wishlists);
        return $this->db->get('course')->result_array();
        }else {
        return array();
      }
      
    }
    
    
    public function get_courses_of_wishlists_by_search_string($search_string) {
      $wishlists = $this->getWishLists();
      if (sizeof($wishlists) > 0) {
        $this->db->where_in('id', $wishlists);
        $this->db->like('title', $search_string);
        return $this->db->get('course')->result_array();
        }else {
        return array();
      }
    }
    
    public function get_total_duration_of_lesson_by_course_id($course_id) {
      $total_duration = 0;
      $lessons = $this->crud_model->get_lessons('course', $course_id)->result_array();
      foreach ($lessons as $lesson) {
        if ($lesson['lesson_type'] != "other") {
          $time_array = explode(':', $lesson['duration']);
          $hour_to_seconds = $time_array[0] * 60 * 60;
          $minute_to_seconds = $time_array[1] * 60;
          $seconds = $time_array[2];
          $total_duration += $hour_to_seconds + $minute_to_seconds + $seconds;
        }
      }
      return gmdate("H:i:s", $total_duration).' '.get_phrase('hours');
    }
    
    public function get_total_duration_of_lesson_by_section_id($section_id) {
      $total_duration = 0;
      $lessons = $this->crud_model->get_lessons('section', $section_id)->result_array();
      foreach ($lessons as $lesson) {
        if ($lesson['lesson_type'] != 'other') {
          $time_array = explode(':', $lesson['duration']);
          $hour_to_seconds = $time_array[0] * 60 * 60;
          $minute_to_seconds = $time_array[1] * 60;
          $seconds = $time_array[2];
          $total_duration += $hour_to_seconds + $minute_to_seconds + $seconds;
        }
      }
      return gmdate("H:i:s", $total_duration).' '.get_phrase('hours');
    }
    
    public function rate($data) {
      if ($this->db->get_where('rating', array('user_id' => $data['user_id'], 'ratable_id' => $data['ratable_id'], 'ratable_type' => $data['ratable_type']))->num_rows() == 0) {
        $this->db->insert('rating', $data);
        }else {
        $checker = array('user_id' => $data['user_id'], 'ratable_id' => $data['ratable_id'], 'ratable_type' => $data['ratable_type']);
        $this->db->where($checker);
        $this->db->update('rating', $data);
      }
    }
    
    public function get_user_specific_rating($ratable_type = "", $ratable_id = "") {
      return $this->db->get_where('rating', array('ratable_type' => $ratable_type, 'user_id' => $this->session->userdata('user_id'), 'ratable_id' => $ratable_id))->row_array();
    }
    
    public function get_ratings($ratable_type = "", $ratable_id = "", $is_sum = false) {
      if ($is_sum) {
        $this->db->select_sum('rating');
        return $this->db->get_where('rating', array('ratable_type' => $ratable_type, 'ratable_id' => $ratable_id));
        
        }else {
        return $this->db->get_where('rating', array('ratable_type' => $ratable_type, 'ratable_id' => $ratable_id));
      }
    }
    public function get_instructor_wise_course_ratings($instructor_id = "", $ratable_type = "", $is_sum = false) {
      $course_ids = $this->get_instructor_wise_courses($instructor_id, 'simple_array');
      if ($is_sum) {
        $this->db->where('ratable_type', $ratable_type);
        $this->db->where_in('ratable_id', $course_ids);
        $this->db->select_sum('rating');
        return $this->db->get('rating');
        
        }else {
        $this->db->where('ratable_type', $ratable_type);
        $this->db->where_in('ratable_id', $course_ids);
        return $this->db->get('rating');
      }
    }
    public function get_percentage_of_specific_rating($rating = "", $ratable_type = "", $ratable_id = "") {
      $number_of_user_rated = $this->db->get_where('rating', array(
            'ratable_type' => $ratable_type,
            'ratable_id'   => $ratable_id
      ))->num_rows();
      
      $number_of_user_rated_the_specific_rating = $this->db->get_where( 'rating', array(
            'ratable_type' => $ratable_type,
            'ratable_id'   => $ratable_id,
            'rating'       => $rating
      ))->num_rows();
      
      //return $number_of_user_rated.' '.$number_of_user_rated_the_specific_rating;
      if ($number_of_user_rated_the_specific_rating > 0) {
        $percentage = ($number_of_user_rated_the_specific_rating / $number_of_user_rated) * 100;
        }else {
        $percentage = 0;
      }
      return floor($percentage);
    }
    
    ////////private message//////
    function send_new_private_message() {
      $message    = $this->input->post('message');
      $timestamp  = strtotime(date("Y-m-d H:i:s"));
      
      $recievers   = $this->input->post('reciever');
      $sender     = $this->session->userdata('user_id');
      
      foreach($recievers as $reciever){
        //check if the thread between those 2 users exists, if not create new thread
        $num1 = $this->db->get_where('message_thread', array('sender' => $sender, 'reciever' => $reciever))->num_rows();
        $num2 = $this->db->get_where('message_thread', array('sender' => $reciever, 'reciever' => $sender))->num_rows();
        if ($num1 == 0 && $num2 == 0) {
          $message_thread_code                        = substr(md5(rand(100000000, 20000000000)), 0, 15);
          $data_message_thread['message_thread_code'] = $message_thread_code;
          $data_message_thread['sender']              = $sender;
          $data_message_thread['reciever']            = $reciever;
          $this->db->insert('message_thread', $data_message_thread);
        }
        if ($num1 > 0)
                $message_thread_code = $this->db->get_where('message_thread', array('sender' => $sender, 'reciever' => $reciever))->row()->message_thread_code;
        if ($num2 > 0)
                $message_thread_code = $this->db->get_where('message_thread', array('sender' => $reciever, 'reciever' => $sender))->row()->message_thread_code;
        
        
        $data_message['message_thread_code']    = $message_thread_code;
        $data_message['message']                = $message;
        $data_message['sender']                 = $sender;
        $data_message['timestamp']              = $timestamp;
        $this->db->insert('message', $data_message);
      }
      
      return $message_thread_code;
    }
    
    function send_reply_message($message_thread_code) {
      $message    = html_escape($this->input->post('message'));
      $timestamp  = strtotime(date("Y-m-d H:i:s"));
      $sender     = $this->session->userdata('user_id');
      
      $data_message['message_thread_code']    = $message_thread_code;
      $data_message['message']                = $message;
      $data_message['sender']                 = $sender;
      $data_message['timestamp']              = $timestamp;
      $this->db->insert('message', $data_message);
    }
    
    function mark_thread_messages_read($message_thread_code) {
      // mark read only the oponnent messages of this thread, not currently logged in user's sent messages
      $current_user = $this->session->userdata('user_id');
      $this->db->where('sender !=', $current_user);
      $this->db->where('message_thread_code', $message_thread_code);
      $this->db->update('message', array('read_status' => 1));
    }
    
    function count_unread_message_of_thread($message_thread_code) {
      $unread_message_counter = 0;
      $current_user = $this->session->userdata('user_id');
      $messages = $this->db->get_where('message', array('message_thread_code' => $message_thread_code))->result_array();
      foreach ($messages as $row) {
        if ($row['sender'] != $current_user && $row['read_status'] == '0')
                $unread_message_counter++;
      }
      return $unread_message_counter;
    }
    
    public function get_last_message_by_message_thread_code($message_thread_code) {
      $this->db->order_by('message_id','desc');
      $this->db->limit(1);
      $this->db->where(array('message_thread_code' => $message_thread_code));
      return $this->db->get('message');
    }
    
    function curl_request($code = '') {
      
      $product_code = $code;
      
      $personal_token = "FkA9UyDiQT0YiKwYLK3ghyFNRVV9SeUn";
      $url = "https://api.envato.com/v3/market/author/sale?code=".$product_code;
      $curl = curl_init($url);
      
      //setting the header for the rest of the api
      $bearer   = 'bearer ' . $personal_token;
      $header   = array();
      $header[] = 'Content-length: 0';
      $header[] = 'Content-type: application/json; charset=utf-8';
      $header[] = 'Authorization: ' . $bearer;
      
      $verify_url = 'https://api.envato.com/v1/market/private/user/verify-purchase:'.$product_code.'.json';
      $ch_verify = curl_init( $verify_url . '?code=' . $product_code );
      
      curl_setopt( $ch_verify, CURLOPT_HTTPHEADER, $header );
      curl_setopt( $ch_verify, CURLOPT_SSL_VERIFYPEER, false );
      curl_setopt( $ch_verify, CURLOPT_RETURNTRANSFER, 1 );
      curl_setopt( $ch_verify, CURLOPT_CONNECTTIMEOUT, 5 );
      curl_setopt( $ch_verify, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
      
      $cinit_verify_data = curl_exec( $ch_verify );
      curl_close( $ch_verify );
      
      $response = json_decode($cinit_verify_data, true);
      
      if (count($response['verify-purchase']) > 0) {
        return true;
        } else {
        return false;
      }
    }
    
    
    // version 1.3
    function get_currencies() {
      return $this->db->get('currency')->result_array();
    }
    
    function get_paypal_supported_currencies() {
      $this->db->where('paypal_supported', 1);
      return $this->db->get('currency')->result_array();
    }
    
    function get_stripe_supported_currencies() {
      $this->db->where('stripe_supported', 1);
      return $this->db->get('currency')->result_array();
    }
    
    // code start by khushboo
    public function get_subjects($param1 = "", $param2="", $param3="", $param4="") {
      $this->db->select('s.*, m.title, c.name AS category_name, sc.name AS sub_category_name, c.id AS category_id, sc.id AS sub_category_id')
        ->from('subject as s')
        ->join('m00_samester AS m', 'm.id = s.samester', 'left')
        ->join('category AS sc', 'sc.id = m.subcategory_id', 'left')
        ->join('category AS c', 'c.id = sc.parent', 'left');
      if ($param1 != "") {
        $this->db->where('s.id', $param1);
      }

      if ($param3 != "") {
        $this->db->where('c.id', $param3);
      }

      if ($param4 != "") {
        $this->db->where('sc.id', $param4);
      }

      if ($param2 != "") {
        $this->db->where('s.samester', $param2);
      }
      return $this->db->get();
    }
    
    public function add_subject() {
      $data['code'] = html_escape($this->input->post('code'));
      $data['name'] = html_escape($this->input->post('name'));
      $data['category_id'] = html_escape($this->input->post('category_id'));
      $data['sub_category_id'] = html_escape($this->input->post('sub_category_id'));
      $data['samester'] = html_escape($this->input->post('samester'));
      $data['font_awesome_class'] = 'fa '.html_escape($this->input->post('font_awesome_class'));
      $data['date_added'] = strtotime(date('D, d-M-Y'));
      $this->db->insert('subject', $data);
    }
    
    public function edit_subject($param1) {
      $data['name'] = html_escape($this->input->post('name'));
      $data['category_id'] = html_escape($this->input->post('category_id'));
      $data['sub_category_id'] = html_escape($this->input->post('sub_category_id'));
      $data['samester'] = html_escape($this->input->post('samester'));
      if($this->input->post('font_awesome_class')!='') {
        $data['font_awesome_class'] = 'fa '.html_escape($this->input->post('font_awesome_class'));
      } 
      $data['last_modified'] = strtotime(date('D, d-M-Y'));
      $this->db->where('id', $param1);
      $this->db->update('subject', $data);
    }
    
    public function delete_subject($subject_id) {
      $this->db->where('id', $subject_id);
      if(!$this->db->delete('subject')){
        return false;
        }else{
        return true;
      }
    }
    
    // code start by visham
    public function get_assignsubjects($param1 = "") {
      $this->db->select('subject.name, subject.id, assign_subject.id AS assignid');
      $this->db->join('assign_subject', 'assign_subject.subject_id = subject.id');
      if ($param1 != "") {
        $this->db->where('assign_subject.user_id', $param1);
      }
      return $this->db->get('subject');
    }
    
    public function get_notassignsubjects($param1 = "") {
      $this->db->select('subject.name, subject.id');
      if ($param1 != "") {
        $this->db->where('subject.id NOT IN (SELECT subject_id FROM assign_subject WHERE user_id='. $param1 .')');
      }
      return $this->db->get('subject');
    }
    
    public function add_assignsubject($param1 = '') { 
      foreach ($this->input->post('subject') as $key => $value) {
        $batch[] = array(
        'subject_id' => $value,
        'user_id' => $param1,
        'assigndate' => date('Y-m-d H:i:s'),
        'status' => 1
        );
      }
      if(isset($batch) && !empty($batch)) {
        $this->db->insert_batch('assign_subject', $batch);
        $this->session->set_flashdata('flash_message', get_phrase('subject_added_successfully'));
        } else {
        $this->session->set_flashdata('error_message', get_phrase('please_select_subject'));
      }
    }
    
    public function edit_assignsubject($param1) {
      $data['name'] = html_escape($this->input->post('name'));
      $data['last_modified'] = strtotime(date('D, d-M-Y'));
      $this->db->where('id', $param1);
      $this->db->update('subject', $data);
    }
    
    public function delete_assignsubject($param1) {
      $this->db->where('id', $param1);
      if(!$this->db->delete('assign_subject')){
        $this->session->set_flashdata('error_message', get_phrase('error_occured'));
        }else{
        $this->session->set_flashdata('flash_message', get_phrase('subject_removed_successfully'));
      }
    }
    
    public function get_questions($param1 = "", $param2="", $param3="", $param4="", $param5="", $param6="", $param7="", $limit='') {
      $this->db->select('questions.*, subject.name, sm.id AS samester_id, sc.id AS subcategory_id, c.id AS category_id');
      if ($param1 != "") {
        $this->db->where('questions.id', $param1);
      }
      if ($param2 != "") {
        $this->db->where('questions.userID', $param2);
      }
      $this->db->join('subject', 'subject.id = questions.subject_id', 'left')
        ->join('m01_chapter AS ch', 'ch.id = questions.chapter_id', 'left')
        ->join('m00_samester AS sm', 'sm.id = subject.samester', 'left')
        ->join('category AS sc', 'sc.id = sm.subcategory_id', 'left')
        ->join('category AS c', 'c.id = sc.parent', 'left');
      
      if ($param3 != "") {
        $this->db->where('questions.status', $param3);
      }

      if ($param4 != "") {
        $this->db->where('c.id', $param4);
      }
      if ($param5 != "") {
        $this->db->where('sc.id', $param5);
      }
      if ($param6 != "") {
        $this->db->where('sm.id', $param6);
      }
      if ($param7 != "") {
        $this->db->where('subject.id', $param7);
      }
      if($limit!='') {
        $this->db->limit($limit);
      }
      return $this->db->get('questions');
    }

    public function QuestionCountByStatus($param1='') {
      $this->db->select("SUM(1) AS total, SUM(IF(status=1, 1, 0)) AS approved, SUM(IF(status=2, 1, 0)) AS rejected, SUM(IF(status=0, 1, 0)) AS sent, SUM(IF(status=3, 1, 0)) AS pending");
      if($param1!='') {
        $this->db->where('userID', $param1);
      } 
      $this->db->group_by('userID');
      return $this->db->get('questions');
    }
    
    public function add_question() {
      $data['subject_id'] = html_escape($this->input->post('subject_id'));
      $data['chapter_id'] = html_escape($this->input->post('chapter_id'));
      $data['question'] = $this->input->post('question');
      $data['explanation'] = html_escape($this->input->post('explanation'));
      $data['marks'] = $this->input->post('marks');
      $data['correct_answer'] = html_escape($this->input->post('correct_answer'));
      $options[]= $this->input->post('option1');
      $options[]= $this->input->post('option2');
      $options[]= $this->input->post('option3');
      $options[]= $this->input->post('option4');
      $data['options'] = $this->trim_and_return_json($options);
      $data['status'] = ($this->session->userdata('teacher_login') == 1 ? 3 : 1);
      $data['userID'] = $this->session->userdata('user_id');
      // echo '<pre>';
      // print_r($data); exit;
      $this->db->insert('questions', $data);
    }
    
    public function update_question($param1='', $param2='') {
      $data['subject_id'] = html_escape($this->input->post('subject_id'));
      $data['chapter_id'] = html_escape($this->input->post('chapter_id'));
      $data['question'] = $this->input->post('question');
      // $data['explanation'] = stripslashes($this->input->post('explanation'));
      $data['explanation'] = $this->input->post('explanation');
      $data['marks'] = html_escape($this->input->post('marks'));
      $data['correct_answer'] = html_escape($this->input->post('correct_answer'));
      $options[]= $this->input->post('option1');
      $options[]= $this->input->post('option2');
      $options[]= $this->input->post('option3');
      $options[]= $this->input->post('option4');
      $data['options'] = $this->trim_and_return_json($options);
      $this->db->where('id', $param1);
      if($param2!='') {
        $this->db->where('userID', $param2);
      }
      $this->db->update('questions', $data);
      //  echo '<pre>';
      // print_r($this->db->last_query()); exit;
    }
    
    public function change_questionstatus($param1='', $param2='') { 
      $data['status'] = $param1;
      if(is_array($param2)) {
        $this->db->where_in('id', $param2);
        } else {
        $this->db->where('id', $param2);
      }
      $this->db->update('questions', $data);
      //  echo '<pre>';
      // print_r($this->db->last_query()); exit;
    }
    
    public function get_exam_pattern($category_id){
      $this->db->select("ed.*, GROUP_CONCAT(CONCAT(s.name, ' : ', ep.num_of_que) SEPARATOR '<br/>') as numOfQue, c.name as subCategory, ep.sub_category_id");
      $this->db->join('exam_pattern as ep', 'ed.id= ep.exam_id');
      $this->db->join('subject as s', 's.id= ep.subject_id');
      $this->db->join('category as c', 'c.id= ep.sub_category_id');
      $this->db->where('ed.category_id', $category_id);
      $this->db->group_by('ep.sub_category_id');
      return $this->db->get('exam_detail as ed');
    }
    
    public function get_edit_exam_pattern($exam_id){
      $this->db->select("ed.*, ep.*");
      $this->db->join('exam_pattern as ep', 'ed.id= ep.exam_id');
      $this->db->where('ed.id', $exam_id);
      return $this->db->get('exam_detail as ed');
    }
    
    public function add_pattern(){
      $data['attempt_time'] = html_escape($this->input->post('attempt_time'));
      $data['cron_start'] = html_escape($this->input->post('cron_start'));
      if($this->input->post('exam_id')){
        $this->db->where('id', $this->input->post('exam_id'));
        $this->db->update('exam_detail', $data);
        }else{
        $data['category_id'] = html_escape($this->input->post('category_id'));
        $this->db->insert('exam_detail', $data);
        $insert_id = $this->db->insert_id();
      }
      $subjects = html_escape($this->input->post('subjects')); 
      $data = array();
      foreach($subjects as $sub){
        $data['subject_id'] = $sub;
        $data['num_of_que'] = html_escape($this->input->post($sub.'_noOfQue'));
        if($this->input->post('exam_id')){
          $where = array('exam_id'=>$this->input->post('exam_id'), 'subject_id'=>$sub);
          $this->db->where($where); 
          $counts= $this->db->get('exam_pattern')->num_rows();
          if($counts > 0) {
            $this->db->where($where);
            $this->db->update('exam_pattern', $data);
          } else {
            $data['exam_id'] = $this->input->post('exam_id');
            $data['sub_category_id'] = html_escape($this->input->post('sub_category_id')); 
            $this->db->insert('exam_pattern', $data);
          } 
        }else{
          $data['exam_id'] = $insert_id;
          $data['sub_category_id'] = html_escape($this->input->post('sub_category_id'));
          $this->db->insert('exam_pattern', $data);
        }
      } 
    }

    public function delete_pattern($param1=''){
      if($param1){
        $this->db->where('id', $param1);
        $this->db->delete('exam_detail'); 
        $this->db->where('exam_id', $param1);
        $this->db->delete('exam_pattern');
      }
    }
    
    public function create_quiz_for_users($sub_category_id)
    {
      $this->db->select('ed.*, ep.subject_id, ep.num_of_que, ep.exam_id, ep.sub_category_id');
      $this->db->join('exam_pattern as ep', 'ep.exam_id=ed.id');
      $this->db->order_by('ep.exam_id');
      $this->db->where('sub_category_id',$sub_category_id);
      $result = $this->db->get('exam_detail as ed')->result_array();
      
      
      $question_ids = '';
            $total_marks = 0;
            $exam_id = 0;
            $count=0;
            foreach($result as $res)
            {
        
                if((($res['exam_id'] != $exam_id) && $exam_id != 0) || ($count == (count($result)-1)) )
                {
                    $data['question_ids']= rtrim($question_ids, ',');
                    $data['student_id']= $this->session->userdata('user_id');
                    $data['total_marks'] = $total_marks;
                    $data['attempt_time']= $result[$count-1]['attempt_time'];
          
                    $data['sub_category_id']= $result[$count-1]['sub_category_id'];
                    $data['start_time'] = date("Y-m-d H:i:s", time());
                    $data['end_time'] = date("Y-m-d H:i:s", strtotime('+24 hours'));
                    $data['exam_id']= $exam_id;
                    
                    
          $question_ids = '';
          $total_marks = 0;
                    
                    $obj[] = $data;
                    
        }
                $count++;
                $exam_id = $res['exam_id'];
        if($res['num_of_que'] != 0){
                    $this->db->select('id, marks');
                    $this->db->where('subject_id', $res['subject_id']);
                    $this->db->order_by('RAND()');
                    $this->db->limit($res['num_of_que'], 0);
                    $questions = $this->db->get('questions')->result_array();
                    foreach($questions as $que){
                        $question_ids = $que['id'].','.$question_ids;
                        $total_marks = $total_marks + $que['marks'];
          }
        }
      }
      
            $examid = array_column($obj,'exam_id');
      
      
            
            $this->db->insert('quiz',$data);
            
            
            $quiz['quiz_createdAt']= date("Y-m-d H:i:s", time());
            $this->db->where_in('id', $exam_id);
            $this->db->update('exam_detail', $quiz);
      
      // $this->getQuiz($sub_category_id, $this->session->userdata('user_id'));
    }
    
    function update_quiz_for_users($sub_category_id,$quiz_id)
    {
      $this->db->select('ed.*, ep.subject_id, ep.num_of_que, ep.exam_id, ep.sub_category_id');
      $this->db->join('exam_pattern as ep', 'ep.exam_id=ed.id');
      $this->db->order_by('ep.exam_id');
      $this->db->where('sub_category_id',$sub_category_id);
      $result = $this->db->get('exam_detail as ed')->result_array();
      
      
      $question_ids = '';
            $total_marks = 0;
            $exam_id = 0;
            $count=0;
            foreach($result as $res)
            {
        
                if((($res['exam_id'] != $exam_id) && $exam_id != 0) || ($count == (count($result)-1)) )
                {
                    $data['question_ids']= rtrim($question_ids, ',');
                    $data['student_id']= $this->session->userdata('user_id');
                    $data['total_marks'] = $total_marks;
                    $data['attempt_time']= $result[$count-1]['attempt_time'];
                    $data['attempt_no']= 0;
                    $data['sub_category_id']= $result[$count-1]['sub_category_id'];
                    $data['start_time'] = date("Y-m-d H:i:s", time());
                    $data['end_time'] = date("Y-m-d H:i:s", strtotime('+24 hours'));
                    $data['exam_id']= $exam_id;
                    
                    
          $question_ids = '';
          $total_marks = 0;
                    
                    $obj[] = $data;
                    
        }
                $count++;
                $exam_id = $res['exam_id'];
        if($res['num_of_que'] != 0){
                    $this->db->select('id, marks');
                    $this->db->where('subject_id', $res['subject_id']);
                    $this->db->order_by('RAND()');
                    $this->db->limit($res['num_of_que'], 0);
                    $questions = $this->db->get('questions')->result_array();
                    foreach($questions as $que){
                        $question_ids = $que['id'].','.$question_ids;
                        $total_marks = $total_marks + $que['marks'];
          }
        }
      }
      
            $examid = array_column($obj,'exam_id');
            $this->db->where('id',$quiz_id);
            $this->db->update('quiz',$data);
      
            
    }
    
    public function create_quiz(){
      
      // $this->db->query("SET time_zone='+0:01'");
      $this->db->select('ed.*, ep.subject_id, ep.num_of_que, ep.exam_id, ep.sub_category_id');
      $this->db->join('exam_pattern as ep', 'ep.exam_id=ed.id');
      $this->db->where('TIMESTAMPDIFF(MINUTE, ed.`quiz_createdAt`, NOW()) > 1439');
      $this->db->or_where('ed.`quiz_createdAt` is NULL');
      $this->db->order_by('ep.exam_id');
      $result = $this->db->get('exam_detail as ed')->result_array();
      
      
      $question_ids = '';
      $total_marks = 0;
      $exam_id = 0;
      $count=0;
      foreach($result as $res)
      {
        
        if((($res['exam_id'] != $exam_id) && $exam_id != 0) || ($count == (count($result)-1)) )
        {
          $data['question_ids']= rtrim($question_ids, ',');
          $data['total_marks'] = $total_marks;
          $data['attempt_time']= $result[$count-1]['attempt_time'];
          $data['sub_category_id']= $result[$count-1]['sub_category_id'];
          $data['start_time'] = date("Y-m-d H:i:s", time());
          $data['end_time'] = date("Y-m-d H:i:s", strtotime('+24 hours'));
          $data['exam_id']= $exam_id;
          
          
          $question_ids = '';
          $total_marks = 0;
          
          $obj[] = $data;
          
        }
        $count++;
        $exam_id = $res['exam_id'];
        if($res['num_of_que'] != 0){
          $this->db->select('id, marks');
          $this->db->where('subject_id', $res['subject_id']);
          $this->db->order_by('RAND()');
          $this->db->limit($res['num_of_que'], 0);
          $questions = $this->db->get('questions')->result_array();
          foreach($questions as $que){
            $question_ids = $que['id'].','.$question_ids;
            $total_marks = $total_marks + $que['marks'];
          }
        }
      }
      
      $examid = array_column($obj,'exam_id');
      
      $this->db->insert_batch('quiz',$obj);
      
      
      $quiz['quiz_createdAt']= date("Y-m-d H:i:s", time());
      $this->db->where_in('id', $exam_id);
      $this->db->update('exam_detail', $quiz);
      
      
      // foreach($result as $res){
      //     print_r($res['exam_id']);
      //     print_r('<br/>');
      //     if(($res['exam_id'] != $exam_id && $exam_id!=0) || $count==(count($result)-1)){
      //         $data['question_ids']= rtrim($question_ids, ',');
      //         $data['total_marks'] = $total_marks;
      //         $data['attempt_time']= $result[$count-1]['attempt_time'];
      //         $data['sub_category_id']= $result[$count-1]['sub_category_id'];
      //         $data['start_time'] = date("Y-m-d H:i:s", time());
      //         $data['end_time'] = date("Y-m-d H:i:s", strtotime('+24 hours'));
      //         $data['exam_id']= $exam_id;
      //         $this->db->insert('quiz', $data);
      
      //         $this->db->where('id', $exam_id); 
      //         $quiz['quiz_createdAt']= date("Y-m-d H:i:s", time());
      //         $this->db->update('exam_detail', $quiz);
      //         echo $this->db->last_query(); 
      // exit();
      //         $question_ids = '';
      //         $total_marks = 0;
      //     } 
      //     $count++;
      //     $exam_id = $res['exam_id'];
      //     if($res['num_of_que'] != 0){
      //         $this->db->select('id, marks');
      //         $this->db->where('subject_id', $res['subject_id']);
      //         $this->db->order_by('RAND()');
      //         $this->db->limit($res['num_of_que'], 0);
      //         $questions = $this->db->get('questions')->result_array();
      //         foreach($questions as $que){
      //             $question_ids = $que['id'].','.$question_ids;
      //             $total_marks = $total_marks + $que['marks'];
      //         }
      //     }
      // }
      exit;
    }
    
    public function get_enroll_exams($user_id){
      
      // echo $user_id;
      // exit();
      
      $query = $this->db->select('*')
      ->from('enroll e')
      ->join('category c','c.id = e.sub_category_id')
      
      ->where('e.user_id',$user_id)
      ->get();
      return $query;
      // echo '<pre>';
      // print_r($query->result());
      // echo '</pre>';
      // exit();
      
      
      
      // $this->db->select('category.*, enroll.*');
      // $this->db->join('category', 'category.id=enroll.sub_category_id');
      // $this->db->join('quiz', 'category.id= quiz.sub_category_id');
      // $this->db->where('quiz.status', '1');
      // $this->db->where('enroll.user_id', $user_id);
      // return  $this->db->get('enroll');
      
      // print_r($this->db->last_query());
      // exit();
      
    }
    
    public function get_myenroll_exams($user_id){
      $this->db->select('category.*, enroll.*, category.id as category_id');
      $this->db->join('category', 'category.id=enroll.sub_category_id');
      $this->db->where('enroll.user_id', $user_id);
      return $this->db->get('enroll');
      
    }
    
    public function getQuiz($sub_category_id, $student_id){
      
      
      $this->db->select('quiz.*, category.name, quiz_result.quiz_id');
      $this->db->join('category', 'category.id= quiz.sub_category_id');
      $this->db->join('quiz_result', 'quiz.id= quiz_result.quiz_id AND quiz_result.student_id="'.$student_id.'"', 'left');
      $this->db->where('sub_category_id', $sub_category_id);
      $this->db->order_by('id', 'desc');
      $this->db->limit(1, 0);
      
      $query =$this->db->get('quiz');
      
      $record = $query->row_array();
      
      
      
      if(isset($record['student_id']) && !empty($record['student_id']) &&  $record['student_id']== $this->session->userdata('user_id'))
      {
        // echo '<pre>';
        // print_r($record);
        // echo '</pre>'; 
        // exit();
        if($record['attempt_no']==0)
        {
          $this->db->set('attempt_no',1);
          $this->db->where('id',$record['id']);
          $this->db->update('quiz');
          return $record;    
        }
        else
        {
          $this->update_quiz_for_users($sub_category_id,$record['id']);
          return false;
        }
        // 
        
      }
      else
      {
        
        $this->create_quiz_for_users($sub_category_id);
        
        return false;
        
        
        
      }
      
      // return $this->db->get('quiz')->row_array();
      // echo '<pre>';
      //print_r($this->db->last_query()); exit;
    }
    
    public function getQuizQuestions($question_ids){
      $question_ids = explode(',', $question_ids);
      $this->db->where_in('id', $question_ids);
      return $this->db->order_by('rand()')
      ->get('questions');
    }
    
    public function save_result($student_id){
      $this->db->query("SET time_zone='+0:00'");
      $data['quiz_id'] = html_escape($this->input->post('quiz_id'));
      $data['student_id'] = $student_id;
      $data['auto_submission']= 0;
      $data['submitted_time'] = date("Y-m-d H:i:s", time());
      $this->db->insert('quiz_result', $data);
      $insert_id = $this->db->insert_id();
      $total_que = html_escape($this->input->post('total_que'));
      $total_marks = 0;
      for($i=1; $i<= $total_que; $i++){
        $data= array();
        $data['result_id'] = $insert_id;
        $question_id = html_escape($this->input->post('queId_'.$i));
        $data['que_id'] = $question_id;
        if($this->input->post('que_'.$question_id))
                $given_ans = html_escape($this->input->post('que_'.$question_id));
        else
                $given_ans = 0;
        $data['given_ans'] = $given_ans;
        $this->db->where('id', $question_id);
        $correct_ans = $this->db->get('questions')->row_array();
        $data['correct_ans'] = $correct_ans['correct_answer'];
        if($given_ans == $correct_ans['correct_answer']){
          $marks = $correct_ans['marks'];
          $data['marks_obt']= $marks;
          $total_marks = $total_marks + $marks;
          }else{
          $data['marks_obt']= 0;
        } 
        $this->db->insert('result_detail', $data);
      }
      $result_data['marks_obt']= $total_marks;
      $this->db->where('id', $insert_id);
      $this->db->update('quiz_result', $result_data);
      return $insert_id;
    }
    
    public function getResult($quiz_id, $student_id){
      $this->db->select('quiz_result.marks_obt as total_marks, result_detail.*, questions.question, questions.options, questions.explanation, questions.chapter_id, questions.subject_id');
      $this->db->join('result_detail', 'quiz_result.id= result_detail.result_id');
      $this->db->join('questions', 'questions.id=result_detail.que_id');
      $this->db->where('quiz_result.quiz_id', $quiz_id);
      $this->db->where('quiz_result.student_id', $student_id);
      return $this->db->get('quiz_result');
    }
    
    public function getAllGivenExams($student_id){
      $this->db->select('quiz_result.*, category.name, question_ids, total_marks');
      $this->db->join('quiz', 'quiz.id=quiz_result.quiz_id');
      $this->db->join('category', 'category.id=quiz.sub_category_id');
      $this->db->where('quiz_result.student_id', $student_id);
      //$this->db->where('quiz.status', 0);
      $this->db->order_by('id', 'desc');
      $data = $this->db->get('quiz_result');
      
      //print_r($this->db->last_query()); exit;
      return $data;
    }
    
    public function fivestudents(){
      $this->db->select('quiz_result.*, category.name, question_ids, total_marks');
      $this->db->join('users', 'student_id=users.id');
      $this->db->order_by('marks_obt', 'desc');
      $this->db->limit(5,0);
      $this->db->group_by('student_id');
      $data = $this->db->get('quiz_result');
      
      //print_r($this->db->last_query()); exit;
      return $data;
    }
    
    public function autoSubmission(){
      //$this->db->query("SET time_zone='+0:00'");
      $this->db->where('status', 1);
      $quizs = $this->db->get('quiz')->result_array();
      
      $sub_category_id = array_values(array_filter(array_map(function($v){
        if(!empty($v['student_id']))
        {
          return $v;
        }
        else
        {
          return null;
        }
      },$quizs)));
      
      // echo '<pre>';
      // print_r($sub_category_id);
      // echo '</pre>';
      // exit;
      $today = date('Y-m-d');
      foreach($quizs as $quiz){
        
        // print_r($quiz);
        $this->db->where('sub_category_id', $quiz['sub_category_id']);
        $students = $this->db->get('enroll')->result_array();
        foreach($students as $student){
          
          // print_r($student);
          foreach($sub_category_id as $key)
          {
            if($key['sub_category_id'] == $quiz['sub_category_id'])
            {
              if($student['user_id'] == $key['student_id'])
              {
                if(empty($quiz['student_id']))
                {
                  continue 2;     
                }
                
              }
              
            }
            
            
          }
          
          $record = $this->db->select('*')
          ->from('quiz_result')
          
          ->where('student_id',$student['user_id'])
          
          ->where('auto_submission',0)
          ->where("date(created_at)",$today)
          ->get();
          if($record->num_rows()>0)
          {
            continue;
          }
          
          if(isset($quiz['student_id']) && !empty($quiz['student_id']) &&  $quiz['student_id'] !=$student['user_id'] )
          {
            continue;
          }
          
          $data = array();
          $data['quiz_id']= $quiz['id'];
          $data['student_id'] = $student['user_id'];
          $data['marks_obt'] = 0;
          $data['attempt_in'] = 0;
          $data['submitted_time'] = date("Y-m-d H:i:s", time());
          $this->db->insert('quiz_result', $data);
          $insert_id = $this->db->insert_id();
          $question_ids = explode(',', $quiz['question_ids']);
          foreach($question_ids as $question_id){ 
            $page_data = array();
            $this->db->where('id', $question_id);
            $correct_ans = $this->db->get('questions')->row_array();
            $page_data['correct_ans'] = $correct_ans['correct_answer'];
            $page_data['result_id'] = $insert_id;
            $page_data['que_id'] = $question_id;
            $page_data['given_ans'] = 0;
            $page_data['marks_obt']=0;
            $this->db->insert('result_detail', $page_data);
          }
        }
        $data = array();
        $data['status'] = 0;
        $this->db->where('id', $quiz['id']);
        $this->db->update('quiz', $data);
      }
    }
    
    public function get_pages($page_id='', $page_url=''){
      if($page_id != ''){
        $this->db->where('id', $page_id);
      }
      if($page_url != ''){
        $this->db->where('page_url', $page_url);
      }
      return $this->db->get('pages');
    }
    
    public function add_page(){
      $data['title'] = html_escape($this->input->post('title'));
      $data['content'] = urlencode($this->input->post('content'));
      $data['status'] = html_escape($this->input->post('status'));
      $data['page_url'] = str_replace(" ","_",strtolower($data['title']));
      $this->db->insert('pages', $data);
      return true;
    }
    
    public function edit_page($page_id){
      $data['title'] = html_escape($this->input->post('title'));
      $data['content'] = html_escape($this->input->post('content'));
      $data['status'] = html_escape($this->input->post('status'));
      $data['page_url'] = str_replace(" ","_",strtolower($data['title']));
      $this->db->where('id', $page_id);
      $this->db->update('pages', $data);
      return true;
    }
    
    public function gallery($type, $start='', $limit='', $or_where=''){
      $this->db->where('type', $type);
      if($or_where!=''){
        $this->db->or_where('type', $or_where);
      }
      $this->db->order_by('id','desc');
      if($limit != ''){
        $this->db->limit($limit, $start);
      }
      return $this->db->get('photos');
    }
    
    public function add_photo($data){
      $this->db->insert('photos', $data);
    }
    
    public function delete_photo($gallery_id) {
      $this->db->where('id', $gallery_id);
      $this->db->delete('photos');
    }
    
    public function getRow($table='', $where=''){
      $this->db->where($where);
      return $this->db->get($table)->row_array();
    }
    
    public function getResultData($table='', $where='', $select='', $joins='', $order_by=''){
      if($select != ''){
        $this->db->select($select);
      }
      if(!empty($joins)){
        foreach($joins as $join){
          $this->db->join($join['table'], $join['condition']);
        }
      }
      if(!empty($where))
            $this->db->where($where);
      
      if($order_by !=''){
        $this->db->order_by($order_by);
      }
      return $this->db->get($table)->result_array();
    }
    
    public function getReferralDetails($user_id){
      $this->db->select('referral.*, users.first_name, users.last_name');
      $this->db->join('users', 'users.id = referral.user_id');
      $this->db->group_start();
      $this->db->where(array('referral_id'=>$user_id, 'type'=>'referral'));
      $this->db->group_end();
      // $this->db->or_group_start();
      // $this->db->where(array('user_id'=>$user_id));
      // $this->db->where('type', 'user');
      // $this->db->group_end();
      return $this->db->get('referral')->result_array();
    }
    
    public function add_row($table, $data){ 
      $this->db->insert($table, $data);
    }
    
    public function get_row($table, $where=''){
      $this->db->where($where);
      return $this->db->get($table);
    }

    public function edit_row($table, $where='', $data){
      $this->db->where($where);
      $this->db->update($table, $data);
    }
    
    public function delete_row($table, $where=''){
      $this->db->where($where);
      $this->db->delete($table);
    }
    
    public function refDetail($referral_code, $user_id){
      $this->db->where('referral_code', $referral_code);
      $ref_user = $this->db->get('users')->row_array();
      if(isset($ref_user['id'])) {
        $data['user_id'] = $user_id;
        $data['referral_id'] = $ref_user['id'];
        $user_amount = $this->db->where('key','user_amount')->get('frontend_settings')->row_array();
        $data['amount'] = $user_amount['value'];
        $data['type'] = 'user';
        $this->db->insert('referral', $data);
        // referral discount
        $ref_amount = $this->db->where('key','referral_amount')->get('frontend_settings')->row_array();
        $data['amount'] = $ref_amount['value'];
        $data['type'] = 'referral';
        $this->db->insert('referral', $data);
      }
    }
    
    public function changeStatus($table='', $where=''){
      $sql = "UPDATE $table SET status= 1 - status $where";
      $this->db->query($sql);
    }
    
    public function get_course_wise_students($days=''){
      $this->db->select('category.id, count(enroll.user_id) as users, enroll.sub_category_id, category.name');
      $this->db->join('enroll', 'category.id= enroll.sub_category_id', 'left');
      $this->db->where('category.parent !=', '0');
      if($days != ''){
        $this->db->where('enroll.date_added BETWEEN CURDATE() - INTERVAL '.$days.' DAY AND CURDATE()');     
      }
      $this->db->group_by('enroll.sub_category_id');
      return $this->db->get('category')->result_array();
    }
    
    public function last_day_attempted_quiz(){
      $this->db->select('category.id, category.name, count(quiz_result.student_id) as users');
      $this->db->join('quiz', 'category.id= quiz.sub_category_id', 'left');
      $this->db->join('quiz_result', 'quiz_result.quiz_id= quiz.id', 'left');
      $this->db->where('category.parent !=', '0');
      $this->db->where('quiz_result.auto_submission', '0');
      $this->db->where('quiz_result.submitted_time BETWEEN CURDATE() - INTERVAL 1 DAY AND CURDATE()');
      $this->db->group_by('quiz_result.quiz_id');
      return $this->db->get('category')->result_array();
    }
    
    public function databaseBackup(){
      $this->load->dbutil();
      // Backup your entire database and assign it to a variable
      $prefs = array(    
      'format'      => 'zip',            
      'filename'    => 'db_backup.sql'
      );
      $backup = $this->dbutil->backup($prefs);
      $db_name = 'database_'. date("Y-m-d") .'.zip';
      $save = FCPATH.'/assets/backup/'.$db_name;
      // Load the file helper and write the file to your server
      $this->load->helper('file');
      var_dump(write_file($save, $backup, 'w+')); 
    }

    public function projectBackup(){
      $db_name = 'project_'. date("Y-m-d") .'.zip';
      $this->load->library('zip');
      $this->zip->read_dir(FCPATH.'/application', FALSE);
      $this->zip->archive(FCPATH.'/assets/backup/'.$db_name);
    }
    
    public function tophundred()
    {
      //      $data=  $this->db->query('SELECT student_id,first_name,last_name, email, marks_obt,total_marks FROM `quiz_result`  left join users on student_id=users.id left join quiz on quiz.id=quiz_id   GROUP BY (student_id)
      // ORDER BY `quiz_result`.`marks_obt`  DESC LIMIT 0,100');
      // return $data->result_array();
      $data = $this->db->query("SELECT DISTINCT u.email, u.id as student_id, u.first_name, u.last_name, q1.quiz_id,c.name as category_name, date(q1.submitted_time) as date, q2.total_marks, q1.marks_obt,q1.auto_submission FROM `users` u join quiz_result q1 on q1.student_id = u.id
            join quiz q2 on q2.id = q1.quiz_id
            join category c on c.id = q2.sub_category_id
            ORDER BY `q1`.`marks_obt`  DESC
            LIMIT 0,100");
      return $data->result_array();
            
    }
    
    
    public function tophundredconsistent()
    {
      $data=  $this->db->query('SELECT student_id,first_name,last_name, email, marks_obt,total_marks , COUNT(student_id) as count  FROM `quiz_result` left join users on student_id=users.id left join quiz on quiz.id=quiz_id  GROUP by student_id  
      ORDER BY COUNT(student_id)  DESC  LIMIT 0,100');
      return $data->result_array();
    }
    
    public function trandom()
    {
      $id  = array_column($this->tophundred(),'student_id');
      
      
      // $data = $this->db->query("SELECT u.id as student_id, u.first_name, u.last_name, u.email, q1.quiz_id,c.name as category_name, date(q1.submitted_time) as date, q2.total_marks, q1.marks_obt,q1.auto_submission FROM `users` u join quiz_result q1 on q1.student_id = u.id
      //     join quiz q2 on q2.id = q1.quiz_id
      //     join category c on c.id = q2.sub_category_id")
      //     ->where_not_in('u.id',$id)
      //     ->order_by('q1.marks_obt','DESC')
      //     ->limit(0,100)
      //     ->get();
      
      $data = $this->db->select('u.id as student_id, u.first_name, u.last_name, u.email, q1.quiz_id,c.name as category_name, date(q1.submitted_time) as date, q2.total_marks, q1.marks_obt,q1.auto_submission')
      ->from('users u')
      ->join('quiz_result q1','q1.student_id = u.id')
      ->join('quiz q2','q2.id = q1.quiz_id')
      ->join('category c','c.id = q2.sub_category_id')
      ->where_not_in('u.id',$id)
      ->order_by('q1.marks_obt','DESC')
      ->limit(0,100)
      ->get();
            
      return $data->result_array();
    }
    
    function fetch_questions($param1=1, $param2='')
    {
      $this->db->select('q.*, s.name, CONCAT(u.first_name, " " , u.last_name) AS teacher, ch.c_name AS chapter_name, ms.title AS samester_name, sc.name AS subcategory_name, c.name AS category_name')
      ->from('questions q')
      ->join('m01_chapter ch','ch.id=q.chapter_id','LEFT')
      ->join('subject s','s.id=q.subject_id','LEFT')
      ->join('m00_samester ms','ms.id=s.samester','LEFT')
      ->join('category sc','sc.id=ms.subcategory_id','LEFT')
      ->join('category c','c.id=sc.parent','LEFT')
      ->join('users u','u.id=q.userID','LEFT');
      
      if($param1!='' || $param1=='0') {  
        $this->db->where('q.status', $param1);
      }   
      if($param2!='') {
        $this->db->where('u.id', $param2);
      }

      if($this->input->post('teacher')!='') {
        $this->db->where('u.id', $this->input->post('teacher'));
      }

      if($this->input->post('subject')!='') {
        $this->db->where('s.id', $this->input->post('subject'));
      }

      if($this->input->post('category_id')!='') {
        $this->db->where('c.id', $this->input->post('category_id'));
      }

      if($this->input->post('sub_category_id')!='') {
        $this->db->where('sc.id', $this->input->post('sub_category_id'));
      }

      if($this->input->post('samester')!='') {
        $this->db->where('ms.id', $this->input->post('samester'));
      }

      if($this->input->post('chapter_id')!='') {
        $this->db->where('ch.id', $this->input->post('chapter_id'));
      }
 
    }
    
    function filter_question()
    {
      if(isset($this->input->post('search',true)['value']))
      {
        $search = $this->input->post('search')['value'];
        $this->db->group_start()
        ->or_like('s.name',$search)
        ->or_like('q.question',$search)
        ->or_where('q.correct_answer',$search)
        ->group_end();
      }
    }
    
    function count_total_question($param1=1, $param2='')
    {
      $this->fetch_questions($param1, $param2);
      return $this->db->count_all_results();
    }
    
    function count_filter_question($param1=1, $param2='')
    {
      $this->fetch_questions($param1, $param2);
      
      $this->filter_question();
      
      // return $this->input->post();
      return $this->db->count_all_results();  
      
    }
    
    
    function get_all_questions($param1=1, $param2='')
    {
      
      $order_column = array('s.name','q.question','q.correct_answer');
      
      $length = $this->input->post('length',true);
      $start = $this->input->post('start',true);
      
      $this->fetch_questions($param1, $param2);
      
      $this->filter_question(); 
      if($this->input->post('order'))
      {
        $this->db->order_by($order_column[$this->input->post('order')[0]['column']],$this->input->post('order')[0]['dir']);
      }
      else
      {
        $this->db->order_by('s.name','ASC');
      }
      
      if($this->input->post('length',true) != -1)
      {
        $this->db->limit($length,$start);
      }
      
      $query =  $this->db->get();
      
      if($query->num_rows()>0)
      {
        return $query->result();
      }
      else
      {
        return array();
      }
    }
    
    
    function getQuizInstructions($param1)
    {
      $query = $this->db->select('*')
      ->from('category')
      ->where('id',$param1)
      ->get();
      return $query->row();
      
      
      
    }    
    function get_student($param1)
    {
      $query = $this->db->select('u.*,e.sub_category_id,e.start_date,e.end_date')
      ->from('users u')
      ->join('enroll e','e.user_id = u.id')
      ->where('role_id',2)
      ->where('e.sub_category_id',$param1)
      ->order_by('u.first_name','ASC')
      ->get();
      
      return $query->result();
    }
    
    function get_winners($where=null)
    {
      $this->db->select("w.*,concat(u.first_name,' ',u.last_name) as name")
            ->from('winners w')
            ->join('users u','u.id = w.user_id');
      if(!empty($where))
      {
        $this->db->where($where);
      }
      
            $query = $this->db->order_by('position','ASC')
            ->get();
      return $query->result();
    }
    
    function get_new_report()
    {
      foreach($this->input->post() as $key =>$val)
      {
        $$key = $val;
      }
      
      $daterange = explode(' - ', $daterange);
      
      $start_date = date('Y-m-d',strtotime($daterange[0]));
      $end_date = date('Y-m-d',strtotime($daterange[1])); 
      
      
      $query = $this->db->select('u.id, u.first_name,u.last_name,u.email,u.contact,(CASE WHEN `s`.`total_marks` IS NULL THEN 0 ELSE `s`.`total_marks` END ) as total_marks, (CASE WHEN `q`.`marks_obt` IS NULL THEN 0 ELSE `q`.`marks_obt` END ) as marks_obt ,( CASE WHEN `q`.`auto_submission` IS NULL THEN 0 ELSE `q`.`auto_submission` END ) as auto_submission , ( CASE WHEN `q`.`total_attempt` IS NULL THEN 0 ELSE `q`.`total_attempt` END ) as total_attempt')
      ->from('users u')
      ->join('enroll e','e.user_id = u.id')
      // ->join("(Select t.sub_category_id, sum(t.total_marks) as total_marks, from (SELECT Distinct(date(start_time)),sub_category_id,total_marks FROM `quiz` where date(start_time) between '{$start_date}' and '{$end_date}' order by sub_category_id) t group by t.sub_category_id) as s",'s.sub_category_id = e.sub_category_id')
      ->join("(SELECT sub_category_id,sum(total_marks) as total_marks FROM (SELECT Distinct(date(start_time)),sub_category_id,total_marks FROM `quiz` WHERE date(start_time) BETWEEN '{$start_date}' AND '{$end_date}' AND sub_category_id = '{$sub_category_id}') as t   GROUP BY sub_category_id) as s",'s.sub_category_id = e.sub_category_id','LEFT')
      //->join("(SELECT q2.sub_category_id,q1.student_id,sum(q1.marks_obt) as marks_obt,sum(CASE WHEN q1.auto_submission =1 THEN 1 ELSE 0 END) as auto_submission,sum(CASE WHEN auto_submission = 0 THEN 1 ELSE 0 END) as total_attempt FROM `quiz_result` q1 join quiz q2 on q2.id = q1.quiz_id where date(submitted_time) BETWEEN '{$start_date}' AND '{$end_date}' AND q2.sub_category_id = '{$sub_category_id}' GROUP BY q2.sub_category_id,q1.student_id) as q",'q.student_id = u.id','LEFT')
      ->join("(SELECT q2.sub_category_id,q1.student_id,sum(q1.marks_obt) as marks_obt ,sum(CASE WHEN q1.auto_submission = 1 THEN 1 ELSE 0 END) as auto_submission,sum(CASE WHEN q1.auto_submission = 0 THEN 1 ELSE 0 END) as total_attempt  FROM `quiz_result` q1 join quiz q2
      on q1.quiz_id = q2.id
      WHERE date(q1.submitted_time) BETWEEN '{$start_date}' AND '{$end_date}'
      GROUP BY q2.sub_category_id,q1.student_id) as q",'q.sub_category_id = e.sub_category_id AND q.student_id = u.id','LEFT')
      ->where('role_id',2)
      ->where('e.sub_category_id',$sub_category_id)
      ->order_by('u.first_name','ASC')
      ->get();
      
      // return $this->db->last_query();
      return $query->result();
    }
    
    function add_winners()
    {
      
      $record = $this->input->post('record');
      
      foreach($record as $key)
      {
        $obj[] = array('user_id'=>$key['id'],
        'sub_category_id'=>$key['sub_category_id'],
        'image'=>$key['image_url'],
        'position'=>$key['position']);
      }
      
      //   $query= $this->db->select('*')
      //                 ->from('winners')
      //                 ->where('sub_category_id',$record[0]['sub_category_id'])
      //                 ->get();
      
      
      $this->db->insert_batch('winners',$obj);
      
      if($this->db->affected_rows()>0)
      {
        $output = array('result'=>true,'message'=>'Position set successfully');
        return $output;
      }
      
    }
    function clear_winners()
    {
      $record =  $this->input->post('record2');
      foreach($record as $key)
      {
        $user_id[] = $key['id'];
        
        $sub_category_id[] = $key['sub_category_id'];
      }
      $this->db->where_in('user_id',$user_id);
      $this->db->where_in('sub_category_id',$sub_category_id);
      $this->db->delete('winners');
      
      
      // $user_id = $this->input->post('id');
      // $sub_category_id = $this->input->post('sub_category_id');
      // $this->db->where('user_id',$user_id);
      // $this->db->where('sub_category_id',$sub_category_id);
      // $this->db->delete('winners');
      
      if($this->db->affected_rows()>0)
      {
        $output = array('result'=>true,'message'=>'Position Clear successfully');
        return $output;
      }
      
      
    }
    
    function get_admin_revenue()
    {
      $query = $this->db->query('SELECT p.id ,p.amount,p.coupon_amount,p.coupon_code,c.name,u.first_name,u.last_name,u.email,FROM_UNIXTIME(p.date_added) as date_added,e.end_date FROM `payment` p JOIN category c on c.id = p.sub_category_id join users u on u.id = p.user_id join enroll e on e.id = p.enroll_id');
      
      return $query->result();
    }
    
    function get_pages_image() {
      $query = $this->db->select('*')
      ->from('photos')
      ->where('page_name!=','')
      ->get();
      
      return $query->result();
      
    }
    function clear_pages_slider() {
      $id = $this->input->post('id');
      // return $this->input->post();
      $this->db->where('id',$id);
      $this->db->delete('photos');
      if($this->db->affected_rows()>0)
      {
        $output = array('result'=>true,'message'=>'Deleted Successfully');
        return $output;
      }
    }
    
    public function add_highlight_quiz($value='') { 
      $filename = rand(0,10000).time();  
      if ($_FILES['banner']['name'] != "") {
        move_uploaded_file($_FILES['banner']['tmp_name'], 'uploads/thumbnails/quiz_thumbnails/' . $filename . '.jpg');
      } 
      $data['title'] = html_escape($this->input->post('title'));
      $data['description'] = html_escape($this->input->post('descriptions'));
      $data['file'] = $filename. '.jpg';
      $data['price'] = html_escape($this->input->post('price'));
      $data['startdate'] = html_escape($this->input->post('date') . ' ' . $this->input->post('time'));
      $data['status'] = 1;
      $data['date'] = date('Y-m-d H:i');
      $this->db->insert('highlight_quiz', $data);
    }
    
    public function update_highlight_quiz($param1='') {
      $filename = rand(0,10000).time();  
      if ($_FILES['banner']['name'] != "") {
        move_uploaded_file($_FILES['banner']['tmp_name'], 'uploads/thumbnails/quiz_thumbnails/' . $filename . '.jpg');
        $data['file'] = $filename . '.jpg';
      }  
      $data['title'] = html_escape($this->input->post('title'));
      $data['description'] = html_escape($this->input->post('descriptions')); 
      $data['price'] = html_escape($this->input->post('price'));
      $data['startdate'] = html_escape($this->input->post('date') . ' ' . $this->input->post('time'));
      $this->db->where('id', $param1);
      $this->db->update('highlight_quiz', $data);
    }
    
    public function get_highlight_quiz($param1='', $param2='') {
      $order_column = array('h.title','h.file','h.price');
      $length = $this->input->post('length',true);
      $start = $this->input->post('start',true);
      
      $this->fetch_highlight_quiz($param1, $param2);
      
      $this->filter_highlight_quiz($param1, $param2); 
      if($this->input->post('order'))
      {
        $this->db->order_by($order_column[$this->input->post('order')[0]['column']],$this->input->post('order')[0]['dir']);
      }
      else
      {
        $this->db->order_by('h.id','ASC');
      }
      
      if($this->input->post('length',true) != -1)
      {
        $this->db->limit($length,$start);
      }
      
      $query =  $this->db->get();
      
      if($query->num_rows()>0)
      {
        return $query->result();
      }
      else
      {
        return array();
      }
    }

    function fetch_highlight_quiz($param1='', $param2='') {
      $this->db->select('h.*')
      ->from('highlight_quiz h');
      if($param1!='' || $param1=='0') {  
        $this->db->where('h.id', $param1);
      }  
    }

    function filter_highlight_quiz($param1='', $param2='') {
      if(isset($this->input->post('search',true)['value']))
      {
        $search = $this->input->post('search')['value'];
        $this->db->group_start()
        ->or_like('h.title',$search)
        ->or_like('h.file',$search)
        ->or_where('h.price',$search)
        ->group_end();
      }
    }

    function count_total_quiz($param1='', $param2='')
    {
      $this->fetch_highlight_quiz($param1, $param2);
      return $this->db->count_all_results();
    }

    function count_filter_quiz($param1='', $param2='')
    {
      $this->fetch_highlight_quiz($param1, $param2);
      $this->filter_highlight_quiz(); 
      return $this->db->count_all_results();   
    }
    
    public function delete_highlight_quiz($param1='') {
      $this->db->where('id', $param1);
      $this->db->delete('highlight_quiz');
    }

    public function last_highlight_quiz($param1='') {
      $this->db->where('status', '1');
      $this->db->order_by('id', 'DESC');
      $this->db->limit(1);
      $data = $this->db->get('highlight_quiz');
      return $data->result();
    }

    public function highlight_quiz_front($param1='', $param2='') {
      $this->db->where("md5(id)='" . $param1 ."'"); 
      if($param2!='') {
        $this->db->where('status', 1); 
      } 
      $data = $this->db->get('highlight_quiz');
      return $data->result();
    }

    public function add_enroll_user($param1='') {
      $quiz = $this->highlight_quiz_front($param1, 1);
      if(isset($quiz[0]->id)) {
        $enroll_user = $this->get_enroll_user('', $quiz[0]->id, html_escape($this->input->post('email')), '');
        if(isset($enroll_user[0]->id) && ($enroll_user[0]->payment_id =='' || $enroll_user[0]->payment_id==null)) {
          $insert_id = $enroll_user[0]->id;
        } elseif(isset($enroll_user[0]->payment_id) && $enroll_user[0]->payment_id !='' && $enroll_user[0]->payment_id!=null) {
          //$this->email_model->send_payment_verification_mail($enroll_user[0], $enroll_user[0]->payment_id);
          $this->session->set_flashdata('error_message', get_phrase('you_are_allready_registered'));
          return 0;
        } else {
          $data['first_name'] = html_escape($this->input->post('first_name'));
          $data['last_name'] = html_escape($this->input->post('last_name'));
          $data['email'] = html_escape($this->input->post('email'));
          $data['mobile'] = html_escape($this->input->post('contact'));
          $data['highlight_quiz_id'] = $quiz[0]->id;
          $data['status'] = 1;
          $data['date'] = date('Y-m-d H:i');
          $this->db->insert('enroll_user', $data);
          $insert_id = $this->db->insert_id();
        } 
        $this->session->set_flashdata('flash_message', get_phrase('enrolled_succefully_please_proceed_on_payment'));
        return md5($insert_id);
      } else {
        $this->session->set_flashdata('error_message', get_phrase('some_error_occured'));
        return 0;
      }
    }

    public function get_enroll_user($param1='', $param2='', $param3='', $param4='') { 
      //$this->db->where('')
      $this->db->select('e.*, h.title, h.price, h.file, h.description')
      ->from('enroll_user e')
      ->join('highlight_quiz h', 'h.id=e.highlight_quiz_id');
      if($param1!='') {
        $this->db->where("md5(e.id) = '" . $param1 . "'");
      }
      if($param2!='') {
        $this->db->where('e.highlight_quiz_id', $param2);
      }
      if($param3!='') {
        $this->db->where('e.email', $param3);
      }
      if($param4!=''){
        $this->db->where("(e.payment_id='' OR e.payment_id IS NULL) AND e.status='requested'"); 
      }
      $data = $this->db->get();
      return $data->result();
    }

    public function update_enroll_user($param1='', $param2='', $param3='', $param4='') {
      $data = $param1;
      $this->db->where('id', $param2);
      $this->db->update('enroll_user', $data);
    }


    public function get_all_enroll_user($param1='', $param2='', $param3='') {
      $order_column = array('e.id', 'e.payment_date','e.email','e.first_name');
      $length = $this->input->post('length',true);
      $start = $this->input->post('start',true);
      
      $this->fetch_enroll_user($param1, $param2, $param3);
      
      $this->filter_enroll_user($param1, $param2, $param3); 
      if($this->input->post('order'))
      {
        $this->db->order_by($order_column[$this->input->post('order')[0]['column']],$this->input->post('order')[0]['dir']);
      }
      else
      {
        $this->db->order_by('e.id','ASC');
      }
      
      if($this->input->post('length',true) != -1)
      {
        $this->db->limit($length,$start);
      }
      
      $query =  $this->db->get();
      
      if($query->num_rows()>0)
      {
        return $query->result();
      }
      else
      {
        return array();
      }
    }

    function fetch_enroll_user($param1='', $param2='', $param3='') {
      $this->db->select('e.*, h.title')
      ->from('enroll_user e')
      ->join('highlight_quiz h', 'h.id=e.highlight_quiz_id','left');
      if($param1!='' || $param1>'0') {  
        $this->db->where('h.id', $param1);
      }  
      if($param2!='' || $param2>'0') {  
        $this->db->where('e.id', $param2);
      }
      if($param3=='paid') {  
        $this->db->where("e.payment_id IS NOT NULL AND e.payment_id!=''");
      }
    }

    function filter_enroll_user($param1='', $param2='', $param3='') {
      if(isset($this->input->post('search',true)['value']))
      {
        $search = $this->input->post('search')['value'];
        $this->db->group_start()
        ->or_like('e.email',$search)
        ->or_like('e.first_name',$search)
        ->or_like('e.last_name',$search)
        ->or_where('e.payment_id',$search)
        ->or_where('e.order_id',$search)
        ->group_end();
      }
    }

    function count_total_enroll_user($param1='', $param2='', $param3='')
    {
      $this->fetch_enroll_user($param1, $param2);
      return $this->db->count_all_results();
    }

    function count_filter_enroll_user($param1='', $param2='', $param3='')
    {
      $this->fetch_enroll_user($param1, $param2);
      $this->filter_enroll_user(); 
      return $this->db->count_all_results();   
    }

    function add_cart($paid_amount=0.00, $total_amount=0.00, $payment_type='Enroll'){
      $data = array(
        'user_id'=>$this->session->userdata('user_id'),
        'subcategory_id'=>$this->session->userdata('subcategory_id'),
        'paid_amount'=>$paid_amount,
        'total_amount'=>$total_amount,
        'status'=>'In-process',
        'payment_type'=>$payment_type,
        'date'=>date('Y-m-d H-i-s')
      );
      $this->db->insert('tr_cart', $data); 
      $insert_id = $this->db->insert_id();
      return md5($insert_id);
    }

    function get_cart($id=''){
      $this->db->where('md5(id)', $id);
      return $this->db->get('tr_cart'); 
    }

    function get_usercart($id='', $order_id=''){
      if($id!='') {
        $this->db->where('md5(id)', $id); 
      }
      
      if($order_id!='') {
        $this->db->where('order_id', $order_id);
      }
      $this->db->select('u.*, tr_cart.user_id, tr_cart.subcategory_id, tr_cart.paid_amount, tr_cart.total_amount, tr_cart.payment_id, tr_cart.payment_signature')
      ->from('tr_cart')
      ->join('users u', 'u.id=tr_cart.user_id');
      return $this->db->get(); 
    }

    function update_cart($data=array(), $id='', $order_id=''){ 
      if($order_id=='') {
        $this->db->where('md5(id)', $id);
      }
      
      if($order_id!='') {
        if($id!='') {
          $this->db->where('md5(id)', $id);
        }
        $this->db->where('order_id', $order_id);
      }
      $this->db->update('tr_cart', $data); 
    }
  }
