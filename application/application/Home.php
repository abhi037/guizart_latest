<?php
  defined('BASEPATH') OR exit('No direct script access allowed');
  require_once (__DIR__.'/../../assets/razorpay-php/Razorpay.php');
  use Razorpay\Api\Api as RazorpayApi;    
  class Home extends CI_Controller {
    
    public function __construct()
    {
      parent::__construct();
      // Your own constructor code
      $this->load->database();
      $this->load->library('session');
      /*cache control*/
      //$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
      //$this->output->set_header('Pragma: no-cache');
      if (!$this->session->userdata('cart_items')) {
        $this->session->set_userdata('cart_items', array());
      } 
    }
    
    public function index() {
      $this->session->set_userdata('last_page', '/');
      
      $this->home();
    }
    
    
    
    public function home() {
      $page_data['page_name'] = "home";
      $page_data['page_title'] = get_phrase('home');
      $page_data['online_exam'] = $this->crud_model->get_sub_categories();
      $page_data['categories'] = $this->crud_model->get_categories();
      $page_data['winners'] = $this->crud_model->get_winners();
      if ($this->session->userdata('user_login') == true) {
        $page_data['enroll_cat'] = $this->crud_model->enroll_history_by_user_id($this->session->userdata('user_id'))->result_array();
        $page_data['enroll_cat'] = array_column($page_data['enroll_cat'], 'sub_category_id');
      }
      $page_data['sliders'] = $this->crud_model->getResultData('photos', array('status'=>1, 'type'=>'slider'), '', '', 'position');
      $page_data['slider_lower'] = $this->crud_model->getResultData('photos', array('status'=>1, 'type'=>'slider1'), '', '', 'position');

      $page_data['hightligt_quiz'] = $this->crud_model->last_highlight_quiz();
      $this->load->view('frontend/default/index', $page_data);
    }

    public function csvupload($value='')
    {
      if(isset($_FILES) && !empty($_FILES) && $_FILES['csv']['tmp_name']!='') {
        echo "<pre>"; print_r($_FILES);
        $file = $_FILES['csv']['tmp_name'];
        $handle = fopen($file, "r"); 
        while(($filesop = fgetcsv($handle, 1000, ",")) !== false){
          if(isset($filesop[4]) && $filesop[4]!='') {
            if(trim($filesop[0])!='') {
              $cate = $this->db->query("SELECT * FROM category WHERE name LIKE '%". trim($filesop[0]) ."%' LIMIT 1");
              $cate_id = null;
              if($cate->num_rows() > 0) {
                $cate = $cate->row_array();
                $cate_id = $cate['id'];
              } else {
                $catedata = array(
                  'name'=> trim($filesop[0]),
                  'code'=> substr(md5(rand(0, 1000000)), 0, 10),
                  'parent'=>0
                );
                $cate = $this->db->insert('category', $catedata);
                $cate_id = $this->db->insert_id();
              }
            }

            if(trim($filesop[1])!='') {
              $subcate = $this->db->query("SELECT * FROM category WHERE name LIKE '%". trim($filesop[1]) ."%' AND parent =". $cate_id ." LIMIT 1");
              $subcate_id = null;
              if($subcate->num_rows() > 0) {
                $subcate = $subcate->row_array();
                $subcate_id = $subcate['id'];
              } else {
                $subcatedata = array(
                  'name'=> trim($filesop[1]),
                  'code'=> substr(md5(rand(0, 1000000)), 0, 10),
                  'parent'=>$cate_id
                );
                $subcate = $this->db->insert('category', $subcatedata);
                $subcate_id = $this->db->insert_id();
              }
            }
            
            if(trim($filesop[2])!='') {
              $samester = $this->db->query("SELECT * FROM m00_samester WHERE title LIKE '%" . trim($filesop[2]) . "%' AND subcategory_id=". $subcate_id ." ");
              $samester_id = null;
              if($samester->num_rows() > 0) {
                $samester = $samester->row_array();
                $samester_id = $samester['id'];
              } else {
                $samesterdata = array(
                  'title'=> trim($filesop[2]),
                  'subcategory_id'=> $subcate_id,
                  'category_id'=>$cate_id,
                  'status'=>1
                );
                $samester = $this->db->insert('m00_samester', $samesterdata);
                $samester_id = $this->db->insert_id();
              }
            }
            
            if(trim($filesop[3])!='') {
              $subject = $this->db->query("SELECT * FROM subject WHERE name LIKE '%" . trim($filesop[3]) . "%' AND samester=". $samester_id ." ");
              $subject_id = null;
              if($subject->num_rows() > 0) {
                $subject = $subject->row_array();
                $subject_id = $subject['id'];
              } else {
                $subjectdata = array(
                  'name'=> trim($filesop[3]),
                  'code'=> substr(md5(rand(0, 1000000)), 0, 10),
                  'samester'=> $samester_id,
                  'sub_category_id'=> $subcate_id,
                  'category_id'=>$cate_id,
                  'status'=>1
                );
                $subject = $this->db->insert('subject', $subjectdata);
                $subject_id = $this->db->insert_id();
              }
            }

            if(trim($filesop[4])!='') {
              $chapter = $this->db->query("SELECT * FROM m01_chapter WHERE c_name LIKE '%" . trim($filesop[4]) . "%' AND subject_id=". $subject_id ." ");
              $oldchapter_id= $newchapter_id = null;
              if($chapter->num_rows() > 0) {
                $chapter = $chapter->row_array();
                $oldchapter_id = $chapter['id'];
              } else {
                $chapterdata = array(
                  'c_name'=> trim($filesop[4]),
                  'c_code'=> substr(md5(rand(0, 1000000)), 0, 10),
                  'subject_id'=> $subject_id,
                  'samester_id'=> $samester_id,
                  'sub_category_id'=> $subcate_id,
                  'category_id'=>$cate_id,
                  'status'=>1
                );
                $chapter = $this->db->insert('m01_chapter', $chapterdata);
                $newchapter_id = $this->db->insert_id();
              }
            }

            echo ($oldchapter_id ? ('Old Chapter id :- ' . $oldchapter_id . '<br/>') : ('New Chapter id :- ' . $newchapter_id . '<br/>'));
          } 
        } 
      }
      
      echo '<form method="post" enctype="multipart/form-data"><input type="file" name="csv" /><input type="submit" /></form>';
    }


    public function questioupload($value='')
    {
      if(isset($_FILES) && !empty($_FILES) && $_FILES['csv']['tmp_name']!='') {
        echo "<pre>"; print_r($_FILES);
        $file = $_FILES['csv']['tmp_name'];
        $handle = fopen($file, "r"); 
        while(($filesop = fgetcsv($handle, 1000, ",")) !== false){
          
          echo "<pre>"; print_r($filesop);
        } 
      }
      
      echo '<form method="post" enctype="multipart/form-data"><input type="file" name="csv" /><input type="submit" /></form>';
    }

    public function getsubcategory($param1='') {
      if($param1!='') {
        $subCategories = $this->crud_model->get_sub_categories($param1);
        echo json_encode($subCategories);
      } else {
        echo 0;
      }
      
    }
    
    public function shopping_cart() {
      if (!$this->session->userdata('cart_items')) {
        $this->session->set_userdata('cart_items', array());
      }
      $page_data['page_name'] = "shopping_cart";
      $page_data['page_title'] = get_phrase('shopping_cart');
      $this->load->view('frontend/default/index', $page_data);
    }
    
    public function category($slug = "", $sub_category_id = "") {
      $checker = array();
      if ($sub_category_id > 0) {
        $page_data['sub_category_id'] = $sub_category_id;
        $sub_category_details = $this->crud_model->get_category_details_by_id($sub_category_id)->row_array();
        $category_details     = $this->crud_model->get_categories($sub_category_details['parent'])->row_array();
        $checker = array(
                'category_id'     => $category_details['id'],
                'sub_category_id' => $sub_category_details['id']
        );
      }
      if ($this->session->userdata('user_login') == true) {
        $page_data['enroll_cat'] = $this->crud_model->enroll_history_by_user_id($this->session->userdata('user_id'))->result_array();
        $page_data['enroll_cat'] = array_column($page_data['enroll_cat'], 'sub_category_id');
      }
      $this->session->set_userdata('subcategory_id', $sub_category_id);
      $page_data['exam'] = $sub_category_details;
      $page_data['category_details'] = $category_details;
      $this->db->where($checker);
      $this->db->where('status', 'active');
      $total_rows = $this->db->get('course')->num_rows();
      $config = array();
      $config = pagintaion($total_rows, 10);
      $config['base_url']  = site_url('home/category/'.$slug.'/'.$sub_category_id.'/');
      $this->pagination->initialize($config);
      
      $page_data['page_name']       = "category_page";
      $page_data['page_title']      = get_phrase('category_page');
      $page_data['per_page']        = $config['per_page'];
      $this->load->view('frontend/default/index', $page_data);
    }
    
    public function all_category() {
      $this->db->where('status', 'active');
      $total_rows = $this->db->get('course')->num_rows();
      $config = array();
      $config = pagintaion($total_rows, 3);
      $config['base_url']  = site_url('home/all_category/');
      $this->pagination->initialize($config);
      
      $page_data['page_name']       = "all_category_page";
      $page_data['page_title']      = get_phrase('all_categories');
      $page_data['per_page']        = $config['per_page'];
      $this->load->view('frontend/default/index', $page_data);
    }
    
    public function course($slug = "", $course_id = "") {
      $page_data['course_id'] = $course_id;
      $page_data['page_name'] = "course_page";
      $page_data['page_title'] = get_phrase('course');
      $this->load->view('frontend/default/index', $page_data);
    }
    
    public function instructor_page($instructor_id = "") {
      $page_data['page_name'] = "instructor_page";
      $page_data['page_title'] = get_phrase('instructor_page');
      $page_data['instructor_id'] = $instructor_id;
      $this->load->view('frontend/default/index', $page_data);
    }
    
    public function my_courses() {
      if ($this->session->userdata('user_login') != true) {
        redirect(site_url('home'), 'refresh');
      }
      $page_data['page_name'] = "my_courses";
      $page_data['page_title'] = get_phrase("my_courses");
      $this->load->view('frontend/default/index', $page_data);
    }
    
    public function my_messages($param1 = "", $param2 = "") {
      if ($this->session->userdata('user_login') != true) {
        redirect(site_url('home'), 'refresh');
      }
      $this->session->set_userdata('last_page', 'my_messages'); 
      if ($param1 == 'read_message') {
        $page_data['message_thread_code'] = $param2;
      }
      elseif ($param1 == 'send_new') {
        $message_thread_code = $this->crud_model->send_new_private_message();
        $this->session->set_flashdata('flash_message', get_phrase('message_sent!'));
        redirect(site_url('home/my_messages/read_message/' . $message_thread_code), 'refresh');
      }
      elseif ($param1 == 'send_reply') {
        $this->crud_model->send_reply_message($param2); //$param2 = message_thread_code
        $this->session->set_flashdata('flash_message', get_phrase('message_sent!'));
        redirect(site_url('home/my_messages/read_message/' . $param2), 'refresh');
      }
      $page_data['page_name'] = "my_messages";
      $page_data['page_title'] = get_phrase('my_messages');
      $this->load->view('frontend/user/index', $page_data);
    }
    
    public function my_notifications() {
      $page_data['page_name'] = "my_notifications";
      $page_data['page_title'] = get_phrase('my_notifications');
      $this->load->view('frontend/user/index', $page_data);
    }
    
    public function my_wishlist() {
      if (!$this->session->userdata('cart_items')) {
        $this->session->set_userdata('cart_items', array());
      }
      $my_courses = $this->crud_model->get_courses_by_wishlists();
      $page_data['my_courses'] = $my_courses;
      $page_data['page_name'] = "my_wishlist";
      $page_data['page_title'] = get_phrase('my_wishlist');
      $this->load->view('frontend/user/index', $page_data);
    }
    
    public function purchase_history() {
      if ($this->session->userdata('user_login') != true) {
        redirect(site_url('home'), 'refresh');
      }
      $this->session->set_userdata('last_page', 'purchase_history'); 
      $total_rows = $this->crud_model->purchase_history($this->session->userdata('user_id'))->num_rows();
      $config = array();
      $config = pagintaion($total_rows, 3);
      $config['base_url']  = site_url('home/purchase_history');
      $this->pagination->initialize($config);
      $page_data['per_page']   = $config['per_page'];
      $page_data['page_name']  = "purchase_history";
      $page_data['page_title'] = get_phrase('purchase_history');
      $page_data['purchase_history'] = $this->crud_model->purchase_history($this->session->userdata('user_id'));
      $this->load->view('frontend/user/index', $page_data);
    }
    
    public function profile($param1 = "") {
      if ($this->session->userdata('user_login') != true) {
        redirect(site_url('home'), 'refresh');
      }
      $this->session->set_userdata('last_page', 'profile'); 
      $page_data['page_name'] = "user_profile";
      $page_data['page_title'] = get_phrase('user_profile');
      // if ($param1 == 'user_profile') {
      //   $page_data['page_name'] = "user_profile";
      //   $page_data['page_title'] = get_phrase('user_profile');
      //   }elseif ($param1 == 'user_credentials') {
      //   $page_data['page_name'] = "user_credentials";
      //   $page_data['page_title'] = get_phrase('credentials');
      //   }elseif ($param1 == 'user_photo') {
      //   $page_data['page_name'] = "update_user_photo";
      //   $page_data['page_title'] = get_phrase('update_user_photo');
      //   }elseif ($param1 == 'user_bank') {
      //   $page_data['page_name'] = "user_bank";
      //   $page_data['page_title'] = get_phrase('user_bank_details');
      // }
      $page_data['user_details'] = $this->user_model->get_user($this->session->userdata('user_id'));
      $page_data['bank_details'] = $this->crud_model->getRow('bank_details', array('user_id'=>$this->session->userdata('user_id')));
      $this->load->view('frontend/user/index', $page_data);
    }
    
    public function update_profile($param1 = "") {
      if ($param1 == 'update_basics') {
        $this->user_model->edit_user($this->session->userdata('user_id'));
        }elseif ($param1 == "update_credentials") {
        $this->user_model->update_account_settings($this->session->userdata('user_id'));
        }elseif ($param1 == "update_photo") {
        $this->user_model->upload_user_image($this->session->userdata('user_id'));
        $this->session->set_flashdata('flash_message', get_phrase('updated_successfully'));
        }elseif ($param1 == "update_payment_settings") {
        $this->user_model->update_instructor_payment_settings($this->session->userdata('user_id'));
        $this->session->set_flashdata('flash_message', get_phrase('updated_successfully'));
        redirect(site_url('home/dashboard/payment_settings'), 'refresh');
        }elseif ($param1 == "update_user_bank") {
        $where = array('user_id'=>$this->session->userdata('user_id'));
        $this->crud_model->edit_row('bank_details', $where, $this->input->post());
        $this->session->set_flashdata('flash_message', get_phrase('updated_successfully'));
      }
      redirect(site_url('home/profile/user_profile'), 'refresh');
    }
    
    public function handleWishList() {
      if ($this->session->userdata('user_login') != 1) {
        echo false;
        }else {
        if (isset($_POST['course_id'])) {
          $course_id = $this->input->post('course_id');
          $this->crud_model->handleWishList($course_id);
        }
        $this->load->view('frontend/default/wishlist_items');
      }
    }
    public function handleCartItems() {
      if (!$this->session->userdata('cart_items')) {
        $this->session->set_userdata('cart_items', array());
      }
      
      $course_id = $this->input->post('course_id');
      $previous_cart_items = $this->session->userdata('cart_items');
      if (in_array($course_id, $previous_cart_items)) {
        $key = array_search($course_id, $previous_cart_items);
        unset($previous_cart_items[$key]);
        }else {
        array_push($previous_cart_items, $course_id);
      }
      
      $this->session->set_userdata('cart_items', $previous_cart_items);
      $this->load->view('frontend/default/cart_items');
    }
    
    public function handleCartItemForBuyNowButton() {
      if (!$this->session->userdata('cart_items')) {
        $this->session->set_userdata('cart_items', array());
      }
      
      $course_id = $this->input->post('course_id');
      $previous_cart_items = $this->session->userdata('cart_items');
      if (!in_array($course_id, $previous_cart_items)) {
        array_push($previous_cart_items, $course_id);
      }
      $this->session->set_userdata('cart_items', $previous_cart_items);
      $this->load->view('frontend/default/cart_items');
    }
    
    public function refreshWishList() {
      $this->load->view('frontend/default/wishlist_items');
    }
    
    public function refreshShoppingCart() {
      $this->load->view('frontend/default/shopping_cart_inner_view');
    }
    
    public function isLoggedIn() {
      if ($this->session->userdata('user_login') == 1)
      echo true;
      else
      echo false;
    }
    
    public function paypal_checkout() {
      if ($this->session->userdata('user_login') != 1)
      redirect('home', 'refresh');
      
      $total_price_of_checking_out  = $this->input->post('total_price_of_checking_out');
      $page_data['user_details']    = $this->user_model->get_user($this->session->userdata('user_id'))->row_array();
      $page_data['amount_to_pay']   = $total_price_of_checking_out;
      $this->load->view('frontend/default/paypal_checkout', $page_data);
    }
    
    public function stripe_checkout() {
      if ($this->session->userdata('user_login') != 1)
      redirect('home', 'refresh');
      
      $total_price_of_checking_out  = $this->input->post('total_price_of_checking_out');
      $page_data['user_details']    = $this->user_model->get_user($this->session->userdata('user_id'))->row_array();
      $page_data['amount_to_pay']   = $total_price_of_checking_out;
      $this->load->view('frontend/default/stripe_checkout', $page_data);
    }
    
    public function payment_success($method = "") {
      $posted_data = $this->input->post();
      $amount_paid = $posted_data['total_amount'];
      
      $coupon_amount = $posted_data['coupon_amount'];
      $coupon_code = $posted_data['coupon_code'];
      $user_id = $this->session->userdata('user_id');
      $sub_category_id = $this->session->userdata('subcategory_id');
      $enroll_id = $this->crud_model->enroll_student($user_id, $sub_category_id);
      $this->crud_model->quiz_purchase($user_id, $method, $amount_paid, $sub_category_id, $coupon_amount, $coupon_code, $enroll_id); 
      $this->crud_model->update_enroll_status($user_id);
      $this->session->unset_userdata('subcategory_id');
      //$this->session->set_flashdata('flash_message', get_phrase('payment_successfully_done'));
      redirect('home', 'refresh');
      
      if ($method == 'stripe') {
        redirect('home', 'refresh');
      }
    }
    
    public function lesson($slug = "", $course_id = "", $lesson_id = "") {
      if ($this->session->userdata('user_login') != 1){
        if ($this->session->userdata('admin_login') != 1){
          redirect('home', 'refresh');
        }
      }
      $course_details = $this->crud_model->get_course_by_id($course_id)->row_array();
      $page_data['course_id']  = $course_id;
      $page_data['page_name']  = 'my_course_details';
      $page_data['page_title'] = $course_details['title'];
      $page_data['sections']   = json_decode($course_details['section']);
      if (sizeof($page_data['sections']) > 0) {
        if ($lesson_id == "") {
          $default_lesson_details = $this->crud_model->get_default_lesson($page_data['sections'][0])->row_array();
          $page_data['lesson_id']  = $default_lesson_details['id'];
          }else {
          $page_data['lesson_id']  = $lesson_id;
        }
        }else {
        $page_data['page_name'] = 'blank_page';
        $page_data['page_title'] = get_phrase('blank_page');
        $page_data['page_body'] = get_phrase('no_section_found');
      }
      
      $this->load->view('frontend/default/index', $page_data);
    }
    
    public function my_courses_by_category() {
      $category_id = $this->input->post('category_id');
      $course_details = $this->crud_model->get_my_courses_by_category_id($category_id)->result_array();
      $page_data['my_courses'] = $course_details;
      $this->load->view('frontend/default/reload_my_courses', $page_data);
    }
    
    public function get_courses_by_search_string($search_string = "") {
      if (isset($_POST['search_string'])) {
        $search_string = $this->input->post('search_string');
        redirect(site_url('home/get_courses_by_search_string/'.$search_string), 'refresh');
      }
      $page_data['courses'] = $this->crud_model->get_courses_by_search_string($search_string);
      $page_data['page_name'] = 'course_search_page';
      $page_data['search_string'] = $search_string;
      $page_data['page_title'] = get_phrase('search_results');
      $this->load->view('frontend/default/index', $page_data);
    }
    public function my_courses_by_search_string() {
      $search_string = $this->input->post('search_string');
      $course_details = $this->crud_model->get_my_courses_by_search_string($search_string)->result_array();
      $page_data['my_courses'] = $course_details;
      $this->load->view('frontend/default/reload_my_courses', $page_data);
    }
    
    public function get_my_wishlists_by_search_string() {
      $search_string = $this->input->post('search_string');
      $course_details = $this->crud_model->get_courses_of_wishlists_by_search_string($search_string);
      $page_data['my_courses'] = $course_details;
      $this->load->view('frontend/default/reload_my_wishlists', $page_data);
    }
    
    public function reload_my_wishlists() {
      $my_courses = $this->crud_model->get_courses_by_wishlists();
      $page_data['my_courses'] = $my_courses;
      $this->load->view('frontend/default/reload_my_wishlists', $page_data);
    }
    
    public function get_course_details() {
      $course_id = $this->input->post('course_id');
      $course_details = $this->crud_model->get_course_by_id($course_id)->row_array();
      echo $course_details['title'];
    }
    
    public function rate_course() {
      $data['review'] = $this->input->post('review');
      $data['ratable_id'] = $this->input->post('course_id');
      $data['ratable_type'] = 'course';
      $data['rating'] = $this->input->post('starRating');
      $data['date_added'] = strtotime(date('D, d-M-Y'));
      $data['user_id'] = $this->session->userdata('user_id');
      $this->crud_model->rate($data);
    }
    
    public function refund_policy() {
      $page_data['page_name'] = 'refund_policy';
      $page_data['page_title'] = get_phrase('refund_policy');
      $this->load->view('frontend/default/index', $page_data);
    }
    
    public function terms_and_condition() {
      $page_data['page_name'] = 'terms_and_condition';
      $page_data['page_title'] = get_phrase('terms_and_condition');
      $this->load->view('frontend/default/index', $page_data);
    }
    
    public function privacy_policy() {
      $page_data['page_name'] = 'privacy_policy';
      $page_data['page_title'] = get_phrase('privacy_policy');
      $this->load->view('frontend/default/index', $page_data);
    }
    
    
    // Version 1.1
    public function dashboard($param1 = "") {
      if ($this->session->userdata('user_login') != 1){
        redirect('home', 'refresh');
      }
      
      if ($param1 == "") {
        $page_data['type'] = 'active';
        }else {
        $page_data['type'] = $param1;
      }
      
      $page_data['page_name']  = 'instructor_dashboard';
      $page_data['page_title'] = get_phrase('instructor_dashboard');
      $page_data['user_id']    = $this->session->userdata('user_id');
      $this->load->view('frontend/default/index', $page_data);
    }

    public function user($param1 = "") {
      if ($this->session->userdata('user_login') != 1){
        redirect('home', 'refresh');
      } 
      $this->session->set_userdata('last_page', 'user'); 
      $page_data['page_name']  = 'dashboard';
      $page_data['page_title'] = get_phrase('dashboard');
      $page_data['user_id']    = $this->session->userdata('user_id');
      $page_data['my_exams'] = $this->crud_model->get_myenroll_exams($this->session->userdata('user_id'))->num_rows();
      $page_data['exams'] = $this->crud_model->getAllGivenExams($this->session->userdata('user_id'))->num_rows();
      $result = $this->crud_model->getReferralDetails($this->session->userdata('user_id'));
      $page_data['referrals'] = count($result);
      $page_data['user_details'] = $this->user_model->get_user($this->session->userdata('user_id'));
      $this->load->view('frontend/user/index', $page_data);
    }
    
    public function create_course() {
      if ($this->session->userdata('user_login') != 1){
        redirect('home', 'refresh');
      }
      
      $page_data['page_name'] = 'create_course';
      $page_data['page_title'] = get_phrase('create_course');
      $this->load->view('frontend/default/index', $page_data);
    }
    
    public function edit_course($param1 = "", $param2 = "") {
      if ($this->session->userdata('user_login') != 1){
        redirect('home', 'refresh');
      }
      
      if ($param2 == "") {
        $page_data['type']   = 'edit_course';
        }else {
        $page_data['type']   = $param2;
      }
      $page_data['page_name']  = 'manage_course_details';
      $page_data['course_id']  = $param1;
      $page_data['page_title'] = get_phrase('edit_course');
      $this->load->view('frontend/default/index', $page_data);
    }
    
    public function course_action($param1 = "", $param2 = "") {
      if ($this->session->userdata('user_login') != 1){
        redirect('home', 'refresh');
      }
      
      if ($param1 == 'create') {
        if (isset($_POST['create_course'])) {
          $this->crud_model->add_course();
          redirect(site_url('home/create_course'), 'refresh');
          }else {
          $this->crud_model->add_course('save_to_draft');
          redirect(site_url('home/create_course'), 'refresh');
        }
        }elseif ($param1 == 'edit') {
        if (isset($_POST['publish'])) {
          $this->crud_model->update_course($param2, 'publish');
          redirect(site_url('home/dashboard'), 'refresh');
          }else {
          $this->crud_model->update_course($param2, 'save_to_draft');
          redirect(site_url('home/dashboard'), 'refresh');
        }
      }
    }
    
    
    public function sections($action = "", $course_id = "", $section_id = "") {
      if ($this->session->userdata('user_login') != 1){
        redirect('home', 'refresh');
      }
      
      if ($action == "add") {
        $this->crud_model->add_section($course_id);
        
        }elseif ($action == "edit") {
        $this->crud_model->edit_section($section_id);
        
        }elseif ($action == "delete") {
        $this->crud_model->delete_section($course_id, $section_id);
        $this->session->set_flashdata('flash_message', get_phrase('section_deleted'));
        redirect(site_url("home/edit_course/$course_id/manage_section"), 'refresh');
        
        }elseif ($action == "serialize_section") {
        $container = array();
        $serialization = json_decode($this->input->post('updatedSerialization'));
        foreach ($serialization as $key) {
          array_push($container, $key->id);
        }
        $json = json_encode($container);
        $this->crud_model->serialize_section($course_id, $json);
      }
      $page_data['course_id'] = $course_id;
      $page_data['course_details'] = $this->crud_model->get_course_by_id($course_id)->row_array();
      return $this->load->view('frontend/default/reload_section', $page_data);
    }
    
    public function manage_lessons($action = "", $course_id = "", $lesson_id = "") {
      if ($this->session->userdata('user_login') != 1){
        redirect('home', 'refresh');
      }
      if ($action == 'add') {
        $this->crud_model->add_lesson();
        $this->session->set_flashdata('flash_message', get_phrase('lesson_added'));
      }
      elseif ($action == 'edit') {
        $this->crud_model->edit_lesson($lesson_id);
        $this->session->set_flashdata('flash_message', get_phrase('lesson_updated'));
      }
      elseif ($action == 'delete') {
        $this->crud_model->delete_lesson($lesson_id);
        $this->session->set_flashdata('flash_message', get_phrase('lesson_deleted'));
      }
      redirect('home/edit_course/'.$course_id.'/manage_lesson');
    }
    
    public function lesson_editing_form($lesson_id = "", $course_id = "") {
      if ($this->session->userdata('user_login') != 1){
        redirect('home', 'refresh');
      }
      $page_data['type']      = 'manage_lesson';
      $page_data['course_id'] = $course_id;
      $page_data['lesson_id'] = $lesson_id;
      $page_data['page_name']  = 'lesson_edit';
      $page_data['page_title'] = get_phrase('update_lesson');
      $this->load->view('frontend/default/index', $page_data);
    }
    
    public function download($filename = "") {
      $tmp           = explode('.', $filename);
      $fileExtension = strtolower(end($tmp));
      $yourFile = base_url().'uploads/lesson_files/'.$filename;
      $file = @fopen($yourFile, "rb");
      
      header('Content-Description: File Transfer');
      header('Content-Type: text/plain');
      header('Content-Disposition: attachment; filename='.$filename);
      header('Expires: 0');
      header('Cache-Control: must-revalidate');
      header('Pragma: public');
      header('Content-Length: ' . filesize($yourFile));
      while (!feof($file)) {
        print(@fread($file, 1024 * 8));
        ob_flush();
        flush();
      }
    }
    
    // Version 1.3 codes
    public function get_enrolled_to_free_course($course_id) {
      $this->crud_model->enroll_to_free_course($course_id, $this->session->userdata('user_id'));
      redirect(site_url('home/my_courses'), 'refresh');
    }
    
    // Code started By Khushboo
    
    public function pages($param1='') {
      $this->session->set_userdata('last_page', $param1);
      $page_data['data'] = $this->crud_model->get_pages('', htmlspecialchars($param1))->row_array();
      // echo '<pre>';
      // var_dump($page_data); exit;
      $page_data['sliders'] = $this->crud_model->getResultData('photos', array('status'=>1, 'type'=>'pages_slider','page_name'=>$param1));
      $page_data['page_name'] = 'pages';
      $page_data['page_title'] = get_phrase($page_data['data']['title']); 
      $this->load->view('frontend/default/index', $page_data);
    }
    public function my_exam(){
      if ($this->session->userdata('user_login') != 1){
        redirect('home', 'refresh');
      }
      $this->session->set_userdata('last_page', 'my_exam'); 
      $page_data['my_exams'] = $this->crud_model->get_enroll_exams($this->session->userdata('user_id'))->result_array();
      $page_data['page_name'] = "my_exam";
      $page_data['page_title'] = get_phrase("my_quiz");
      $this->load->view('frontend/user/index', $page_data);
    }
    
    public function my_quiz($param1=''){
      if ($this->session->userdata('user_login') != 1){
        redirect('home', 'refresh');
      }
      $this->session->set_userdata('last_page', 'my_exam'); 
      $page_data['quiz']= $this->crud_model->getQuiz($param1, $this->session->userdata('user_id'));
      
      if($page_data['quiz'] == false)
      {
        $this->my_quiz($param1);
      }
      else
      {
        if($page_data['quiz']['quiz_id']!="")
        redirect(site_url('home/getResult/'.$page_data['quiz']['quiz_id']), 'refresh');
        
        if($this->input->post(null,true))
        { 
          $page_data['questions']= $this->crud_model->getQuizQuestions($page_data['quiz']['question_ids']);
          $page_data['page_name'] = "quiz";
          $page_data['page_title'] = $page_data['quiz']['name'];
          
        }
        else
        {
          $page_data['instruction'] = $this->crud_model->getQuizInstructions($param1);
          $page_data['page_name'] = "general_instructions";
          $page_data['page_title'] = $page_data['quiz']['name'];
          
        }
        
        $this->load->view('frontend/default/index', $page_data);    
      }
      
    }
    
    public function result(){
      if ($this->session->userdata('user_login') != 1){
        redirect('home', 'refresh');
      }
      // print_r($this->input->post());
      // exit();
      
      $this->crud_model->save_result($this->session->userdata('user_id'));
      
      $quiz_id = html_escape($this->input->post('quiz_id'));
      $page_data['page_name'] = 'submit_message';
      $page_data['page_title'] = 'Submit message';
      $page_data['quiz_id'] = $quiz_id;
      $this->load->view('frontend/default/index', $page_data);  
      // redirect(site_url('home/getResult/'.$quiz_id), 'refresh');
    }
    
    public function getResult($param1=""){
      if ($this->session->userdata('user_login') != 1){
        redirect('home', 'refresh');
      }
      $quiz_id = $param1;
      $page_data['page_name'] = "result";
      $page_data['page_title'] = "Your Result";
      $page_data['result'] = $this->crud_model->getResult($quiz_id, $this->session->userdata('user_id'))->result_array();
      $this->load->view('frontend/default/index', $page_data);
    }

    public function getDoc() {
      $studymaterial = $this->Master_model->get_docs('', array('tr_doc.subject_id'=>$this->input->post('subject_id'), 'tr_doc.status'=>1), 1)->row_array();
      echo (isset($studymaterial['file']) ? trim(base_url() . 'uploads/doc/' . $studymaterial['file']) : '');
    }
    
    public function previousExams(){
      if ($this->session->userdata('user_login') != 1){
        redirect('home', 'refresh');
      }
      $this->session->set_userdata('last_page', 'previousExams'); 
      $page_data['exams'] = $this->crud_model->getAllGivenExams($this->session->userdata('user_id'));
      // print_r($page_data);
      // exit();
      $page_data['page_name'] = "previous_exams";
      $page_data['page_title'] = "Previous Quizzes";
      $page_data['subCategories'] = $this->crud_model->get_sub_categories()->result_array();
      $this->load->view('frontend/user/index', $page_data);
    }
    
    public function paymentRegistration($param1="") {
      $this->session->set_userdata('last_page', 'paymentReg');
      $this->session->set_userdata('subcategory_id', $param1);
      $page_data['page_name'] = "paymentReg";
      $page_data['page_title'] = get_phrase("payment_checkout");
      $this->load->view('frontend/default/index', $page_data);
    }
    
    public function checkout($param1=""){
      if ($this->session->userdata('user_login') != 1){
        redirect('home', 'refresh');
      }
      $this->session->set_userdata('subcategory_id', $param1);
      $page_data['page_name'] = "checkout_new";
      $page_data['page_title'] = "checkout";
      $data = $this->crud_model->get_category_details_by_id($param1)->row_array();
      if($data['disabled']==1) {
        redirect('home', 'refresh');
      }
      $page_data['subcategory'] = $data;
      if($data['price'] > 0 ) {
        $this->load->view('frontend/default/index', $page_data);
      } else {
        header('Location:'. base_url(). 'checkout/free');
      } 
    }
    
    public function faqs(){
      $this->session->set_userdata('last_page', 'faqs');
      $page_data['page_name'] = "faqs";
      $page_data['page_title'] = "Frequently asked question";
      $page_data['faqs'] = $this->crud_model->getResultData('faq');
      $this->load->view('frontend/default/index', $page_data);
    }
    
    public function photogallery(){
      $this->session->set_userdata('last_page', 'photogallery');
      $page_data['page_name'] = "photogallery";
      $page_data['page_title'] = "Photo Gallery";
      $page_data['galleries'] = $this->crud_model->gallery('gallery', 0, 8);
      $this->load->view('frontend/default/index', $page_data);
    }
    
    public function ajax_get_gallery($param1='') {
      $page_data['galleries'] = $this->crud_model->gallery('gallery', $param1, 8);
      $total_rows = $page_data['galleries']->num_rows();
      $page_data['start'] = ($param1 + 8);
      if($total_rows != 0){
        return $this->load->view('frontend/default/ajax_get_gallery', $page_data);
        }else{
        return 0;
      }
    }
    
    public function my_enroll() {
      if ($this->session->userdata('user_login') != true) {
        redirect(site_url('home'), 'refresh');
      }
      $this->session->set_userdata('last_page', 'my_enroll'); 
      $page_data['page_name'] = "my_enroll";
      $page_data['page_title'] = get_phrase("enrolled_quiz");
      $page_data['my_exams'] = $this->crud_model->get_myenroll_exams($this->session->userdata('user_id'))->result_array();
      $this->load->view('frontend/user/index', $page_data);
    }
    
    public function my_referral(){
      if ($this->session->userdata('user_login') != true) {
        redirect(site_url('home'), 'refresh');
      }
      $this->session->set_userdata('last_page', 'my_referral'); 
      $result = $this->crud_model->getReferralDetails($this->session->userdata('user_id'));
      $total_rows = count($result);
      $config = array();
      $config = pagintaion($total_rows, 3);
      $config['base_url']  = site_url('home/my_referral');
      $this->pagination->initialize($config);
      $page_data['per_page']   = $config['per_page'];
      $page_data['page_name']  = "my_referral";
      $page_data['page_title'] = get_phrase('my_referral');
      $page_data['referrals'] = $result;
      $page_data['total_rows'] = $total_rows;
      $this->load->view('frontend/user/index', $page_data);
    }
    
    public function discount($param1=''){
      if ($this->session->userdata('user_login') != true) {
        redirect(site_url('home'), 'refresh');
      }
      $coupon = $this->crud_model->getRow('coupon_codes', array('code'=>$this->input->post('code'), 'status'=>1));
      echo json_encode($coupon);
      
    }
    
    public function contact_us_form(){
      $msg = $this->input->post('message');
      $from = $this->input->post('email');
      $name = $this->input->post('name');
      $number = $this->input->post('number');
      $message = "Name: ".$name."<br/>";
      $message .= "Email: ".$from."<br/>";
      $message .= "Phone Number: ".$number."<br/>";
      $message .= "Message: ".$msg;
      $this->email_model->send_contact_email($message, $from);
      $this->session->set_flashdata('flash_message', get_phrase('message_sent!'));
      redirect(site_url('home/pages/contact_us'), 'refresh');
    }
    
    public function action()
    {
      //$this->load->model("excel_export_model");
      $this->load->library("excel");
      $object = new PHPExcel();
      
      $object->setActiveSheetIndex(0);
      
      $table_columns = array("Name", "Address", "Gender", "Designation", "Age");
      
      $column = 0;
      
      foreach($table_columns as $field)
      {
        $object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
        $column++;
      }
      
      //$employee_data = $this->excel_export_model->fetch_data();
      
      $excel_row = 2;
      $objWriter = PHPExcel_IOFactory::createWriter($object, 'Excel5');
      //readfile($objWriter);
      $objWriter->save('php://output');
      //$objWriter->save("uploads/".gmdate('D, d M Y H:i:s')."fileName.xls");
      $objWriter->save("uploads/fileName.xls");
      //$this->load->helper('download');
      $data = file_get_contents("http://quizart.co.in/uploads/fileName.xls"); // Read the file's contents
      force_download("fileName.xls", $data); 
      //readfile("http://quizart.co.in/uploads/fileName.xls"); 
      exit();
    }
    
    public function razorpay($param1=''){  
      $user = $this->crud_model->get_enroll_user($param1, '', '', 1); 
      if(isset($user[0]) && isset($user[0]->id)) { 
        $this->session->set_userdata('order_id', $user[0]->id);
        if($user[0]->price > 0) {
          $api = new RazorpayApi(RAZOR_KEY_ID, RAZOR_KEY_SECRET); 
          $orderData = [
            'receipt'         => $user[0]->id,
            'amount'          => (isset($user[0]->price) ? ($user[0]->price*100) : 0), // 2000 rupees in paise
            'currency'        => 'INR',
            'payment_capture' => 1 // auto capture
          ];
          $razorpayOrder = $api->order->create($orderData); 
        }   
        $page_data['page_name']  = "razorpay";
        $page_data['page_title'] = get_phrase('razorpay');
        $page_data['order'] = (isset($razorpayOrder) && !empty($razorpayOrder) ? $razorpayOrder : array());
        $datas = array('order_id'=>(isset($razorpayOrder['id']) ? $razorpayOrder['id'] : null));
        $this->crud_model->update_enroll_user($datas, $user[0]->id);
        $page_data['quizdata'] = $user[0];
        $this->load->view('frontend/default/index', $page_data);
      } else {
        $this->session->set_flashdata('error_message', get_phrase('some_error_occured'));
        redirect(site_url('home'), 'refresh');
      }
    }
    
    public function successpage($param1='', $param2=''){ 
      if($param1=='add') {
        $userdata = $this->crud_model->get_enroll_user($param2); 
        if(($userdata[0]->order_id==$this->input->post('order_id')) && $userdata[0]->price > 0) {
          $data = array(
            'payment_id' => $this->input->post('payment_id'),
            'payment_signature' => $this->input->post('payment_id'),
            'status' => 'completed',
            'payment_date' => date('Y-m-d H:i:s')
          );
          $this->crud_model->update_enroll_user($data, $userdata[0]->id);
          $this->email_model->send_payment_verification_mail($userdata[0], $this->input->post('payment_id'));
          $this->session->set_flashdata('flash_message', get_phrase('payment_successfull'));
        } elseif($userdata[0]->price == 0) {
          $data = array(
            'payment_id' => null,
            'payment_signature' => null,
            'status' => 'completed',
            'payment_date' => date('Y-m-d H:i:s')
          );
          $this->crud_model->update_enroll_user($data, $userdata[0]->id); 
          $this->session->set_flashdata('flash_message', get_phrase('enroll_successfully'));
        } else {
          $this->session->set_flashdata('error_message', get_phrase('some_error_occured'));
        }
        header("Location:" . site_url('home/successpage/'. $param2));
      } 
      $userdata = $this->crud_model->get_enroll_user($param1);
      $page_data['page_name']  = "successpage";
      $page_data['page_title'] = get_phrase('successpage'); 
      $page_data['userdata'] = $userdata[0];
      $this->load->view('frontend/default/index', $page_data);
    }

    public function enrolluser(){ 
      $page_data['page_name']  = "enrolluser";
      $page_data['page_title'] = get_phrase('enroll_user');
      $page_data['razorpay_payment_id'] = $this->input->post('razorpay_payment_id');
      $page_data['razorpay_order_id'] = $this->input->post('razorpay_order_id');
      $this->load->view('frontend/default/index', $page_data);
    }

    public function add_enrolluser($param1='') {
      $data = $this->crud_model->add_enroll_user($param1);
      if($data) { 
        redirect(site_url('home/razorpay/' . $data), 'refresh');
      } else {
        redirect(site_url('home'), 'refresh');
      }
    }

    public function highlightquiz($param1=''){  
      $page_data['page_name']  = "razorpay";
      $page_data['page_title'] = get_phrase('razorpay');
      $data = $this->crud_model->highlight_quiz_front($param1, 1);
      //print_r(); die();
      $page_data['quizdata'] = $data[0];
      $this->load->view('frontend/default/index', $page_data);
    }

    public function termcondition($value='')
    {   
      $page_data['page_name'] = 'termcondition';
      $page_data['page_title'] = 'termcondition';
      $this->load->view('frontend/default/index', $page_data);  
    }

    public function takebackup(){
      $this->crud_model->databaseBackup();
      $this->crud_model->projectBackup();
      $this->email_model->send_backup();
      echo "done";
    }

    public function contributor($param1=''){ 
      if($param1=='premium') { 
        $page_data['page_name'] = 'contributor_premium';
        $page_data['page_title'] = 'Premium Contributor';
      } else {
        $page_data['page_name'] = 'contributor_free';
        $page_data['page_title'] = 'Free Contributor';
      }
      $this->load->view('frontend/default/index', $page_data); 
    } 
  }
