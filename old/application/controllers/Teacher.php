<?php
  defined('BASEPATH') OR exit('No direct script access allowed');
  require_once (__DIR__.'/../../assets/razorpay-php/Razorpay.php');
  use Razorpay\Api\Api as RazorpayApi; 
  class Teacher extends CI_Controller {
    public function __construct()
    {
      parent::__construct();
      $this->load->database();
      $this->load->library('session');
      $this->load->helper('cookie');
      /*cache control*/
      $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
      $this->output->set_header('Pragma: no-cache');
      $this->load->library('CKEditor');
      $this->load->library('CKFinder');
      $this->ckeditor->basePath = base_url().'assets/ckeditor/';
      
    } 
    
    public function dashboard($param1 = '', $param2 = '') 
    { 
      if ($this->session->userdata('teacher_login') != true) {
        redirect(site_url('login'), 'refresh');
      } 
      $this->session->set_userdata('last_page', 'dashboard'); 
      $page_data['page_name'] = 'dashboard';
      $page_data['page_title'] = get_phrase('dashboard');
      $quesdata = $this->crud_model->QuestionCountByStatus($this->session->userdata('user_id'));
      $page_data['quesdata'] = $quesdata->row_array();
      $page_data['categories'] = $this->crud_model->get_categories(); 
      if($param1=='assignsubject') {
        $this->crud_model->add_assignsubject($this->session->userdata('user_id'));
        header("location:".base_url()."teacher/dashboard"); 
      }
      if($param1=='deletesubject') {
        $this->crud_model->delete_assignsubject($param2);
        header("location:".base_url()."teacher/dashboard"); 
      }
      $page_data['pending_questions'] = $this->db->where("userID='" . $this->session->userdata('user_id') . "' AND status=3")->count_all_results('questions');
      //echo $page_data['pending_questions']; die('h');
      $page_data['subjects'] = $this->crud_model->get_notassignsubjects($this->session->userdata('user_id'));
      $page_data['selected_subjects'] = $this->crud_model->get_assignsubjects($this->session->userdata('user_id'));
      $page_data['user_details'] = $this->user_model->get_user($this->session->userdata('user_id'));
      $this->load->view('backend/index.php', $page_data);
    }

    public function manage_profile($param1 = '', $param2 = '', $param3 = '')
    {
      if($param1) {

      }
      
      $this->session->set_userdata('last_page', 'manage_profile');
      if ($this->session->userdata('teacher_login') != 1)
      redirect(site_url('login'), 'refresh');
      if ($param1 == 'update_profile_info') {
        $this->user_model->edit_user($param2);
        redirect(site_url('teacher/manage_profile'), 'refresh');
      }
      if ($param1 == 'change_password') {
        $this->user_model->change_password($param2);
        redirect(site_url('teacher/manage_profile'), 'refresh');
      }
      if ($param1 == 'update_user_bank') { 
        $where = array('user_id' => $this->session->userdata('user_id'));
        $check = $this->crud_model->get_row('bank_details', $where)->num_rows();
        if($check > 0) {
          $this->crud_model->edit_row('bank_details', $where, $this->input->post());
        } else {
          $_POST['user_id'] = $this->session->userdata('user_id');
          $this->crud_model->add_row('bank_details', $this->input->post());
        } 
        $this->session->set_flashdata('flash_message', get_phrase('updated_successfully'));
        redirect(site_url('teacher/manage_profile'), 'refresh');
      }
      $page_data['page_name']  = 'manage_profile';
      $page_data['page_title'] = get_phrase('manage_profile');
      $page_data['bank_details'] = $this->crud_model->getRow('bank_details', array('user_id'=>$this->session->userdata('user_id')));
      $page_data['edit_data']  = $this->db->get_where('users', array(
      'id' => $this->session->userdata('user_id')
      ))->result_array();
      $this->load->view('backend/index', $page_data);
    } 

    public function questions($param1 = '', $param2 = '', $param3 = '') {
      if ($this->session->userdata('teacher_login') != 1)
      redirect(site_url('login'), 'refresh'); 
      $this->session->set_userdata('last_page', 'questions');
      $page_data['page_name'] = 'questions';
      $page_data['page_title'] = get_phrase('questions');
      $page_data['questions'] = array(); //$this->crud_model->get_questions($param1, $this->session->userdata('user_id')); 
      $this->load->view('backend/index', $page_data);
    }

    public function question_form($param1 = "", $param2 = "") {
      
      if ($this->session->userdata('teacher_login') != 1) {
        redirect(site_url('login'), 'refresh');
      }
      $this->session->set_userdata('last_page', 'questions'); 
      $page_data['categories'] = $this->crud_model->get_categories(); 
      if ($param1 == 'add_question') { 
        //Add Ckfinder to Ckeditor
        $page_data['subjects'] = $this->crud_model->get_subjects();
        $this->ckfinder->SetupCKEditor($this->ckeditor,'../../assets/ckfinder/');
        $page_data['page_name'] = 'question_add';
        $page_data['page_title'] = get_phrase('add_question'); 
        $this->load->view('backend/index', $page_data);
        
        }elseif ($param1 == 'question_edit') {
        //Add Ckfinder to Ckeditor
        $this->ckfinder->SetupCKEditor($this->ckeditor,'../../../assets/ckfinder/');
        $page_data['page_name'] = 'question_edit';
        $page_data['question_id'] =  $param2; 
        $data = $this->crud_model->get_questions($param2, $this->session->userdata('user_id'))->row_array();
        //echo "<pre>"; print_r($data); die();
        $page_data['question_detail'] = $data;
        $page_data['sub_categories'] = ($data['category_id']!='' ? $this->crud_model->get_sub_categories($data['category_id']) : array()); 
        $page_data['samesters'] = $this->Master_model->view_samester('', '', $data['subcategory_id']);
        $page_data['subjects'] = $this->crud_model->get_subjects('', $data['samester_id']); 
        $page_data['chapters'] = $this->Master_model->get_chapters('', $data['subject_id']); 
        if(!is_array($page_data['question_detail'])) {
          redirect(site_url('teacher/questions'), 'refresh');
        } 
        $page_data['page_title'] = get_phrase('edit_question');
        $this->load->view('backend/index', $page_data);
      }
    }

    public function question_actions($param1 = "", $param2 = "") {
      
      if ($this->session->userdata('teacher_login') != 1) {
        redirect(site_url('login'), 'refresh');
      }
      if ($param1 == "add") {
        $this->crud_model->add_question();
        redirect(site_url('teacher/questions'), 'refresh');
        
      }
      elseif ($param1 == "edit") {
        $this->crud_model->update_question($param2, $this->session->userdata('user_id'));
        redirect(site_url('teacher/questions'), 'refresh');
        
      }
      elseif ($param1 == 'delete') {
        $where = array('id'=>$param2, 'userID' => $this->session->userdata('user_id'));
        $this->crud_model->delete_row('questions', $where);
        redirect(site_url('teacher/questions'), 'refresh');
      }
    }

    function get_all_questions($param1='', $param2='')
    {
      $param2 = $this->session->userdata('user_id');
      $record = $this->crud_model->get_all_questions($param1, $param2);
      $data = array(); 
      //echo "<pre>"; print_r($record); die();
      foreach($record as $key)
      {
        $sub_array['subject']=$key->name;
        $sub_array['chapter']=$key->chapter_name;
        $sub_array['samester']=$key->samester_name;
        $sub_array['subcategory']=$key->subcategory_name;
        $sub_array['category']=$key->category_name;
        $sub_array['question']=$key->question;
        $sub_array['correct_answer']=$key->correct_answer;
        $sub_array['status']=($key->status ==3 ? 'Pending' : 'Submitted');
        $sub_array['action'] = ($key->status==3 ? '<div class="btn-group">
        <button class="btn btn-small btn-default btn-demo-space" data-toggle="dropdown"> <i class = "fa fa-ellipsis-v"></i> </button>
        <ul class="dropdown-menu dropdown-default" role="menu">
        <li>
        <a href="'.site_url('teacher/question_form/question_edit/'.$key->id).'">
        '.get_phrase('edit').'</a>
        </li>
        <li class="divider"></li>
        <li>
        <a href="'.site_url('teacher/question_actions/delete/'.$key->id).'" onclick="return confirm(Are you sure to delete);">
        '.get_phrase('delete').'</a>
        </li>' : $sub_array['status']);
        
        $data[] =$sub_array;
      }
      
      $output = array('draw' => intval($this->input->post('draw')),
      'recordsTotal' => $this->crud_model->count_total_question($param1, $param2),
      'recordsFiltered' =>$this->crud_model->count_filter_question($param1, $param2),
      'data'=>$data,
      'record'=>$record,
      // 'filter'=>$filter,
      'result' =>$this->db->last_query(),
      // 'course'=>$course_record
      );
      //echo "<pre>"; print_r($output); die();
      echo json_encode($output);
      // echo json_encode($this->input->post());
    }

    function get_chapter($param1='', $param2='', $param3='') {
      if ($this->session->userdata('teacher_login') != true) {
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

    function sub_categories($param1='') {
      if ($this->session->userdata('teacher_login') != true) {
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

    function get_samester($param1='', $param2='', $param3='') {
      if ($this->session->userdata('teacher_login') != true) {
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

    function get_subject($param1='', $param2='', $param3='') {
      if ($this->session->userdata('teacher_login') != true) {
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

    public function sendquestions($param1='', $param2='') {
      $data = $this->crud_model->get_questions('', $this->session->userdata('user_id'), 3, $this->input->post('category_id'), $this->input->post('sub_category_id'), $this->input->post('samester'), $this->input->post('subject_id'), 5); 
      if($data->num_rows()>=5) { 
        $data = $data->result_array();
        $arrdata = array();
        foreach ($data as $key => $value) {
          $arrdata[] = $value['id'];
        } 
        $updata = array('status'=>0);
        $this->db->where_in('id', $arrdata);
        $this->db->update('questions', $updata);
        $this->session->set_flashdata('flash_message', get_phrase('questions_are_sent_for_approval.'));
      }
      header("Location:". base_url() ."teacher/dashboard");
    }

    public function GetQuesCount() {
      $data = $this->crud_model->get_questions('', $this->session->userdata('user_id'), 3, $this->input->post('category_id'), $this->input->post('sub_category_id'), $this->input->post('samester'), $this->input->post('subject_id'));
      echo $data->num_rows();
    }

    public function videos($param1 = '', $param2 = '', $param3 = '') {
      if ($this->session->userdata('teacher_login') != 1)
      redirect(site_url('login'), 'refresh'); 

      $this->session->set_userdata('last_page', 'videos');
      $page_data['page_name'] = 'videos';
      $page_data['page_title'] = get_phrase('videos');
      $page_data['videos'] = $this->Master_model->get_videos('', array('userID'=>$this->session->userdata('user_id')));  
      $this->load->view('backend/index', $page_data);
    }

    public function video_form($param1 = "", $param2 = "") {
      
      if ($this->session->userdata('teacher_login') != 1) {
        redirect(site_url('login'), 'refresh');
      }

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
        $data = $this->Master_model->get_videos($param2, array('userID'=>$this->session->userdata('user_id')))->row_array();
        //echo "<pre>"; print_r($data); die();
        $page_data['video_detail'] = $data;
        $page_data['sub_categories'] = ($data['category_id']!='' ? $this->crud_model->get_sub_categories($data['category_id']) : array()); 
        $page_data['samesters'] = $this->Master_model->view_samester('', '', $data['subcategory_id']);
        $page_data['subjects'] = $this->crud_model->get_subjects('', $data['samester_id']); 
        $page_data['chapters'] = $this->Master_model->get_chapters('', $data['subject_id']); 
        if(!is_array($page_data['video_detail'])) {
          redirect(site_url('teacher/videos'), 'refresh');
        } 
        $page_data['page_title'] = get_phrase('edit_question');
        $this->load->view('backend/index', $page_data);
      }
    }

    public function video_actions($param1 = "", $param2 = "") {
      
      if ($this->session->userdata('teacher_login') != 1) {
        redirect(site_url('login'), 'refresh');
      } 
      if ($param1 == "add") {
        $this->Master_model->add_video();
        redirect(site_url('teacher/videos'), 'refresh');
        
      }
      elseif ($param1 == "edit") {
        $this->Master_model->update_video($param2, $this->session->userdata('user_id'));
        redirect(site_url('teacher/videos'), 'refresh');
        
      }
      elseif ($param1 == 'delete') {
        $where = array('id'=>$param2, 'userID' => $this->session->userdata('user_id'));
        $this->crud_model->delete_row('questions', $where);
        redirect(site_url('teacher/videos'), 'refresh');
      }
    }

    public function becomepremium(){ 
      if($this->session->userdata('user_id') > 0 && $this->session->userdata('role_id')==3) {
        $string = $this->crud_model->add_cart(1100, 1100, 'Premium Teacher');
        $posted['orderId'] = $string;
        $posted['orderAmount'] = 1100;
        $this->session->set_userdata('posted', $posted); 
        $api = new RazorpayApi(RAZOR_KEY_ID, RAZOR_KEY_SECRET); 
        $orderData = [
          'receipt'         => $string,
          'amount'          => 110000, // 2000 rupees in paise
          'currency'        => 'INR',
          'payment_capture' => 1 // auto capture
        ];

        $razorpayOrder = $api->order->create($orderData);  
        $admin_details = $this->user_model->get_all_user($this->session->userdata('user_id'))->row_array(); 
        $orderDetails['customerName'] = $admin_details['first_name'].' '.$admin_details['last_name'];
        $orderDetails['customerEmail'] = $admin_details['email'];
        $orderDetails['customerPhone'] = $admin_details['contact'];
        $orderDetails['notifyUrl'] = base_url('/teacher/notifyurl');
        $orderDetails['returnUrl'] = base_url('/teacher/returnurl');
        $orderDetails['orderId'] = $string;
        $orderDetails['order'] = $razorpayOrder;
        $cartdata = array('order_id'=>$orderDetails['order']['id']); 
        $this->crud_model->update_cart($cartdata, $string);
        $this->load->view('backend/teacher/checkout_form', $orderDetails);
      } else {
        redirect(site_url('home'), 'refresh');
      } 
    }


    function returnurl()
    { 
      if(!empty($this->input->post(null)))
      {
        $signature = hash_hmac('sha256', $this->input->post('razorpay_order_id') . "|" . $this->input->post('razorpay_payment_id'), RAZOR_KEY_SECRET);  
        $new_post = $this->input->post(null); 
        $new_post['orderAmount'] = $this->session->userdata('posted')['orderAmount'];
        $new_post['txStatus'] =($signature == $this->input->post('razorpay_signature') && $this->input->post('razorpay_signature')!='' ? 'Success' : 'Failed');
        $this->session->set_userdata('new_post', $new_post); 
        if ($signature == $this->input->post('razorpay_signature') && $this->input->post('razorpay_signature')!='') {
          $user_id = $this->session->userdata('user_id'); 
          if($user_id=='') {
            $userdata = $this->crud_model->get_usercart('', $this->input->post('razorpay_order_id'))->row_array();
            if($userdata['role_id']=='3') {
              $this->session->set_userdata('teacher_login', '1');
              $this->session->set_userdata('user_id', $userdata['id']);
              set_cookie('user', md5($row->id), '86400');
              $this->session->set_userdata('role_id', 3);
              $this->session->set_userdata('role', get_user_role('user_role', $userdata['id']));
              $this->session->set_userdata('name', $userdata['first_name'].' '.$userdata['last_name']);
            } else {
              redirect(site_url('home'), 'refresh');
            }
            
          }
          //$sub_category_id = $this->session->userdata('subcategory_id');
          $cartdata=array(
            'status'=>'Success', 
            'payment_id'=>$this->input->post('razorpay_payment_id'),
            'payment_signature'=>$this->input->post('razorpay_signature')
          );
          $this->crud_model->update_cart($cartdata, $this->session->userdata('posted')['orderId'], $this->input->post('razorpay_order_id'));
          $this->user_model->updatePremium();
          $this->session->set_flashdata('flash_message', get_phrase('payment_successful'));
          redirect(site_url('teacher/dashboard/'), 'refresh');
          //header("location:" .base_url(). "teacher/dashboard"); 
        }
        else
        { 
          $cartdata=array(
            'status'=>'Failed'
          );
          $this->crud_model->update_cart($cartdata, $this->session->userdata('posted')['orderId']);
          $this->session->set_flashdata('error_message', get_phrase('payment_failed'));
          redirect(site_url('teacher/dashboard/'), 'refresh');
          //header("location:" .base_url(). "teacher/dashboard"); 
        } 
      } else {
        redirect(site_url('home'), 'refresh');
      }
    }
    
    function notifyurl()
    {
       print_r($this->input->post()); 
    }

  }   
