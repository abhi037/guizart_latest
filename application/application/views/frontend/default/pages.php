
<!-- <section class="">
    <div class="">
        <div class="row">
            <div class="col">
                <div class="">
                    <div id="bs4-slide-carousel" class="carousel slide" data-ride="carousel" >
 
                        <ol class="carousel-indicators">
                            <?php
                                for($i=0; $i<count($sliders); $i++):
                            ?>
                        
                            <li data-target="#bs4-slide-carousel" data-slide-to="<?php echo $i; ?>" class="<?php if($i==0) echo 'active'; ?>">

                            <?php
                                endfor;
                            ?>
                        
                        </ol>
                        
                        <div class="carousel-inner" style="width: 100%;height:100% !important;">

                        <?php
                            $i=-1;
                            foreach($sliders as $slider):
                                $i++;
                        ?>
                        
                            <div class="carousel-item <?php if($i==0) echo 'active'; ?>">
                        
                            <img class="d-inline w-100" src="<?php echo base_url().'uploads/pages/slider/'.$slider['image_name']; ?>" alt="">
                        
                           Captions for the slides go here 
                        <?php /* ?>
                                <div class="carousel-caption text-success d-none d-sm-block">
                        
                                <h5>The demo of using text in Slider</h5>
                        
                                <p class="text-light">Another caption line goes here
                        
                                <button class="btn btn-outline-primary btn-lg">More info</button>
                        
                                </p>
                        
                                </div>
                      <?php */ ?>
                         <div class="carousel-caption d-none d-sm-block">

                                <?php if($slider['htext']!=''): ?>
                        
                                    <h1><?php echo $slider['htext']; ?></h1>

                                <?php endif;
                                    if($slider['ptext']!=''):
                                ?>
                        
                                <p class="text-light"><?php // echo $slider['ptext']; ?>
                        
                                <a href="<?php echo $slider['blink']; ?>"><button class="btn btn-dark btn-lg"><?php  echo $slider['ptext']; ?></button></a>
                        
                                </p>
                                <?php endif; ?>

                        
                                </div>

                        Captions ending here for slide 1
                        
                        </div>
                        <?php
                            endforeach;
                        ?>
                        
                        
                        
                        </div>
                        
                        <a class="carousel-control-prev" href="#bs4-slide-carousel" role="button" data-slide="prev">
                        
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        
                            <span class="sr-only">Previous</span>
                        
                        </a>
                        
                        <a class="carousel-control-next" href="#bs4-slide-carousel" role="button" data-slide="next">
                        
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        
                            <span class="sr-only">Next</span>
                        
                        </a> 
                        
                        </div>
 
                </div>
            </div>
        </div>
    </div>
</section>

<section class="my-courses-area">
    <div class="container">
        <?php echo html_entity_decode(urldecode($data['content'])); ?>
    </div>
