<section class="page-header-area">
    <div class="container">
        <div class="row">
            <div class="col">
                <h1 class="page-title"><?php echo $page_title; ?></h1>
            </div>
        </div>
    </div>
</section>

<section class="category-course-list-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12 align-items-center">
               <div class="title"> Please login or signup to complete the process</div>
            </div>
            <div class="col-md-5">
                <div class="title">login</div>
                <div class="sign-in-modal"> 
                    <form action="<?php echo site_url('login/validate_login/user/'.$this->uri->segment('4')); ?>" method="post">
                        <div class="input-group">
                            <span class="input-field-icon"><i class="fas fa-envelope"></i></span>
                            <input type="email" name="email" class="form-control" placeholder="<?php echo get_phrase('email'); ?>">
                        </div>
                        <div class="input-group">
                            <span class="input-field-icon"><i class="fas fa-lock"></i></span>
                            <input type="password" name="password" class="form-control" placeholder="<?php echo get_phrase('password'); ?>">
                        </div>
                        <button type="submit" class="btn btn-primary"><?php echo get_phrase('log_in'); ?></button>
                    </form>
                </div>
            </div>
            <div class="col-md-1" style="border-right:1px solid grey;"></div>
            <div class="col-md-1"></div>
            <div class="col-md-5">
                <div class="title">Sign Up</div>
                <div class="sign-in-modal">
                    <form action="<?php echo site_url('login/register/'.$this->uri->segment('4')); ?>" method="post">
                    <div class="input-group">
                        <span class="input-field-icon"><i class="fas fa-user"></i></span>
                        <input type="text" name = "first_name" class="form-control" placeholder="<?php echo get_phrase('first_name'); ?>">
                    </div>
                    <div class="input-group">
                        <span class="input-field-icon"><i class="fas fa-user"></i></span>
                        <input type="text" name="last_name" class="form-control" placeholder="<?php echo get_phrase('last_name'); ?>">
                    </div>
                    <div class="input-group">
                        <span class="input-field-icon"><i class="fas fa-envelope"></i></span>
                        <input type="email" name="email" class="form-control" placeholder="<?php echo get_phrase('email'); ?>">
                    </div>
                    <div class="input-group">
                        <span class="input-field-icon"><i class="fas fa-mobile"></i></span>
                        <input type="text" name="contact" class="form-control" placeholder="<?php echo get_phrase('contact_no'); ?>">
                    </div>
                    <div class="input-group">
                        <span class="input-field-icon"><i class="fas fa-lock"></i></span>
                        <input type="password" name="password" class="form-control" placeholder="<?php echo get_phrase('password'); ?>">
                    </div>
                    <button type="submit" class="btn btn-primary"><?php echo get_phrase('sign_up'); ?></button>
                </form>
                </div>
            </div>
        </div>
    </div>
</section>


