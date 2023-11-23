<section class="">
  <div class="">
    <div class="row">
      <div class="col">
        <div class="">
          <div id="bs4-slide-carousel" class="carousel slide" data-ride="carousel" >	
            <ol class="carousel-indicators">
              <?php
              for($i=0; $i<count($sliders); $i++):
							?>
                <li data-target="#bs4-slide-carousel" data-slide-to="<?php echo $i; ?>" class="<?php if($i==0) echo 'active'; ?>"></li> 
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
									<img class="d-inline w-100" src="<?php echo base_url().'uploads/slider/'.$slider['image_name']; ?>" alt="">
										
									<!--Captions for the slides go here -->
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
										<!--Captions ending here for slide 1-->  
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

<section class="home-fact-area">
	<div class="container-lg">
		<div class="row">
			<div class="col-md-4 d-flex">
				<div class="home-fact-box mr-md-auto ml-auto mr-auto">
					<i class="fas fa-bullseye float-left"></i>
					<div class="text-box">
						<h4><?php
						echo $online_exam->num_rows().' '.get_phrase('online_quiz'); ?></h4>
						<!--- <p><?php echo get_phrase('explore_a_variety_of_fresh_topics'); ?></p>-->
					</div>
				</div>
			</div>
			
			<div class="col-md-4 d-flex">
				<div class="home-fact-box mr-md-auto ml-auto mr-auto">
					<i class="fa fa-check float-left"></i>
					<div class="text-box">
						<h4><?php echo get_phrase('complete_and_detail_explainations'); ?></h4>
						<!---  <p><?php echo get_phrase('find_the_right_course_for_you'); ?></p> -->
					</div>
				</div>
			</div>
			
			<div class="col-md-4 d-flex">
				<div class="home-fact-box mr-md-auto ml-auto mr-auto">
					<i class="fa fa-clock float-left"></i>
					<div class="text-box">
						<h4><?php echo get_phrase('attempt_quiz_on_your_schedule'); ?></h4>
						<!---   <p><?php echo get_phrase('learn_on_your_schedule'); ?></p>--> 
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
	
<section class="popular-courses-area ptb-100">
	<div class="container">
		<div class="section-title">
			<u><h3>Our Courses</h3></u>
		</div>
		<?php 
		foreach ($categories as $catkey => $catvalue) 
    {
    ?>
      <h4 style="text-align: center; font-weight: bold;background: linear-gradient(-45deg,#427CDF,#6e1a52);color:white;"><?php echo $catvalue['name'];?></h4>
			<div class="row">
				<?php
					foreach($online_exam->result_array() as $exam):
				  if($exam['parent']==$catvalue['id']) { 
				?>
				<div class="col-lg-3 col-md-6">
					<div class="single-courses-item">
						<div class="courses-img">
							<?php if($exam['image_name'] != ''): ?>
							<img src="<?php echo base_url().'uploads/subcategory/'.$exam['image_name']; ?>" alt="">
							<?php else: ?>
							<img src="<?php echo base_url().'uploads/subcategory/quiz.jpg'; ?>" alt="">
							<?php endif; ?>
						</div>
						
						<div class="courses-content">
							<h3><a href="#"><?php echo $exam['name']; ?></a></h3>
						</div> 
						
						<div class="courses-content-bottom">
							<?php
								if($this->session->userdata('user_login') && array_search($exam['id'], $enroll_cat) !== false):
							?>
							  <h4><button class="btn btn-success">Enrolled</button></h4>
							<?php
								else:
							?>
							  <h4><a href="<?php echo site_url('home/category/'). slugify($exam['name']) .'/'.$exam['id']; ?>"><button class="btn btn-primary">Enroll Now</button></a></h4>
              <?php
								endif;
							/*
							<h4><a href="<?php echo site_url('home/checkout/').$exam['id']; ?>"><button class="btn btn-primary">Enroll Now</button></a></h4>
							<?php
								else:
							?>
							<h4><a href="<?php echo site_url('home/paymentRegistration/').$exam['id']; ?>"><button class="btn btn-primary">Enroll Now</button></a></h4>
							<?php
								endif;*/
							?>
							<h4 class="price">
								<?php 
									$prices = array_filter(array($exam['price'], $exam['half_price'], $exam['quart_price']));
									// if(!empty($prices)) 
									// echo currency(min(array_filter($prices))); 
									// else
									echo currency($exam['price']);
								?>
							</h4>
						</div>
					</div>
				</div>
				<?php
			    }
					endforeach;
				?>                    
			</div>
	  <?php 
	  }
	  ?>
	</div>
</section>
	
	
<section class="slider_lower">
	<div id="bs4-slide-carousel1" class="carousel slide" data-ride="carousel" >
		<ol class="carousel-indicators">
			<?php
				for($i=0; $i<count($slider_lower); $i++):
			?>
			  <li data-target="#bs4-slide-carousel" data-slide-to="<?php echo $i; ?>" class="<?php if($i==0) echo 'active'; ?>"></li>
			<?php
				endfor;
			?> 
		</ol>
		<div class="carousel-inner" style="width: 100%;">
			<?php 
				$i=-1;
				foreach($slider_lower as $slider):
				$i++;
			?> 
				<div class="carousel-item <?php if($i==0) echo 'active'; ?>">
                      
					<img class="d-inline w-100" src="<?php echo base_url().'uploads/slider/'.$slider['image_name']; ?>" alt="">
                      
					<!--Captions for the slides go here -->
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
					<!--Captions ending here for slide 1-->              
				</div>
			<?php
				endforeach;
			?> 
		</div>
			
		<a class="carousel-control-prev" href="#bs4-slide-carousel1" role="button" data-slide="prev">
			
			<span class="carousel-control-prev-icon" aria-hidden="true"></span>
			
			<span class="sr-only">Previous</span>
			
		</a>
		
		<a class="carousel-control-next" href="#bs4-slide-carousel1" role="button" data-slide="next">
			
			<span class="carousel-control-next-icon" aria-hidden="true"></span>
			
			<span class="sr-only">Next</span>
			
		</a> 
			
	</div>		
</section>

<section class="why-choose-us">
    <!--<div class="container-fluid">-->
  <div class="">
    <div class="row">
      <div class="col-lg-12 col-md-12">
        <div class="image"> 
        	<img class="d-inline w-100" src="https://www.quizart.co.in/assets/frontend/img/WHY_CHOOSE_US_01.jpg" alt="">
        </div>
			</div>
					</div>
	</div>
</section>

<!--<section class="why-choose-us">
  <div class="">
    <div class="row">
      <div class="col-lg-12 col-md-12">
        <div class="image"> 
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
		
<section class="how-it-works ptb-100">
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
          <h3>Apply, Enroll or Register</h3>
				</div>
			</div>
                
      <div class="col-lg-12 col-md-12">
        <div class="view-all text-center">
          <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#signUpModal">Register Now <i class="icofont-rounded-double-right"></i></a>
				</div>
			</div>
		</div>
	</div>
</section>
		
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
		