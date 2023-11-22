<ol class="breadcrumb bc-3">
    <li>
        <a href="<?php echo site_url('admin/dashboard'); ?>">
            <i class="entypo-folder"></i>
            <?php echo get_phrase('dashboard'); ?>
        </a>
    </li>
    <li><a href="<?php echo site_url('admin/coupon'); ?>"><?php echo get_phrase('coupon_codes'); ?></a> </li>
    <li><a href="#" class="active"><?php echo get_phrase('edit_coupon'); ?></a> </li>
</ol>
<h2><i class="fa fa-arrow-circle-o-right"></i> <?php echo $page_title; ?></h2>
<br />

<div class="row">
	<div class="col-md-8 col-md-offset-2">
		<div class="panel panel-primary" data-collapsed="0">
            <div class="panel-heading">
				<div class="panel-title">
					<?php echo get_phrase('edit_coupon_form'); ?>
				</div>
			</div>
			<div class="panel-body">
                <form action="<?php echo site_url('admin/coupon/edit/'.$coupon_id); ?>" method="post" role="form" class="form-horizontal form-groups-bordered">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label class="col-sm-3 control-label"><?php echo get_phrase('coupon_code'); ?></label>

                            <div class="col-sm-5">
                                <input type="text" name = "code" class="form-control" value="<?php echo $coupon['code']; ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('discount_percent'); ?></label>

                            <div class="col-sm-5">
                                <input type="text" name = "discount_percent" class="form-control" value="<?php echo $coupon['discount_percent']; ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('discount_amount'); ?></label>

                            <div class="col-sm-5">
                                <input type="text" name = "discount_amount" class="form-control" value="<?php echo $coupon['discount_amount']; ?>" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('status'); ?></label>

                            <div class="col-sm-5">
                                <select name = "status" class="form-control" required>
                                    <option value="1" <?php if($coupon['status']==1) echo 'selected'; ?> >Active</option>
                                    <option value="0" <?php if($coupon['status']==0) echo 'selected'; ?> >Inactive</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-5">
                                <button class = "btn btn-success" type="submit"><?php echo get_phrase('update_coupon'); ?></button>
                            </div>
                        </div>
                    </div>
                </form>
			</div>
		</div>
	</div>
</div>
