 <!-- Start Banner 
    ============================================= -->
    <div class="banner-area bg-gray transparent-nav default bottom-large">
        <div id="bootcarousel" class="carousel text-light slide carousel-fade animate_text" data-ride="carousel">

            <!-- Indicators for slides -->
            <div class="carousel-indicator">
                <div class="container">
                    <div class="row" >
                        <div class="col-lg-12">
                            <ol class="carousel-indicators">
								 <?php
              for($i=0; $i<count($sliders); $i++):
							?>
                                <li data-target="#bootcarousel" data-slide-to="<?php echo $i; ?>" class="<?php if($i==0) echo 'active'; ?>"></li>
                              	<?php
								endfor;
							?>	
                            </ol>
                        </div>
                    </div>
               </div>
            </div>

            <!-- Wrapper for slides -->
            <div class="carousel-inner carousel-zoom">
				<?php
								$i=-1;
								foreach($sliders as $slider):
								$i++;
							?>
                <div class="carousel-item <?php if($i==0) echo 'active'; ?>">
                  <!-- <img class="d-inline w-75 float-right" src="assets/frontend/img/2440x1578.png" alt="">  -->  
                <!-- <div class="slider-thumb bg-cover" style="background-image: url(assets/frontend/img/2440x1578.jpg);"></div> -->

                <div class="slider-thumb bg-cover" style="background-image: url(<?php echo base_url().'uploads/slider/'.$slider['image_name']; ?>);"></div>
                    <div class="box-table shadow dark">
                        <div class="box-cell">
                            <div class="container">
                                <div class="row" style= "justify-content: left !important;">
                                    <div class="col-lg-6">
                                        <div class="content">
											 <?php if($slider['htext']!=''): ?>
                                            <h1 data-animation="animated fadeInRight"><strong> <?php echo $slider['htext']; ?></strong></h2>
                                            <?php endif;
											if($slider['ptext']!=''):
										?>
											
                                            <a data-animation="animated fadeInUp" class="btn btn-md btn-gradient" href="<?php echo $slider['blink']; ?>"><?php  echo $slider['ptext']; ?> </a>
                                            <!-- <a data-animation="animated fadeInUp" class="btn btn-md btn-light border" href="#">View Courses</a> -->
                                          <?php endif; ?>
										</div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
					
                </div>
			
             <?php
								endforeach;
							?> 
            </div>
            <!-- End Wrapper for slides -->

            <!-- Left and right controls -->
            <a class="left carousel-control light" href="#bootcarousel" data-slide="prev">
                <i class="ti-angle-left"></i>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control light" href="#bootcarousel" data-slide="next">
                <i class="ti-angle-right"></i>
                <span class="sr-only">Next</span>
            </a>

        </div>
        
    </div>
    <!-- End Banner -->

 <!-- Start Fun Factor Area
    ============================================= -->
    <div class="fun-factor-area overflow-hidden bg-gradient text-light default-padding">
        <div class="container">
            <div class="fun-fact-items text-center">
                <!-- Fixed BG -->
                <div class="fixed-bg contain" style="background-image: url(assets/frontend/img/map.svg);"></div>
                <!-- Fixed BG -->
                <div class="row">
                    <div class="col-lg-3 col-md-6 item">
                        <div class="fun-fact">
                            <div class="counter">
                                <div class="timer" data-to="<?php echo $online_exam->num_rows() ; ?> " data-speed="5000"><?php echo $online_exam->num_rows() ; ?> </div>
                                <div class="operator"></div>
                            </div>
                            <span class="medium"><?php echo get_phrase('online_quizzes'); ?></span>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 item">
                        <div class="fun-fact">
                            <div class="counter">
                                <div class="timer" data-to="128" data-speed="5000">128</div>
                                <div class="operator">+</div>
                            </div>
                            <span class="medium">Total courses</span>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 item">
                        <div class="fun-fact">
                            <div class="counter">
                                <div class="timer" data-to="120" data-speed="5000">120</div>
                                <div class="operator">+</div>
                            </div>
                            <span class="medium"><?php echo get_phrase('complete_and_detailed_explanations'); ?></span>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 item">
                        <div class="fun-fact">
                            <div class="counter">
                                <div class="timer" data-to="90" data-speed="5000">100</div>
                                <div class="operator">%</div>
                            </div>
                            <span class="medium"><?php echo get_phrase('attempt_quiz_on_your_schedule'); ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Fun Factor Area -->
