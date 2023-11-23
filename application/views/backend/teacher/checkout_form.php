<!doctype HTML>
<html>
  <head>
    <title>Payment | <?php echo get_settings('system_name'); ?></title>
  </head>
  <script src="<?php echo base_url('assets/backend/js/jquery-1.11.0.min.js'); ?>"></script>
  <link rel="stylesheet" href="<?php echo base_url().'assets/frontend/css/bootstrap.min.css'; ?>">
  <link rel="stylesheet" href="<?php echo base_url().'assets/frontend/css/fontawesome-all.min.css'; ?>">
  <body> 
    <form method="POST" action="https://api.razorpay.com/v1/checkout/embedded" id="redirectForm" align="centre" style="text-align: center;">  
      <input type="hidden" name="key_id" value="<?php echo RAZOR_KEY_ID; ?>">  
      <input type="hidden" name="order_id" value="<?php echo $order['id'];?>">  
      <input type="hidden" name="name" value="<?php echo get_settings('system_name'); ?>">  
      <input type="hidden" name="description" value="A Wild Sheep Chase">  
      <input type="hidden" name="image" value="<?php echo base_url().'assets/frontend/img/logo.png'; ?>">  
      <input type="hidden" name="prefill[name]" value="<?php echo (isset($customerName) ? ($customerName) : '0'); ?>">  
      <?php if($customerPhone) { ?>
        <input type="hidden" name="prefill[contact]" value="<?php echo (isset($customerPhone) ? $customerPhone : '0'); ?>">  
      <?php } ?>
      <input type="hidden" name="prefill[email]" value="<?php echo (isset($customerEmail) ? $customerEmail : '0'); ?>"> 
      <input type="hidden" name="callback_url" value="<?php echo $returnUrl;?>">
      <input type="hidden" name="cancel_url" value="<?php echo $notifyUrl;?>"> 
      <i class="fa fa-spinner fa-6 fa-spin" aria-hidden="true"></i>
    </form>
    <script>
      setTimeout(document.getElementById("redirectForm").submit(), 3000);    
    </script> 
  </body>
</html>