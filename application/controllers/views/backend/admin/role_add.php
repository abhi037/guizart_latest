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
  <div class="col-md-12">
    <div class="panel panel-primary" data-collapsed="0">
      <div class="panel-heading">
        <div class="panel-title">
          <?php echo get_phrase('role_add_form'); ?>
        </div>
      </div>
      <div class="panel-body">
        <form action="<?php echo site_url('usermanagement/roles/add'); ?>" method="post" role="form" class="form-horizontal form-groups-bordered">
          <div class="col-md-12 col-sm-12 col-xs-12"> 
            
            <div class="form-group">
              <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('role_name'); ?></label>
              <div class="col-sm-5">
                <input type="text" name="name" id="name" class="form-control" required>
              </div>
            </div>  
            <?php foreach($permissions AS $key=>$values) {?>
              <div class="row">
                <div class="panel panel-primary" data-collapsed="0">
                  <div class="panel-heading">
                    <div class="panel-title">
                      <?php echo $key; ?>
                    </div>
                  </div>
                  <div class="panel-body">
                    <?php foreach($values AS $value) { ?>
                      <div class="row">
                        <label class="col-sm-12">
                          <div class="col-sm-6">
                            <?php echo $value['permission']; ?>
                          </div>
                          <div class="col-sm-5">
                            <input type="checkbox" name="permission[]" id="permission[]" value="<?php echo $value['id'];?>" <?php echo (isset($value['isrequired']) && $value['isrequired'] ? 'checked="checked"' : '')?>/>
                          </div>
                        </label>
                      </div>  
                    <?php } ?> 
                  </div>
                </div>
              </div>
            <?php } ?>
            <div class="form-group">
              <div class="col-sm-offset-3 col-sm-5">
                <button class = "btn btn-success" type="submit" name="button"><?php echo get_phrase('add_role'); ?></button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
