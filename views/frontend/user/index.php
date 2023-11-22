<?php
    $system_name = $this->db->get_where('settings' , array('key'=>'system_name'))->row()->value;
    $system_title = $this->db->get_where('settings' , array('key'=>'system_title'))->row()->value;
    $user_details = $this->user_model->get_all_user($this->session->userdata('user_id'))->row_array();
    $text_align     = $this->db->get_where('settings', array('key' => 'text_align'))->row()->value;
    $logged_in_user_role = strtolower($this->session->userdata('role'));
?>
<!DOCTYPE html>
<html lang="en" dir="<?php if ($text_align == 'right-to-left') echo 'rtl'; ?>">
  <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    
    
    <title><?php echo $system_title; ?> | <?php echo get_phrase($page_title); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta content="" name="description" />
    <meta content="" name="author" />
    <link name="favicon" type="image/x-icon" href="<?php echo base_url().'assets/favicon.png' ?>" rel="shortcut icon" />
    <!-- BEGIN PLUGIN CSS -->
    <?php include 'includes_top.php'; ?>
    
    <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-175809190-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-175809190-1');
</script>

  </head>
  <!-- END HEAD -->
<body class="page-body" data-url="http://neon.dev">
    <!-- BEGIN CONTAINER -->
    <div class="page-container">
        <?php include 'navigation.php' ?>
        <div class="main-content">
			<?php include 'header.php';?>

			<?php include $page_name.'.php';?>
            <?php include 'footer.php';?>
		</div>
    </div>
</body>
<?php include 'includes_bottom.php'; ?>
<?php include 'modal.php';?>
</html>