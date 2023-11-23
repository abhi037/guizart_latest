<ol class="breadcrumb bc-3">
    <li>
        <a href="<?php echo site_url('admin/dashboard'); ?>">
            <i class="entypo-folder"></i>
            <?php echo get_phrase('dashboard'); ?>
        </a>
    </li>
    <li><a href="#" class="active"><?php echo get_phrase('pages'); ?></a> </li>
</ol>
<h2><i class="fa fa-arrow-circle-o-right"></i> <?php echo $page_title; ?></h2>
<br />

<div class="row">
	<div class="col-md-8 col-md-offset-2">
        <div class="panel panel-primary" data-collapsed="0">
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-4 col-md-offset-4">
                        <!--<a href = "<?php echo site_url('admin/page_form/add_page'); ?>" class="btn btn-block btn-info btn-lg" type="button"><i class="fa fa-plus"></i>&nbsp;&nbsp;<?php echo get_phrase('add_page'); ?></a>-->
                    </div>
                </div>
                <hr>
                <table class="table table-bordered datatable" id="table-1">
                  <thead>
                    <tr>
                      <th><?php echo get_phrase('Title'); ?></th>
                      <th><?php echo get_phrase('page_url'); ?></th>
                      <th><?php echo get_phrase('status'); ?></th>
                      <th><?php echo get_phrase('actions'); ?></th>
                    </tr>
                  </thead>
                  <tbody>
                      <?php
                      $counter = 1;
                      foreach ($pages->result_array() as $page): ?>
                          <tr class= "<?php if( $counter % 2 == 0) echo 'odd gradeX'; else echo 'even gradeC'; $counter++;?>">
                            <td><?php echo $page['title']; ?></td>
                            <td><?php echo $page['page_url']; ?></td>
                            <td><?php echo $page['status']; ?></td>
                            <td>

                                <div class="btn-group">
                                    <button class="btn btn-small btn-default btn-demo-space" data-toggle="dropdown"> <i class = "fa fa-ellipsis-v"></i> </button>
                                    <ul class="dropdown-menu dropdown-default" role="menu">
                                        <li>
                                            <a href="<?php echo site_url('admin/page_form/page_edit/'.$page['id']); ?>">
                                                <?php echo get_phrase('edit');?>
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
    function ajax_get_sub_category(category_id) {
        $.ajax({
            url: '<?php echo site_url('admin/ajax_get_sub_category/');?>' + category_id ,
            success: function(response)
            {
                jQuery('#sub_category_id').html(response);
                console.log(response);
            }
        });
    }
</script>
