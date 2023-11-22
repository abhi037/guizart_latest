<?php

    $query = $this->db->select('u.*,b.bank_name, b.user_name, b.account_number,b.ifsc,b.branch_address')
            ->from('users u')
            ->join('bank_details b','b.user_id = u.id')
            ->where('u.id',$user_id)
            ->get();
    $user_data = $query->row_array();
    // $user_data = $this->db->get_where('users', array('id' => $user_id))->row_array();
    
    $social_links = json_decode($user_data['social_links'], true);
?>
<ol class="breadcrumb bc-3">
    <li class = "active">
        <a href="#">
            <i class="entypo-folder"></i>
            <?php echo get_phrase('dashboard'); ?>
        </a>
    </li>
    <li><a href="<?php echo site_url('admin/users'); ?>"><?php echo get_phrase('students'); ?></a> </li>
    <li><a href="#" class="active"><?php echo get_phrase('edit_students'); ?></a> </li>
</ol>
<h2><i class="fa fa-arrow-circle-o-right"></i> <?php echo $page_title; ?></h2>
<br />

<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
            <div class="panel-heading">
				<div class="panel-title">
					<?php echo get_phrase('student_edit_form'); ?>
				</div>
			</div>
			<div class="panel-body">
                <form class="" action="<?php echo site_url('admin/users/edit/'.$user_id); ?>" method="post" enctype="multipart/form-data">
                    <div class="col-md-8">
                        <div class="panel-group" id="accordion" data-toggle="collapse">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a class="" data-toggle="collapse" data-parent="#accordion"  href="#collapseTwo">
                                            <?php echo get_phrase('basic_info'); ?>
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseTwo" class="panel-collapse collapse in">
                                    <div class="panel-body">
                                        <div class="col-md-8 col-sm-8 col-xs-8">
                                            <div class="form-group">
                                                <label class="form-label"><?php echo get_phrase('first_name'); ?></label>
                                                <div class="controls">
                                                    <input type="text" name = "first_name" class="form-control" value="<?php echo $user_data['first_name']; ?>" required>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="form-label"><?php echo get_phrase('last_name'); ?></label>
                                                <div class="controls">
                                                    <input type="text" name = "last_name" class="form-control"  value="<?php echo $user_data['last_name']; ?>" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                                            <?php echo get_phrase('login_credentials'); ?>
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseOne" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <div class="col-md-8 col-sm-8 col-xs-8">
                                            <div class="form-group">
                                                <label class="form-label"><?php echo get_phrase('email'); ?></label>
                                                <div class="controls">
                                                    <input type="email" name = "email" class="form-control"  value="<?php echo $user_data['email']; ?>" required>
                                                </div>
                                            </div>
                                            
                                        </div>
                                        <div class="clear-fix">
                                        </div>
                                        <div class="col-md-8 col-sm-8 col-xs-8">
                                            <div class="form-group">
                                                <label class="form-label"><?php echo get_phrase('Password'); ?></label>
                                                <div class="controls">
                                                    <input type="password" name ="password" id="password" class="form-control" disabled="disabled">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-4 col-xs-4">
                                             <label class="form-label">&nbsp;</label><br>
                                             <i class="fa fa-key fa-2x enable_password" title="Set New Password"></i>
                                        </div>
                                       <div class="col-md-8 col-sm-8 col-xs-8">
                                           <div class="form-row">
                                                <div class="form-group col-md-6 col-sm-6 col-xs-6">
                                                    
                                                    <div class="controls">
                                                        <button type="button" class="btn btn-danger change_status" data-id="<?php echo $user_data['id'];?>" <?php if($user_data['status'] ==0){echo 'disabled ="disabled"';}?>>Deactivate</button>
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-6 col-sm-6 col-xs-6">
                                                    
                                                    <div class="controls">
                                                        <button type="button" class="btn btn-success change_status" data-id="<?php echo $user_data['id'];?>" <?php if($user_data['status'] ==1){echo 'disabled ="disabled"';}?>>Activate</button>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                                            <?php echo get_phrase('social_information'); ?>
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseThree" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <div class="col-md-8 col-sm-8 col-xs-8">
                                            <div class="form-group">
                                                <label class="form-label"><?php echo get_phrase('facebook'); ?></label>
                                                <div class="controls">
                                                    <input type="text" name = "facebook_link" class="form-control" value="<?php echo $social_links['facebook']; ?>" >
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="form-label"><?php echo get_phrase('twitter'); ?></label>
                                                <div class="controls">
                                                    <input type="text" name = "twitter_link" class="form-control" value="<?php echo $social_links['twitter']; ?>" >
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="form-label"><?php echo get_phrase('linkedin'); ?></label>
                                                <div class="controls">
                                                    <input type="text" name = "linkedin_link" class="form-control" value="<?php echo $social_links['linkedin']; ?>" >
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseFour">
                                            <?php echo get_phrase('biography'); ?>
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseFour" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <div class="col-md-8 col-sm-8 col-xs-8">
                                            <div class="form-group">
                                                <label class="form-label"><?php echo get_phrase('biography'); ?></label>
                                                <div class="controls">
                                                    <textarea rows="5" class="form-control wysihtml5" data-stylesheet-url="<?php echo base_url('assets/backend/css/wysihtml5-color.css');?>"
                                                        name="biography" placeholder="<?php echo get_phrase('biography'); ?>"
                                                        id="sample_wysiwyg" ><?php echo $user_data['biography']; ?></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <?php /*
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseFive">
                                            <?php echo get_phrase('payment_info'); ?> <span style="color: red; font-size: 12px;">(<?php echo get_phrase('required_for_instructors'); ?>)</span>
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseFive" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <div class="col-md-8 col-sm-8 col-xs-8">
                                            <?php
                                               // $paypal_keys          = json_decode($user_data['paypal_keys'], true);
                                               // $stripe_keys          = json_decode($user_data['stripe_keys'], true);
                                             ?>
                                            <div class="form-group">
                                                <label class="form-label"><?php echo get_phrase('paypal_client_id'); ?></label>
                                                <div class="controls">
                                                    <input type="text" name = "paypal_client_id" class="form-control" value="<?php echo $paypal_keys[0]['production_client_id']; ?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label"><?php echo get_phrase('stripe_public_key'); ?></label>
                                                <div class="controls">
                                                    <input type="text" name = "stripe_public_key" class="form-control" value="<?php echo $stripe_keys[0]['public_live_key']; ?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label"><?php echo get_phrase('stripe_secret_key'); ?></label>
                                                <div class="controls">
                                                    <input type="text" name = "stripe_secret_key" class="form-control" value="<?php echo $stripe_keys[0]['secret_live_key']; ?>">
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        */    ?>
                             <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseFive">
                                            <?php echo get_phrase('bank_details');
                                                
                                                // print_r($user_data);
                                            
                                            ?> 
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseFive" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <div class="col-md-8 col-sm-8 col-xs-8">
                                            
                                            <div class="form-group">
                                                <label class="form-label"><?php echo get_phrase('bank_name'); ?></label>
                                                <div class="controls">
                                                    <input type="text" name = "bank_name" class="form-control" value="<?php echo $user_data['bank_name'];?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label"><?php echo get_phrase('user_name'); ?></label>
                                                <div class="controls">
                                                    <input type="text" name = "bank_user_name" class="form-control" value="<?php echo $user_data['user_name'];?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label"><?php echo get_phrase('account_no.'); ?></label>
                                                <div class="controls">
                                                    <input type="text" name = "bank_account_number" class="form-control" value="<?php echo $user_data['account_number'];?>">
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label class="form-label"><?php echo get_phrase('ifsc_code.'); ?></label>
                                                <div class="controls">
                                                    <input type="text" name = "ifsc_code" class="form-control" value="<?php echo $user_data['ifsc'];?>">
                                                </div>
                                            </div>
                                            
                                             <div class="form-group">
                                                <label class="form-label"><?php echo get_phrase('branch_address'); ?></label>
                                                <div class="controls">
                                                    <input type="text" name ="branch_address" class="form-control" value="<?php echo $user_data['branch_address'];?>">
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="col-md-8 col-sm-8 col-xs-8">
                            <div class="form-group">
                                <label class="form-label"><?php echo get_phrase('user_image');?></label>

                                <div class="controls">
                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                        <div class="fileinput-new thumbnail" style="width: 100px; height: 100px;" data-trigger="fileinput">
                                            <img src="<?php echo base_url('uploads/user_image/'.$user_id.'.jpg');?>" alt="...">
                                        </div>
                                        <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px"></div>
                                        <div>
                                            <span class="btn btn-white btn-file">
                                                <span class="fileinput-new"><?php echo get_phrase('select_image'); ?></span>
                                                <span class="fileinput-exists"><?php echo get_phrase('change'); ?></span>
                                                <input type="file" name="user_image" accept="image/*">
                                            </span>
                                            <a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput"><?php echo get_phrase('remove'); ?></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-8 col-sm-8 col-xs-8">
                            <button class = "btn btn-success" type="submit" name="button"><?php echo get_phrase('update_user'); ?></button>
                        </div>
                    </div>
                </form>
			</div>
		</div>
	</div>
</div>


<script>
    $(document).ready(function(){
        $(document).off('click','.enable_password').on('click','.enable_password',function(){
            var pass = document.getElementById('password');
            pass.toggleAttribute('disabled');
        });
        
        $(document).off('click','.change_status').on('click','.change_status',function(){
            var id = $(this).attr('data-id');
            $.ajax({
                url:'<?php echo base_url('admin/change_user_status')?>',
                type:'POST',
                data:{id:id},
                dataType:'json',
                success:function(data){
                    console.log(data);
                    if(data.result == true)
                    {
                        alert(data.message);
                        location.reload();
                    }
                },
                error:function(xhr)
                {
                    console.log(xhr.status+' '+xhr.statusText);
                }
                
            });
        });
    })
</script>