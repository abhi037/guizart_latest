<ol class="breadcrumb bc-3">
  <li>
    <a href="<?php echo site_url('admin/dashboard'); ?>">
      <i class="entypo-folder"></i>
      <?php echo get_phrase('dashboard'); ?>
    </a>
  </li>
  <li><a href="#" class="active"><?php echo get_phrase('roles'); ?></a> </li>
</ol>
<h2><i class="fa fa-arrow-circle-o-right"></i> <?php echo $page_title; ?></h2>
<br />

<div class="row">
  <div class="col-md-6">
    <div class="panel panel-primary" data-collapsed="0">
      <div class="panel-body"> 
        <div class="row">
          <div class="col-md-4 col-md-offset-4">
            <a href = "<?php echo site_url('usermanagement/role_form/add_role'); ?>" class="btn btn-block btn-info btn-lg" type="button">
              <i class="fa fa-plus"></i>&nbsp;&nbsp;<?php echo get_phrase('add_role'); ?>
            </a>
          </div>
        </div>

        </br>

        <table class="table table-bordered datatable" id="table-1">
          <thead>
            <tr>
              <th><?php echo get_phrase('Role'); ?></th> 
              <th><?php echo get_phrase('actions'); ?></th>
            </tr>
          </thead>
          <tbody> 
            <?php 
            foreach($roles->result_array() AS $role) 
            { 
              if($role['id'] > 3) { ?>
                <tr>
                  <td> <?php echo $role['name'];?></td>
                  <td> 
                   <div class="btn-group">
                      <button type="button" class="btn btn-default" data-toggle="dropdown"> <i class = "fa fa-ellipsis-v"></i> </button>
                      <ul class="dropdown-menu"> 
                        <li>
                          <a href="<?php echo site_url('usermanagement/role_form/edit_role/' . $role['id']) ?>">
                            <?php echo get_phrase('edit');?>
                          </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                          <a href="#" onclick="confirm_modal('<?php echo site_url('usermanagement/roles/delete/' . $role['id']); ?>');">
                            <?php echo get_phrase('delete');?>
                          </a>
                        </li>
                      </ul>
                    </div>
                  </td>
                </tr>
            <?php 
              }
            } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
