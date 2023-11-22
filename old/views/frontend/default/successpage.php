<?php if($userdata->price > 0) {?>
	<center> 
	  <h3>Your payment is successfull.</h3>
	  <p>
	  	Hello, <?php echo (isset($userdata->first_name) ? $userdata->first_name . ' ' . $userdata->last_name : '');?>
	  </p>
	  <p>
	  	Your successful payment id is <?php echo (isset($userdata->payment_id) ? $userdata->payment_id : '');?>
	  </p>
	</center>
<?php } else {?>
	<center> 
	  <h3>Enrolled successfull.</h3>
	  <p>
	  	Hello, <?php echo (isset($userdata->first_name) ? $userdata->first_name . ' ' . $userdata->last_name : '');?>
	  </p>
	  <p>
	  	you are enrolled successfully.
	  </p>
	</center>
<?php } ?>