</section> -->
<!-- <?php if($page_title == "Contact Us"): ?>
Start Contact Area 
        <section class="contact-area ptb-100">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-12">
                        <div class="contact-box">
                            <div class="icon">
                                <i class="icofont-phone"></i>
                            </div>
                            
                            <div class="content">
                                <h4>Phone / Fax</h4>
                                <p>(+91) 8218895206</p>
                                <br><br>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-lg-4 col-md-12">
                        <div class="contact-box">
                            <div class="icon">
                                <i class="icofont-envelope"></i>
                            </div>
                            
                            <div class="content">
                                <h4>E-mail</h4>
                                <p>info@quizart.co.in</p> <br><br>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-lg-4 col-md-12">
                        <div class="contact-box">
                            <div class="icon">
                                <i class="icofont-google-map"></i>
                            </div>
                            
                            <div class="content">
                                <h4>Location</h4>
                                <p>7/501, Malhar deluxe sahara grace, <span>Jankipuram, Lucknow (UP). PIN - 226021</span></p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-lg-12 col-md-12">
                        Map Area 
                        <div id="googleMap"></div>
                        End Map Area 
                    </div>
                    
                    <div class="col-lg-4 col-md-12">
                        <div class="leave-your-message">
                            <h3>Leave Your Message</h3>
                            <p>If you have any questions about the services we provide simply use the form. We try and respond to all queries and comments within 24 hours.</p>
                            
                            <div class="stay-connected">
                                <h3>Stay Connected</h3>
                                <ul>
                                    <li>
                                        <a href="https://facebook.com/QuizartAteam" target="_blank">
                                            <i class="icofont-facebook"></i>
                                            
                                            <span>Facebook</span>
                                        </a>
                                    </li>
                                    
                                    <li>
                                        <a href="https://twitter.com/QuizartATeam" target="_blank">
                                            <i class="icofont-twitter"></i>
                                            
                                            <span>Twitter</span>
                                        </a>
                                    </li>
                                    
                                    <li>
                                        <a href="https://www.instagram.com/quizart_team" target="_blank">
                                            <i class="icofont-instagram"></i>
                                            
                                            <span>Instagram</span>
                                        </a>
                                    </li>
                                    
                                    <li>
                                        <a href="https://vimeo.com/quizart" target="_blank">
                                            <i class="icofont-vimeo"></i>
                                            
                                            <span>Vimeo</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-lg-8 col-md-12">
                        <form id="contactForm" action="<?php echo site_url('home/contact_us_form'); ?>" method="post">
                            <div class="row">
                                <div class="col-lg-6 col-md-6">
                                    <div class="form-group">
                                        <label for="name">Name*</label>
                                        <input type="text" class="form-control" name="name" id="name" required data-error="Please enter your name">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                
                                <div class="col-lg-6 col-md-6">
                                    <div class="form-group">
                                        <label for="email">Email*</label>
                                        <input type="email" class="form-control" name="email" id="email" required data-error="Please enter your email">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                
                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <label for="number">Phone Number*</label>
                                        <input type="text" class="form-control" name="number" id="number" required data-error="Please enter your number">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                
                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <label for="message">Message*</label>
                                        <textarea name="message" class="form-control" id="message" cols="30" rows="4" required data-error="Write your message"></textarea>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                
                                <div class="col-lg-12 col-md-12">
                                    <button type="submit" class="btn btn-primary">Send Message</button>
                                    <div id="msgSubmit" class="h3 text-center hidden"></div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        End Contact Area

        <?php endif; ?> -->
 <!-- Start Breadcrumb 
    ============================================= --><?php if($page_title == "Contact Us"): ?>
    <div   class="breadcrumb-area bg-gray text-center shadow dark text-light bg-cover" style="background-image: url(assets/img/2440x1578.png);">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 ">
                    <h1>Contact Us</h1>
                    <ul class="breadcrumb">
                        <li><a href="#"><i class="fas fa-home"></i> Home</a></li>
                        <li class="active">Contact</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumb -->

    <!-- Start Contact Area
    ============================================= -->
   
    <div class="contact-area default-padding-top">
        <div class="container">
            <div class="contact-items">
                <div class="row align-center">
                    <div class="col-lg-4 left-item">
                        <div class="info-items">
                            <!-- Single Item -->
                            <div class="item">
                                <div class="icon">
                                    <i class="fas fa-map-marked-alt"></i>
                                </div>
                                <div class="info">
                                    <h5>Location</h5>
                                    <p>
                                       7/501, Malhar deluxe sahara grace, <span>Jankipuram, Lucknow (UP). PIN - 226021</span></p>
                                    </p>
                                </div>
                            </div>
                            <!-- End Single Item -->
                            <!-- Single Item -->
                            <div class="item">
                                <div class="icon">
                                    <i class="fas fa-phone"></i>
                                </div>
                                <div class="info">
                                    <h5>Make a Call</h5>
                                    <p>
                                      (+91) 8218895206
                                    </p>
                                </div>
                            </div>
                            <!-- End Single Item -->
                            <!-- Single Item -->
                            <div class="item">
                                <div class="icon">
                                    <i class="fas fa-envelope-open"></i>
                                </div>
                                <div class="info">
                                    <h5>Send a Mail</h5>
                                    <p>
                                        info@quizart.co.in
                                    </p>
                                </div>
                            </div>
                            <!-- End Single Item -->
                        </div>
                    </div>
                    <div class="col-lg-8 right-item">
                        <h5>Need Help?</h5>
                        <h2>Keep in Touch</h2>
                        <form id="contactForm" action="<?php echo site_url('home/contact_us_form'); ?>" method="post">
                            <div class="row">
                                <div class="col-lg-6 col-md-6">
                                    <div class="form-group">
                                        <label for="name">Name*</label>
                                        <input type="text" class="form-control" name="name" id="name" required data-error="Please enter your name">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                
                                <div class="col-lg-6 col-md-6">
                                    <div class="form-group">
                                        <label for="email">Email*</label>
                                        <input type="email" class="form-control" name="email" id="email" required data-error="Please enter your email">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                
                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <label for="number">Phone Number*</label>
                                        <input type="text" class="form-control" name="number" id="number" required data-error="Please enter your number">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                
                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <label for="message">Message*</label>
                                        <textarea name="message" class="form-control" id="message" cols="30" rows="4" required data-error="Write your message"></textarea>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                
                                <div class="col-lg-12 col-md-12">
                                    <button type="submit" class="btn btn-primary">Send Message</button>
                                    <div id="msgSubmit" class="h3 text-center hidden"></div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
     
    <!-- End Contact -->

    <!-- Star Google Maps
    ============================================= -->
    <div class="maps-area">
        <div class="google-maps">
            <iframe src="https://www.google.com/maps/embed?pb=!1m10!1m8!1m3!1d14767.262289338461!2d70.79414485000001!3d22.284975!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sin!4v1424308883981"></iframe>
        </div>
    </div>
 <?php endif; ?>
