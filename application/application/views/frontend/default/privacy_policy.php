<!-- <section class="category-header-area">
    <div class="container-lg">
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
                <h1 class="category-name">
                    <?php echo $page_title; ?>
                </h1>
            </div>
        </div>
    </div>
</section>

<section class="category-course-list-area" style="text-align:justify;">
    <div class="container">
        <div class="row">
            <div class="col" style="padding: 35px;">
                <?php echo get_frontend_settings('privacy_policy'); ?>
            </div>
        </div>
    </div>
</section> -->

<!-- Start Breadcrumb 
    ============================================= -->
    <div class="breadcrumb-area bg-gray text-center shadow dark text-light bg-cover" style="background-image: url(../../assets/frontend/img/2440x1578.png);">
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

     <!-- Start Blog
    ============================================= -->
    <div class="blog-area single full-blog full-blog default-padding">
        <div class="container">
            <div class="blog-items">
                <div class="row">
                    <div class="blog-content col-md-12">
                        <div class="item">

                            <div class="blog-item-box">
                               

                                <div class="content">
                                  
                 <?php echo get_frontend_settings('privacy_policy'); ?>
      
                                  
                                </div>
                            </div>
                        </div>

                  


                    

                    </div>
                </div>
            </div>
        </div>
    </div>