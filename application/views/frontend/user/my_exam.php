<!-- <section class="page-header-area">
    <div class="container">
        <div class="row">
            <div class="col">
                <h1 class="page-title"><?php echo get_phrase('My Quizzes 34'); ?></h1>
            </div>
        </div>
    </div>
</section> -->
<section class="page-header-area">
  <ol class="breadcrumb bc-3">
  <li class = "active">
    <a href="<?php echo site_url('home/user'); ?>">
      <i class="entypo-folder"></i>
      <?php echo get_phrase('dashboard'); ?>
    </a>
  </li> 
  <li><a href="" class="active"><?php echo get_phrase('My Quizzes'); ?></a> </li>
</ol>
<h2><i class="fa fa-diamond"></i> <?php echo $page_title; ?></h2>
<br />  
</section>

<div class="row" style="margin-bottom:5%;margin-top:2%;">
 <?php foreach ($my_exams as $my_exam):?> 
<div class="col-sm-4 col-xs-12"> 
  <div class="tile-block tile-blue"> 
    <div class="tile-header"> 
      <i class="glyphicon glyphicon-list-alt"></i> 
      <a href="<?php echo ((strtotime('now') > strtotime($my_exam['end_date'])) ? '#' : site_url('home/my_quiz/'.$my_exam['sub_category_id'])); ?>">
<?php echo $my_exam['name']; ?>



<span><h4 style = "color: white;" > <?php 
                      $prices = array_filter(array($my_exam['price'], $my_exam['half_price'], $my_exam['quart_price']));
                      // if(!empty($prices)) 
                      //     echo currency(min(array_filter($prices))); 
                      // else
                      echo currency($my_exam['price']);
                  ?> </h4></span> 
                  </a> 
</div> 
<p class="text-center">
                  <?php echo ((strtotime('now') > strtotime($my_exam['end_date'])) ? 'Expired' : 'Expire on'); ?>: <strong><?php echo date('d M Y', strtotime($my_exam['end_date']));?></strong>
                </p>
<div class="tile-content"> 
 
    <div class="col-sm-12"> <a href="<?php echo ((strtotime('now') > strtotime($my_exam['end_date'])) ? '#' : site_url('home/my_quiz/'.$my_exam['sub_category_id'])); ?>">
 <?php if(isset($my_exam['image_name']) && !empty($my_exam['image_name'])): ?>
                 
                   <img src="<?php echo base_url().'uploads/subcategory/'.$my_exam['image_name']; ?>" class="img-responsive img-rounded full-width"> 
                <?php else: ?>
                    <img src="<?php echo base_url().'uploads/subcategory/quiz.jpg'; ?>" class="img-responsive img-rounded full-width"> 
                <?php endif; ?>

                
    
   
  </a> 
</div>

   </div>
     <div class="tile-footer"> 
  

       
                  <a class="btn btn-primary btn-block" href="<?php echo ((strtotime('now') > strtotime($my_exam['end_date'])) ? '#' : site_url('home/my_quiz/'.$my_exam['sub_category_id'])); ?>">Start Quiz</a>
              
     </div> 
    </div> 
  </div>
  
     <?php
      endforeach;
      ?>   
   <!-- end  div -->
                </div>




    </div>

<!-- <section class="my-courses-area">
    <div class="row no-gutters" id="my_courses_area">
      <?php foreach ($my_exams as $my_exam):?> 
        <div class="col-md-3">
          <div class="course-box-wrap">
            <div class="course-box">
              <a href="<?php echo ((strtotime('now') > strtotime($my_exam['end_date'])) ? '#' : site_url('home/my_quiz/'.$my_exam['sub_category_id'])); ?>">
                <div class="course-image">
                  <?php if(isset($my_exam['image_name']) && !empty($my_exam['image_name'])): ?>
				            <img src="<?php echo base_url().'uploads/subcategory/'.$my_exam['image_name']; ?>" alt="" style="width:100%">
                  <?php else: ?>
                    <img src="<?php echo base_url().'uploads/subcategory/quiz.jpg'; ?>" alt="">
                  <?php endif; ?>
                  <span class="play-btn"></span>
                </div>
              </a>
              <div class="course-details">
                <a href="<?php echo ((strtotime('now') > strtotime($my_exam['end_date'])) ? '#' : site_url('home/my_quiz/'.$my_exam['sub_category_id'])); ?>"> 
                  <h5 class="title"><?php echo $my_exam['name']; ?></h5>
                </a>
              </div>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
</section> -->

