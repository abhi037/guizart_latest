<section class="page-header-area">
    <div class="container">
        <div class="row">
            <div class="col">
                <h1 class="page-title"><?php echo get_phrase('My Quizs'); ?></h1>
            </div>
        </div>
    </div>
</section>

<?php 
// echo '<pre>';
// print_r($my_exams);
//  echo '</pre>';?>
<section class="my-courses-area">
    <div class="row no-gutters" id="my_courses_area">
      <?php foreach ($my_exams as $my_exam):?>
        <div class="col-md-3">
          <div class="course-box-wrap">
            <div class="course-box">
              <a href="<?php echo site_url('home/my_quiz/'.$my_exam['sub_category_id']); ?>">
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
                <a href="<?php echo site_url('home/my_quiz/'.$my_exam['sub_category_id']); ?>"><h5 class="title"><?php echo $my_exam['name']; ?></h5></a>
              </div>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
</section>

