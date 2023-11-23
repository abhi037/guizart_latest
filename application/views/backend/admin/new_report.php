<ol class="breadcrumb bc-3">
    <li>
        <a href="<?php echo site_url('admin/dashboard'); ?>">
            <i class="entypo-folder"></i>
            <?php echo get_phrase('dashboard'); ?>
        </a>
    </li>
    <li><a href="#" class="active"><?php echo get_phrase('Report'); ?></a> </li>
</ol>
<h2><i class="fa fa-arrow-circle-o-right"></i> <?php echo $page_title; ?></h2>
<br />



<div class="panel panel-primary">
	<div class="panel-body">
		<div class="row">
            <div class="col-md-4">
                <label>Categories</label>
                <select class="form-control" name="categories" id="categories">
                    <option></option>
                    <?php foreach($categories->result() as $key){
                        echo '<option value="'.$key->id.'">'.$key->name.'</option>';
                    } ?>
                </select>
            </div>
            <div class="col-md-4">
                <label>Sub Categories</label>
                <select class="form-control" name="sub_categories" id="sub_categories">
                    <option></option>
                    
                </select>
            </div>
            <div class="col-md-4">
                <label>Data Range</label>
                <input type="text" name="daterange" id="daterange" class="form-control">
            </div>
        </div>
	</div>
</div>

<div class="panel panel-primary">
	<div class="panel-body">
		<div class="row">
			<div class="col-md-12 table-responsive" id="table_list">
				
			</div>
		</div>
	</div>
</div>


<script type="text/javascript">

	function get_report(){

	}

    $(document).ready(function(){
        /*Get Subcategories*/
        $(document).off('change','#categories').on('change','#categories',function(){
            var id = $('#categories option:selected').val();
            if(id)
            {
               $.ajax({
                    url:'<?php echo base_url("admin/get_sub_categories")?>',
                    type:'POST',
                    data:{id:id},
                    dataType:'json',
                    success:function(data)
                    {
                        console.log(data);
                        var html ='<option value=""></option>';
                        if(data)
                        {
                            
                            for(x of data)
                            {
                                html+='<option value="'+x.id+'">'+x.name+'</option>';
                            }
                            
                        }
                        $('#sub_categories').html(html);
                    },
                    error:function(xhr)
                    {
                        console.log(xhr.status+ ' '+xhr.statusText);
                    }

                }); 
            }
        });

       

        $('#daterange').daterangepicker({
        	locale:{
	        	format:"DD MMMM YYYY",
	        },
	        maxDate:moment().subtract('days',0),
        });

       

        $(document).off('click','.applyBtn').on('click','.applyBtn',function(){
        	
        	data={
        		category_id : $('#categories option:selected').val(),
        		sub_category_id : $('#sub_categories option:selected').val(),
        		daterange : $('#daterange').val()
        	}
        	
        	$.ajax({
        		url:'<?php echo base_url("admin/get_new_report")?>',
        		type:'POST',
        		data:data,
        		dataType:'json',
        		success:function(data)
        		{
        		//	console.log(data);
        			$('#table_list').html(data);
        // 			var html ='';
        // 			if(data)
        // 			{
        // 				for(x of data)
        // 				{
        // 					html +='<tr>'+
        					
        // 						'<td>'+x.first_name+' '+x.last_name+'</td>'+
        // 						'<td>'+x.email+'</td>'+
        // 						'<td>'+x.contact+'</td>'+
        // 						'<td>'+x.total_marks+'</td>'+
        // 						'<td>'+x.marks_obt+'</td>'+
        // 						'<td>'+x.auto_submission+'</td>'+
        // 						'<td>'+x.total_attempt+'</td>'+
        // 					'</tr>';
        // 				}
        // 			}
        		
        			
        			$('#myTable').DataTable({
                		dom: 'Bfrtip',
                        buttons: [
                            'excel'
                        ]
        			});
        		},
        		error:function(xhr)
        		{
        			console.log(xhr.status+' '+xhr.statusText);
        		}
        	});
        });

        
    });
</script>

