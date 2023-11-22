<ol class="breadcrumb bc-3">
    <li>
        <a href="<?php echo site_url('admin/dashboard'); ?>">
            <i class="entypo-folder"></i>
            <?php echo get_phrase('dashboard'); ?>
        </a>
    </li>
    <li><a href="<?php echo site_url('admin/coupon'); ?>"><?php echo get_phrase('coupon_codes'); ?></a> </li>
    <li><a href="#" class="active"><?php echo get_phrase('add_coupon'); ?></a> </li>
</ol>
<h2><i class="fa fa-arrow-circle-o-right"></i> <?php echo $page_title; ?></h2>
<br />

<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-primary" data-collapsed="0">
            <div class="panel-heading">
                <div class="panel-title">
                    <?php echo get_phrase('coupon_add_form'); ?>
                </div>
            </div>
            <div class="panel-body">
                <form action="<?php echo site_url('admin/coupon/add'); ?>" method="post" role="form" class="form-horizontal form-groups-bordered">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label class="col-sm-3 control-label"><?php echo get_phrase('coupon_code'); ?></label>

                            <div class="col-sm-5">
                                <input type="text" name = "code" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('discount_percent'); ?></label>

                            <div class="col-sm-5">
                                <input type="text" name = "discount_percent" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('discount_amount'); ?></label>

                            <div class="col-sm-5">
                                <input type="text" name = "discount_amount" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('status'); ?></label>

                            <div class="col-sm-5">
                                <select name = "status" class="form-control" required>
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-5">
                                <button class = "btn btn-success" type="submit"><?php echo get_phrase('add_coupon'); ?></button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



<style media="screen">
  .iconpicker-items {
    overflow-y: hidden;
  }
</style>
