<?php
  defined('BASEPATH') OR exit('No direct script access allowed');
  
  class Master_model extends CI_Model {
    
	  function __construct()
	  {
	    parent::__construct();
	    /*cache control*/
	    $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
	    $this->output->set_header('Pragma: no-cache');
	  }

	  public function add_samester() {
	  	$data = array(
        'title'=>html_escape($this->input->post('title')),
        'category_id'=>html_escape($this->input->post('category_id')),
        'subcategory_id'=>html_escape($this->input->post('sub_category_id')),
        'status'=>1,
        'date'=>date('Y-m-d H:i:s')
	  	);
	  	$this->db->insert('m00_samester', $data);
	  	$this->session->set_flashdata('flash_message', get_phrase('samester_added_successfully'));
	  }

	  public function update_samester($param1='') {
	  	$data = array(
        'title'=>html_escape($this->input->post('title')),
        'category_id'=>html_escape($this->input->post('category_id')),
        'subcategory_id'=>html_escape($this->input->post('sub_category_id')) 
	  	);
	  	$this->db->where('id', $param1);
	  	$this->db->update('m00_samester', $data);
	  	$this->session->set_flashdata('flash_message', get_phrase('samester_update_successfully'));
	  }

	  public function delete_samester($param1='') {
      $this->db->where('id', $param1);
      $this->db->delete('m00_samester');
    }

	  public function view_samester($param1='', $param2='', $param3='') {
      $this->db->select('s.*, c.name AS category_name, sc.name AS sub_category_name, c.id AS category_id')
        ->from('m00_samester AS s')
        ->join('category AS sc', 'sc.id=s.subcategory_id', 'LEFT')
        ->join('category AS c', 'c.id=sc.parent');
      if($param1!='') {
      	$this->db->where('s.id', $param1);
      }

      if($param2!='') {
      	$this->db->where('c.id', $param2);
      }

      if($param3!='') {
      	$this->db->where('s.subcategory_id', $param3);
      }
      $data = $this->db->get();
      return $data;
	  }

	  // code start by khushboo
    public function get_chapters($param1 = "", $param2 = "") {
      $this->db->select('ch.*, m.title, c.name AS category_name, sc.name AS sub_category_name, s.name AS subject_name, c.id AS category_id, sc.id AS sub_category_id, m.id AS samester_id')
        ->from('m01_chapter as ch')
        ->join('subject as s', 's.id = ch.subject_id', 'left')
        ->join('m00_samester AS m', 'm.id = s.samester', 'left')
        ->join('category AS sc', 'sc.id = m.subcategory_id', 'left')
        ->join('category AS c', 'c.id = sc.parent', 'left');
      if ($param1 != "") {
        $this->db->where('ch.id', $param1);
      }
      if ($param2 != "") {
        $this->db->where('ch.subject_id', $param2);
      }
      return $this->db->get();
    }
    
    public function add_chapter() {
      $data['c_code'] = html_escape($this->input->post('code'));
      $data['c_name'] = html_escape($this->input->post('name'));
      $data['category_id'] = html_escape($this->input->post('category_id'));
      $data['sub_category_id'] = html_escape($this->input->post('sub_category_id'));
      $data['samester_id'] = html_escape($this->input->post('samester'));
      $data['subject_id'] = html_escape($this->input->post('subject_id'));
      $data['status'] = 1;
      $data['font_awesome_class'] = 'fa '.html_escape($this->input->post('font_awesome_class'));
      $data['date'] = date('Y-m-d H:i');
      $this->db->insert('m01_chapter', $data);
    }
    
    public function edit_chapter($param1) {
      $data['c_code'] = html_escape($this->input->post('code'));
      $data['c_name'] = html_escape($this->input->post('name'));
      $data['category_id'] = html_escape($this->input->post('category_id'));
      $data['sub_category_id'] = html_escape($this->input->post('sub_category_id'));
      $data['samester_id'] = html_escape($this->input->post('samester'));
      $data['subject_id'] = html_escape($this->input->post('subject_id'));
      if($this->input->post('font_awesome_class')!='') {
        $data['font_awesome_class'] = 'fa '.html_escape($this->input->post('font_awesome_class'));
      }  
      $this->db->where('id', $param1);
      $this->db->update('m01_chapter', $data);
    }
    
    public function delete_chapter($subject_id) {
      $this->db->where('id', $subject_id);
      if(!$this->db->delete('m01_chapter')){
        return false;
        }else{
        return true;
      }
    }

    public function get_videos($param1 = "", $param2=array(), $limit='') {
      $this->db->select('tr_videos.*, subject.name, sm.id AS samester_id, sc.id AS subcategory_id, c.id AS category_id, sm.title AS samester_name, c.name AS category_name, sc.name AS sub_category_name, u.first_name, u.last_name, u.email');
      if ($param1 != "") {
        $this->db->where('tr_videos.id', $param1);
      } 
      $this->db->join('users AS u', 'tr_videos.userID = u.id', 'left')
        ->join('subject', 'subject.id = tr_videos.subject_id', 'left') 
        ->join('m00_samester AS sm', 'sm.id = subject.samester', 'left')
        ->join('category AS sc', 'sc.id = sm.subcategory_id', 'left')
        ->join('category AS c', 'c.id = sc.parent', 'left');
      if(!empty($param2)) {
        $this->db->where($param2);
      }
      if($limit!='') {
        $this->db->limit($limit);
      }
      return $this->db->get('tr_videos');
    }

    public function add_video() { 
      $filename = null;  
      if ($_FILES['video']['name'] != "") {
        $filename = $_FILES['video']['name'];
        move_uploaded_file($_FILES['video']['tmp_name'], 'uploads/video/' . $_FILES['video']['name']);
      } 
      $data['video_title'] = $this->input->post('video_title');
      $data['description'] = html_escape($this->input->post('description'));
      $data['subject_id'] = html_escape($this->input->post('subject_id')); 
      $data['userID'] = $this->session->userdata('user_id');
      $data['file'] = $filename; 
      $data['date'] = date('Y-m-d H:i:s');
      $data['status'] = 1; 
      $this->db->insert('tr_videos', $data);
    }
    
    public function update_video($param1='', $param2='') {
       $filename = null;  
      if ($_FILES['video']['name'] != "") {
        $filename = $_FILES['video']['name'];
        move_uploaded_file($_FILES['video']['tmp_name'], 'uploads/video/' . $_FILES['video']['name']);
        $data['file'] = $filename;
      }  
      $data['video_title'] = $this->input->post('video_title');
      $data['description'] = html_escape($this->input->post('description'));
      $data['subject_id'] = html_escape($this->input->post('subject_id'));  
      $data['updated_date'] = date('Y-m-d H:i:s');
      $this->db->where('id', $param1);
      if($param2!='') {
        $this->db->where('userID', $param2);
      }
      $this->db->update('tr_videos', $data); 
    }


    public function get_docs($param1 = "", $param2=array(), $limit='') {
      $this->db->select(' tr_doc.*, subject.name, sm.id AS samester_id, sc.id AS subcategory_id, c.id AS category_id, sm.title AS samester_name, c.name AS category_name, sc.name AS sub_category_name, u.first_name, u.last_name, u.email');
      if ($param1 != "") {
        $this->db->where(' tr_doc.id', $param1);
      } 
      $this->db->join('users AS u', ' tr_doc.userID = u.id', 'left')
        ->join('subject', 'subject.id =  tr_doc.subject_id', 'left') 
        ->join('m00_samester AS sm', 'sm.id = subject.samester', 'left')
        ->join('category AS sc', 'sc.id = sm.subcategory_id', 'left')
        ->join('category AS c', 'c.id = sc.parent', 'left');
      if(!empty($param2)) {
        $this->db->where($param2);
      }
      if($limit!='') {
        $this->db->limit($limit);
      }
      return $this->db->get('tr_doc');
    } 

    public function add_doc() { 
      $filename = null;  
      if ($_FILES['doc']['name'] != "") {
        $filename = $_FILES['doc']['name'];
        move_uploaded_file($_FILES['doc']['tmp_name'], 'uploads/doc/' . $_FILES['doc']['name']);
      } 
      $data['doc_title'] = $this->input->post('doc_title');
      $data['description'] = html_escape($this->input->post('description'));
      $data['subject_id'] = html_escape($this->input->post('subject_id')); 
      $data['userID'] = $this->session->userdata('user_id');
      $data['file'] = $filename; 
      $data['date'] = date('Y-m-d H:i:s');
      $data['status'] = 1; 
      $this->db->insert('tr_doc', $data);
    }
    
    public function update_doc($param1='', $param2='') {
       $filename = null;  
      if ($_FILES['doc']['name'] != "") {
        $filename = $_FILES['doc']['name'];
        move_uploaded_file($_FILES['doc']['tmp_name'], 'uploads/doc/' . $_FILES['doc']['name']);
        $data['file'] = $filename;
      }  
      $data['doc_title'] = $this->input->post('doc_title');
      $data['description'] = html_escape($this->input->post('description'));
      $data['subject_id'] = html_escape($this->input->post('subject_id'));  
      $data['updated_date'] = date('Y-m-d H:i:s');
      $this->db->where('id', $param1);
      if($param2!='') {
        $this->db->where('userID', $param2);
      }
      $this->db->update('tr_doc', $data); 
    }

  }
?>