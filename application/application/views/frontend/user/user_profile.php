<?php
  
  $social_links = json_decode($user_details['social_links'], true);
?>
<section class="page-header-area">

<ol class="breadcrumb bc-3">
  <li class = "active">
    <a href="#">
      <i class="entypo-folder"></i>
      <?php echo get_phrase('dashboard'); ?>
    </a>
  </li> 
  <li><a href="#" class="active"><?php echo get_phrase('Manage Profile'); ?></a> </li>
</ol>
<h2><i class="fa fa-user"></i> <?php echo $page_title; ?></h2>
<br />

</section>
<div class="row"> 
  <div class="col-md-12">
    <div class="panel panel-primary" data-collapsed="0">
      <div class="panel-heading">
        <div class="panel-title">
          <div class="name"><?php echo ucwords ($user_details['first_name'].' '.$user_details['last_name']); ?></div>
        </div>
      </div>
      <div class="panel-body"> 
        <div class="col-md-12"> 

          <div class="panel-group" >
            
            <div class="panel panel-default">
              <div class="panel-heading">
                <h4 class="panel-title">
                  <a class="" data-toggle="collapse" data-parent="#accordion"  href="#collapseTwo">
                    <div class="title"><?php echo get_phrase('profile'); ?></div> 
                  </a>
                </h4>
              </div> 
              <div id="collapseTwo" class="panel-collapse collapse in">
              <div class="panel-body">
                <div class="col-md-12 col-sm-12 col-xs-12">
                  <div class="subtitle">
                    <?php echo get_phrase('add_information_about_yourself_to_share_on_your_profile'); ?>.
                  </div><br /> 
                  <div class="user-dashboard-content"> 
                    <form action="<?php echo site_url('home/update_profile/update_basics'); ?>" method="post">
                      <div class="content-box">
                        <div class="basic-group">
                            <div class="form-group">
                                <label for="FristName"><?php echo get_phrase('basics'); ?>:</label>
                                <input type="text" class="form-control" name = "first_name" id="FristName" placeholder="<?php echo get_phrase('first_name'); ?>" value="<?php echo $user_details['first_name']; ?>" />
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name = "last_name" placeholder="<?php echo get_phrase('last_name'); ?>" value="<?php echo $user_details['last_name']; ?>" />
                            </div>
                            <div class="form-group">
                                <label for="Biography"><?php echo get_phrase('biography'); ?>:</label>
                                <textarea class="form-control author-biography-editor" name = "biography" id="Biography"><?php echo $user_details['biography']; ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="referral_code"><?php echo get_phrase('referral_code'); ?>:</label>
                                <input type="text" class="form-control" name = "referral_code" placeholder="<?php echo get_phrase('referral_code'); ?>" value="<?php echo $user_details['referral_code']; ?>" readonly />
                            </div>
                        </div>
                        <div class="link-group">
                          <div class="form-group">
                            <input type="text" class="form-control" maxlength="60" name = "twitter_link" placeholder="<?php echo get_phrase('twitter_link'); ?>" value="<?php echo $social_links['twitter']; ?>" />
                            <small class="form-text text-muted"><?php echo get_phrase('add_your_twitter_link'); ?>.</small>
                          </div>
                          <div class="form-group">
                            <input type="text" class="form-control" maxlength="60" name = "facebook_link" placeholder="<?php echo get_phrase('facebook_link'); ?>" value="<?php echo $social_links['facebook']; ?>" />
                            <small class="form-text text-muted"><?php echo get_phrase('add_your_facebook_link'); ?>.</small>
                          </div>
                          <input type="hidden" name="email" value="<?php echo $user_details['email']; ?>" />
                          <div class="form-group">
                            <input type="text" class="form-control" maxlength="60" name = "linkedin_link" placeholder="<?php echo get_phrase('linkedin_link'); ?>" value="<?php echo $social_links['linkedin']; ?>" />
                            <small class="form-text text-muted"><?php echo get_phrase('add_your_linkedin_link'); ?>.</small>
                          </div>
                        </div>
                      </div>
                      <div class="content-update-box">
                          <button type="submit" class="btn btn-success">Save</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
            </div>
            
            <div class="panel panel-default">
              <div class="panel-heading">
                <h4 class="panel-title">
                  <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                    <?php echo get_phrase('account'); ?>
                  </a>
                </h4>
              </div>
              
              <div id="collapseOne" class="panel-collapse collapse">
                <div class="panel-body"> 
                  <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="user-dashboard-content">
                      <div class="subtitle"><?php echo get_phrase('edit_your_account_settings'); ?>.</div><br />
                      <form action="<?php echo site_url('home/update_profile/update_credentials'); ?>" method="post">
                        <div class="content-box">
                          <div class="email-group">
                            <div class="form-group">
                              <label for="email"><?php echo get_phrase('email'); ?>:</label>
                              <input type="email" class="form-control" name = "email" id="email" placeholder="<?php echo get_phrase('email'); ?>" value="<?php echo $user_details['email']; ?>">
                            </div>
                          </div>
                          <div class="contact-group">
                            <div class="form-group">
                              <label for="contact"><?php echo get_phrase('contact'); ?>:</label>
                              <input type="text" class="form-control" name = "contact" id="contact" placeholder="<?php echo get_phrase('contact'); ?>" value="<?php echo $user_details['contact']; ?>">
                            </div>
                          </div>
                          <div class="password-group">
                            <div class="form-group">
                              <label for="password"><?php echo get_phrase('password'); ?>:</label>
                              <input type="password" class="form-control" id="current_password" name = "current_password" placeholder="<?php echo get_phrase('enter_current_password'); ?>">
                            </div>
                            <div class="form-group">
                              <input type="password" class="form-control" name = "new_password" placeholder="<?php echo get_phrase('enter_new_password'); ?>">
                            </div>
                            <div class="form-group">
                              <input type="password" class="form-control" name = "confirm_password" placeholder="<?php echo get_phrase('re-type_your_password'); ?>">
                            </div>
                          </div>
                        </div>
                        <div class="content-update-box">
                          <button type="submit" class="btn btn-success"><?php echo get_phrase('save'); ?></button>
                        </div>
                      </form>
                    </div>
                  </div> 
                </div>
              </div>
            </div>
            
            <div class="panel panel-default">
              <div class="panel-heading">
                <h4 class="panel-title">
                  <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                    <?php echo get_phrase('photo'); ?>
                  </a>
                </h4>
              </div>
                              
              <div id="collapseThree" class="panel-collapse collapse">
                <div class="panel-body">
                  <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="user-dashboard-content"> 
                      <div class="subtitle"><?php echo get_phrase('update_your_photo'); ?>.</div><br />
                      <form action="<?php echo site_url('home/update_profile/update_photo'); ?>" enctype="multipart/form-data" method="post">
                        <div class="content-box">
                          <div class="email-group">
                            <div class="form-group">
                              <label for="user_image"><?php echo get_phrase('upload_image'); ?>:</label>
                              <input type="file" class="form-control" name = "user_image" id="user_image">
                            </div>
                          </div>
                        </div>
                        <input type="hidden" name="email" value="<?php echo $user_details['email']; ?>" />
                        <div class="content-update-box">
                          <button type="submit" class="btn btn-success"><?php echo get_phrase('save'); ?></button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            
            <div class="panel panel-default">
              <div class="panel-heading">
                <h4 class="panel-title">
                  <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseFour">
                    <?php echo get_phrase('Bank Details'); ?>
                  </a>
                </h4>
              </div>
              
              <div id="collapseFour" class="panel-collapse collapse">
                <div class="panel-body">
                  <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="user-dashboard-content">
                      <div class="content-title-box">
                        <div class="title"><?php echo get_phrase('Bank Details'); ?></div>
                      </div>
                      <form action="<?php echo site_url('home/update_profile/update_user_bank'); ?>" method="post">
                        <div class="content-box">
                          <div class="basic-group">
                            <div class="form-group">
                              <input type="hidden" name="email" value="<?php echo $user_details['email']; ?>" />
                              <label for="FristName"><?php echo get_phrase('basics'); ?>:</label>
                              <input type="text" class="form-control" name = "bank_name" id="bank_name" placeholder="<?php echo get_phrase('bank_name'); ?>" value="<?php echo $bank_details['bank_name']; ?>">
                            </div>
                            <div class="form-group">
                              <input type="text" class="form-control" name = "user_name" id="user_name" placeholder="<?php echo get_phrase('user_name'); ?>" value="<?php echo $bank_details['user_name']; ?>">
                            </div>
                            <div class="form-group">
                              <input type="text" class="form-control" name = "account_number" placeholder="<?php echo get_phrase('account_number'); ?>" value="<?php echo $bank_details['account_number']; ?>">
                            </div>
                            <div class="form-group">
                              <input type="text" class="form-control" name = "ifsc" placeholder="<?php echo get_phrase('ifsc_code'); ?>" value="<?php echo $bank_details['ifsc']; ?>">
                            </div>
                            <div class="form-group">
                              <input type="text" class="form-control" name = "branch_address" placeholder="<?php echo get_phrase('branch_address'); ?>" value="<?php echo $bank_details['branch_address']; ?>" >
                            </div>
                          </div>
                        </div>
                        <div class="content-update-box">
                          <button type="submit" class="btn btn-success">Save</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>  
          </div>
        </div>  
      </div>
    </div>
  </div>
</div>
 