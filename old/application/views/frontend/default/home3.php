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
                <li data-target="#bs4-slide-carousel" data-slide-to="<?php echo $i; ?>" class="<?php if($i==0) echo 'active'; ?>">
                </li>
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

                    <img class="d-inline w-100" src="<?php echo base_url().'uploads/slider/'.$slider['image_name']; ?>" alt="" style="max-height: 485px">

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
<!--
<section class="home-fact-area">
  <div class="container-lg">
    <div class="row">
      <div class="col-md-4 d-flex">
        <div class="home-fact-box mr-md-auto ml-auto mr-auto">
          <i class="fas fa-bullseye float-left"></i>
          <div class="text-box">
            <h4><?php
            echo $online_exam->num_rows().' '.get_phrase('online_quiz'); ?></h4>
            
          </div>
        </div>
      </div>

      <div class="col-md-4 d-flex">
        <div class="home-fact-box mr-md-auto ml-auto mr-auto">
          <i class="fa fa-check float-left"></i>
          <div class="text-box">
            <h4><?php echo get_phrase('complete_and_detail_explainations'); ?></h4>
            
          </div>
        </div>
      </div>

      <div class="col-md-4 d-flex">
        <div class="home-fact-box mr-md-auto ml-auto mr-auto">
          <i class="fa fa-clock float-left"></i>
          <div class="text-box">
            <h4><?php echo get_phrase('attempt_quiz_on_your_schedule'); ?></h4>
            
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
-->


<section class="popular-courses-area ptb-100 mtop-slider">
  <div class="container">
    <div class="row"> 
      <div class="col-md-12 col-sm-12"> 
        <div class="nav "> 
          <?php
            $cid=0;  
            foreach ($categories as $catkey => $catvalue) 
            {
              $cid=($catkey==0 ? $catvalue['id'] : $cid);
          ?>
              <a class="btn btn-default filter-button dynamic" id="<?php echo $catvalue['id'];?>" href="javascript:void(0)" >
                <?php echo $catvalue['name'];?>
              </a>
          <?php
            }
          ?> 
        </div>

        <div class="row"> 
          <div class="gallery_product filter">
            <div id="carousel-example-multi" class="carousel slide carousel-multi-item v-2 product-carousel" data-ride="carousel">  
              <div class="carousel-inner" role="listbox" id="productslider">  
                <i class="fa fa-spinner fa-spin" style="font-size:256px; color: #fff"></i>
                <!-- <p style="height: 100%; margin-top: -16em !important; "> Loading</p> -->
              </div> 
              <!--Controls-->
              <div class="controls-top s-sliderposition my-3">
                <a class="btn-floating s-arrowimg1st btn-sm" href="#carousel-example-multi" data-slide="prev">
                  <i class="fas fa-chevron-left"></i></a>
                <a class="btn-floating s-arrowimg btn-sm" href="#carousel-example-multi" data-slide="next">
                  <i class="fas fa-chevron-right"></i></a>
              </div>
              <!--/.Controls-->  
            </div>
          </div>
        </div>  

      </div>
    </div>
  </div>
</section> 
<section class="instructsp">
  <div class="container">
    <div class="row">
      <div class="col-md-4">
        <img src="https://lh3.googleusercontent.com/proxy/txsOvsbYzb47fvxhsEHMlnB5RjLs2X0nsLGNL-6GvHLxZyc9I6WWHAd-u_fKkxuXDFJLfgZzQADJPmbvwBJAkjwVKYh99PLJEa9VJqAa74bGlXvwoXy8vReIvFQZQGope3luJK4Y1FXamVzkmR7WyQQmYX4atPCm-TQwqB0p9AS0RwvCCKGD3pZIngRZh7hSkDUR" width="300" heigth="300" alt="">
      </div>
      <div class="col-md-8">
        <div class="instructor">
        <h4>Become an Student</h4>
        <p>Top instractor from around the world teach millions of students on QuizArt. We provide 
        the tools and skills to teach what you love</p>
        <a href="javascript:void(0);" onclick="$('.btn-sign-up')[0].click();"><button class="btn btn-primary">Start Learning today</button></a>
        </div>
      </div>
    </div>
  </div>
</section>


