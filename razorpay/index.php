<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="utf-8">
    <link rel="stylesheet" href="http://yegor256.github.io/tacit/tacit.min.css"/>
</head>
<body>
<center>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <form id="checkout-selection" method="POST" name='razorpayform' action="verify.php">
      <h3>Quiz Art - Registration for MAY 2020 Batch</h3>        
      <input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id">
      <input type="hidden" name="razorpay_signature"  id="razorpay_signature" >
      <img src="https://scholarshipscorner.website/wp-content/uploads/2020/04/Add-a-heading-3-440x264.png" style="width:50%" />
      <br/>
        <input type="radio" name="checkout" value="automatic" style="margin-top:10px">I accept terms & conditions<br>
        <input type="submit" value="Enroll Now" id="rzp-button1" />
    </form>
  </center>
</body>
</html>
<script>
// Checkout details as a json
var options = <?php echo $json?>;

/**
 * The entire list of Checkout fields is available at
 * https://docs.razorpay.com/docs/checkout-form#checkout-fields
 */
options.handler = function (response){
    document.getElementById('razorpay_payment_id').value = response.razorpay_payment_id;
    document.getElementById('razorpay_signature').value = response.razorpay_signature;
    document.razorpayform.submit();
};

// Boolean whether to show image inside a white frame. (default: true)
options.theme.image_padding = false;

options.modal = {
    ondismiss: function() {
        console.log("This code runs when the popup is closed");
    },
    // Boolean indicating whether pressing escape key 
    // should close the checkout form. (default: true)
    escape: true,
    // Boolean indicating whether clicking translucent blank
    // space outside checkout form should close the form. (default: false)
    backdropclose: false
};

var rzp = new Razorpay(options);

document.getElementById('rzp-button1').onclick = function(e){
    rzp.open();
    e.preventDefault();
}
</script>