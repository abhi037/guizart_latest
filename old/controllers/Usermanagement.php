<?php
  defined('BASEPATH') OR exit('No direct script access allowed');
  
  class Usermanagement extends CI_Controller {
    public function __construct() {
      parent::__construct();
      
      $this->load->database();
      $this->load->library('session');
      /*cache control*/
      $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
      $this->output->set_header('Pragma: no-cache');
      
      $this->load->library('CKEditor');
      $this->load->library('CKFinder');
      $this->ckeditor->basePath = base_url().'assets/ckeditor/';
      if ($this->session->userdata('admin_login') != true) {
        if($this->session->userdata('role_id') > 3) {
          $isaaceable=$this->user_model->GetAccess($this->input->server('REDIRECT_QUERY_STRING'), $this->session->userdata('role_id'));
          if($isaaceable->num_rows() <=0) {
            redirect(site_url('login'), 'refresh');
          } 
        } else {
          redirect(site_url('login'), 'refresh');
        } 
      }
    }

    public function employee($param1 = "", $param2 = "") { 
      if ($param1 == "add") {
        $this->user_model->add_user();
        redirect(site_url('Usermanagement/employee'), 'refresh');
      }
      elseif ($param1 == "edit") {
        $this->user_model->edit_user($param2);
        redirect(site_url('Usermanagement/employee'), 'refresh');
      }
      elseif ($param1 == "delete") {
        $this->user_model->delete_user($param2);
        redirect(site_url('Usermanagement/employee'), 'refresh');
      }
      
      $this->session->set_userdata('last_page', 'employee');
      $page_data['page_name'] = 'employee';
      $page_data['page_title'] = get_phrase('employee');
      $page_data['users'] = $this->user_model->get_employee();
      $this->load->view('backend/index', $page_data);
    }
    
    public function employee_form($param1 = "", $param2 = "") { 
      $this->session->set_userdata('last_page', 'employee');
      $page_data['roles'] = $this->user_model->get_role();
      if ($param1 == 'add_employee_form') {
        $page_data['page_name'] = 'employee_add';
        $page_data['page_title'] = get_phrase('add_employee');
        $this->load->view('backend/index', $page_data);
      }
      elseif ($param1 == 'edit_employee_form') {
        $page_data['page_name'] = 'employee_edit';
        $page_data['user_id'] = $param2;
        $page_data['page_title'] = get_phrase('edit_employee');
        $page_data['user_data'] = $this->user_model->get_all_user($param2)->row_array();
        $this->load->view('backend/index', $page_data);
      }
    }

    public function roles($param1='', $param2='') {
      $page_data['page_name'] = 'roles'; 
      $this->session->set_userdata('last_page', 'roles');
      $page_data['page_title'] = get_phrase('roles_management'); 
      $page_data['roles'] = $this->user_model->get_role();
      if ($param1 == "add") {
        $this->user_model->add_role();
        redirect(site_url('usermanagement/roles'), 'refresh');
      }

      if ($param1 == "update") {
        $this->user_model->update_role($param2);
        redirect(site_url('usermanagement/roles'), 'refresh');
      }

      if ($param1 == "delete") {
        $this->user_model->delete_role($param2);
        redirect(site_url('usermanagement/roles'), 'refresh');
      }
      $this->load->view('backend/index', $page_data);
    }

    public function role_form($param1='', $param2='') {
      $this->session->set_userdata('last_page', 'roles');
      $datas = $this->user_model->userpermission();
      $permissions = array();
      foreach ($datas->result_array() as $key => $value) {
        $permissions[$value['type']][] = $value; 
      }
      $page_data['permissions']=$permissions;
      if ($param1 == 'add_role') {
        $page_data['page_name'] = 'role_add'; 
        $page_data['page_title'] = get_phrase('add_role'); 
        $page_data['roles'] = $this->user_model->get_role();
        $this->load->view('backend/index', $page_data);
      } else if ($param1 == 'edit_role') {
        $page_data['page_name'] = 'role_edit'; 
        $page_data['page_title'] = get_phrase('edit_role'); 
        $page_data['roleid']=$param2;
        $page_data['roles'] = $this->user_model->get_role($param2)->result_array(); 
        $acl = $this->user_model->getAcl($param2)->result_array();
        $permissions=array();
        foreach ($acl as $key => $value) {
          $permissions[] = $value['permission_id'];
        } 
        $page_data['acl']= $permissions;
        $this->load->view('backend/index', $page_data);
      }
    }

  }
?>