<!-- <section class="home-fact-area">
	<div class="container-lg">
		<div class="row">
			<div class="col-md-4 d-flex">
				<div class="home-fact-box mr-md-auto ml-auto mr-auto">
					<i class="fas fa-bullseye float-left"></i>
					<div class="text-box">
						<h4><?php
						//echo $online_exam->num_rows().' '.get_phrase('online_quizzes'); ?></h4>
						<!--- <p><?php// echo get_phrase('explore_a_variety_of_fresh_topics'); ?></p>
					</div>
				</div>
			</div>
			
			<div class="col-md-4 d-flex">
				<div class="home-fact-box mr-md-auto ml-auto mr-auto">
					<i class="fa fa-check float-left"></i>
					<div class="text-box">
						<h4><?php // echo get_phrase('complete_and_detailed_explanations'); ?></h4>
						<!---  <p><?php // echo get_phrase('find_the_right_course_for_you'); ?></p>
				</div>
			</div>
			
			<div class="col-md-4 d-flex">
				<div class="home-fact-box mr-md-auto ml-auto mr-auto">
					<i class="fa fa-clock float-left"></i>
					<div class="text-box">
						<h4><?php // echo get_phrase('attempt_quiz_on_your_schedule'); ?></h4>
						<!---   <p><?php // echo get_phrase('learn_on_your_schedule'); ?></p>
					</div>
				</div>
			</div>
		</div>
	</div>
</section> -->

 <!-- Star Why Chose Us
    ============================================= -->
    <div class="why-choseus-area bg-gray default-padding bottom-less">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="site-heading text-center">
                        <h5>Join the Best Quiz Site</h5>
                        <h2>Turn Your Knowledge into a <br>Success Story</h2>
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
                            <img src="assets/frontend/img/800x600.png" alt="Thumb">
                            <a href="https://www.youtube.com/watch?v=0U3WN3f52x8" class="popup-youtube light video-play-button item-center">
                                <i class="fa fa-play"></i>
                            </a>
                        </div>
                    </div>

                    <div class="item-box col-lg-7">
                        <div class="row">
                            <div class="single-item col-lg-6 col-md-6">
                                <div class="item">
                                    <span>Free</span>
                                    <i class="flaticon-teacher-1"></i>
                                    <h4>Contributors</h4>
                                    <p>
                                        You can submit your own video tutorials, MCQs, and other student materials as a Contributor to win upto 5 crore.
                                        
                                    </p>
                                    <!-- <ul>
                                        <li>Carrel Booking</li>
                                        <li>Student Reading Room</li>
                                        <li>Science library</li>
                                    </ul> -->
                                     <div class="bottom-info">
                                   
                                    <div class="enroll">
                                        <a class="btn btn-theme effect btn-sm" href="<?php echo site_url('home/contributor/free'); ?>">Register</a>
                                    </div>
                                </div>
                                </div>
                                
                            </div>
                            <div class="single-item col-lg-6 col-md-6">
                                <div class="item">
                                    <span>₹1100</span>
                                    <i class="flaticon-teacher-2"></i>
                                    <h4>Contributor (Premium)</h4>
        
                                    <p>
                                        As a premium contributor you can get access to additional features which can help you engage more users to earn prize.
                                        
                                    </p>
                                
                                        <div class="bottom-info">
                                   
                                    <div class="enroll">
                                        <a class="btn btn-theme effect btn-sm" href="<?php echo site_url('home/contributor/premium'); ?>">Register</a>
                                    </div>
                                </div>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
  