<section class="popular-courses-area s-productspecing">
  <div class="container">
    <div class="section-title">
      <u><h3>Quizes</h3></u>
    </div>

    <div class="row">
      <div id="carousel-example-multi1" class="carousel slide carousel-multi-item v-2 product-carousel" data-ride="carousel"> 
        <!--Controls-->
        <div class="controls-top s-sliderposition-b my-3">
          <a class="btn-floating s-arrowimg1st btn-sm" href="#carousel-example-multi1" data-slide="prev"><i class="fas fa-chevron-left"></i></a>
          <a class="btn-floating s-arrowimg btn-sm" href="#carousel-example-multi1" data-slide="next"><i class="fas fa-chevron-right"></i></a>
        </div>
        <!--/.Controls-->  
        <div class="carousel-inner" role="listbox"> 
          <?php
          $total = $online_exam->num_rows();
          foreach($online_exam->result_array() as $keys=>$exam): 
            if($keys%4 ==0) { 
              ?> 
              <div class="carousel-item <?php echo $keys ==0 ? 'active' : ''; ?> mx-auto"> 
                <div class="row">
                <?php } ?>
                <div class="col-lg-3 col-md-3 col-sm-3">
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
                      elseif($this->session->userdata('user_login')):
                        ?>
                        <h4><a href="<?php echo site_url('home/checkout/').$exam['id']; ?>"><button class="btn btn-primary">Enroll Now</button></a></h4>
                        <?php
                      else:
                        ?>
                        <h4><a href="<?php echo site_url('home/paymentRegistration/').$exam['id']; ?>"><button class="btn btn-primary">Enroll Now</button></a></h4>
                        <?php
                      endif;
                      ?>
                      <h4 class="price">
                        <?php 
                        // $prices = array_filter(array($exam['price'], $exam['half_price'], $exam['quart_price']));
                        // if(!empty($prices)) 
                        //   echo currency(min(array_filter($prices))); 
                        // else
                          echo currency($exam['price']);
                        ?>
                      </h4>
                    </div>
                  </div>
                </div>
                <?php  if($keys%4 ==3 || ($total==$keys+1)) { ?>
                </div>
              </div>  
            <?php } ?>
            <?php
          endforeach;
          ?>   
        </div>
      </div>                 
    </div>
  </div>
</section>

<section class="instructsp">
  <div class="container">
    <div class="row">
      <div class="col-md-8">
        <div class="instructor">
        <h4>Become an instructor</h4>
        <p>All over the world, instructors are collaborate with us to enhance our students skills.</p>
        <a href="javascript:void(0);" onclick="$('.btn-sign-up')[0].click();"><button class="btn btn-primary">Start teaching today</button></a>
        </div>
      </div>
      
      <div class="col-md-4">
        <img src="<?php echo base_url().'assets/frontend/img/student.jpg'; ?>" alt="">
       
      </div>
    </div>
  </div>
</section>

<section class="slider_lower" style="margin-bottom:10px">
  <div id="bs4-slide-carousel1" class="carousel slide" data-ride="carousel" >

    <ol class="carousel-indicators">
      <?php
      for($i=0; $i<count($slider_lower); $i++):
        ?>
        
        <li data-target="#bs4-slide-carousel" data-slide-to="<?php echo $i; ?>" class="<?php if($i==0) echo 'active'; ?>">

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
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-6 col-md-12">
        <div class="image"></div>
      </div>

      <div class="col-lg-6 col-md-12">
        <div class="why-choose ptb-100">
          <h3>Why Choose Us</h3>

          <div class="single-choose">
            <div class="icon">
              <i class="icofont-book-alt"></i>
            </div>

            <div class="content">
              <h4>WHAT YOU NEED IS HERE</h4>
              <h5 class="text-white"><ul><li>Most appropriate and useful study material to crack any exam.</li>
              <li>Biggest question bank with most comprehensive explanations.</li>
              <li>Most Strategic pathway to achieve your goals.</li></ul></h5>
            </div>
          </div>

          <div class="single-choose">
            <div class="icon">
              <i class="icofont-teacher"></i>
            </div>

            <div class="content">
              <h4>EXPERT PANEL</h4>
              <h5 class="text-white"><ul><li>Exhaustive list of contributors.</li><li>Most experienced experts to verify and update the study material.</li>
              <li>Most frequently reviewed study material to fit the need of the hour.</li></ul></h5>
            </div>
          </div>
              
          <div class="single-choose mb-0">
            <div class="icon">
              <i class="icofont-money"></i>
            </div>
            
            <div class="content">
              <h4>CASH PRIZES</h4>
              <h5 class="text-white"><ul><li>This is the only quiz where every second user is a winner.</li><li>Massive and Numerous Prizes.</li>
                <li>Equally huge prizes for the lucky ones and regular ones.</li></ul></h5>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- <section class="fun-facts-area facts-bg ptb-100">
  <div class="container-lg">
    <div class="row" style="margin-top:35px;margin-bottom:35px;">
      <div class="col-md-1"></div>
      <div class="col">
        <p style="text-align:center;font-size:20px;color:#FF8601">Percentage increase in database every 3 months</p><br>
        <div class="bar_container">
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
      <div class="col">
        <p style="text-align:center;font-size:20px;color:#FF4E4E">Average percentage of questions asked in different competitive exams from our database
        </p>
        <div class="bar_container">
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
        </div>
      </div> 
      <div class="col-1"></div>
    </div>
  </div>
