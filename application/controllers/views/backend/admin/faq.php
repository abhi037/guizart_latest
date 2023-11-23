<ol class="breadcrumb bc-3">
    <li>
        <a href="<?php echo site_url('admin/dashboard'); ?>">
            <i class="entypo-folder"></i>
            <?php echo get_phrase('dashboard'); ?>
        </a>
    </li>
    <li><a href="#" class="active"><?php echo get_phrase('faqs'); ?></a> </li>
</ol>
<h2><i class="fa fa-arrow-circle-o-right"></i> <?php echo $page_title; ?></h2>
<br />

<div class="row">
	<div class="col-md-8 col-md-offset-2">
		<div class="panel panel-primary" data-collapsed="0">
			<div class="panel-body">
                <div class="row" style="margin-left: -15px;">
                    <div class="col-md-3">
                        <a href = "<?php echo site_url('admin/faq_form/add_faq'); ?>" class="btn btn-block btn-info" type="button"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;&nbsp;<?php echo get_phrase('add_faq'); ?></a>
                    </div>
                </div>
                <table class="table table-bordered datatable" id="table-1">
                  <thead>
                    <tr>
                      <th><?php echo get_phrase('question'); ?></th>
                      <th><?php echo get_phrase('answer'); ?></th>
                      <th><?php echo get_phrase('status'); ?></th>
                      <th><?php echo get_phrase('actions'); ?></th>
                    </tr>
                  </thead>
                  <tbody>
                      <?php
                      $counter = 1;
                      foreach ($faqs as $faq): ?>
                          <tr class= "<?php if( $counter % 2 == 0) echo 'odd gradeX'; else echo 'even gradeC'; $counter++;?>">
                            <td><?php echo $faq['que']; ?></td>
                            <td><?php echo $faq['ans']; ?></td>
                            <td>
                                <?php
                                    if($faq['status']==1):
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
                                        <li>
                                            <a href="<?php echo site_url('admin/faq_form/edit_faq/'.$faq['id']); ?>">
                                                <?php echo get_phrase('edit');?>
                                            </a>
                                        </li>
                                        <li class="divider"></li>
                                        <li>
                                            <a href="#" onclick="confirm_modal('<?php echo site_url('admin/faq/delete/'.$faq['id']); ?>');">
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
