<!-- <section class="category-header-area" style="background-image: url(<?php echo base_url().'uploads/slimline-06.jpg'; ?>); background-position: center; background-repeat: no-repeat;  background-size: cover;">
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
              <?php echo $page_title;; ?>
            </a>
          </li>
        </ol>
      </nav>
    </div>
  </div>
</div> 
</br>
<section class="category-course-list-area">
  <div class="container">
    <div class="row">
      <div class="col"> 
        <a href="#" data-target="#signUpModal" data-toggle="modal" onclick="teacher('premium')">
          <button class="btn btn-primary">Register</button>
        </a>
      </div>
    </div>
  </div>
</section> -->

  <!-- Start Breadcrumb 
    ============================================= -->
    <div class="breadcrumb-area bg-gray text-center shadow dark text-light bg-cover" style="background-image: url(<?php echo base_url().'uploads/slimline-06.jpg'; ?>); background-position: center; background-repeat: no-repeat;  background-size: cover;">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <h1><?php echo $page_title;; ?></h1>
                    <ul class="breadcrumb">
                        <li><a href="<?php echo site_url('home'); ?>"><i class="fas fa-home"></i> Home</a></li>
                        <li class="active"><?php echo $page_title;; ?></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumb -->
    
    <!-- Star About Area
    ============================================= -->
    <div class="about-area default-padding">
        <!-- Fixed Shape -->
        <div class="fixed-shape-bottom">
            <img src="<?php echo base_url().'assets/frontend/img/shape/12.png'; ?>" alt="Shape">
        </div>
        <!-- End Fixed Shape -->
        <div class="container">
            <div class="about-items">
                <div class="row align-center">
                    
                    <div class="col-lg-6 info">
                        <h2>
                            Join the Premium quizart contributor community 
                        </h2>
                        <p>
                            Random Quiz games are particularly popular with students because they are fun and include a tonne of insightful information. By signing up as a Premium contributor, Quizart gives you a unique way to use your knowledge to succeed financially. You can access extra features as a premium contributor, which can help you engage more users and earn more rewards. 
                        </p>
                        <ul>
                            <li>
                                <div class="fun-fact">
                                    <span class="timer" data-to="10" data-speed="5000"></span>
                                    <span class="medium">+ Cr Prize</span>
                                </div>
                            </li>
                            <li>
                                <div class="fun-fact">
                                    <span class="timer" data-to="30" data-speed="5000">30</span>
                                    <span class="medium">+ Categories</span>
                                </div>
                            </li>
                        </ul>
                        <a class="btn circle btn-md btn-gradient" href="#" data-target="#signUpModal" data-toggle="modal" onclick="teacher('premium')" >Register</a>
                    </div>

                    <div class="col-lg-6 thumb">
                        <img src="<?php echo base_url().'assets/frontend/img/illustration/pre_teac_1.svg'; ?>" alt="Thumb">
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- End About Area -->