<section class="page-header-area">
  <div class="container">
    <div class="row">
      <div class="col">
          <h1 class="page-title"><?php echo get_phrase('My Quizs'); ?></h1>
      </div>
    </div>
  </div>
</section>

<section class="popular-courses-area ptb-100 my_enroll"> 
  <div class="row">
      <?php
      if($this->session->userdata('new_post')!=null){
          $record = $this->session->userdata('new_post');
          //print_r($record);
      }
      foreach($my_exams as $exam):
      ?>
        <div class="col-lg-4 col-md-6">
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
              <h4 class="price">
                <?php 
                    $prices = array_filter(array($exam['price'], $exam['half_price'], $exam['quart_price']));
                    // if(!empty($prices)) 
                    //     echo currency(min(array_filter($prices))); 
                    // else
                    echo currency($exam['price']);
                ?> 
              </h4>
              <p class="text-center">
                Expire on: <strong><?php echo date('d M Y', strtotime($exam['end_date']));?></strong>
              </p>
              <?php if(strtotime('now') > strtotime('-1 month',strtotime($exam['end_date']))) { ?> 
                <a class="btn btn-primary" href="<?php echo base_url('home/checkout/').$exam['category_id']?>">Renew Now</a>
              <?php }?>
            </div>
          </div>
        </div>
      <?php
      endforeach;
      ?>                    
  </div> 
</section> 