<?php if($page_title == "About Us"): ?>
 <!-- Start Breadcrumb 
    ============================================= -->
    <div class="breadcrumb-area bg-gray text-center shadow dark text-light bg-cover" style="background-image: url(../../assets/frontend/img/2440x1578.png);">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <h1>About Us</h1>
                    <ul class="breadcrumb">
                        <li><a href="#"><i class="fas fa-home"></i> Home</a></li>
                        <li class="active">About</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumb -->

    <!-- Star About Area
    ============================================= -->
    <div class="about-area default-padding-top">
        <!-- Fixed Shape -->
        <div class="fixed-shape-bottom">
            <img src="../../assets/frontend/img/shape/12.png" alt="Shape">
        </div>
        <!-- End Fixed Shape -->
        <div class="container">
            <div class="about-items">
                <div class="row align-center">
                    
                    <div class="col-lg-6 info">
                        <h2>
                            Learn and Earn with Our Educational and Fun Quizzes
                        </h2>
                        <p>
                           We especially enjoy playing arbitrary Quiz games because they are entertaining and have a ton of worthwhile content. You have fun while learning, expanding your general information, and improving your brilliance while playing Quizzes. Through daily quizzes, QuizArt offers you a special method of learning and equips you with the knowledge you need to be successful. 
                        </p>
                        <ul>
                            <li>
                                <div class="fun-fact">
                                    <!-- <span class="timer" data-to="168" data-speed="5000"></span> -->
                                    <span class="medium">Online Quiz</span>
                                </div>
                            </li>
                            <li>
                                <div class="fun-fact">
                                    <!-- <span class="timer" data-to="454" data-speed="5000"></span> -->
                                    <span class="medium">Contributor</span>
                                </div>
                            </li>
                        </ul>
                    </div>

                    <div class="col-lg-6 thumb">
                        <img src="../../assets/frontend/img/illustration/5.png" alt="Thumb">
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- End About Area -->

    <!-- Star Why Chose Us
    ============================================= -->
    <div class="why-choseus-area bg-gray default-padding bottom-less">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 ">
                    <div class="site-heading text-center">
                        <h5>Enroll now</h5>
                        <h2>Every Second Member is a <br>Winner at QuizArt</h2>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Fixed BG -->
        <div class="container-full">
            <div class="info">
                <div class="row">

                    <div class="single-item thumb col-lg-5">
                        <div class="thumb-box">
                            <img src="../../assets/frontend/img/800x600.png" alt="Thumb">
                            <a href="https://www.youtube.com/watch?v=0U3WN3f52x8" class="popup-youtube light video-play-button item-center">
                                <i class="fa fa-play"></i>
                            </a>
                        </div>
                    </div>

                    <div class="item-box col-lg-7">
                        <div class="row">
                            <div class="single-item col-lg-6 col-md-6">
                                <div class="item">
                                    <span>01</span>
                                    <i class="flaticon-library"></i>
                                    <h4>Join as a Contributor</h4>
                                    <p>
                                        Joining Quizart as a Contributor can help you win massive cash prizes worth upto 5 crore rupees. All you need is:
                                    </p>
                                    <ul>
                                        <li>Upload MCQ’s</li>
                                        <li>Upload Video Tutorials</li>
                                        <li>Upload Student Material</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="single-item col-lg-6 col-md-6">
                                <div class="item">
                                    <span>02</span>
                                    <i class="flaticon-teacher-2"></i>
                                    <h4>Join as a student</h4>
                                    <p>
                                       Joining Quizart as a student can help you win massive cash prizes worth upto 10 crore rupees. 
                                    </p>
                                    <ul>
                                        <li>Daily Quizzes</li>
                                        <li>Best Study Material</li>
                                        <li>Boost Knowledge</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- End Why Chose Us -->

    <!-- Star Advisor Area
    ============================================= -->
    <div class="advisor-area default-padding bottom-less">
        <div class="container">
            <div class="heading-left">
                <div class="row">
                    <div class="col-lg-5">
                        <h5>Course Advisor</h5>
                        <h2>
                            Our professional & Expert Course advisor
                        </h2>
                    </div>
                    <div class="col-lg-6 offset-lg-1">
                        <p>
                            Everything melancholy uncommonly but solicitude inhabiting projection off. Connection stimulated estimating excellence an to impression. 
                        </p>
                        <a class="btn btn-md btn-dark border" href="#">View All <i class="fas fa-plus"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="advisor-items text-center">
                <div class="row">
                    <!-- Single Item -->
                    <div class="single-item col-lg-3 col-md-6">
                        <div class="item">
                            <div class="thumb">
                                <img src="../../assets/frontend/img/800x800.png" alt="Thumb">
                                <ul>
                                    <li class="facebook">
                                        <a href="#">
                                            <i class="fab fa-facebook-f"></i>
                                        </a>
                                    </li>
                                    <li class="twitter">
                                        <a href="#">
                                            <i class="fab fa-twitter"></i>
                                        </a>
                                    </li>
                                    <li class="linkedin">
                                        <a href="#">
                                            <i class="fab fa-linkedin-in"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="info">
                                <h4><a href="#">Prof. Deol Jones</a></h4>
                                <span>Science specialist</span>
                            </div>
                        </div>
                    </div>
                    <!-- End Single Item -->
                    <!-- Single Item -->
                    <div class="single-item col-lg-3 col-md-6">
                        <div class="item">
                            <div class="thumb">
                                <img src="../../assets/frontend/img/800x800.png" alt="Thumb">
                                <ul>
                                    <li class="facebook">
                                        <a href="#">
                                            <i class="fab fa-facebook-f"></i>
                                        </a>
                                    </li>
                                    <li class="twitter">
                                        <a href="#">
                                            <i class="fab fa-twitter"></i>
                                        </a>
                                    </li>
                                    <li class="linkedin">
                                        <a href="#">
                                            <i class="fab fa-linkedin-in"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="info">
                                <h4><a href="#">Busel park</a></h4>
                                <span>Programmer</span>
                            </div>
                        </div>
                    </div>
                    <!-- End Single Item -->
                    <!-- Single Item -->
                    <div class="single-item col-lg-3 col-md-6">
                        <div class="item">
                            <div class="thumb">
                                <img src="../../assets/frontend/img/800x800.png" alt="Thumb">
                                <ul>
                                    <li class="facebook">
                                        <a href="#">
                                            <i class="fab fa-facebook-f"></i>
                                        </a>
                                    </li>
                                    <li class="twitter">
                                        <a href="#">
                                            <i class="fab fa-twitter"></i>
                                        </a>
                                    </li>
                                    <li class="linkedin">
                                        <a href="#">
                                            <i class="fab fa-linkedin-in"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="info">
                                <h4><a href="#">Jnoes Sari</a></h4>
                                <span>Chemistry specialist</span>
                            </div>
                        </div>
                    </div>
                    <!-- End Single Item -->
                    <!-- Single Item -->
                    <div class="single-item col-lg-3 col-md-6">
                        <div class="item">
                            <div class="thumb">
                                <img src="../../assets/frontend/img/800x800.png" alt="Thumb">
                                <ul>
                                    <li class="facebook">
                                        <a href="#">
                                            <i class="fab fa-facebook-f"></i>
                                        </a>
                                    </li>
                                    <li class="twitter">
                                        <a href="#">
                                            <i class="fab fa-twitter"></i>
                                        </a>
                                    </li>
                                    <li class="linkedin">
                                        <a href="#">
                                            <i class="fab fa-linkedin-in"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="info">
                                <h4><a href="#">Dr. Anil Dev</a></h4>
                                <span>Developer</span>
                            </div>
                        </div>
                    </div>
                    <!-- End Single Item -->
                </div>
            </div>
        </div>
    </div>
    <!-- End Advisor Area -->

    <!-- Start Video Area
    ============================================= -->
    <div class="video-area padding-xl text-center bg-fixed text-light shadow dark-hard" style="background-image: url(../../assets/frontend/img/2440x1578.png);">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="video-heading">
                        <div class="content">
                            <h2>Drench Yourself in the Shower of Prizes</h2>
                            <p>
                                The only location where you can make money while learning. You visit every day, finish quizzes, and if you are fortunate, you might become a millionaire. The most regular and fortunate people receive the same prize, not just the finest.
                            </p>
                        </div>
                        <a class="popup-youtube relative video-play-button" href="https://www.youtube.com/watch?v=8GQTt50izkg">
                            <i class="fa fa-play"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Video Area -->

  
  
        <?php endif; ?>
    <!-- End Google Maps -->
