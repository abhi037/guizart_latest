
<style>
	.mb-3{
		margin-bottom: 3vh;
	}
</style>
<ol class="breadcrumb bc-3">
  <li class = "active">
      <a href="<?php echo site_url('admin/dashboard'); ?>">
          <i class="entypo-folder"></i>
          <?php echo get_phrase('dashboard'); ?>
      </a>
  </li>
  <li><a href="<?php echo site_url('admin/pages'); ?>" class=""><?php echo get_phrase('pages'); ?></a> </li>
  <li><a href="#" class="active"><?php echo get_phrase('edit_pages'); ?></a> </li>
</ol>
<h2><i class="fa fa-arrow-circle-o-right"></i> <?php echo $page_title; ?></h2>
<br />

<!--<form action="<?php echo site_url('admin/pages_slider/edit/').$page_id; ?>" method="post" role="form" class="form-horizontal form-groups-bordered" enctype="multipart/form-data">-->

<!--<div class="panel panel-primary">-->
<!--	<div class="panel-body">-->
<!--		<div class="row mb-3">-->
<!--			<div class="col-md-12 form-group">-->
<!--				<label class="col-sm-3 control-label">Upload Images</label>-->
<!--				 <div class="col-sm-5">-->
<!--                    <input type="file" name="gallery" class="form-control" required>-->
<!--                </div>-->
<!--			</div>-->
<!--		</div>-->
<!--		<div class="row mb-3">-->
<!--			<div class="col-md-12 form-group">-->
<!--				<label class="col-sm-3 control-label">Position</label>-->
<!--                <div class="col-sm-5">-->
<!--                    <input type="number" name="position" class="form-control" min="1" value="1" required>-->
<!--                </div>-->
<!--			</div>-->
<!--		</div>-->
<!--		<div class="row mb-3">-->
<!--			<div class="col-md-12 form-group">-->
<!--				<label class="col-sm-3 control-label">Heading Text</label>-->
<!--                <div class="col-sm-5">-->
<!--                    <input type="text" name="htext" class="form-control">-->
<!--                </div>-->
<!--			</div>-->
<!--		</div>-->
<!--		<div class="row mb-3">-->
<!--			<div class="col-md-12 form-group">-->
<!--				<label class="col-sm-3 control-label">Button Text</label>-->
<!--                <div class="col-sm-5">-->
<!--                    <input type="text" name="ptext" class="form-control">-->
<!--                </div>-->
<!--			</div>-->
<!--		</div>-->
<!--		<div class="row mb-3">-->
<!--			<div class="col-md-12 form-group">-->
<!--				<label class="col-sm-3 control-label">Button Link</label>-->
<!--                <div class="col-sm-5">-->
<!--                    <input type="text" name="blink" class="form-control">-->
<!--                    <input type="hidden" name="type" value="pages_slider">-->
<!--                    <input type="hidden" name="page_name" value="<?php echo $page_detail['title']; ?>">-->
<!--                </div>-->
<!--			</div>-->
<!--		</div>-->
		
<!--		<div class="row mb-3">-->
<!--			<div class="col-md-12 form-group">-->
<!--				<label class="col-sm-3 control-label">Status</label>-->
<!--                <div class="col-sm-5">-->
<!--                    <select name = "status" class="form-control" required>-->
<!--                        <option value="1">Active</option>-->
<!--                        <option value="0">Inactive</option>-->
<!--                    </select>-->
<!--                </div>-->
<!--			</div>-->
<!--		</div>-->
<!--		<div class="row mb-3">-->
<!--			<div class="col-md-12 form-group">-->
<!--				<div class="col-sm-offset-3 col-sm-5">-->
<!--                    <button class = "btn btn-success" type="submit" name="button"><?php echo get_phrase('upload'); ?></button>-->
<!--                </div>-->
<!--			</div>-->
<!--		</div>-->
<!--	</div>-->
<!--</div>-->

<!--</form>-->

 <form class="" action="<?php echo site_url('admin/pages/edit/'.$page_id); ?>" method="post" enctype="multipart/form-data">
<div class="panel panel-primary">
	<div class="panel-body">
		<div class="row mb-3 ">
			<div class="col-md-12 form-group">
				 <label class="form-label"><?php echo get_phrase('Title'); ?></label> 
                <div class="controls">
                    <input type="text" name = "title" class="form-control" value="<?php echo $page_detail['title']; ?>">
                </div>
			</div>


			<div class="col-md-12 form-group">
				<label class="form-label"><?php echo get_phrase('content'); ?></label>
				<div class="controls col-md-12">
                  <?php echo $this->ckeditor->editor("content","", html_entity_decode($page_detail['content'])); ?>
              	</div>
			</div>
		</div>
		<div class="row mb-3">
			<div class="col-md-12 form-group">
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
	              <button class = "btn btn-block btn-success" type="submit" name="button"><?php echo get_phrase('update_page'); ?></button>
	         </div>
	       </div>
	    </div>

	</div>
</div>
</form>