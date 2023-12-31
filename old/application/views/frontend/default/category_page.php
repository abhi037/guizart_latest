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

<section class="category-header-area" style="background-image: url(<?php echo base_url() . 'uploads/' . $sliderimg; ?>); background-position: center; background-repeat: no-repeat;  background-size: cover;">
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
</section>