<!-- <section class="Teachers-Contributor" style="background-color: #dfe3ec; padding-top:0px; margin-top:20px;">

	<div class="container"> 
	<section class="home-fact-area" style="background-image: url(<?php echo base_url().'uploads/heading contributor.jpg'; ?>); background-position: center; background-repeat: no-repeat;  background-size: cover;">
				<h1> &nbsp; </h1>
			</section>
			<img src="<?php echo base_url().'uploads/heading contributor.jpg'; ?>" style="max-width: -webkit-fill-available; margin-bottom:10px;"/>
		  <br />
		<h4 style="text-align: center; font-weight: bold;background: linear-gradient(-45deg,#427CDF,#6e1a52);color:white;">Medical</h4>
			<div class="row" style="justify-content: center;">
				<div class="col-lg-3 col-md-3" style="max-width: 100%; margin: auto;">
					<div class="single-courses-item">
						<div class="courses-img">
							<img src="https://quizart.co.in/uploads/frontend/TEACHERS FREE-01.jpg">
						</div>
						
						<div class="courses-content">
							<h3><a href="#">Contributors</a></h3>
						</div> 
						
						<div class="courses-content-bottom">
							<h4>
						    <a href="<?php echo site_url('home/contributor/free'); ?>" >
								  <button class="btn btn-primary">Register</button>
							  </a>
							</h4>
                            <h4 class="price"> Free </h4> 				
						</div>
					</div>
				</div>
				<div class="col-lg-3 col-md-3"  style="max-width: 100%; margin: auto;">
					<div class="single-courses-item">
						<div class="courses-img">
							<img src="https://quizart.co.in/uploads/frontend/TEACHERS premium-01.jpg">
						</div>
						
						<div class="courses-content">
							<h3><a href="#">Contributor (Premium)</a></h3>
						</div> 
						
						<div class="courses-content-bottom">
							<h4>
								<a href="<?php echo site_url('home/contributor/premium'); ?>" >
									<button class="btn btn-primary">Register</button>
								</a>
							</h4>
            	<h4 class="price">
							  ₹1100							
							</h4>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section> -->

	
