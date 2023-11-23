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
                                <li><a href="<?php echo site_url('home/profile/user_profile'); ?>"><?php echo get_phrase('profile'); ?></a></li>
                                <li><a href="<?php echo site_url('home/profile/user_credentials'); ?>"><?php echo get_phrase('account'); ?></a></li>
                                <li><a href="<?php echo site_url('home/profile/user_photo'); ?>"><?php echo get_phrase('photo'); ?></a></li>
                                <li  class="active"><a href="<?php echo site_url('home/profile/user_bank'); ?>"><?php echo get_phrase('Bank Details'); ?></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="user-dashboard-content">
                        <div class="content-title-box">
                            <div class="title"><?php echo get_phrase('Bank Details'); ?></div>
                        </div>
                        <form action="<?php echo site_url('home/update_profile/update_user_bank'); ?>" method="post">
                            <div class="content-box">
                                <div class="basic-group">
                                    <div class="form-group">
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
                                <button type="submit" class="btn">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
