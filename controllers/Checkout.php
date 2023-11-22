<?php
defined('BASEPATH') OR exit('No direct script access allowed');
  require_once (__DIR__.'/../../assets/razorpay-php/Razorpay.php');
  use Razorpay\Api\Api as RazorpayApi;    
class Checkout extends CI_Controller {
  function payment()
  {
    foreach($this->input->post(null) as $key => $value) {
      $posted[$key] = $value;
    } 
    $orderDetails = array();
    $orderDetails['notifyUrl'] = base_url('/checkout/notifyurl');
    $orderDetails['returnUrl'] = base_url('/checkout/returnurl');

    $userDetails = $this->getUserDetails();
    $order = $this->getOrderDetails();
    
    $orderDetails['customerName'] = $userDetails['customerName'];
    $orderDetails['customerEmail'] = $userDetails['customerEmail'];
    $orderDetails['customerPhone'] = $userDetails['customerPhone'];
    
    $orderDetails['orderId'] = $order['orderId'];
    $posted['orderId'] = $order['orderId'];
    $posted['orderAmount'] = $order['orderAmount'];
    $this->session->set_userdata('posted',$posted); 

    $orderDetails['orderAmount'] = $order['orderAmount'];
    $orderDetails['orderNote'] = $order['orderNote'];
    $orderDetails['orderCurrency'] = $order['orderCurrency'];  
    $api = new RazorpayApi(RAZOR_KEY_ID, RAZOR_KEY_SECRET); 
    $orderData = [
      'receipt'         => $order['orderId'],
      'amount'          => (isset($order['orderAmount']) ? ($order['orderAmount']*100) : 0), // 2000 rupees in paise
      'currency'        => 'INR',
      'payment_capture' => 1 // auto capture
    ];

    $razorpayOrder = $api->order->create($orderData);  
    
    $orderDetails['order'] = $razorpayOrder;
    $cartdata = array('order_id'=>$orderDetails['order']['id']); 
    $this->crud_model->update_cart($cartdata, $order['orderId']);
    $this->load->view('frontend/default/checkout_form',$orderDetails); 
  }

  function free()
  { 
    if ($this->session->userdata('user_login') != 1){
      redirect('home', 'refresh');
    } 
    $data = $this->crud_model->get_category_details_by_id($this->session->userdata('subcategory_id'))->row_array(); 
    $details = $this->crud_model->getenroll_student($this->session->userdata('user_id'), $this->session->userdata('subcategory_id'));
    if($details->num_rows() == 0 && ($data['price'] == 0 || $data['price'] == 0.00)) {
      $enroll_id = $this->crud_model->enroll_student($this->session->userdata('user_id'), $this->session->userdata('subcategory_id')); 
      $method = 'free'; 
      $amount_paid = 0;
      $coupon_amount = 0;
      $coupon_code = null;
      $this->crud_model->quiz_purchase($this->session->userdata('user_id'), $method, $amount_paid, $this->session->userdata('subcategory_id'), $coupon_amount, $coupon_code, $enroll_id);    
    } 
    header('Location:'. base_url(). 'home/my_enroll');
  }

  function trail()
  { 
    if ($this->session->userdata('user_login') != 1){
      redirect('home/paymentRegistration/' . $this->uri->segment(3) . '/trail', 'refresh');
    }  
    $subcategory_id = $this->uri->segment('3') ? $this->uri->segment('3') : $this->session->userdata('subcategory_id'); 
    $data = $this->crud_model->get_category_details_by_id($subcategory_id)->row_array(); 
    $details = $this->crud_model->getenroll_student($this->session->userdata('user_id'), $subcategory_id);
    if($details->num_rows() == 0 && isset($data['id']) && $data['id'] > 0) {
      $enroll_id = $this->crud_model->enroll_student($this->session->userdata('user_id'), $subcategory_id, 'Trial'); 
      if($enroll_id == 0) {
        $this->session->set_flashdata('error_message', get_phrase('trail_not_available_for_you.'));
        header('Location:'. base_url(). 'home');
      }
      $method = 'Trial'; 
      $amount_paid = 0;
      $coupon_amount = 0;
      $coupon_code = null;
      $this->crud_model->quiz_purchase($this->session->userdata('user_id'), $method, $amount_paid, $subcategory_id, $coupon_amount, $coupon_code, $enroll_id);   
      header('Location:'. base_url(). 'home/my_enroll'); 
    } else {
      $this->session->set_flashdata('error_message', get_phrase('trail_not_available_for_you.'));
      header('Location:'. base_url(). 'home');
    }
  }
  
  
  function getUserDetails()
  {
      $query = $this->db->select('*')
              ->from('users')
              ->where('id',$this->session->userdata('user_id'))
              ->get();
      $data = $query->row();
      
      return array('customerName' => $data->first_name.' '.$data->last_name,
      'customerEmail' => $data->email,
      'customerPhone' => $data->contact
      );
      
  }

