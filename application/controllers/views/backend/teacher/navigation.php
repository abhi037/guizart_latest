<?php
  $status_wise_courses = $this->crud_model->get_status_wise_courses();
?>
<div class="sidebar-menu">
    <header class="logo-env"><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
      <!-- logo -->
      <div class="logo">
        <a href="<?php echo site_url('teacher/dashboard'); ?>">
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
      <li class="<?php echo is_active('dashboard'); ?>">
        <a href="<?php echo site_url('teacher/dashboard'); ?>">
          <i class="fa fa-tachometer"></i>
          <span><?php echo get_phrase('dashboard'); ?></span>
        </a>
      </li> 
      <li class="<?php echo is_active('questions'); ?>">
        <a href="<?php echo site_url('teacher/questions'); ?>">
          <i class="fa fa-commenting-o"></i>
          <span><?php echo get_phrase('question'); ?></span>
        </a>
      </li> 
      <li class="<?php echo is_active('videos'); ?>">
        <a href="<?php echo site_url('teacher/videos'); ?>">
          <i class="fa fa-video-camera"></i>
          <span><?php echo get_phrase('video'); ?></span>
        </a>
      </li> 
    </ul>
</div>
