<?php
    $social_links = json_decode($user_details['social_links'], true);
 ?>
<section class="user-dashboard-area">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="user-dashboard-box">
                    <div class="user-dashboard-sidebar">
                        <div class="user-box">
                            <img src="<?php echo base_url().'uploads/user_image/'.$this->session->userdata('user_id').'.jpg';?>" alt="" class="img-fluid">
                            <div class="name">
                                <div class="name"><?php echo $user_details['first_name'].' '.$user_details['last_name']; ?></div>
                            </div>
                        </div>
                        <div class="user-dashboard-menu">
                            <ul>
                                <li class="active"><a href="<?php echo site_url('home/profile/user_profile'); ?>"><?php echo get_phrase('profile'); ?></a></li>
                                <li><a href="<?php echo site_url('home/profile/user_credentials'); ?>"><?php echo get_phrase('account'); ?></a></li>
                                <li><a href="<?php echo site_url('home/profile/user_photo'); ?>"><?php echo get_phrase('photo'); ?></a></li>
                                <li><a href="<?php echo site_url('home/profile/user_bank'); ?>"><?php echo get_phrase('Bank Details'); ?></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="user-dashboard-content">
                        <div class="content-title-box">
                            <div class="title"><?php echo get_phrase('profile'); ?></div>
                            <div class="subtitle"><?php echo get_phrase('add_information_about_yourself_to_share_on_your_profile'); ?>.</div>
                        </div>
                        <form action="<?php echo site_url('home/update_profile/update_basics'); ?>" method="post">
                            <div class="content-box">
                                <div class="basic-group">
                                    <div class="form-group">
                                        <label for="FristName"><?php echo get_phrase('basics'); ?>:</label>
                                        <input type="text" class="form-control" name = "first_name" id="FristName" placeholder="<?php echo get_phrase('first_name'); ?>" value="<?php echo $user_details['first_name']; ?>">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name = "last_name" placeholder="<?php echo get_phrase('last_name'); ?>" value="<?php echo $user_details['last_name']; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="Biography"><?php echo get_phrase('biography'); ?>:</label>
                                        <textarea class="form-control author-biography-editor" name = "biography" id="Biography"><?php echo $user_details['biography']; ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="referral_code"><?php echo get_phrase('referral_code'); ?>:</label>
                                        <input type="text" class="form-control" name = "referral_code" placeholder="<?php echo get_phrase('referral_code'); ?>" value="<?php echo $user_details['referral_code']; ?>" readonly>
                                    </div>
                                    <div class="form-group">
                                        <ul class="social-network social-circle">
                                            <li><a href="https://www.facebook.com/sharer/sharer.php?u=quizart.co.in&quote=My Referral Code is <?php echo $user_details['referral_code']; ?>" class="icoFacebook" title="Facebook" target="_blank"><i class="fa fa-facebook"></i></a></li>
                                            <li><a href="https://twitter.com/intent/tweet?via=quizart.co.in&text=My Referral Code is <?php echo $user_details['referral_code']; ?>" class="icoTwitter" title="Twitter" target="_blank"><i class="fa fa-twitter"></i></a></li>
                                            <li><a href="https://www.linkedin.com/shareArticle?url=quizart.co.in" class="icoLinkedin" title="Linkedin" target="_blank"><i class="fa fa-linkedin"></i></a></li>
                                        </ul>
                                    </div>



                                </div>
                                <div class="link-group">
                                    <div class="form-group">
                                        <input type="text" class="form-control" maxlength="60" name = "twitter_link" placeholder="<?php echo get_phrase('twitter_link'); ?>" value="<?php echo $social_links['twitter']; ?>">
                                        <small class="form-text text-muted"><?php echo get_phrase('add_your_twitter_link'); ?>.</small>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" maxlength="60" name = "facebook_link" placeholder="<?php echo get_phrase('facebook_link'); ?>" value="<?php echo $social_links['facebook']; ?>">
                                        <small class="form-text text-muted"><?php echo get_phrase('add_your_facebook_link'); ?>.</small>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" maxlength="60" name = "linkedin_link" placeholder="<?php echo get_phrase('linkedin_link'); ?>" value="<?php echo $social_links['linkedin']; ?>">
                                        <small class="form-text text-muted"><?php echo get_phrase('add_your_linkedin_link'); ?>.</small>
                                    </div>
                                </div>
                            </div>
                            <div class="content-update-box">
                                <button type="submit" class="btn">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