<div class="breadcrumb-area bg-gray text-center shadow dark text-light bg-cover" style="background-image: url(assets/frontend/img/2440x1578.png);">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 ">
                    <h1>Quiz</h1>
                    <ul class="breadcrumb">
                        <li><a href="#"><i class="fas fa-link"></i> View More</a></li>
                        <!-- <li class="active">Courses</li> -->
                    </ul>
                </div>
            </div>
        </div>
    </div>

	 <!-- Star Courses Area
    ============================================= -->
    
    <div class="courses-area trend-layout">
        <?php 
		foreach ($categories as $catkey => $catvalue) 
    {
    	$sliderimg='';
	    if(trim($catvalue['name'])=='Medical') {
	      $sliderimg = 'slimline-01.jpg';
	    } else if(trim($catvalue['name'])=='Engineering') {
	      $sliderimg = 'slimline-05.jpg';
	    } else if(trim($catvalue['name'])=='School') {
	      $sliderimg = 'slimline-03.jpg';
	    } else if(trim($catvalue['name'])=='Home Maker') {
	      $sliderimg = 'slimline-02.jpg';
	    } else if(trim($catvalue['name'])=='All Sector Competitive exam') {
	      $sliderimg = 'slimline-04.jpg';
	    }
    ?>
        <!-- <div class="bg-gray text-center rounded-lg dark text-light bg-cover m-5 " style="background-image: url(<?php echo base_url() . 'uploads/' . $sliderimg; ?>);"> -->
       
       <div class="bg-gray text-center shadow dark text-light bg-cover m-5 " style="background-image: url(assets/frontend/img/1400x200.png)">
        <div class="container p-5">
            <div class="row">
                <div class="col-lg-8 m-5 ">
                    <!-- <h1>Quiz</h1> -->
                    <!-- <ul class="breadcrumb">
                        <li><a href="#"><i class="fas fa-link"></i> View More</a></li>
                        <li class="active">Courses</li> 
                    </ul> -->
                </div>
            </div>
        </div>
    </div>
        <div class="container">
            <div class="courses-items">
                <div class="row">
                    <?php
					foreach($online_exam->result_array() as $exam):
				  if($exam['parent']==$catvalue['id']) { 
				?>
                    <!-- Single item -->
                    <div class="single-item col-lg-4 col-md-6">
                        <div class="item">
                            <div class="thumb">
                                <?php if($exam['image_name'] != ''): ?>
                                    <a href="#">
                                    <!-- <img src="<?php echo base_url().'uploads/subcategory/'.$exam['image_name']; ?>" alt="Thumb"> -->
                                    <img src="<?php echo base_url().'uploads/subcategory/800x800_l.png'; ?>" alt="Thumb">
                               
                                </a>
							
							<?php else: ?>
                                <a href="#">
                                    <img src="<?php echo base_url().'uploads/subcategory/800x800_l.png'; ?>" alt="Thumb">
                                </a>
							
							<?php endif; ?>
                               
                            </div>
                            <div class="info">
                                <div class="top-info">
                                    <div class="rating">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star-half-alt"></i>
                                        <span>4.8 (867)</span>
                                    </div>
                                    <div class="price">
                                       <?php 
									$prices = array_filter(array($exam['price'], $exam['half_price'], $exam['quart_price']));
									// if(!empty($prices)) 
									// echo currency(min(array_filter($prices))); 
									// else
									echo currency($exam['price']);
                                    ?>
                                    </div>
                                </div>
                                <div class="meta">
                                    <ul>
                                        <li>
                                            <img src="assets/frontend/img/logox100.png" alt="Advisor">
                                            <a href="#">QuizArt</a>
                                             <!-- in <a href="#">Programming</a> -->
                                        </li>
                                    </ul>
                                </div>
                                <h4>
                                    <a href="#"><?php echo $exam['name']; ?></a>
                                </h4>
                                <p>
                                    While quizzes might not be the most imaginative way to learn, they're nevertheless beneficial for memorising facts and measuring knowledge.
                                </p>
                                <div class="bottom-info">
                                    <div class="course-info">
                                        <ul>
                                            <li><i class="fas fa-clock"></i> 08:27:00</li>
                                            <li><i class="fas fa-list-ul"></i> 65</li>
                                            <li><i class="fas fa-user"></i> 6K</li>
                                        </ul>
                                    </div>
                                     <!-- 1st buttom -->
                                       <?php
								if($this->session->userdata('user_login') && array_search($exam['id'], $enroll_cat) !== false):
							?>
                                    <div class="enroll">
                                      
                                        <a class="btn btn-success effect btn-sm" href="">Enrolled</a>
                                    </div>
                                    	<?php else:	?>
                                    <!-- 2nd buttom -->
                                     <div class="enroll">
                                       
                                        <a class="btn  effect btn-sm <?php echo ($exam['disabled']==1 ? 'btn-secondary' : 'btn-theme'); ?> <?php echo ($exam['disabled']==1 ? 'disabled' : '"'); ?>" href="<?php echo ($exam['disabled']==1 ?  'javascript:void(0)' : (site_url('home/category/'). slugify($exam['name']) .'/'.$exam['id'])); ?>">
                                        <?php echo ($exam['disabled']==1 ? 'Coming Soon' : 'Enroll Now'); ?></a>
                                    </div>

                                     <?php
								endif;
                               ?>
                               
                                     <!-- 3rd buttom -->
                                     <!-- <div class="enroll">
                                    
                                        <a class="btn btn-theme effect btn-sm" href="#">Enrolled</a>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Single item -->
               <?php
			    }
					endforeach;
				?>   
                </div>
             
            </div>
        </div>
         <?php 
	  }
	  ?>
    </div>
 
	
	 <!-- Start Banner 
    ============================================= -->
    <div class="banner-area banner auto-height double-items p-5">
        <div id="bootocarousel" class="carousel slide carousel-fade animate_text" data-ride="carousel">

            <!-- Wrapper for slides -->
            <div class="carousel-inner">
                <?php 
				$i=-1;
				foreach($slider_lower as $slider):
				$i++;
			?> 
                <div class="carousel-item <?php if($i==0) echo 'active'; ?>">
                    <div class="box-table">
                        <div class="box-cell">
                            <div class="container">
                                <div class="row align-center">
                                    <div class="col-lg-4">
                                        <div class="content">
                                            <?php if($slider['htext']!=''): ?> 
                                            <h2 data-animation="animated fadeInRight"><strong><?php echo $slider['htext']; ?></strong></h2>
                                           <?php endif;
							if($slider['ptext']!=''):
						?> 
                                            <!-- <p data-animation="animated slideInLeft">
                                               <?php // echo $slider['ptext']; ?>
                                            </p> -->
                                            <a data-animation="animated fadeInUp" class="btn btn-md btn-gradient" href="<?php echo $slider['blink']; ?>"><?php  echo $slider['ptext']; ?></a>
                                        <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="thumb" data-animation="animated fadeInLeft">
                                            <!-- <img class="d-inline w-75 float-right" src="assets/frontend/img/2440x1578.png" alt="">  -->
                                            <img class="d-inline w-75 float-right" src="<?php echo base_url().'uploads/slider/'.$slider['image_name']; ?>" alt="Thumb">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
               
            <!-- End Wrapper for slides -->

            <!-- Left and right controls -->
            <a class="left carousel-control light" href="#bootocarousel" data-slide="prev">
                    
                <i class="ti-angle-left"></i>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control light" href="#bootocarousel" data-slide="next">
                <i class="ti-angle-right"></i>
                <span class="sr-only">Next</span>
            </a>
