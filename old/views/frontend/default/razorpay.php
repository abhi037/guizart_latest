<center>   
  <h3><?php echo (isset($quizdata->title) ? $quizdata->title : 'No title'); ?></h3>
  <img src="<?php echo  base_url(). 'uploads/thumbnails/quiz_thumbnails/' . (isset($quizdata->file) ? $quizdata->file : '') ?>" style="width:50%" />
  <p><?php echo (isset($quizdata->description) ? html_entity_decode($quizdata->description) : ''); ?></p>
  <br/>
  <?php if(isset($quizdata->price) && $quizdata->price > 0) { ?>
    <label>
      <input type="radio" name="checkout" value="1" id="checkout" style="margin-top:10px"> 
      <a href="<?php echo site_url('home/termcondition'); ?>" target="_blank"> I accept terms & conditions </a>
    </label>
    <br>
    <button id="rzp-button1" class="btn btn-primary">Pay</button>
  <?php } else { ?>
    <!-- <a href="<?php echo site_url('home/successpage/add/' . md5((isset($quizdata->id) ? $quizdata->id : '')));?>" class="btn btn-primary"> Enroll </a> -->
  <?php } ?>
  <form action="<?php echo site_url('home/successpage/add/' . md5((isset($quizdata->id) ? $quizdata->id : ''))); ?>" method="POST" name="razorpayform">
    <input type="hidden" name="payment_id" id="payment_id" />
    <input type="hidden" name="signature" id="signature"/>
    <input type="hidden" name="order_id" id="order_id"/> 
  </form> 

  <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
  <script>
    var options = {
        "key": "<?php echo RAZOR_KEY_ID; ?>", // Enter the Key ID generated from the Dashboard
        "amount": "<?php echo (isset($quizdata->price) ? ($quizdata->price*100) : '0'); ?>", // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise
        "currency": "INR",
        "name": "<?php echo (isset($quizdata->first_name) ? ($quizdata->first_name .' '. $quizdata->last_name) : '0'); ?>",
        "description": "<?php echo (isset($quizdata->description) ? ($quizdata->description) : '0'); ?>",
        "image": "<?php echo  base_url(). 'uploads/thumbnails/quiz_thumbnails/' . (isset($quizdata->file) ? $quizdata->file : '') ?>",
        "order_id": "<?php echo $order['id'];?>", //This is a sample Order ID. Pass the `id` obtained in the response of Step 1
        "handler": function (response){
            document.getElementById('payment_id').value = response.razorpay_payment_id;
            document.getElementById('signature').value = response.razorpay_signature;
            document.getElementById('order_id').value = response.razorpay_order_id; 
            document.razorpayform.submit();
            $('#rzp-button1').attr('disable');
        },
        "prefill": {
            "name": "<?php echo (isset($quizdata->first_name) ? ($quizdata->first_name .' '. $quizdata->last_name) : '0'); ?>",
            "email": "<?php echo (isset($quizdata->email) ? $quizdata->email : '0'); ?>",
            "contact": "<?php echo (isset($quizdata->mobile) ? $quizdata->mobile : '0'); ?>"
        }, 
        "theme": {
            "color": "#F37254"
        }
    };
    var rzp1 = new Razorpay(options);
    $(document).ready(function(){ 

      document.getElementById('rzp-button1').onclick = function(e){
        if($('#checkout').prop("checked") == true){
          rzp1.open();
          e.preventDefault();   
        }
      }
    });
  </script>
</center>