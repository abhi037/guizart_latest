<hr />
<ol class="breadcrumb bc-3">
  <li class = "active">
    <a href="#">
      <i class="entypo-folder"></i>
      <?php echo get_phrase('dashboard'); ?>
		</a>
	</li>
  <li><a href="<?php echo site_url('admin/sub_categories'); ?>"><?php echo get_phrase('class'); ?></a> </li>
  <li><a href="#" class="active"><?php echo get_phrase($page_title); ?></a> </li>
</ol>
<h2><i class="fa fa-arrow-circle-o-right"></i> <?php echo $page_title; ?></h2>
<br />

<div class="row">
	<div class="col-md-8 col-md-offset-2">
		<div class="panel panel-primary" data-collapsed="0">
      <div class="panel-heading">
				<div class="panel-title">
					<?php echo get_phrase('add_class_detail'); ?>
				</div>
			</div>
			<div class="panel-body">
        <div class="row">
          <form action="<?php echo site_url('master/manage/samester_action/add'); ?>" method="post" role="form" class="form-horizontal form-groups-bordered" enctype="multipart/form-data">
            <div class="col-md-12 col-sm-12 col-xs-12"> 
							
              <div class="form-group">
                <label class="col-sm-3 control-label"><?php echo get_phrase('category'); ?></label>
                <div class="col-sm-5">
                  <select class="form-control select2" id="category_id" name="category_id" data-init-plugin="select2" required>
                  	<option value=""> Select Category</option>
                    <?php foreach ($categories->result_array() as $category): ?>
										  <option value="<?php echo $category['id']; ?>" <?php if(isset($sub_category_id) && $category_id == $category['id']) echo 'selected'; ?>><?php echo $category['name']; ?></option>
                    <?php endforeach; ?>
									</select>
								</div>
							</div>
							
              <div class="form-group">
                <label class="col-sm-3 control-label"><?php echo get_phrase('sub_category'); ?></label>
                <div class="col-sm-5">
                  <select class="form-control select2" id="sub_category_id" name="sub_category_id" data-init-plugin="select2" required> 
									</select>
								</div>
							</div>
							
              <div class="form-group">
                <label class="col-sm-3 control-label"><?php echo get_phrase('name'); ?></label>
                <div class="col-sm-5">
                  <input type="text" name="title" id="title" class="form-control" required>
								</div>
							</div> 
							
              <div class="form-group">
                <div class="col-sm-offset-3 col-sm-5">
                  <button class="btn btn-success" type="submit" name="button"><?php echo get_phrase('add_class_detail'); ?></button>
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
	$(document).ready(function(){
    $('#category_id').change(function() {
    	var category_id = $(this).val(); 
    	$('#sub_category_id').find('option').remove();
      $('#s2id_sub_category_id').find('.select2-chosen').html('');
      $('#sub_category_id').append('<option value="">Select Sub-Category</option>');
      $.ajax({
        url: '<?php echo base_url('master/manage/sub_categories/')?>',
        type:'POST',
        data: {category_id: category_id},
        dataType:'json',
      }).done(function(response){ 
        if(response!='0') { 
        	$.each(response, function (index, value) {
	          $('#sub_category_id').append('<option value="'+ value.id +'">'+ value.name +'</option>');
	        }); 
        }  
      });
    });
  });
</script>