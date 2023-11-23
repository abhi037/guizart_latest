
<?php
  $status_wise_courses = $this->crud_model->get_status_wise_courses();
  $role_id=$this->session->userdata('role_id');
  $urls= ($this->session->userdata('role_id') !=1 ? ($this->session->userdata('access_url') ? $this->session->userdata('access_url') : array()) : array());
?>
<div class="sidebar-menu">
    <header class="logo-env"><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <!-- logo --> 
    <div class="logo">
      <a href="<?php echo site_url('admin/dashboard'); ?>">
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
    <!-- add class "multiple-expanded" to allow multiple submenus to open -->
    <!-- class "auto-inherit-active-class" will automatically add "active" class for parent elements who are marked already with class "active" -->
    <!-- Search Bar -->
    <?php  
    if($role_id==1 || in_array('/admin/dashboard', $urls)) { 
      ?>
      <li class="<?php echo is_active('dashboard'); ?>">
        <a href="<?php echo site_url('admin/dashboard'); ?>">
          <i class="fa fa-tachometer"></i>
          <span><?php echo get_phrase('dashboard'); ?></span>
        </a>
      </li>
    <?php
    } ?> 
    
    <?php if($role_id==1 || in_array('/admin/categories', $urls) || in_array('/admin/sub_categories', $urls) || in_array('/master/manage/samester', $urls) || in_array('/admin/subjects', $urls) || in_array('/master/manage/chapters', $urls)) { ?>
      <li class = "<?php echo is_multi_level_active(['categories', 'sub_categories', 'subjects', 'samester', 'chapters', 'samester_form'], 1); ?>">
        <a href="javascript:;">
          <i class="fa fa-suitcase"></i>
          <span><?php echo get_phrase('master'); ?></span>
        </a>
        <ul class="sub-menu">
          <?php  
          if($role_id==1 || in_array('/admin/categories', $urls)) { 
            ?>
            <li class="<?php echo is_multi_level_active(['categories'], 1); ?>">
              <a href="<?php echo site_url('admin/categories'); ?>">
                <i class="fa fa-university"></i>
                <span><?php echo get_phrase('categories'); ?></span>
              </a>
            </li>
          <?php
          } ?>  
          <?php  
          if($role_id==1 || in_array('/admin/sub_categories', $urls)) { 
            ?>
            <li class="<?php echo is_multi_level_active(['sub_categories'], 1); ?>">
              <a href="<?php echo site_url('admin/sub_categories'); ?>">
                <i class="fa fa-university"></i>
                <span><?php echo get_phrase('sub_-_categories'); ?></span>
              </a>
            </li>
          <?php
          } ?>  

          <?php  
          if($role_id==1 || in_array('/master/manage/samester', $urls)) { 
            ?>
            <li class="<?php echo is_active('samester'); ?>">
              <a href="<?php echo site_url('master/manage/samester'); ?>">
                <i class="fa fa-university"></i>
                <span><?php echo get_phrase('class'); ?></span>
              </a>
            </li>
          <?php
          } ?>   
          <?php  
          if($role_id==1 || in_array('/admin/subjects', $urls)) { 
            ?>
            <li class="<?php echo is_active('subjects'); ?>">
              <a href="<?php echo site_url('admin/subjects'); ?>">
                <i class="fa fa-book"></i>
                <span><?php echo get_phrase('subjects'); ?></span>
              </a>
            </li>
          <?php
          } ?>    
          <?php  
          if($role_id==1 || in_array('/master/manage/chapters', $urls)) { 
            ?>
            <li class="<?php echo is_active('chapters'); ?>">
              <a href="<?php echo site_url('master/manage/chapters'); ?>">
                <i class="fa fa-book"></i>
                <span><?php echo get_phrase('chapters'); ?></span>
              </a>
            </li> 
          <?php
          } ?>  
          <br>
        </ul>
      </li>
    <?php } ?>
    
    
    <?php  
    if($role_id==1 || in_array('/admin/winners', $urls)) { 
      ?>
      <li class="<?php echo is_active('winners'); ?>">
        <a href="<?php echo site_url('admin/winners'); ?>">
          <i class="fa fa-trophy"></i>
          <span><?php echo get_phrase('winners'); ?></span>
        </a>
      </li>
    <?php
    } ?>  
    
    <?php  
    if($role_id==1 || in_array('/admin/users', $urls)) { 
      ?>
      <li class="<?php echo is_active('users'); ?>">
        <a href="<?php echo site_url('admin/users'); ?>">
          <i class="fa fa-users"></i>
          <span><?php echo get_phrase('students'); ?></span>
        </a>
      </li>
    <?php
    } ?> 

    <?php  
    /*if($role_id==1 || in_array('/admin/enroll_student', $urls)) { 
      ?>
      <li class = "<?php echo is_multi_level_active(['enroll_history', 'enroll_student','enroll_list'], 1); ?>">
        <a href="javascript:;">
          <i class="fa fa-history"></i>
          <span><?php echo get_phrase('enrollment'); ?></span>
        </a>
        <ul class="sub-menu"> 
          <li class = "<?php echo is_active('enroll_student'); ?>" > <a href="<?php echo site_url('admin/enroll_student'); ?>"><?php echo get_phrase('enroll_a_student'); ?></a> </li> 
          <br>
        </ul>
      </li>
    <?php
    } */?>  
    
    <?php  
    if($role_id==1 || in_array('/admin/matrix', $urls)) { 
      ?>
      <li class="<?php echo is_active('matrix'); ?>">
        <a href="<?php echo site_url('admin/matrix'); ?>">
          <i class="fa fa-university"></i>
          <span><?php echo get_phrase('exam_matrix'); ?></span>
        </a>
      </li>
    <?php
    } ?>  
    
    <?php  
    if($role_id==1 || in_array('/admin/coupon', $urls)) { 
      ?>
      <li class="<?php echo is_active('coupon'); ?>">
        <a href="<?php echo site_url('admin/coupon'); ?>">
          <i class="fa fa-tag"></i>
          <span><?php echo get_phrase('coupon'); ?></span>
        </a>
      </li>
    <?php
    } ?>  
    
    <?php  
    if($role_id==1 || in_array('/admin/admin_revenue', $urls) || in_array('/admin/enroll_list', $urls) || in_array('/admin/attempted_list', $urls) || in_array('/admin/total_question', $urls) || in_array('/admin/new_report', $urls) || in_array('/admin/contributor_report', $urls)) { 
      ?>
      <li class = "<?php echo is_multi_level_active(['admin_revenue', 'instructor_revenue', 'new_report', 'contributor_report'], 1); ?>">
        <a href="javascript:;">
          <i class="fa fa-bar-chart"></i>
          <span><?php echo get_phrase('report'); ?></span>
        </a>
        <ul class="sub-menu">
          <li class = "<?php echo is_active('admin_revenue'); ?>" > 
            <a href="<?php echo site_url('admin/admin_revenue'); ?>"><?php echo get_phrase('admin_revenue'); ?></a> 
          </li> 

          <li class = "<?php echo is_active('admin_revenue'); ?>" > 
            <a href="<?php echo site_url('admin/enroll_list'); ?>"><?php echo get_phrase('enroll_list'); ?></a> 
          </li>
                  
          <li class = "<?php echo is_active('admin_revenue'); ?>" > 
            <a href="<?php echo site_url('admin/attempted_list'); ?>"><?php echo get_phrase('attempted_list'); ?></a> 
          </li>

          <li class = "<?php echo is_active('admin_revenue'); ?>" > 
            <a href="<?php echo site_url('admin/total_question'); ?>"><?php echo get_phrase('total_question'); ?></a> 
          </li>
                  
          <li class = "<?php echo is_active('new_report'); ?>" > 
            <a href="<?php echo site_url('admin/new_report'); ?>"><?php echo get_phrase('Detail_report'); ?></a> 
          </li>    

          <li class = "<?php echo is_active('contributor_report'); ?>" > 
            <a href="<?php echo site_url('admin/contributor_report'); ?>"><?php echo get_phrase('contributor_report'); ?></a> 
          </li> 
          <br>
        </ul>
      </li>
    <?php
    } ?>  
    
    <?php  
    if($role_id==1 || in_array('/admin/message', $urls)) { 
      ?>
      <li class="<?php echo is_multi_level_active(['message'], 1); ?>">
        <a href="<?php echo site_url('admin/message'); ?>">
          <i class="fa fa-commenting-o"></i>
          <span><?php echo get_phrase('message'); ?></span>
        </a>
      </li>
    <?php
    } ?>  

    <?php  
    if($role_id==1 || in_array('/admin/questions', $urls)) { 
      ?>
      <li class="<?php echo is_multi_level_active(['questions'], 1); ?>">
        <a href="<?php echo site_url('admin/questions'); ?>">
          <i class="fa fa-commenting-o"></i>
          <span><?php echo get_phrase('questions'); ?></span>
        </a>
      </li>
    <?php
    } ?> 

    <?php  
    if($role_id==1 || in_array('/admin/approvequestions', $urls)) { 
      ?>
      <li class="<?php echo is_multi_level_active(['approvequestions'], 1); ?>">
        <a href="<?php echo site_url('admin/approvequestions'); ?>">
          <i class="fa fa-commenting-o"></i>
          <span><?php echo get_phrase('approve_questions'); ?></span>
        </a>
      </li>
    <?php
    } ?> 
    
    <?php  
    if($role_id==1 || in_array('/admin/highlight_quiz', $urls)) { 
      ?>
      <li class="<?php echo is_multi_level_active(['highlight_quiz'], 1); ?>">
        <a href="<?php echo site_url('admin/highlight_quiz'); ?>">
          <i class="fa fa-commenting-o"></i>
          <span><?php echo get_phrase('highlight_quiz'); ?></span>
        </a>
      </li>
    <?php
    } ?> 

    <?php  
    if($role_id==1 || in_array('/admin/videos', $urls)) { 
      ?>
      <li class="<?php echo is_multi_level_active(['videos'], 1); ?>">
        <a href="<?php echo site_url('admin/videos'); ?>">
          <i class="fa fa-video-camera"></i>
          <span><?php echo get_phrase('videos'); ?></span>
        </a>
      </li>
    <?php
    } ?> 

    <?php  
    if($role_id==1 || in_array('/admin/studymaterials', $urls)) { 
      ?>
      <li class="<?php echo is_multi_level_active(['studymaterials'], 1); ?>">
        <a href="<?php echo site_url('admin/studymaterials'); ?>">
          <i class="fa fa-database"></i>
          <span><?php echo get_phrase('study_material'); ?></span>
        </a>
      </li>
    <?php
    } ?> 

    <?php  
    if($role_id==1 || in_array('/usermanagement/employee', $urls)) { 
      ?>
      <li class="<?php echo is_multi_level_active(['employee'], 1); ?>">
        <a href="<?php echo site_url('usermanagement/employee'); ?>">
          <i class="fa fa-shield"></i>
          <span><?php echo get_phrase('employee_management'); ?></span>
        </a>
      </li>
    <?php
    } ?> 

    <?php  
    if($role_id==1 || in_array('/usermanagement/roles', $urls)) { 
      ?>
      <li class="<?php echo is_multi_level_active(['roles'], 1); ?>">
        <a href="<?php echo site_url('usermanagement/roles'); ?>">
          <i class="fa fa-lock"></i>
          <span><?php echo get_phrase('role_management'); ?></span>
        </a>
      </li>
    <?php
    } ?> 

    <?php  
    if($role_id==1 || in_array('/admin/faq', $urls)) { 
      ?>
      <li class="<?php echo is_active(['faq'], 1); ?>">
        <a href="<?php echo site_url('admin/faq'); ?>">
          <i class="fa fa-commenting-o"></i>
          <span><?php echo get_phrase('faq'); ?></span>
        </a>
      </li>
    <?php
    } ?> 
    
    <?php  
    if($role_id==1 || in_array('/admin/slider', $urls)) { 
      ?>
      <li class="<?php echo is_active(['slider'], 1); ?>">
        <a href="<?php echo site_url('admin/slider'); ?>">
          <i class="fa fa-commenting-o"></i>
          <span><?php echo get_phrase('Slider'); ?></span>
        </a>
      </li>
    <?php
    } ?> 
    
    <?php  
    if($role_id==1 || in_array('/admin/photogallery', $urls)) { 
      ?>
      <li class="<?php echo is_multi_level_active(['photogallery'], 1); ?>">
        <a href="<?php echo site_url('admin/photogallery'); ?>">
          <i class="fa fa-commenting-o"></i>
          <span><?php echo get_phrase('photogallery'); ?></span>
        </a>
      </li>
    <?php
    } ?> 
    
    <?php  
    if($role_id==1 || in_array('/admin/pages', $urls)) { 
      ?>
      <li class="<?php echo is_multi_level_active(['pages'], 1); ?>">
        <a href="<?php echo site_url('admin/pages'); ?>">
          <i class="fa fa-commenting-o"></i>
          <span><?php echo get_phrase('pages'); ?></span>
        </a>
      </li>
    <?php
    } ?> 
    
    <?php  
    if($role_id==1 || in_array('/admin/pages_slider', $urls)) { 
      ?>
      <li class="<?php echo is_multi_level_active(['pages_slider'], 1); ?>">
        <a href="<?php echo site_url('admin/pages_slider'); ?>">
          <i class="fa fa-clone"></i>
          <span><?php echo get_phrase('pages_slider'); ?></span>
        </a>
      </li>
    <?php
    } ?> 
        
    <?php  
    if($role_id==1 || in_array('/admin/system_settings', $urls) || in_array('/admin/frontend_settings', $urls) || in_array('/admin/smtp_settings', $urls) || in_array('/admin/manage_language', $urls)) { 
      ?>
      <li class = "<?php echo is_multi_level_active(['system_settings', 'payment_settings', 'manage_language', 'frontend_settings', 'smtp_settings', 'instructor_settings'], 1); ?>">
        <a href="javascript:;">
          <i class="fa fa-sliders"></i>
          <span><?php echo get_phrase('settings'); ?></span>
        </a>
        <ul class="sub-menu">
          <?php  
          if($role_id==1 || in_array('/admin/system_settings', $urls)) { 
            ?>
            <li class = "<?php echo is_active('system_settings'); ?>" > 
              <a href="<?php echo site_url('admin/system_settings'); ?>"><?php echo get_phrase('system_settings'); ?></a> 
            </li>
          <?php
          } ?> 
          <?php  
          if($role_id==1 || in_array('/admin/frontend_settings', $urls)) { 
            ?>
            <li class = "<?php echo is_active('frontend_settings'); ?>" > 
              <a href="<?php echo site_url('admin/frontend_settings'); ?>"><?php echo get_phrase('frontend_settings'); ?></a> 
            </li> 
          <?php
          } ?> 
          <?php  
          if($role_id==1 || in_array('/admin/smtp_settings', $urls)) { 
            ?>
            <li class = "<?php echo is_active('smtp_settings'); ?>" > 
              <a href="<?php echo site_url('admin/smtp_settings'); ?>"><?php echo get_phrase('SMTP_settings'); ?></a>
            </li>
          <?php
          } ?> 
          <?php  
          if($role_id==1 || in_array('/admin/manage_language', $urls)) { 
            ?>
            <li class = "<?php echo is_active('manage_language'); ?>" > 
              <a href="<?php echo site_url('admin/manage_language'); ?>"><?php echo get_phrase('manage_language'); ?></a> 
            </li>
          <?php
          } ?>  
          <br>
        </ul>
      </li>
    <?php
    } ?> 

    <?php  
    if($role_id==1 || in_array('/admin/export_database', $urls)) { 
      ?>
      <li class="<?php echo is_multi_level_active(['pages'], 1); ?>">
        <a href="<?php echo site_url('admin/export_database'); ?>">
          <i class="fas fa-database"></i>
          <span><?php echo get_phrase('databse'); ?></span>
        </a>
      </li>
    <?php
    } ?> 
    
    
    
  </ul>
</div>