<?php
				endforeach;
			?> 
        </div>
    </div>
    <div class="fixed-shape-bottom">
            <img src="assets/frontend/img/shape/12.png" alt="Shape">
        </div>
            </div>
    <!-- End Banner -->


 <div class="choose-us-area  bg-gray  default-padding">
        <!-- Fixed Shpae  -->
        <div class="fixed-shape shape left bottom">
            <img src="assets/frontend/img/shape/1.png" alt="Shape">
        </div>
        <!-- End Fixed Shpae  -->
        <div class="container">
            <div class="item-box">
                <div class="row">
                    <div class="col-lg-5 left-info">
                        <h2>Why Choose Us?</h2>
                        <p>
                            Quizart pushes you to think critically and logically, which can help you develop your problem-solving and critical thinking abilities. You can increase your knowledge and develop your current abilities by signing up and completing quizzes on a variety of subjects. 
                        </p>
                        <p>
                        You can improve your resume and position yourself as a more desirable job applicant by contributing your knowledge and abilities through the creation of quizzes. Join our quiz website now to take advantage of the chance to learn, earn, and have fun!

                        </p>
                        <a data-animation="animated fadeInUp" class="btn btn-md btn-gradient" href="#">Discover More</a>
                    </div>
                    <div class="col-lg-6 offset-lg-1 right-info">
                        <ul>
                            <li>
                                <i class="fas fa-check"></i>
                                <h4>QuizArt is all that You Need</h4>
                                <p>
                                   The best and most effective study tools for passing any test. Largest question library with the most thorough justifications. The most strategic route to your objectives.
                                </p>
                            </li>
                            <li>
                                <i class="fas fa-check"></i>
                                <h4>Expert Panel</h4>
                                <p>
                                    Exhaustive collection of contributors. Most knowledgeable professionals will validate and refresh the study materials. The most commonly consulted study material to meet the moment's demand.

                                </p>
                            </li>
                            <li>
                                <i class="fas fa-check"></i>
                                <h4>Cash Rewards</h4>
                                <p>
                                    The only quiz where a person wins every two attempts is this one. Huge and Several Prizes. The lucky and regular winners will both receive enormous rewards.

								</p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
            </div>
            <!-- </div> -->
             <!-- Star Scholarship Area
    ============================================= -->
    <div class="scholarship-area  default-padding">
        <div class="container">
            <div class="item-box">
                <div class="row align-center">
                    <div class="col-lg-6 thumb">
                        <div class="thumb-box">
                            <img src="assets/frontend/img/illustration/5.png" alt="Thumb">
                        </div>
                    </div>
                    <div class="col-lg-6 info">
                        <h2>How QuizArt Works?</h2>
                        <p>
                          On a variety of subjects, including science, engineering, and medicine, QuizArt offers a large collection of quizzes and study materials. QuizArt has something for everyone, whether you are a homemaker or are just seeking to learn something new. The steps to using QuizArt are as follows:
                        </p>
                        <ul>
                            <li>
                                <div class="content"> 
									<!-- <i class="fa fa-book" aria-hidden="true"></i> -->
                                    <h4>Find Courses</h4>
                                    <p>
                                       Choose your preferred subject from a list of 31 categories of courses on QuizArt. 
                                    </p>
                                </div>
                            </li>
                            <li>
                                <div class="content">
									<!-- <i class="fa fa-file-text" aria-hidden="true"></i> -->
                                    <h4>View Course Information</h4>
                                    <p>
                                    Each course includes a list of related categories. examine the details of any course and select your top choice. 
                                    </p>
                                </div>
                            </li>
							  <li>
                                <div class="content">
									<!-- <i class="fa fa-user" aria-hidden="true"></i> -->
                                    <h4>Register & Get Enrolled</h4>
                                    <p>
                                     Simply fill out a form to register with Quizart and begin studying right away.
                                    </p>
                                </div>
                            </li>
                        </ul>
                        <a class="btn btn-md btn-gradient" href="#"  data-toggle="modal" data-target="#signUpModal">Register Now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Scholarship Us -->
