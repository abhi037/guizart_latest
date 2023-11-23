<ol class="breadcrumb bc-3">
    <li>
        <a href="<?php echo site_url('admin/dashboard'); ?>">
            <i class="entypo-folder"></i>
            <?php echo get_phrase('dashboard'); ?>
        </a>
    </li>
    <li><a href="#" class="active"><?php echo get_phrase('exam_pattern'); ?></a> </li>
</ol>
<h2><i class="fa fa-arrow-circle-o-right"></i> <?php echo $page_title; ?></h2>
<br />

<div class="row">
	<div class="col-md-8 col-md-offset-2">
		<div class="panel panel-primary" data-collapsed="0">
			<div class="panel-body">
                <div class="row">
                    <div class="col-md-4 col-md-offset-4">
                        <div class="form-group">
                            <div class="controls">
                                <select class="form-control" id="category_id" name="category_id" required onchange="ajax_get_exam_pattern(this.value)">
                                    <option value=""><?php echo get_phrase('select_category'); ?></option>
                                    <?php
                                        foreach ($categories->result_array() as $category):?>
                                        <option value="<?php echo $category['id']; ?>"><?php echo $category['name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div id="category_result">
                </div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
    function ajax_get_exam_pattern(category_id){
        $.ajax({
            url: '<?php echo site_url('admin/ajax_get_exam_pattern/');?>' + category_id ,
            success: function(response)
            {
                jQuery('#category_result').html(response);
                console.log(response);
            }
        });
    }
</script>
