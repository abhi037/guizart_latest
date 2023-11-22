<ol class="breadcrumb bc-3">
  <li class = "active">
      <a href="<?php echo site_url('admin/dashboard'); ?>">
          <i class="entypo-folder"></i>
          <?php echo get_phrase('dashboard'); ?>
      </a>
  </li>
  <li><a href="<?php echo site_url('admin/pages'); ?>" class=""><?php echo get_phrase('pages'); ?></a> </li>
  <li><a href="#" class="active"><?php echo get_phrase('add_pages'); ?></a> </li>
</ol>
<h2><i class="fa fa-arrow-circle-o-right"></i> <?php echo $page_title; ?></h2>
<br />
<div class="row">
<div class="col-md-12">
	<div class="panel panel-primary" data-collapsed="0">
          <div class="panel-heading">
			<div class="panel-title">
        <?php echo get_phrase('add_page_form'); ?>
			</div>
		</div>
		<div class="panel-body">
              <div class="row">
                  <div class="col-md-12">
                      <form class="" action="<?php echo site_url('admin/pages/add'); ?>" method="post" enctype="multipart/form-data">



                        <div class="form-group">
                            <label class="form-label"><?php echo get_phrase('Title'); ?></label>
                            <div class="controls">
                                <input type="text" name = "title" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                                  <label class="form-label"><?php echo get_phrase('content'); ?></label>
                                  <div class="controls">
                                      <?php echo $this->ckeditor->editor("content",""); ?>
                                  </div>
                              </div>

                        <div class="form-group">
                            <label class="form-label"><?php echo get_phrase('status'); ?></label>
                            <div class="controls">
                                <select class="form-control" id="status" name="status" required>
                                        <option value="1">Active</option>
                                        <option value="0">In Active</option>
                                </select>
                            </div>
                        </div>


                  </div>

                  <div class="row">
                    <div class="col-md-offset-4 col-md-3 col-sm-12 col-xs-12">
                      <div class="form-group">
                          <button class = "btn btn-block btn-success" type="submit" name="button"><?php echo get_phrase('add_page'); ?></button>
                      </div>
                    </div>
                  </div>

                  </form>
              </div>
		</div>
	</div>
</div>
</div>

<script type="text/javascript">
  
</script>

<style media="screen">
body {
  overflow-x: hidden;
}
</style>