<!-- <section class="why-choose-us">
    
  <div class="">
    <div class="row">
      <div class="col-lg-12 col-md-12">
        <div class="image"> 
        	<img class="d-inline w-100" src="https://quizart.co.in/assets/frontend/img/WHY_CHOOSE_US_01.jpg" alt="">
        
        </div>
			</div>
		</div>
	</div>
</section> -->
                    
      <!-- <div class="col-lg-6 col-md-12">
        <div class="why-choose ptb-100">
          <h3>Why Choose Us</h3>       
          <div class="single-choose">
            <div class="icon">
              <i class="icofont-book-alt"></i>
						</div>

            <div class="content">
              <h4>WHAT YOU NEED IS HERE</h4>
              <h5 class="text-white">
              	<ul>
              		<li>Most appropriate and useful study material to crack any exam.</li>
                  <li>Biggest question bank with most comprehensive explanations.</li>
								  <li>Most Strategic pathway to achieve your goals.</li>
								</ul>
							</h5>
						</div>
					</div>
          
          <div class="single-choose">
            <div class="icon">
              <i class="icofont-teacher"></i>
						</div>
                                
            <div class="content">
              <h4>EXPERT PANEL</h4>
              <h5 class="text-white">
              	<ul>
              		<li>Exhaustive list of contributors.</li>
              		<li>Most experienced experts to verify and update the study material.</li>
									<li>Most frequently reviewed study material to fit the need of the hour.</li>
								</ul>
							</h5>
						</div>
					</div>
                            
          <div class="single-choose mb-0">
            <div class="icon">
              <i class="icofont-money"></i>
						</div>
            <div class="content">
              <h4>CASH PRIZES</h4>
              <h5 class="text-white">
              	<ul>
              		<li>This is the only quiz where every second user is a winner.</li>
              		<li>Massive and Numerous Prizes.</li>
								  <li>Equally huge prizes for the lucky ones and regular ones.</li>
								</ul>
							</h5>
						</div>
					</div>
				</div>
			</div> -->
		
		
		<!--<section class="fun-facts-area facts-bg ptb-100">
			<div class="container-lg">
			<div class="row" style="margin-top:35px;margin-bottom:35px;">
			<div class="col-md-1"></div>
			<div class="col"><p style="text-align:center;font-size:20px;color:#FF8601">Percentage increase in database every 3 months</p><br><div class="bar_container">
			<div id="main_container">
			<div id="pbar" class="progress-pie-chart" data-percent="0">
			<div class="ppc-progress">
			<div class="ppc-progress-fill" id="progress-fill"></div>
			</div>
			<div class="ppc-percents" id="ppc-percents">
			<div class="pcc-percents-wrapper">
			<span>%</span>
			</div>
			</div>
			</div>
			
			<progress style="display: none" id="progress_bar" value="0" max="<?php echo get_frontend_settings('que_inc_per'); ?>"></progress>
			</div>
			</div>
			</div>
			<div class="col"><p style="text-align:center;font-size:20px;color:#FF4E4E">Average percentage of questions asked in different competitive exams from our database
			</p><div class="bar_container">
			<div id="main_container">
			<div id="pbar1" class="progress-pie-chart" data-percent="0">
			<div class="ppc-progress">
			<div class="ppc-progress-fill" id="progress-fill1"></div>
			</div>
			<div class="ppc-percents" id="ppc-percents1">
			<div class="pcc-percents-wrapper">
			<span>%</span>
			</div>
			</div>
			</div>
			
			<progress style="display: none" id="progress_bar1" value="0" max="<?php echo get_frontend_settings('que_ask_per'); ?>"></progress>
			</div>
			</div></div>
			
		<!--        <div class="col"><p style="text-align:center;color:#FF8601">real time toppers graphs course wise</p><div class="bar_container">-->
		<!--<div id="main_container">-->
		<!--<div id="pbar2" class="progress-pie-chart" data-percent="0">-->
		<!--<div class="ppc-progress">-->
		<!--<div class="ppc-progress-fill" id="progress-fill2"></div>-->
		<!--</div>-->
		<!--<div class="ppc-percents" id="ppc-percents2">-->
		<!--<div class="pcc-percents-wrapper">-->
		<!--<span>%</span>-->
		<!--</div>-->
		<!--</div>-->
		<!--</div>-->
		<!--<progress style="display: none" id="progress_bar2" value="0" max="<?php echo get_frontend_settings('real_topper'); ?>"></progress>-->
		<!--</div>-->
		<!--</div></div>-->
        <!--<div class="col-1"></div>
			</div>
			</div>
		</section>-->
		
		
