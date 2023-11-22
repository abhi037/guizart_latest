<?php
    $user_details = $this->user_model->get_user($this->session->userdata('user_id'))->row_array();
?>



       <div class="top-bar-area bg-dark text-light inline inc-border f-item contact">
        <div class="container">
            <div class="row align-center">
                
                <div class="col-lg-7 col-md-12 left-info">
                    <div class="item-flex">
                        <ul class="list">
                          <li>
                                <i class="fas fa-phone"></i> Have any question? +91-8218895206
                            </li>
                        
                           <?php
                        if(isset($hightligt_quiz[0])) {  ?>
                         
                        <!-- <marquee scrolldelay="50" behavior="alternate" direction="left" onmouseover="this.stop()" onmouseout="this.start()" scrollamount="2">  -->
                            <li>
                                  

                                <i class="fas fa-bullhorn"></i> <a href="#"><?php echo isset($hightligt_quiz[0]->title) ? $hightligt_quiz[0]->title : '' ?>


    
    		
    	
    		<strong>
    		  
    		  	<?php if($hightligt_quiz[0]->price=='0' || $hightligt_quiz[0]->price=='0.00') { ?>
    		  		<a style="color: #4687f7" href="<?php echo site_url('home/highlightquiz/' . (isset($hightligt_quiz[0]->id) ? md5($hightligt_quiz[0]->id) : "")); ?>">Enroll Now..!!</a>
  		  		<?php } else {?>
  		  			<a data-toggle="modal" data-target="#EnrollUpModel" style="color: #4687f7" href="#">Enroll Now..!!</a>
  		  		<?php } ?> 
    		 
    	  </strong> 
  
	
	

                                </a>
                               
                            </li>
                               <!-- </marquee> -->
	<?php } ?>
                        </ul>
                    </div>
                </div>

                <div class="col-lg-5 col-md-12 right-info">
                    <div class="item-flex">
                        <div class="social">
                            <ul>
                                <li>
                                    <a href="https://www.facebook.com/QuizartAteam" target="_blank"><i class="fab fa-facebook-f"></i></a>
                                </li>
                                <li>
                                    <a href="https://twitter.com/QuizartATeam" target="_blank"><i class="fab fa-twitter"></i></a>
                                </li>
                                <li>
                                    <a href="https://www.instagram.com/quizart_team/" target="_blank"><i class="fab fa-instagram"></i></a>
                                </li>
                                <li>
                                    <a href="https://vimeo.com/quizart" target="_blank"><i class="fab fa-vimeo"></i></a>
                                </li>
                            </ul>
                        </div>
                       
                        <div class="button">
                           <li class="nav-item dropdown ml-1 ml-md-3">
                                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-expanded="false">
                                     <?php
                if (file_exists(base_url().'uploads/user_image/'.$user_details['id'].'.jpg') || file_exists('uploads/user_image/'.$user_details['id'].'.jpg')): ?>
                <img src="<?php echo base_url().'uploads/user_image/'.$user_details['id'].'.jpg';?>" alt="Avatar" class="rounded-circle" style="border-radius: 50%; height: 45px; width: 45px; margin-top: -5px">
                <?php else: ?>
                <img src="<?php echo base_url().'uploads/user_image/placeholder.png';?>" alt="Avatar" class="rounded-circle" style="border-radius: 50%; height: 45px; width: 45px; margin-top: -5px">
                <?php endif; ?>  
                                    <!-- <img src="<?php echo base_url().'uploads/user_image/placeholder.png';?>" alt="Avatar" class="rounded-circle" width="40"> -->
                                  </a>
                                    <div class="dropdown-menu dropdown-menu-right">
                           <ul class="nav navbar-nav navbar-left">
                                     <li class="dropdown"><a class="dropdown-toggle" href="<?php echo site_url('home/profile/user_profile'); ?>"><i class="fas fa-user mr-2"></i><?php echo get_phrase('user_profile'); ?></a></li>
                                <li class="dropdown" >
                                    <a class="dropdown-toggle" href="<?php echo site_url('home/my_enroll'); ?>"><i class="fas fa-gem mr-2"></i><?php echo get_phrase('enrolled_quizzes'); ?></a>
                                </li>
                                 <li class="dropdown"><a href="<?php echo site_url('home/previousExams'); ?>"><i class="fas fa-trophy mr-2"></i><?php echo get_phrase('previous_quizzes'); ?></a></li>
                <li class="dropdown"><a class="dropdown-toggle" href="<?php echo site_url('home/my_referral'); ?>"><i class="fas fa-share mr-2"></i><?php echo get_phrase('my_referral'); ?></a></li>
                <li class="dropdown"><a class="dropdown-toggle" href="<?php echo site_url('home/my_messages'); ?>"><i class="fas fa-envelope mr-2"></i><?php echo get_phrase('my_messages'); ?></a></li>
                <li class="dropdown"><a class="dropdown-toggle" href="<?php echo site_url('home/purchase_history'); ?>"><i class="fas fa-shopping-cart mr-2"></i><?php echo get_phrase('purchase_history'); ?></a></li>
       
                <li class="dropdown"><a class="dropdown-toggle"href="<?php echo site_url('login/logout/user'); ?>"><i class="fas fa-sign mr-2"></i><?php echo get_phrase('log_out'); ?></a></li>
                            </ul>
              
                                       
                                    </div>
                                </li>
                            <!-- <a href="#">Register</a> -->
                            <!-- <a href="<?php echo get_phrase('log_in'); ?>" data-toggle="modal" data-target="#signInModal"><i class="fa fa-sign-in-alt"></i>Account</a> -->
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- End Header Top -->

     <!-- Header 
    ============================================= -->
    <header id="home">

        <!-- Start Navigation -->
        <nav class="navbar shadow-less navbar-default navbar-sticky bootsnav">

            <div class="container">

                <!-- Start Atribute Navigation -->
                <div class="attr-nav col-8 col-sm-6 col-xs-2">
                    <form action="<?php echo site_url('home/get_courses_by_search_string'); ?>" method="post" >
                        <input type="text" name = 'search_string' placeholder="<?php echo get_phrase('search_for_quiz'); ?>" class="form-control" name="text">
                        <button type="submit">
                            <i class="fa fa-search"></i>
                        </button>  
                    </form>
                </div>        
                      
                <!-- End Atribute Navigation -->

                <!-- Start Header Navigation -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu">
                        <i class="fa fa-bars"></i>
                    </button>
                    <a class="navbar-brand" href="<?php echo site_url(''); ?>">
                        <img src="<?php echo base_url().'assets/frontend/img/logo.png'; ?>" class="logo" alt="Logo">
                    </a>
                </div>
                <!-- End Header Navigation -->

                <!-- Collect the nav links, forms, and other content for toggling -->
                 <?php include 'menu.php'; ?>
                  
            </div>

        </nav>
        <!-- End Navigation -->

    </header>
                <!-- <nav class="navbar-expand-md navbar-dark custom-menu">

                    <div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent">
                        <ul class="navbar-nav">
                        <li class="nav-item <?php echo is_active('/'); ?>">
                            <a class="nav-link custom-link" href="<?php echo site_url('/'); ?>">Home <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item <?php echo is_active('about_us'); ?>">
                            <a class="nav-link custom-link" href="<?php echo site_url('home/pages/about_us'); ?>">About Us</a>
                        </li>
                        <li class="nav-item <?php echo is_active('our_team'); ?>">
                            <a class="nav-link custom-link" href="<?php echo site_url('home/pages/our_team'); ?>">Our team</a>
                        </li>
                        <li class="nav-item <?php echo is_active('achievements'); ?>">
                            <a class="nav-link custom-link" href="<?php echo site_url('home/pages/achievements'); ?>">Achievements</a>
                        </li>
                        <li class="nav-item <?php echo is_active('news_&_events'); ?>">
                            <a class="nav-link custom-link" href="<?php echo site_url('home/pages/news_&_events'); ?>">News and events</a>
                        </li>
                        <li class="nav-item <?php echo is_active('photogallery'); ?>">
                            <a class="nav-link custom-link" href="<?php echo site_url('home/photogallery'); ?>">Photo gallery</a>
                        </li>
                        <li class="nav-item <?php echo is_active('faqs'); ?>">
                            <a class="nav-link custom-link" href="<?php echo site_url('home/faqs'); ?>">FAQs</a>
                        </li>
                        
                        <li class="nav-item <?php echo is_active('contact_us'); ?>">
                            <a class="nav-link custom-link" href="<?php echo site_url('home/pages/contact_us'); ?>">Contact Us</a>
                        </li>
                        </ul>
                    </div>
                </nav> -->
     
