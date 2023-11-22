<?php
  $status_wise_courses = $this->crud_model->get_status_wise_courses();
?>
<div class="sidebar-menu">
    <header class="logo-env"><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
      <!-- logo -->
      <div class="logo">
        <a href="<?php echo site_url('home/user'); ?>">
          <img src="<?php echo base_url().'assets/backend/logo.png'; ?>" width="120" alt="" />
        </a>
      </div>
    
      <!-- logo collapse icon -->
      <div class="sidebar-collapse">
        <a href="#" class="sidebar-collapse-icon"><!-- add class "with-animation" if you want sidebar to have animation during expanding/collapsing transition -->
          <i class="entypo-menu"></i>
        </a>
      </div>
    
      <!-- open/close menu icon (do not remove if you want to enable menu on mobile devices) -->
      <div class="sidebar-mobile-menu visible-xs">
        <a href="#" class="with-animation"><!-- add class "with-animation" to support animation -->
          <i class="entypo-menu"></i>
        </a>
      </div>
    
    </header>
    
    <ul id="main-menu" class=""> 
      <li class="<?php echo is_active('user'); ?>">
        <a href="<?php echo site_url('home/user'); ?>"><i class="far fa-gem"></i><?php echo get_phrase('dashboard'); ?></a>
      </li>
      <!-- <li class="<?php echo is_active('my_exam'); ?>">
        <a href="<?php echo site_url('home/my_exam'); ?>"><i class="far fa-gem"></i><?php echo get_phrase("Today's_paper"); ?></a>
      </li> -->

      <li class="<?php echo is_active('my_enroll'); ?>">
        <a href="<?php echo site_url('home/my_enroll'); ?>"><i class="far fa-gem"></i><?php echo get_phrase('enrolled_quizzes'); ?></a>
      </li>
      <li class="<?php echo is_active('previousExams'); ?>">
        <a href="<?php echo site_url('home/previousExams'); ?>"><i class="far fa-gem"></i><?php echo get_phrase('previous_quizzes'); ?></a>
      </li>
      <li class="<?php echo is_active('my_referral'); ?>">
        <a href="<?php echo site_url('home/my_referral'); ?>"><i class="far fa-gem"></i><?php echo get_phrase('my_referral'); ?></a>
      </li>
      <li class="<?php echo is_active('my_messages'); ?>">
        <a href="<?php echo site_url('home/my_messages'); ?>"><i class="far fa-envelope"></i><?php echo get_phrase('my_messages'); ?></a>
      </li>
      <li class="<?php echo is_active('purchase_history'); ?>">
        <a href="<?php echo site_url('home/purchase_history'); ?>"><i class="fas fa-shopping-cart"></i><?php echo get_phrase('purchase_history'); ?></a>
      </li>
      <li class="<?php echo is_active('profile'); ?>">
        <a href="<?php echo site_url('home/profile/user_profile'); ?>"><i class="fas fa-user"></i><?php echo get_phrase('user_profile'); ?></a>
      </li>
      <li class="<?php echo is_active('dashboard'); ?>">
        <a href="<?php echo site_url('login/logout/user'); ?>"><?php echo get_phrase('log_out'); ?></a>
      </li>
    </ul> 
</div>