<!-- <section class="how-it-works ptb-100">
  <div class="container">
    <div class="section-title">
      <u><h3>How It Works<span>?</span></h3></u>
		</div>
    <br>
    <div class="row">
      <div class="col-lg-4 col-md-6">
        <div class="work-process">
          <i class="icofont-search-document"></i>
          <h3>Search Courses</h3>
				</div>
			</div>
                
      <div class="col-lg-4 col-md-6">
        <div class="work-process">
          <i class="icofont-info"></i>
          <h3>View Course Details</h3>
				</div>
			</div>
                
      <div class="col-lg-4 col-md-6 offset-md-3 offset-lg-0">
        <div class="work-process">
          <i class="icofont-like"></i>
          <h3>Register & Get Enrolled</h3>
				</div>
			</div>
                
      <div class="col-lg-12 col-md-12">
        <div class="view-all text-center">
          <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#signUpModal">Register Now <i class="icofont-rounded-double-right"></i></a>
				</div>
			</div>
		</div>
	</div>
</section> -->
		
		<!--<section class="top-winners text-white">
			<div class="container ptb-100">
            <div class="section-title">
			<h3 class="text-white">Top 3 Winners</h3>
			</div>
            <div class="offset-md-4 col-md-4 topper-slider">
			<div class="slider-for">
			<?php foreach($online_exam->result_array as $subcategory): ?>
			<div class="title"><?php echo $subcategory['name']; ?></div>
			<?php endforeach; ?>
			</div>
            </div>
			<div class="slider-nav">
			<?php foreach($online_exam->result_array as $subcategory): ?>
			<div class="col">
			<ul>
			<?php 
				
				foreach($winners as $key):
				if($key->sub_category_id == $subcategory['id']):
			?>
			<li>
			<div>
			<img  src="<?php echo $key->image?>" alt="<?php echo $key->name?>" >
			<div class="title"><?php echo $key->name?></div>
			</div>
			</li>
			<?php endif;
			endforeach; ?>
			</ul>
			</div>
			<?php endforeach; ?>
			</div>
			</div>
		</section>-->
		
		<script type="text/javascript">
			$(document).ready(function() {
				// topper slider
				$('.slider-for').slick({
					slidesToShow: 1,
					slidesToScroll: 1,
					fade: true,
					asNavFor: '.slider-nav',
					autoplay: true,
					prevArrow:false,
					nextArrow:false,
					//  prevArrow:"<img class='a-left control-c prev slick-prev' src='<?php echo base_url().'assets/frontend/img/icons/prev_arrow.png'; ?>'>",
					//  nextArrow:"<img class='a-right control-c next slick-next' src='<?php echo base_url().'assets/frontend/img/icons/next_arrow.png'; ?>'>",
					onAfterChange:function(slickSlider,i){
						//remove all active class
						$('.slider-nav .slick-slide').removeClass('slick-active');
						//set active class for current slide
						$('.slider-nav .slick-slide').eq(i).addClass('slick-active');         
					}
				});
				$('.slider-nav').slick({
					slidesToShow: 1,
					slidesToScroll: 1,
					arrows: true,
					asNavFor: '.slider-for',
					dots: false,
					responsive: [
					{
						breakpoint: 800,
						settings: {
							slidesToShow: 2,
							slidesToScroll: 2,
							//autoplay: true,
							//autoplaySpeed: 5000
						}
					},
					{
						breakpoint: 600,
						settings: {
							slidesToShow: 2,
							slidesToScroll: 2,
							//autoplay: true,
							//autoplaySpeed: 2000
						}
					},
					{
						breakpoint: 480,
						settings: {
							slidesToShow: 1,
							slidesToScroll: 1,
							//autoplay: true,
							//autoplaySpeed: 2000
						}
					}
					]
					
				});
				$('.slider-nav .slick-slide').eq(0).addClass('slick-active');
				
				// end topper slider
				var progressbar = $('#progress_bar');
				max = progressbar.attr('max');
				time = (1000 / max) * 5;
				value = progressbar.val();
				
				var progressbar2 = $('#progress_bar2');
				max2 = progressbar2.attr('max');
				time2 = (1000 / max2) * 5;
				value2 = progressbar2.val();
				
				var progressbar1 = $('#progress_bar1');
				max1 = progressbar1.attr('max');
				time1 = (1000 / max1) * 5;
				value1 = progressbar1.val();
				
				var loading = function() {
					if (value < max) {
						value += 1;
						addValue = progressbar.val(value);
					}
					if (value2 < max2) {
						value2 += 1;
						addValue2 = progressbar2.val(value2);
					}
					if (value1 < max1) {
						value1 += 1;
						addValue1 = progressbar1.val(value1);
					}
					
					$('#progress_bar').html(value + '%');
					$('#progress_bar2').html(value2 + '%');
					$('#progress_bar1').html(value1 + '%');
					
					var $ppc = $('#pbar'),
					deg = 360 * value / 100;
					if (value > 50) {
						$ppc.addClass('gt-50');
					}
					
					var $ppc2 = $('#pbar2'),
					deg2 = 360 * value2 / 100;
					if (value2 > 50) {
						$ppc2.addClass('gt-50');
					}
					
					var $ppc1 = $('#pbar1'),
					deg1 = 360 * value1 / 100;
					if (value1 > 50) {
						$ppc1.addClass('gt-50');
					}
					
					$('#progress-fill').css('transform', 'rotate(' + deg + 'deg)');
					$('#progress-fill1').css('transform', 'rotate(' + deg1 + 'deg)');
					$('#progress-fill2').css('transform', 'rotate(' + deg2 + 'deg)');
					
					$('#ppc-percents span').html(value + '%');
					$('#ppc-percents1 span').html(value1 + '%');
					$('#ppc-percents2 span').html(value2 + '%');
					var highestMax = Math.max(max, max1, max2);
					var highestValue = Math.max(value, value1, value2);
					if (highestValue == highestMax) {
						clearInterval(animate);
					}
				};
				
				var animate = setInterval(function() {
					loading();
				}, time);
			});
			
		</script>
		