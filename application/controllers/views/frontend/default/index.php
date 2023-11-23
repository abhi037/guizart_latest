
<!DOCTYPE html>
<html lang="en">
<head>

	<?php if ($page_name == 'course_page'):
		$title = $this->crud_model->get_course_by_id($course_id)->row_array()?>
		<title><?php echo $title['title'].' | '.get_settings('system_name'); ?></title>
	<?php else: ?>
		<title><?php echo ucwords($page_title).' | '.get_settings('system_name'); ?></title>
	<?php endif; ?>


	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="author" content="<?php echo get_settings('author') ?>" />

	<?php
	$seo_pages = array('course_page');
	if (in_array($page_name, $seo_pages)):
	$course_details = $this->crud_model->get_course_by_id($course_id)->row_array();?>
		<meta name="keywords" content="<?php echo $course_details['meta_keywords']; ?>"/>
		<meta name="description" content="<?php echo $course_details['meta_description']; ?>" />
	<?php else: ?>
		<meta name="keywords" content="<?php echo get_settings('website_keywords'); ?>"/>
		<meta name="description" content="<?php echo get_settings('website_description'); ?>" />
	<?php endif; ?>

	<link name="favicon" type="image/x-icon" href="<?php echo base_url().'assets/favicon.png' ?>" rel="shortcut icon" />
	<?php include 'includes_top.php';?>

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-175809190-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-175809190-1');
</script>

</head>
<body>
	<?php
	if ($this->session->userdata('user_login')) {
		include 'logged_in_header.php';
	}else {
		include 'logged_out_header.php';
	}
	
	if(isset($hightligt_quiz[0])) {  ?>

    <marquee style="font-family: serif;font-size: 15px;margin: 2px 0px -4px 0px;background-color: #222222;color: #fff;font-weight: bold;" scrolldelay="50" behavior="alternate" direction="left" onmouseover="this.stop()" onmouseout="this.start()" scrollamount="2"> 
    		<strong><?php echo isset($hightligt_quiz[0]->title) ? $hightligt_quiz[0]->title : '' ?></strong>
    		<!-- <br />
    		<img src="<?php echo  base_url() . 'uploads/thumbnails/quiz_thumbnails/'. (isset($hightligt_quiz[0]->file) ? $hightligt_quiz[0]->file : '') ?>" > 
    		<br /> -->
    		<strong>
    		  <font color="red">
    		  	<?php if($hightligt_quiz[0]->price=='0' || $hightligt_quiz[0]->price=='0.00') { ?>
    		  		<a style="color: #4687f7" href="<?php echo site_url('home/highlightquiz/' . (isset($hightligt_quiz[0]->id) ? md5($hightligt_quiz[0]->id) : "")); ?>">Enroll Now..!!</a>
  		  		<?php } else {?>
  		  			<a data-toggle="modal" data-target="#EnrollUpModel" style="color: #4687f7" href="#">Enroll Now..!!</a>
  		  		<?php } ?> 
    		  </font>
    	  </strong> 
    </marquee>
	<?php } ?>
	
	<?php
	include $page_name.'.php';
	include 'footer.php';
	include 'includes_bottom.php';
	include 'modal.php';
	?>
</body>
</html>
