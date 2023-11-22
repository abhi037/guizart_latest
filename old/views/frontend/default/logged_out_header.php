<section class="menu-area">
    <div class="">
        <div class="row">
            <div class="col">
                <nav class="navbar navbar-expand-lg navbar-light">

                    <ul class="mobile-header-buttons">
                        <li><a class="mobile-nav-trigger" href="#mobile-primary-nav">Menu<span></span></a></li>
            			<li><a class="mobile-search-trigger" href="#mobile-search">Search<span></span></a></li>
            		</ul>

                    <a href="<?php echo site_url(''); ?>" class="navbar-brand" href="#"><img src="<?php echo base_url().'assets/frontend/img/logo.png'; ?>" alt="" height="50"></a>

                    <?php include 'menu.php'; ?>

                    <form class="inline-form" action="<?php echo site_url('home/get_courses_by_search_string'); ?>" method="post" style="width: 100%;">
                        <div class="input-group search-box mobile-search">
                            <input type="text" name = 'search_string' class="form-control" placeholder="<?php echo get_phrase('search_for_quiz'); ?>">
                            <div class="input-group-append">
                                <button class="btn" type="submit"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                    <span class="signin-box-move-desktop-helper"></span>
                    <div class="sign-in-box btn-group">

                        <button type="button" class="btn btn-sign-in" data-toggle="modal" data-target="#signInModal"><?php echo get_phrase('log_in'); ?></button>

                        <button type="button" class="btn btn-sign-up" data-toggle="modal" data-target="#signUpModal"><?php echo get_phrase('sign_up'); ?></button>

                    </div> <!--  sign-in-box end -->



                </nav>
                <!-- <nav class="navbar-expand-md navbar-dark custom-menu">

                    <div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent">
                        <ul class="navbar-nav">
                        <li class="nav-item <?php echo is_active('/'); ?>">
                            <a class="nav-link custom-link" href="<?php echo site_url('/'); ?>">Home <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item <?php echo is_active('about_us'); ?>">
                            <a class="nav-link custom-link" href="<?php echo site_url('home/pages/about_us'); ?>">About Us</a>
                        </li>
                        <li class="nav-item <?php echo is_active('our_team'); ?>">
                            <a class="nav-link custom-link" href="<?php echo site_url('home/pages/our_team'); ?>">Our team</a>
                        </li>
                        <li class="nav-item <?php echo is_active('achievements'); ?>">
                            <a class="nav-link custom-link" href="<?php echo site_url('home/pages/achievements'); ?>">Achievements</a>
                        </li>
                        <li class="nav-item <?php echo is_active('news_&_events'); ?>">
                            <a class="nav-link custom-link" href="<?php echo site_url('home/pages/news_&_events'); ?>">News and events</a>
                        </li>
                        <li class="nav-item <?php echo is_active('photogallery'); ?>">
                            <a class="nav-link custom-link" href="<?php echo site_url('home/photogallery'); ?>">Photo gallery</a>
                        </li>
                        <li class="nav-item <?php echo is_active('faqs'); ?>">
                            <a class="nav-link custom-link" href="<?php echo site_url('home/faqs'); ?>">FAQs</a>
                        </li>
                        
                        <li class="nav-item <?php echo is_active('contact_us'); ?>">
                            <a class="nav-link custom-link" href="<?php echo site_url('home/pages/contact_us'); ?>">Contact Us</a>
                        </li>
                        </ul>
                    </div>
                </nav> -->
            </div>
        </div>
    </div>
</section>
