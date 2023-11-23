<?php
    if (isset($sub_category_id)) {
        $sub_category_details = $this->crud_model->get_category_details_by_id($sub_category_id)->row_array();
        $category_details     = $this->crud_model->get_categories($sub_category_details['parent'])->row_array();
        $category_name        = $category_details['name'];
        $sub_category_name    = $sub_category_details['name'];
    }
    $sliderimg='';
    if(trim($category_name)=='Medical') {
      $sliderimg = 'slimline-01.jpg';
    } else if(trim($category_name)=='Engineering') {
      $sliderimg = 'slimline-05.jpg';
    } else if(trim($category_name)=='School') {
      $sliderimg = 'slimline-03.jpg';
    } else if(trim($category_name)=='Home Maker') {
      $sliderimg = 'slimline-02.jpg';
    } else if(trim($category_name)=='All Sector Competitive exam') {
      $sliderimg = 'slimline-04.jpg';
    }
?>

<!-- <section class="category-header-area" style="background-image: url(<?php echo base_url() . 'uploads/' . $sliderimg; ?>); background-position: center; background-repeat: no-repeat;  background-size: cover;">
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <h1 class="category-name">
    &nbsp;
  </h1>
</section> 
<div class="container-lg" style="background: #29303b;">
  <div class="row">
    <div class="col">
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo site_url('home'); ?>"><i class="fas fa-home"></i></a></li>
          <li class="breadcrumb-item">
            <a href="#">
                <?php echo $category_name; ?>
            </a>
          </li>
          <li class="breadcrumb-item active">
            <?php echo $sub_category_name; ?>
          </li>
        </ol>
      </nav> 
    </div>
  </div>
</div>


