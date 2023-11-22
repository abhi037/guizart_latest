<ol class="breadcrumb bc-3">
    <li>
        <a href="<?php echo site_url('admin/dashboard'); ?>">
            <i class="entypo-folder"></i>
            <?php echo get_phrase('dashboard'); ?>
        </a>
    </li>
    <li><a href="#" class="active"><?php echo get_phrase('slider'); ?></a> </li>
</ol>
<h2><i class="fa fa-arrow-circle-o-right"></i> <?php echo $page_title; ?></h2>
<br />

<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
			<div class="panel-body">
                <div class="row">
                    <form action="<?php echo site_url('admin/slider/add'); ?>" method="post" role="form" class="form-horizontal form-groups-bordered" enctype="multipart/form-data">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Upload Images</label>
                                <div class="col-sm-5">
                                    <input type="file" name="gallery" class="form-control" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">Position</label>
                                <div class="col-sm-5">
                                    <input type="number" name="position" class="form-control" min="1" value="1" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">Heading Text</label>
                                <div class="col-sm-5">
                                    <input type="text" name="htext" class="form-control">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">Button Text</label>
                                <div class="col-sm-5">
                                    <input type="text" name="ptext" class="form-control">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">Button Link</label>
                                <div class="col-sm-5">
                                    <input type="text" name="blink" class="form-control">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">Slider Position</label>
                                <div class="col-sm-5">
                                    <select name = "type" class="form-control" required>
                                        <option value="slider">Slider Upper</option>
                                        <option value="slider1">Slider Lower</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">Status</label>
                                <div class="col-sm-5">
                                    <select name = "status" class="form-control" required>
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
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
    function ajax_get_slider(){
        $.ajax({
            url: '<?php echo site_url('admin/ajax_get_slider/');?>',
            success: function(response)
            {
                jQuery('#gallery').html(response);
            }
        });
    }

    ajax_get_slider();

    function changePosition(id){
        var position = $('#position'+id).val();
        console.log(position); 
        $.ajax({
            type: "POST",
            url: "<?php echo base_url('admin/slider/changePosition');?>",
            data: { id: id, position : position} ,
            success: function (r) {
                toastr.success('Data Updated successfully!');
            }
        });
    }
</script>