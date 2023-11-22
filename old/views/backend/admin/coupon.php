<ol class="breadcrumb bc-3">
    <li>
        <a href="<?php echo site_url('admin/dashboard'); ?>">
            <i class="entypo-folder"></i>
            <?php echo get_phrase('dashboard'); ?>
        </a>
    </li>
    <li><a href="#" class="active"><?php echo get_phrase('coupon_codes'); ?></a> </li>
</ol>
<h2><i class="fa fa-arrow-circle-o-right"></i> <?php echo $page_title; ?></h2>
<br />

<div class="row">
	<div class="col-md-8 col-md-offset-2">
		<div class="panel panel-primary" data-collapsed="0">
			<div class="panel-body">
                <div class="row" style="margin-left: -15px;">
                    <div class="col-md-3">
                        <a href = "<?php echo site_url('admin/coupon_form/add_coupon'); ?>" class="btn btn-block btn-info" type="button"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;&nbsp;<?php echo get_phrase('add_coupon'); ?></a>
                    </div>
                </div>
                <table class="table table-bordered datatable" id="table-1">
                  <thead>
                    <tr>
                      <th><?php echo get_phrase('coupon_code'); ?></th>
                      <th><?php echo get_phrase('discount_percent'); ?></th>
                      <th><?php echo get_phrase('discount_amount'); ?></th>
                      <th><?php echo get_phrase('status'); ?></th>
                      <th><?php echo get_phrase('actions'); ?></th>
                    </tr>
                  </thead>
                  <tbody>
                      <?php
                      $counter = 1;
                      foreach ($coupons as $coupon): ?>
                          <tr class= "<?php if( $counter % 2 == 0) echo 'odd gradeX'; else echo 'even gradeC'; $counter++;?>">
                            <td><?php echo $coupon['code']; ?></td>
                            <td><?php echo $coupon['discount_percent']; ?></td>
                            <td><?php echo $coupon['discount_amount']; ?></td>
                            <td>
                                <?php
                                    if($coupon['status']==1):
                                        echo 'Active';
                                    else:
                                        echo 'Inactive';
                                    endif;
                                ?>
                            </td>
                            <td>

                                <div class="btn-group">
                                    <button class="btn btn-small btn-default btn-demo-space" data-toggle="dropdown"> <i class = "fa fa-ellipsis-v"></i> </button>
                                    <ul class="dropdown-menu dropdown-default" role="menu">
                                            <a href="<?php echo site_url('admin/coupon_form/edit_coupon/'.$coupon['id']); ?>">
                                                <?php echo get_phrase('edit');?>
                                            </a>
                                        </li>
                                        <li class="divider"></li>
                                        <li>
                                            <a href="#" onclick="confirm_modal('<?php echo site_url('admin/coupons/delete/'.$coupon['id']); ?>');">
                                                <?php echo get_phrase('delete');?>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                          </tr>
                      <?php endforeach; ?>
                  </tbody>
                </table>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">

</script>