<section class="category-course-list-area" style="background-color: #f9f9f9">
  <div class="container">
    <div class="row">
      <div class="col">
        <div class="category-filter-box filter-box clearfix">
          <a href = "<?php echo site_url('home/all_category'); ?>" class="btn btn-outline-secondary all-btn"><?php echo get_phrase('all'); ?></a>

          <?php if (isset($sub_category_id)): ?>
            <div class="btn-group category-list">
              <a class="btn btn-outline-secondary dropdown-toggle" href="#"data-toggle="dropdown">
                <?php echo get_phrase('category_list'); ?>
              </a>
              <div class="dropdown-menu">
                <?php foreach ( $this->crud_model->get_sub_categories($category_details['id']) as $sub_category): ?>
                  <a class="dropdown-item" href="<?php echo site_url('home/category/'.slugify($sub_category['name']).'/'.$sub_category['id']); ?>">
                      <?php echo $sub_category['name']; ?>
                  </a>
                <?php endforeach; ?>
              </div>
            </div>
          <?php endif; ?>
        </div>
        <?php if(isset($exam) && !empty($exam)) { ?>
          <div class="row">
            <div class="col-lg-12 col-md-12">
              <div class="single-courses-item"> 
                <div class="row">
                  <div class="col-lg-3 col-md-6"> 
                    <div class="courses-img">
                      <?php  
                      if($exam['image_name'] != ''): ?>
                      <img src="<?php echo base_url().'uploads/subcategory/'.$exam['image_name']; ?>" alt="" style="width: 100%; height: 300px;" />
                      <?php else: ?>
                      <img src="<?php echo base_url().'uploads/subcategory/quiz.jpg'; ?>" alt="" style="width: 100%; height: 300px;" />
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
                        <h4><a href="<?php echo ($exam['disabled']==1 ?  'javascript:void(0)' : (site_url('home/checkout/').$exam['id'])); ?>"><button class="btn btn-primary"> <?php echo ($exam['disabled']==1 ? 'Comming Soon' : 'Enroll Now'); ?></button></a></h4>
                        <h4><a href="<?php echo ($exam['disabled']==1 ?  'javascript:void(0)' : (site_url('Checkout/trail/') . $exam['id'] .'/trial')); ?>"><button class="btn btn-primary">5 Days Trial</button></a></h4>
                      <?php
                        else:
                      ?>
                        <h4><a href="<?php echo ($exam['disabled']==1 ?  'javascript:void(0)' : (site_url('home/paymentRegistration/').$exam['id'])); ?>"><button class="btn btn-primary"><?php echo ($exam['disabled']==1 ? 'Comming Soon' : 'Enroll Now'); ?></button></a></h4>
                        <h4><a href="<?php echo ($exam['disabled']==1 ?  'javascript:void(0)' : (site_url('home/paymentRegistration/') . $exam['id'] .'/trial')); ?>"><button class="btn btn-primary">5 Days Trial</button></a></h4>
                      <?php
                        endif;
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
                  <div class="col-md-6 col-md-9"> 
                    <?php echo urldecode($exam['description']); ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
        <?php } ?>
        <div class="category-course-list">
          <ul>
            <?php
              if (isset($sub_category_id)) {
                $array = array('category_id' => $category_details['id'], 'sub_category_id' => $sub_category_id);
                $this->db->where($array);
                $this->db->where('status', 'active');
                $courses = $this->db->get('course', $per_page, $this->uri->segment(5));
              }
            foreach($courses->result_array() as $course):
            $instructor_details = $this->user_model->get_all_user($course['user_id'])->row_array();?>
            <li>
              <div class="course-box-2">
                <div class="course-image">
                  <a href="<?php echo site_url('home/course/'.slugify($course['title']).'/'.$course['id']) ?>">
                      <img src="<?php echo $this->crud_model->get_course_thumbnail_url($course['id']); ?>" alt="" class="img-fluid">
                  </a>
                </div>
                <div class="course-details">
                  <a href="<?php echo site_url('home/course/'.slugify($course['title']).'/'.$course['id']); ?>" class="course-title"><?php echo $course['title']; ?></a>
                  <a href="<?php echo site_url('home/instructor_page/'.$instructor_details['id']) ?>" class="course-instructor">
                      <span class="instructor-name"><?php echo $instructor_details['first_name'].' '.$instructor_details['last_name']; ?></span> -
                  </a>
                  <div class="course-subtitle">
                      <?php echo $course['short_description']; ?>
                  </div>
                  <div class="course-meta">
                    <span class=""><i class="fas fa-play-circle"></i>
                        <?php
                            $number_of_lessons = $this->crud_model->get_lessons('course', $course['id'])->num_rows();
                            echo $number_of_lessons.' '.get_phrase('lessons');
                         ?>
                    </span>
                    <span class=""><i class="far fa-clock"></i>
                        <?php echo $this->crud_model->get_total_duration_of_lesson_by_course_id($course['id']); ?>
                    </span>
                    <span class=""><i class="fas fa-closed-captioning"></i><?php echo ucfirst($course['language']); ?></span>
                    <span class=""><i class="fa fa-level-up"></i><?php echo ucfirst($course['level']); ?></span>
                  </div>
                </div>
                <div class="course-price-rating">
                  <div class="course-price">
                    <?php if ($course['is_free_course'] == 1): ?>
                      <span class="current-price"><?php echo get_phrase('free'); ?></span>
                    <?php else: ?>
                      <?php if($course['discount_flag'] == 1): ?>
                        <span class="current-price"><?php echo currency($course['discounted_price']); ?></span>
                        <span class="original-price"><?php echo currency($course['price']); ?></span>
                      <?php else: ?>
                        <span class="current-price"><?php echo currency($course['price']); ?></span>
                      <?php endif; ?>
                    <?php endif; ?>
                  </div>
                  <div class="rating">
                    <?php
                    $total_rating =  $this->crud_model->get_ratings('course', $course['id'], true)->row()->rating;
                    $number_of_ratings = $this->crud_model->get_ratings('course', $course['id'])->num_rows();
                    if ($number_of_ratings > 0) {
                        $average_ceil_rating = ceil($total_rating / $number_of_ratings);
                    }else {
                        $average_ceil_rating = 0;
                    }

                    for($i = 1; $i < 6; $i++):?>
                    <?php if ($i <= $average_ceil_rating): ?>
                    <i class="fas fa-star filled"></i>
                    <?php else: ?>
                    <i class="fas fa-star"></i>
                    <?php endif; ?>
                    <?php endfor; ?>
                    <span class="d-inline-block average-rating"><?php echo $average_ceil_rating; ?></span>
                  </div>
                  <div class="rating-number">
                    <?php echo $this->crud_model->get_ratings('course', $course['id'])->num_rows().' '.get_phrase('ratings'); ?>
                  </div>
                </div>
              </div>
            </li>
            <?php endforeach; ?>
          </ul> 
        </div>
        <nav>
            <?php echo $this->pagination->create_links(); ?>
        </nav>
      </div>
    </div>
  </div>
