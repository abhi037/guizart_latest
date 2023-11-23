<?php
  defined('BASEPATH') OR exit('No direct script access allowed');
  
  class Manage extends CI_Controller {
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
      
    }

  	function samester($param1='', $param2='') 
  	{
     if ($this->session->userdata('admin_login') != true) {
        redirect(site_url('login'), 'refresh');
      } 
      $this->session->set_userdata('last_page', 'samester'); 
      $page_data['page_name'] = 'samester';
      $page_data['page_title'] = get_phrase('class');
      $page_data['samesters'] = $this->Master_model->view_samester(); 
      $this->load->view('backend/index', $page_data);
  	}

    function samester_form($param1='', $param2='') 
    {
      if ($this->session->userdata('admin_login') != true) {
        redirect(site_url('login'), 'refresh');
      } 
      $this->session->set_userdata('last_page', 'samester');  
      $page_data['page_name'] = 'samester_add';
      if($param1!='' && $param2!='') {
        $page_data['page_name'] = 'samester_edit';
        $page_data['page_title'] = get_phrase('edit_class_detail');
        $samester = $this->Master_model->view_samester($param2)->result_array(); 
        if(!empty($samester) && isset($samester[0])) {
          $page_data['samester'] = $samester[0]; 
          $page_data['sub_categories'] = $this->crud_model->get_sub_categories($samester[0]['category_id']);  
        } else {
          redirect(site_url('master/manage/samester'), 'refresh');
        } 
      } else {
        $page_data['page_name'] = 'samester_add';
        $page_data['page_title'] = get_phrase('add_class_detail');
      }
      $page_data['categories'] = $this->crud_model->get_categories(); 
      $this->load->view('backend/index', $page_data);
    }

    function sub_categories($param1='') {
      if ($this->session->userdata('admin_login') != true) {
        echo 0;
      } 
      $categories = $this->crud_model->get_sub_categories(trim($this->input->post('category_id')));
      $jsoncate = null;
      foreach ($categories as $key => $value) {
        $jsoncate[] = array('id'=>$value['id'], 'name'=>$value['name']); 
      }
      if(!empty($jsoncate)) {
        echo json_encode($jsoncate);
      } else {
        echo 0;
      }
    }

    function samester_action($param1='', $param2=''){
      if ($this->session->userdata('admin_login') != true) {
        redirect(site_url('login'), 'refresh');
      } 
      if($param1=='add') {
        $this->Master_model->add_samester();
      }

      if($param1=='update' && $param2!='') {
        $this->Master_model->update_samester($param2);
      }

      if($param1=='delete' && $param2!='') {
        $this->Master_model->delete_samester($param2);
      }

      header("Location:". site_url('master/manage/samester/'));
    }

    function get_samester($param1='', $param2='', $param3='') {
      if ($this->session->userdata('admin_login') != true) {
        echo 0;
      } 
      $param3 = ($this->input->post('sub_category_id') ? trim($this->input->post('sub_category_id')) : '');
      $param2 = ($this->input->post('category_id') ? trim($this->input->post('category_id')) : '');
      $samesters = $this->Master_model->view_samester('', $param2, $param3);
      $samesters = $samesters->result_array();
      if(!empty($samesters)) {
        echo json_encode($samesters);
      } else {
        echo 0;
      }
    }

    public function chapters($param1 = "", $param2 = "") {
      if ($this->session->userdata('admin_login') != true) {
        redirect(site_url('login'), 'refresh');
      }
      
      $this->session->set_userdata('last_page', 'chapters');
      if ($param1 == 'add') {
        $this->Master_model->add_chapter();
        $this->session->set_flashdata('flash_message', get_phrase('data_added_successfully'));
        redirect(site_url('master/manage/chapters'), 'refresh');
      }
      elseif ($param1 == "edit") {
        $this->Master_model->edit_chapter($param2);
        $this->session->set_flashdata('flash_message', get_phrase('data_updated_successfully'));
        redirect(site_url('master/manage/chapters'), 'refresh');
      }
      elseif ($param1 == "delete") {
        $res = $this->Master_model->delete_chapter($param2);
        if($res){
          $this->session->set_flashdata('flash_message', get_phrase('data_deleted'));
          }else{
          $this->session->set_flashdata('error_message',get_phrase('cannot delete data'));
        }
        redirect(site_url('master/manage/chapters'), 'refresh');
      }
      $page_data['page_name'] = 'chapter';
      $page_data['page_title'] = get_phrase('chapter');
      $page_data['subjects'] = $this->Master_model->get_chapters($param2); 
      $this->load->view('backend/index', $page_data);
    }
    
    public function chapter_form($param1 = "", $param2 = "") {
      if ($this->session->userdata('admin_login') != true) {
        redirect(site_url('login'), 'refresh');
      }
      $this->session->set_userdata('last_page', 'chapters');
      if ($param1 == "add_chapter") {
        $page_data['page_name'] = 'chapter_add';
        $page_data['page_title'] = get_phrase('add_chapter');
      }
      if ($param1 == "edit_chapter") {
        $page_data['page_name'] = 'chapter_edit';
        $page_data['page_title'] = get_phrase('edit_edit'); 
        $data = $this->Master_model->get_chapters($param2)->row_array();
        $page_data['data'] = $data;
        $page_data['sub_categories'] = ($data['category_id']!='' ? $this->crud_model->get_sub_categories($data['category_id']) : array()); 
        $page_data['chapter_id'] = $param2;
        $page_data['samesters'] = $this->Master_model->view_samester('', '', $data['sub_category_id']);
        $page_data['subjects'] = $this->crud_model->get_subjects('', $data['samester_id']); 
      }
      $page_data['categories'] = $this->crud_model->get_categories(); 
      $this->load->view('backend/index', $page_data);
    }

    function get_subject($param1='', $param2='', $param3='') {
      if ($this->session->userdata('admin_login') != true) {
        echo 0;
      } 
      $param2 = ($this->input->post('samester') ? trim($this->input->post('samester')) : '');
      $subjects = array();
      if($param2!='') {
        $subjects = $this->crud_model->get_subjects('', $param2);
        $subjects = $subjects->result_array();
      } 
      if(!empty($subjects)) {
        echo json_encode($subjects);
      } else {
        echo 0;
      }
    }

    function get_chapter($param1='', $param2='', $param3='') {
      if ($this->session->userdata('admin_login') != true) {
        echo 0;
      } 
      $param2 = ($this->input->post('subject_id') ? trim($this->input->post('subject_id')) : ''); 
      $chapters = $this->Master_model->get_chapters('', $param2);
      $chapters = $chapters->result_array();
      if(!empty($chapters)) {
        echo json_encode($chapters);
      } else {
        echo 0;
      }
    }
  }
?>