  function getOrderDetails()
  {
      $amount_for = $this->input->post('amount');
      
      $query = $this->db->select('*')
              ->from('category')
              ->where('id',$this->session->userdata('subcategory_id'))
              ->get();
      $data = $query->row_array();
      
      // return $data;
      $query1 = $this->db->select('*')
                  ->from('coupon_codes')
                  ->where('code',$this->input->post('cupon_code'))
                  ->get();
      $data2 = $query1->row();
      
      $this->session->userdata('coupon_code',$this->input->post('cupon_code'));
      if($query1->num_rows()>0)
      {
        if($data2->discount_amount != 0)
        {
            $amount = $data[$amount_for] - $data2->discount_amount;
            $this->session->set_userdata('coupon_amount',$data2->discount_amount);
            
        }
        else if($data2->discount_percent !=0)
        {
            $coupon_amount = ($data[$amount_for] * $data2->discount_percent)/100;
            $amount = $data[$amount_for] - $coupon_amount;
            $this->session->set_userdata('coupon_amount',$coupon_amount);
        }
        else
        {
             $amount = $data[$amount_for];
        }   
      }
      else
      {
        $amount = $data[$amount_for]; 
      }
      
      $string = $this->crud_model->add_cart($amount, $data[$amount_for]);
      // return $data;
      return array(
        'orderId' => $string,
        'orderAmount'=>$amount,
        'orderNote'=>$data['name'],
        'orderCurrency'=>'INR'
      );
      
  }

  function generateSignature($postData)
  {
      $secretKey = "ea7139aba2a7d6b35a7254805990548c20205644";
        
       // get secret key from your config
       ksort($postData);
       $signatureData = "";
       foreach ($postData as $key => $value){
            $signatureData .= $key.$value;
       }
       $signature = hash_hmac('sha256', $signatureData, $secretKey,true);
       $signature = base64_encode($signature);
       return $signature;
  }
  
  function returnurl()
  {
      if($this->input->post(null))
      { 
          $signature = hash_hmac('sha256', $this->input->post('razorpay_order_id') . "|" . $this->input->post('razorpay_payment_id'), RAZOR_KEY_SECRET); 
          // $orderId = $_POST["orderId"];
          // $orderAmount = $_POST["orderAmount"];
          // $referenceId = $_POST["referenceId"];
          // $txStatus = $_POST["txStatus"];
          // $paymentMode = $_POST["paymentMode"];
          // $txMsg = $_POST["txMsg"];
          // $txTime = $_POST["txTime"];
          // $signature = $_POST["signature"];
          // $data = $orderId.$orderAmount.$referenceId.$txStatus.$paymentMode.$txMsg.$txTime;
          // $secretkey = "ea7139aba2a7d6b35a7254805990548c20205644";
          // $hash_hmac = hash_hmac('sha256', $data, $secretkey, true) ;
          // $computedSignature = base64_encode($hash_hmac); 
          $new_post = $this->input->post(null); 
          $new_post['orderAmount'] = $this->session->userdata('posted')['orderAmount'];
          $new_post['txStatus'] =($signature == $this->input->post('razorpay_signature') && $this->input->post('razorpay_signature')!='' ? 'Success' : 'Failed');
          $this->session->set_userdata('new_post', $new_post); 
          if ($signature == $this->input->post('razorpay_signature') && $this->input->post('razorpay_signature')!='') {
            $user_id = $this->session->userdata('user_id'); 
            $sub_category_id = $this->session->userdata('subcategory_id');
            $cartdata=array(
              'status'=>'Success', 
              'payment_id'=>$this->input->post('razorpay_payment_id'),
              'payment_signature'=>$this->input->post('razorpay_signature')
            );
            $this->crud_model->update_cart($cartdata, $this->session->userdata('posted')['orderId'], $this->input->post('razorpay_order_id'));
            $cart = $this->crud_model->get_cart($this->session->userdata('posted')['orderId'])->row_array();
            
            $enroll_id = $this->crud_model->enroll_student($user_id, $sub_category_id); 
            $method = 'razorpay';
            
            $amount_paid = $cart['paid_amount'];
            $coupon_amount = $this->session->userdata('coupon_amount');
            $coupon_code = $this->session->userdata('coupon_code');
            $this->crud_model->quiz_purchase($user_id, $method, $amount_paid, $sub_category_id, $coupon_amount, $coupon_code, $enroll_id); 
            $this->crud_model->update_enroll_status($user_id);
            
            $this->session->unset_userdata('subcategory_id');
            $this->session->unset_userdata('posted');
            $this->session->unset_userdata('coupon_code');
            $this->session->unset_userdata('coupon_amount');

            redirect('/home/my_enroll');
            if ($method == 'stripe') {
                redirect('/home/my_enroll', 'refresh');
            }
          }
          else
          { 
            $cartdata=array(
              'status'=>'Failed'
            );
            $this->crud_model->update_cart($cartdata, $this->session->userdata('posted')['orderId']);
            $this->session->set_flashdata('error_message', get_phrase('payment_failed'));
            redirect('/home/my_enroll');
          } 
      }
      
  }
  
  function notifyurl()
  {
     print_r($this->input->post()); 
  }
    
}