</section> -->

 <!-- Start Breadcrumb 
    ============================================= -->
    <div class="breadcrumb-area bg-gray text-center shadow dark text-light bg-cover" style="background-image: url(<?php echo base_url().'assets/frontend/img/1400x200.png'; ?>);">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <h1>Quiz Details</h1>
                    <ul class="breadcrumb">
                        <li><a href="<?php echo site_url('home'); ?>"><i class="fas fa-home"></i> Home</a></li>
                        <li><a href="#"> <?php echo $category_name; ?></a></li>
                        <li class="active"><?php echo $sub_category_name; ?></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumb -->

    <!-- Start Course Details 
    ============================================= -->
    <div class="course-details-area default-padding">
        <div class="container">
            <div class="row">
              <?php if(isset($exam) && !empty($exam)) { ?>
                <div class="col-lg-8 info">

                    <div class="top-info">
                        <h2><?php echo $exam['name']; ?> </h2>
                        <!-- <ul>
                            <li>
                                <div class="thumb">
                                    <img src="assets/img/100x100.png" alt="Thumb">
                                </div>
                                <div class="info">
                                    <span>Teacher</span>
                                    <h5>John Kanel</h5>
                                </div>
                            </li>
                            <li>
                                <div class="info">
                                    <span>Category</span>
                                    <h5>Mathematics</h5>
                                </div>
                            </li>
                            <li>
                                <div class="info">
                                    <span>Last Update</span>
                                    <h5>January 24, 2021</h5>
                                </div>
                            </li>
                        </ul> -->
                    </div>

                    <div class="main-content">
                        <div class="center-tabs">
                            <ul id="tabs" class="nav nav-tabs">
                                <li class="nav-item">
                                    <a href="" data-target="#tab1" data-toggle="tab" class="active nav-link">Description</a>
                                </li>
                                <!-- <li class="nav-item">
                                    <a href="" data-target="#tab2" data-toggle="tab" class="nav-link">Curriculum</a>
                                </li>
                                <li class="nav-item">
                                    <a href="" data-target="#tab3" data-toggle="tab" class="nav-link">Advisor</a>
                                </li>
                                <li class="nav-item">
                                    <a href="" data-target="#tab4" data-toggle="tab" class="nav-link">Reviews</a>
                                </li> -->
                            </ul>
                            <div id="tabsContent" class="tab-content">
                                <div id="tab1" class="tab-pane overview fade active show">
                                   <!-- <h4>Course Desscription</h4>  -->
                                         <?php echo urldecode($exam['description']); ?>
                                    <!-- <p>
                                        Calling nothing end fertile for venture way boy. Esteem spirit temper too say adieus who direct esteem. It esteems luckily mr or picture placing drawing no. Apartments frequently or motionless on reasonable projecting expression. Way mrs end gave tall
                                        walk fact bed.
                                    </p>
                                    <p>
                                        Placing assured be if removed it besides on. Far shed each high read are men over day. Afraid we praise lively he suffer family estate is. Ample order up in of in ready. Timed blind had now those ought set often which. Or snug dull he show more true wish.
                                        No at many deny away miss evil. On in so indeed spirit an mother. Amounted old strictly but marianne admitted. People former is remove remain as.
                                    </p>
                                    <h4>Learning Objectives</h4>
                                    <ul>
                                        <li>Be able to use simple tricks and techniques to make self-control easier.</li>
                                        <li>Actually apply these strategies and make a deliberate effort to understand their effects</li>
                                        <li>Have a huge advantage when it comes to sticking to your diet</li>
                                        <li>Meeting your fitness goals, and leading a healthier lifestyle.</li>
                                    </ul> -->
                                </div>
                                <!-- <div id="tab2" class="tab-pane curriculum fade">
                                    <p>
                                        Placing assured be if removed it besides on. Far shed each high read are men over day. Afraid we praise lively he suffer family estate is. Ample order up in of in ready. Timed blind had now those ought set often which. Or snug dull he show more true wish.
                                        No at many deny away miss evil. On in so indeed spirit an mother. Amounted old strictly but marianne admitted. People former is remove remain as.
                                    </p>
                                    <div class="accordion" id="accordionExample">
                                        <div class="card">
                                            <div class="card-header" id="headingOne">
                                                <h5 class="mb-0" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                    Java Programming
                                                </h5>
                                            </div>

                                            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                                                <div class="card-body">
                                                    <ul>
                                                        <li>
                                                            <div class="left-content">
                                                                <span>01</span>
                                                                <i class="fas fa-play-circle"></i>
                                                                <h5><a href="#">Introduction Of Java</a></h5>
                                                            </div>
                                                            <div class="right-content">
                                                                <a href="#">Preview</a>
                                                                <span><i class="fas fa-clock"></i> 19 minutes</span>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="left-content">
                                                                <span>02</span>
                                                                <i class="fas fa-file"></i>
                                                                <h5><a href="#">Basic Development</a></h5>
                                                            </div>
                                                            <div class="right-content">
                                                                <i class="fas fa-lock"></i>
                                                                <span><i class="fas fa-clock"></i> 11 minutes</span>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="card-header" id="headingTwo">
                                                <h5 class="mb-0 collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                    PHP Programming
                                                </h5>
                                            </div>
                                            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                                                <div class="card-body">
                                                    <ul>
                                                        <li>
                                                            <div class="left-content">
                                                                <span>01</span>
                                                                <i class="fas fa-play-circle"></i>
                                                                <h5><a href="#">Introduction</a></h5>
                                                            </div>
                                                            <div class="right-content">
                                                                <a href="#">Preview</a>
                                                                <span><i class="fas fa-clock"></i> 36 minutes</span>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="left-content">
                                                                <span>02</span>
                                                                <i class="fas fa-play-circle"></i>
                                                                <h5><a href="#">Benifits Of Function</a></h5>
                                                            </div>
                                                            <div class="right-content">
                                                                <i class="fas fa-lock"></i>
                                                                <span><i class="fas fa-clock"></i> 58 minutes</span>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="card-header" id="headingThree">
                                                <h5 class="mb-0 collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                    Python learning
                                                </h5>
                                            </div>
                                            <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                                                <div class="card-body">
                                                    <ul>
                                                        <li>
                                                            <div class="left-content">
                                                                <span>01</span>
                                                                <i class="fas fa-play-circle"></i>
                                                                <h5><a href="#">About Python</a></h5>
                                                            </div>
                                                            <div class="right-content">
                                                                <a href="#">Preview</a>
                                                                <span><i class="fas fa-clock"></i> 47 minutes</span>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="left-content">
                                                                <span>02</span>
                                                                <i class="fas fa-play-circle"></i>
                                                                <h5><a href="#">Python For Beginners</a></h5>
                                                            </div>
                                                            <div class="right-content">
                                                                <i class="fas fa-lock"></i>
                                                                <span><i class="fas fa-clock"></i> 44 minutes</span>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> -->
                                <!-- <div id="tab3" class="tab-pane advisor fade">
                                    <div class="advisor-items">
                                        Single Item
                                        <div class="single-item">
                                            <div class="row">
                                                <div class="col-lg-4 col-md-4 thumb">
                                                    <img src="assets/img/800x800.png" alt="Advisor">
                                                </div>
                                                <div class="col-lg-8 col-md-8 info">
                                                    <h4>Jones Mark</h4>
                                                    <span>Java Programmer</span>
                                                    <div class="rating">
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star-half-alt"></i>
                                                        <span>4.8 (867)</span>
                                                    </div>
                                                    <p>
                                                        Lasted my coming uneasy marked so should. Gravity letters it amongst herself dearest an windows by. Wooded ladies she basket season age her uneasy saw. Discourse unwilling am no described.
                                                    </p>
                                                    <ul>
                                                        <li><i class="fas fa-play"></i> 12 Courses</li>
                                                        <li><i class="fas fa-comment-alt"></i> 867 Rating</li>
                                                        <li><i class="fas fa-users"></i> 4k Students</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                         End Single Item 
                                        Single Item 
                                        <div class="single-item">
                                            <div class="row">
                                                <div class="col-lg-4 col-md-4 thumb">
                                                    <img src="assets/img/800x800.png" alt="Advisor">
                                                </div>
                                                <div class="col-lg-8 col-md-8 info">
                                                    <h4>Adom Mohaa</h4>
                                                    <span>Professor</span>
                                                    <div class="rating">
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star-half-alt"></i>
                                                        <span>4.8 (867)</span>
                                                    </div>
                                                    <p>
                                                        Lasted my coming uneasy marked so should. Gravity letters it amongst herself dearest an windows by. Wooded ladies she basket season age her uneasy saw. Discourse unwilling am no described.
                                                    </p>
                                                    <ul>
                                                        <li><i class="fas fa-play"></i> 12 Courses</li>
                                                        <li><i class="fas fa-comment-alt"></i> 867 Rating</li>
                                                        <li><i class="fas fa-users"></i> 4k Students</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        End Single Item 
                                    </div>
                                </div> -->
                                <!-- <div id="tab4" class="tab-pane reviews fade">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="avg-ratings">
                                                <h2>4.9</h2>
                                                <div class="rating">
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star-half-alt"></i>
                                                </div>
                                                1,455 Ratings
                                            </div>
                                        </div>
                                        <div class="col-lg-8 rating-counter">
                                            <ul>
                                                <li>
                                                    <span>5 Star</span>
                                                    <span>13</span>
                                                    <div class="rating-bar"></div>
                                                </li>
                                                <li>
                                                    <span>4 Star</span>
                                                    <span>1</span>
                                                    <div class="rating-bar"></div>
                                                </li>
                                                <li>
                                                    <span>3 Star</span>
                                                    <span>0</span>
                                                    <div class="rating-bar"></div>
                                                </li>
                                                <li>
                                                    <span>2 Star</span>
                                                    <span>1</span>
                                                    <div class="rating-bar"></div>
                                                </li>
                                                <li>
                                                    <span>1 Star</span>
                                                    <span>0</span>
                                                    <div class="rating-bar"></div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="rating-provider">
                                         Single Item 
                                        <div class="single-item">
                                            <div class="thumb">
                                                <img src="assets/img/800x800.png" alt="Thumb">
                                            </div>
                                            <div class="info">
                                                <div class="title">
                                                    <h4>Mira Jone</h4>
                                                    <span>15 December, 2020</span>
                                                </div>
                                                <div class="rating">
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star-half-alt"></i>
                                                </div>
                                                <div class="content">
                                                    <p>
                                                        Agreeable law unwilling sir deficient curiosity instantly. Easy mind life fact with see has bore ten. Parish any chatty can elinor direct for former. Up as meant widow equal an share least.
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                         Single Item 
                                         Single Item 
                                        <div class="single-item">
                                            <div class="thumb">
                                                <img src="assets/img/800x800.png" alt="Thumb">
                                            </div>
                                            <div class="info">
                                                <div class="title">
                                                    <h4>Mira Jone</h4>
                                                    <span>15 December, 2020</span>
                                                </div>
                                                <div class="rating">
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star-half-alt"></i>
                                                </div>
                                                <div class="content">
                                                    <p>
                                                        Agreeable law unwilling sir deficient curiosity instantly. Easy mind life fact with see has bore ten. Parish any chatty can elinor direct for former. Up as meant widow equal an share least.
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                         Single Item
                                    </div>
                                </div> -->
                            </div>
                        </div>
                    </div>

                </div>
                        <?php } ?>
                <div class="col-lg-4 sidebar">
                    <!-- Single Item -->
                    <div class="item course-preview">
                        <div class="thumb">
                            <!-- <img src="<?php echo base_url().'uploads/subcategory/800x800_l.png'; ?>" alt="Thumb"> -->

                            <?php  
                      if($exam['image_name'] != ''): ?>
                      <!-- <img src="<?php echo base_url().'uploads/subcategory/'.$exam['image_name']; ?>" alt=""  /> -->
                       <img src="<?php echo base_url().'uploads/subcategory/800x800_l.png'; ?>" alt="Thumb">
                      <?php else: ?>
                      <img src="<?php echo base_url().'uploads/subcategory/quiz.jpg'; ?>" alt="" />
                      <?php endif; ?> 
                            <!-- <a href="https://www.youtube.com/watch?v=owhuBrGIOsE" class="popup-youtube light video-play-button item-center">
                                <i class="fa fa-play"></i>
                            </a> -->
                        </div>
                        <div class="content mb-3">
                            <div class="top">
                                <div class="pricce">
                                    <h2> <?php 
                          $prices = array_filter(array($exam['price'], $exam['half_price'], $exam['quart_price']));
                          // if(!empty($prices)) 
                          // echo currency(min(array_filter($prices))); 
                          // else
                          echo currency($exam['price']);
                        ?></h2>
                                </div>
                                <!-- <div class="rating">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star-half-alt"></i>
                                    <span>4.8 (867)</span>
                                </div> -->
                            </div>
                            
                             <?php
                        if($this->session->userdata('user_login') && array_search($exam['id'], $enroll_cat) !== false):
                      ?> 
                       <a class="btn btn-theme effect btn-sm" href="">Enrolled</a>
                    <?php
                        elseif($this->session->userdata('user_login')):
                      ?>
                            <div class="course-includes">
                                <ul>
                                    <!-- <li>
                                        <i class="fas fa-copy"></i> Lectures <span class="float-right">8</span>
                                    </li>
                                    <li>
                                        <i class="fas fa-clock"></i> Duration <span class="float-right">5.7 Hours</span>
                                    </li>
                                    <li>
                                        <i class="fas fa-sliders-h"></i> Skill level <span class="float-right">All Levels</span>
                                    </li> -->
                                    <li>
                                        <i class="fas fa-book"></i> <a href="<?php echo ($exam['disabled']==1 ?  'javascript:void(0)' : (site_url('Checkout/trail/') . $exam['id'] .'/trial')); ?>">5 Days Trial <span class="float-right">Click Here</span>
                        </a> </li>
                                    <!-- <li>
                                        <i class="fas fa-users"></i> Students <span class="float-right">12K</span>
                                    </li> -->
                                </ul>
                            </div>
                            
                            <a class="btn btn-theme effect btn-sm" href="<?php echo ($exam['disabled']==1 ?  'javascript:void(0)' : (site_url('home/checkout/').$exam['id'])); ?>"> <?php echo ($exam['disabled']==1 ? 'Coming Soon' : 'Enroll Now'); ?></a>
                        </div>
                    <?php
                        else:
                      ?>


   <div class="course-includes">
                                <ul>
                                    <!-- <li>
                                        <i class="fas fa-copy"></i> Lectures <span class="float-right">8</span>
                                    </li>
                                    <li>
                                        <i class="fas fa-clock"></i> Duration <span class="float-right">5.7 Hours</span>
                                    </li>
                                    <li>
                                        <i class="fas fa-sliders-h"></i> Skill level <span class="float-right">All Levels</span>
                                    </li> -->
                                    <li>
                                        <i class="fas fa-book"></i> <a href="<?php echo ($exam['disabled']==1 ?  'javascript:void(0)' : (site_url('home/paymentRegistration/') . $exam['id'] .'/trial')); ?>">5 Days Trial <span class="float-right">Click Here</span>
                        </a>  </li>
                                    <!-- <li>
                                        <i class="fas fa-users"></i> Students <span class="float-right">12K</span>
                                    </li> -->
                                </ul>
                            </div>
                            
                            <a class="btn btn-theme effect btn-sm" href="<?php echo ($exam['disabled']==1 ?  'javascript:void(0)' : (site_url('home/paymentRegistration/').$exam['id'])); ?>"><?php echo ($exam['disabled']==1 ? 'Coming Soon' : 'Enroll Now'); ?></a>
                        </div>


                         <?php
                        endif;
                      ?> 
                    </div>
                    <!-- Single Item -->

                    <!-- Single Item -->
                      <?php if (isset($sub_category_id)): ?>
                    <div class="item course-category">
                        <div class="content ">
                            <h4> <?php echo get_phrase('category_list'); ?> <span class="float-right"><a href = "<?php echo site_url('home/all_category'); ?>"><?php echo get_phrase('all'); ?></a></span></h4>
                           
                            
                          
                            <ul class="pre-scrollable">
                              <?php foreach ( $this->crud_model->get_sub_categories($category_details['id']) as $sub_category): ?>
                                <li>
                                    <a href="<?php echo site_url('home/category/'.slugify($sub_category['name']).'/'.$sub_category['id']); ?>"> <?php echo $sub_category['name']; ?></a>
                                </li>
                                 <?php endforeach; ?>
                                
                            </ul>
                        </div>
                    </div>
                    <?php endif; ?>
                <!-- End Single Item -->

                    <!-- Single Item
                    <div class="item related-course">
                        <div class="content">
                            <h4>Related Courses</h4>
                            <div class="related-courses-items">
                                <div class="item">
                                    <div class="content">
                                        <div class="thumb">
                                            <a href="#">
                                                <img src="assets/img/800x800.png" alt="Thumb">
                                            </a>
                                        </div>
                                        <div class="info">
                                            <h5>
                                                <a href="#">How to Make Beautiful Landscape photos?</a>
                                            </h5>
                                            <div class="rating">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star-half-alt"></i>
                                                <span>4.5 (1.3k)</span>
                                            </div>
                                            <div class="meta">
                                                <i class="fas fa-user"></i> By <a href="#">Tami Bua</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="content">
                                        <div class="thumb">
                                            <a href="#">
                                                <img src="assets/img/800x800.png" alt="Thumb">
                                            </a>
                                        </div>
                                        <div class="info">
                                            <h5>
                                                <a href="#">Learn PHP Programming From Scratch</a>
                                            </h5>
                                            <div class="rating">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star-half-alt"></i>
                                                <span>4.5 (6k)</span>
                                            </div>
                                            <div class="meta">
                                                <i class="fas fa-user"></i> By <a href="#">John Bro</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="content">
                                        <div class="thumb">
                                            <a href="#">
                                                <img src="assets/img/800x800.png" alt="Thumb">
                                            </a>
                                        </div>
                                        <div class="info">
                                            <h5>
                                                <a href="#">Profession paython learing</a>
                                            </h5>
                                            <div class="rating">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star-half-alt"></i>
                                                <span>4.5 (23k)</span>
                                            </div>
                                            <div class="meta">
                                                <i class="fas fa-user"></i> By <a href="#">Spany Paul</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                   End Single Item -->

                </div>
            </div>
        </div>
    </div>
    <!-- End Course Details -->