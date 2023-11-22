<ol class="breadcrumb bc-3">
    <li>
        <a href="<?php echo site_url('admin/dashboard'); ?>">
            <i class="entypo-folder"></i>
            <?php echo get_phrase('dashboard'); ?>
        </a>
    </li>
    <li><a href="#" class="active"><?php echo get_phrase('pages_slider'); ?></a> </li>
</ol>
<h2><i class="fa fa-arrow-circle-o-right"></i> <?php echo $page_title; ?></h2>
<br />


<form action="<?php echo site_url('admin/pages_slider/'); ?>" method="post" role="form" class="form-horizontal form-groups-bordered" enctype="multipart/form-data">

<div class="panel panel-primary">
	<div class="panel-body">
		<div class="row mb-3">
			<div class="col-md-12 form-group">
				<label class="col-sm-3 control-label">Upload Images</label>
				 <div class="col-sm-5">
                    <input type="file" name="gallery" class="form-control" required>
                </div>
			</div>
		</div>
		
		<div class="row mb-3">
			<div class="col-md-12 form-group">
				<label class="col-sm-3 control-label">Select Pages</label>
                <div class="col-sm-5">
                    <input type="hidden" name="type" value="pages_slider">
                    <select class="form-control" name="page_name">
                        <option value=""></option>
                        <?php
                            foreach($pages->result_array() as $page){
                            echo '<option value="'.$page['title'].'">'.$page['title'].'</option>';
                        }?>
                    </select>
                </div>
			</div>
		</div>
	
	
		
		<div class="row mb-3">
			<div class="col-md-12 form-group">
				<label class="col-sm-3 control-label">Status</label>
                <div class="col-sm-5">
                    <select name = "status" class="form-control" required>
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </div>
			</div>
		</div>
		<div class="row mb-3">
			<div class="col-md-12 form-group">
				<div class="col-sm-offset-3 col-sm-5">
                    <button class = "btn btn-success" type="submit" name="button"><?php echo get_phrase('upload'); ?></button>
                </div>
			</div>
		</div>
	</div>
</div>

</form>


<div class="panel panel-primary">
    <div class="panel-body">
        <div class="table-responsive">
           
            <table class="table">
                <thead>
                    <tr>
                        <th>Page</th>
                        <th>Image</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($pages_image as $key){
                        echo '<tr>
                                <td>'.get_phrase($key->page_name).'</td>
                                <td>
                                    <img src="'.base_url('uploads/pages/slider/').$key->image_name.'" class="img-fluid" style="width:100px">
                                </td>
                                <td>'.$key->status.'</td>
                                <td>
                                    <button class="btn btn-danger clear" title="Clear" data-id="'.$key->id.'">
                                        <i class="fa fa-times"></i>
                                    </button>
                                </td>
                        </tr>';
                    }?>
                </tbody>
            </table>
        </div>
    </div>
</div>


<script>
    $(document).ready(function(){
        $(document).off('click','.clear').on('click','.clear',function(){
            var id = $(this).attr('data-id');
            var ans = confirm('Are You Sure?');
            if(ans)
            {
              $.ajax({
                  url:'<?php echo base_url('admin/clear_pages_slider')?>', 
                  type:'POST',
                  data:{id:id},
                  dataType:'json',
                  success:function(data)
                  {
                      console.log(data);
                      if(data.result==true)
                      {
                          message = data.message;
                          type ='success';
                          location.reload();
                      }
                  },
                  error:function(xhr)
                  {
                        console.log(xhr.status+' '+xhr.statusText);
                  }
                });  
            }
           
        }) ;
    });
</script>

