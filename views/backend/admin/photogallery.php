<ol class="breadcrumb bc-3">
    <li>
        <a href="<?php echo site_url('admin/dashboard'); ?>">
            <i class="entypo-folder"></i>
            <?php echo get_phrase('dashboard'); ?>
        </a>
    </li>
    <li><a href="#" class="active"><?php echo get_phrase('Photo_gallery'); ?></a> </li>
</ol>
<h2><i class="fa fa-arrow-circle-o-right"></i> <?php echo $page_title; ?></h2>
<br />

<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
			<div class="panel-body">
                <div class="row">
                    <form action="<?php echo site_url('admin/photogallery/add'); ?>" method="post" role="form" class="form-horizontal form-groups-bordered" enctype="multipart/form-data">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Upload Images</label>
                                <div class="col-sm-5">
                                    <input type="file" name="gallery[]" class="form-control" multiple="multiple" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-5">
                                <button class = "btn btn-success" type="submit" name="button"><?php echo get_phrase('upload'); ?></button>
                            </div>
                        </div>
                    </form>
                </div>
			</div>
		</div>
	</div>
</div>
<hr/>

<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
			<div class="panel-body" id="gallery">
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
    function ajax_get_gallery(){
        $.ajax({
            url: '<?php echo site_url('admin/ajax_get_gallery/');?>',
            success: function(response)
            {
                jQuery('#gallery').html(response);
            }
        });
    }

    ajax_get_gallery();
</script>