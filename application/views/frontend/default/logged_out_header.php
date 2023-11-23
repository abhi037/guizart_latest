
                <!-- <nav class="navbar navbar-expand-lg navbar-light">

                    <ul class="mobile-header-buttons">
                        <li><a class="mobile-nav-trigger" href="#mobile-primary-nav">Menu<span></span></a></li>
            			<li><a class="mobile-search-trigger" href="#mobile-search">Search<span></span></a></li>
            		</ul>

                    <a href="<?php echo site_url(''); ?>" class="navbar-brand" href="#"><img src="<?php echo base_url().'assets/frontend/img/logo.png'; ?>" alt="" height="50"></a>

                   

                    <form class="inline-form" action="<?php echo site_url('home/get_courses_by_search_string'); ?>" method="post" style="width: 100%;">
                        <div class="input-group search-box mobile-search">
                            <input type="text" name = 'search_string' class="form-control" placeholder="<?php echo get_phrase('search_for_quiz'); ?>">
                            <div class="input-group-append">
                                <button class="btn" type="submit"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                    <span class="signin-box-move-desktop-helper"></span>
                    <div class="sign-in-box btn-group">

                        <button type="button" class="btn btn-sign-in" data-toggle="modal" data-target="#signInModal"><?php echo get_phrase('log_in'); ?></button>

                     <button type="button" class="btn btn-sign-up" data-toggle="modal" data-target="#signUpModal"><?php echo get_phrase('sign_up'); ?></button> 
                    </div>  sign-in-box end 



                </nav> -->
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
                            <!-- <a href="#">Register</a> -->
                            <a href="<?php echo get_phrase('log_in'); ?>" data-toggle="modal" data-target="#signInModal"><i class="fa fa-sign-in-alt"></i>Login</a>
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
     
