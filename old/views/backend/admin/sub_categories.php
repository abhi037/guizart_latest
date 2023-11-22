
<hr />
<ol class="breadcrumb bc-3">
    <li class = "active">
        <a href="#">
            <i class="entypo-folder"></i>
            <?php echo get_phrase('dashboard'); ?>
        </a>
    </li>
    <li><a href="<?php echo site_url('admin/categories'); ?>"><?php echo get_phrase('categories'); ?></a> </li>
    <li><a href="#" class="active"><?php echo get_phrase('sub_categories'); ?></a> </li>
</ol>
<h2><i class="fa fa-arrow-circle-o-right"> </i> <?php echo $page_title; ?></h2>
<br />

<div class="row">
    <div class="col-md-9 col-md-offset-1">
        <div class="panel panel-primary" data-collapsed="0">
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-offset-4 col-md-3">
                        <a href = "<?php echo site_url('admin/sub_category_form/add_sub_category').'/'.$this->uri->segment('3'); ?>" class="btn btn-lg btn-info" type="button" style="font-size: 13px;"><i class="fa fa-plus"></i> <?php echo get_phrase('add_sub_category');  ?></a>
                    </div>
                </div>

                <table class="table table-bordered datatable" id="table-1">
                    <thead>
                        <tr>
                            <th><?php echo get_phrase('sub_category_title'); ?></th>
                            <th><?php echo get_phrase('category_title'); ?></th>
                            <th hidden><?php echo get_phrase('date_added'); ?></th>
                            <th hidden><?php echo get_phrase('last_modified'); ?></th>
                            <th><?php echo get_phrase('actions'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($sub_categories->result_array() as $sub_category): ?>
                            <tr class="gradeU">
                                <td><?php echo $sub_category['name']; ?></td>
                                <th><?php echo $sub_category['category_name']; ?></th>
                                <td hidden><?php echo date('D, d-M-Y', $sub_category['date_added']); ?></td>
                                <td hidden><?php echo date('D, d-M-Y', $sub_category['last_modified']); ?></td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-default" data-toggle="dropdown"> <i class = "fa fa-ellipsis-v"></i> </button>

                                        <ul class="dropdown-menu dropdown-default" role="menu">
                                            <li>
                                                <a href="<?php echo site_url('admin/sub_category_form/edit_sub_category/'.$sub_category['id']); ?>">
                                                    <?php echo get_phrase('edit');?>
                                                </a>
                                            </li>
                                            <li class="divider"></li>
                                            <li>
                                                <a href="#" onclick="confirm_modal('<?php echo site_url('admin/sub_categories/'.$selected_category_id.'/delete/'.$sub_category['id']); ?>');">
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
  $(document).ready(function(){
    $('#table-1').DataTable({ });
  }); 
</script>
