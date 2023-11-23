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
      
    
 <!-- start div -->
  <?php
      if($this->session->userdata('new_post')!=null){
          $record = $this->session->userdata('new_post');
          //print_r($record);
      }
      foreach($my_exams as $exam):
      ?>



 <div class="col-sm-4 col-xs-12"> 
  <div class="tile-block tile-plum"> 
    <div class="tile-header"> 
      <i class="glyphicon glyphicon-list-alt"></i> 
      <a href="<?php echo ((strtotime('now') > strtotime($exam['end_date'])) ? '#' : site_url('home/my_quiz/'.$exam['sub_category_id'])); ?>">
<?php echo $exam['name']; ?>
<span><h4 style = "color: white;" > <?php 
                      $prices = array_filter(array($exam['price'], $exam['half_price'], $exam['quart_price']));
                      // if(!empty($prices)) 
                      //     echo currency(min(array_filter($prices))); 
                      // else
                      echo currency($exam['price']);
                  ?> </h4></span> </a> 
</div> 
<p class="text-center">
                  <?php echo ((strtotime('now') > strtotime($exam['end_date'])) ? 'Expired' : 'Expire on'); ?>: <strong><?php echo date('d M Y', strtotime($exam['end_date']));?></strong>
                </p>
<div class="tile-content"> 
 
    <div class="col-sm-12"> <a href="<?php echo ((strtotime('now') > strtotime($exam['end_date'])) ? '#' : site_url('home/my_quiz/'.$exam['sub_category_id'])); ?>">
    <?php if($exam['image_name'] != ''): ?>
                 
                   <img src="<?php echo base_url().'uploads/subcategory/'.$exam['image_name']; ?>" class="img-responsive img-rounded full-width"> 
                <?php else: ?>
                    <img src="<?php echo base_url().'uploads/subcategory/quiz.jpg'; ?>" class="img-responsive img-rounded full-width"> 
                <?php endif; ?>
    
   
  </a> 
</div>

   </div>
     <div class="tile-footer"> 
  

        <?php if(strtotime('now') > strtotime('-1 month',strtotime($exam['end_date']))) { ?> 
                  <a class="btn btn-primary btn-block" href="<?php echo base_url('home/checkout/').$exam['category_id']?>">Renew Now</a>
                <?php }?>
     </div> 
    </div> 
  </div>
  
     <?php
      endforeach;
      ?>   
   <!-- end  div -->
                </div>
<!-- <section class="popular-courses-area ptb-100 my_enroll"> 
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
            <a href="<?php echo ((strtotime('now') > strtotime($exam['end_date'])) ? '#' : site_url('home/my_quiz/'.$exam['sub_category_id'])); ?>">
              <div class="courses-img">
                <?php if($exam['image_name'] != ''): ?>
                   <img src="<?php echo base_url().'uploads/subcategory/'.$exam['image_name']; ?>" alt="">
                <?php else: ?>
                    <img src="<?php echo base_url().'uploads/subcategory/quiz.jpg'; ?>" alt="">
                <?php endif; ?>
              </div>
            </a>
            <a href="<?php echo ((strtotime('now') > strtotime($exam['end_date'])) ? '#' : site_url('home/my_quiz/'.$exam['sub_category_id'])); ?>">      
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
                  <?php echo ((strtotime('now') > strtotime($exam['end_date'])) ? 'Expired' : 'Expire on'); ?>: <strong><?php echo date('d M Y', strtotime($exam['end_date']));?></strong>
                </p>
                <?php if(strtotime('now') > strtotime('-1 month',strtotime($exam['end_date']))) { ?> 
                  <a class="btn btn-primary" href="<?php echo base_url('home/checkout/').$exam['category_id']?>">Renew Now</a>
                <?php }?>
              </div>
            </a>
          </div>
        </div>
      <?php
      endforeach;
      ?>                    
  </div> 
</section>  -->