</section> -->
 
<!--
<section class="top-winners text-white">
  <div class="container ptb-36">
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
</section>
-->
<section class="how-it-works">
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

    <script type="text/javascript">
      // $(document).ready(function() {
      //   // topper slider
      //   $('.slider-for').slick({
      //     slidesToShow: 1,
      //     slidesToScroll: 1,
      //     fade: true,
      //     asNavFor: '.slider-nav',
      //     autoplay: true,
      //     prevArrow:false,
      //     nextArrow:false,
      //     //  prevArrow:"<img class='a-left control-c prev slick-prev' src='<?php echo base_url().'assets/frontend/img/icons/prev_arrow.png'; ?>'>",
      //     //  nextArrow:"<img class='a-right control-c next slick-next' src='<?php echo base_url().'assets/frontend/img/icons/next_arrow.png'; ?>'>",
      //     onAfterChange:function(slickSlider,i){
      //       //remove all active class
      //       $('.slider-nav .slick-slide').removeClass('slick-active');
      //       //set active class for current slide
      //       $('.slider-nav .slick-slide').eq(i).addClass('slick-active');         
      //     }
      //   });
      //   $('.slider-nav').slick({
      //     slidesToShow: 1,
      //     slidesToScroll: 1,
      //     arrows: true,
      //     asNavFor: '.slider-for',
      //     dots: false,
      //     responsive: [
      //     {
      //       breakpoint: 800,
      //       settings: {
      //         slidesToShow: 2,
      //         slidesToScroll: 2,
      //         //autoplay: true,
      //         //autoplaySpeed: 5000
      //       }
      //     },
      //     {
      //       breakpoint: 600,
      //       settings: {
      //         slidesToShow: 2,
      //         slidesToScroll: 2,
      //         //autoplay: true,
      //         //autoplaySpeed: 2000
      //       }
      //     },
      //     {
      //       breakpoint: 480,
      //       settings: {
      //         slidesToShow: 1,
      //         slidesToScroll: 1,
      //         //autoplay: true,
      //         //autoplaySpeed: 2000
      //       }
      //     }
      //     ]
          
      //   });

      //   $('.slider-nav2').slick({
      //     slidesToShow: 1,
      //     slidesToScroll: 1,
      //     arrows: true,
      //     asNavFor: '.slider-for',
      //     dots: false,
      //     responsive: [
      //     {
      //       breakpoint: 800,
      //       settings: {
      //         slidesToShow: 2,
      //         slidesToScroll: 2,
      //         //autoplay: true,
      //         //autoplaySpeed: 5000
      //       }
      //     },
      //     {
      //       breakpoint: 600,
      //       settings: {
      //         slidesToShow: 2,
      //         slidesToScroll: 2,
      //         //autoplay: true,
      //         //autoplaySpeed: 2000
      //       }
      //     },
      //     {
      //       breakpoint: 480,
      //       settings: {
      //         slidesToShow: 1,
      //         slidesToScroll: 1,
      //         //autoplay: true,
      //         //autoplaySpeed: 2000
      //       }
      //     }
      //     ]
          
      //   });
      //   $('.slider-nav .slick-slide .slider-nav2').eq(0).addClass('slick-active');
        
      //   // end topper slider
      //   var progressbar = $('#progress_bar');
      //   max = progressbar.attr('max');
      //   time = (1000 / max) * 5;
      //   value = progressbar.val();
        
      //   var progressbar2 = $('#progress_bar2');
      //   max2 = progressbar2.attr('max');
      //   time2 = (1000 / max2) * 5;
      //   value2 = progressbar2.val();
        
      //   var progressbar1 = $('#progress_bar1');
      //   max1 = progressbar1.attr('max');
      //   time1 = (1000 / max1) * 5;
      //   value1 = progressbar1.val();
        
      //   var loading = function() {
      //     if (value < max) {
      //       value += 1;
      //       addValue = progressbar.val(value);
      //     }
      //     if (value2 < max2) {
      //       value2 += 1;
      //       addValue2 = progressbar2.val(value2);
      //     }
      //     if (value1 < max1) {
      //       value1 += 1;
      //       addValue1 = progressbar1.val(value1);
      //     }
          
      //     $('#progress_bar').html(value + '%');
      //     $('#progress_bar2').html(value2 + '%');
      //     $('#progress_bar1').html(value1 + '%');
          
      //     var $ppc = $('#pbar'),
      //     deg = 360 * value / 100;
      //     if (value > 50) {
      //       $ppc.addClass('gt-50');
      //     }
          
      //     var $ppc2 = $('#pbar2'),
      //     deg2 = 360 * value2 / 100;
      //     if (value2 > 50) {
      //       $ppc2.addClass('gt-50');
      //     }
          
      //     var $ppc1 = $('#pbar1'),
      //     deg1 = 360 * value1 / 100;
      //     if (value1 > 50) {
      //       $ppc1.addClass('gt-50');
      //     }
          
      //     $('#progress-fill').css('transform', 'rotate(' + deg + 'deg)');
      //     $('#progress-fill1').css('transform', 'rotate(' + deg1 + 'deg)');
      //     $('#progress-fill2').css('transform', 'rotate(' + deg2 + 'deg)');
          
      //     $('#ppc-percents span').html(value + '%');
      //     $('#ppc-percents1 span').html(value1 + '%');
      //     $('#ppc-percents2 span').html(value2 + '%');
      //     var highestMax = Math.max(max, max1, max2);
      //     var highestValue = Math.max(value, value1, value2);
      //     if (highestValue == highestMax) {
      //       clearInterval(animate);
      //     }
      //   };
        
      //   var animate = setInterval(function() {
      //     loading();
      //   }, time);
      // });

    
      $(document).ready(function() {
        dynamicslider('<?php echo $cid;?>');
        $('.dynamic').click(function() {
          var id = $(this).attr("id");
          dynamicslider(id);
        });
        function dynamicslider(id) {
          var html='';
          $('#productslider').html(html);
          $.ajax({
            url: '<?php echo base_url('home/getsubcategory/')?>' + id,
            type:'POST',
            data: {id: id},
            dataType:'json',
          }).done(function(response){ 
            if(response!='0') { 
              $.each(response, function (index, value) { 
                if(index%4==0) {
                  if(index==0)  {
                    html = html + `<div class="carousel-item active mx-auto">
                      <div class="row">`;
                  } else {
                    html = html + `<div class="carousel-item mx-auto">
                      <div class="row">`;
                  } 
                }
                    html = html + `<div class="col-md-3 col-sm-3">
                      <div class="card mb-2 s-image">
                        <div class="view overlay">`;
                        if(value.image_name) {
                          html = html + `<img src="<?php echo base_url() . 'uploads/subcategory/'; ?>` + value.image_name + `" alt="" class="card-img-top" />`;
                        } else {
                          html = html + `<img class="card-img-top" src="<?php echo base_url();?>uploads/subcategory/1587210480_thumb.jpg" alt="Card image cap" class="card-img-top" />`;
                        } 
                    html = html + `<a href="#">
                            <div class="mask rgba-white-slight"></div>
                          </a>
                        </div>
                        <div class="p-content">
                          <h2><a href="#">` + value.name + `</a></h2>
                        </div>
                        <div class="p-content-button">
                          <h4><a href="home/paymentRegistration/` + value.id + `"><button class="btn btn-primary">Enroll Now</button></a></h4>
                          <h4 class="p-price">  ₹` + value.price + `  </h4>
                        </div>

                      </div>
                    </div>`;
                if(index%4==3 || (index==response.length-1)) {
                  html = html + `</div>
                  </div>`;
                } 
              }); 
              $('#productslider').html(html);
            }  
          });  
          
        }
      });
    </script>