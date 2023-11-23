<ol class="breadcrumb bc-3">
    <li>
        <a href="<?php echo site_url('admin/dashboard'); ?>">
            <i class="entypo-folder"></i>
            <?php echo get_phrase('dashboard'); ?>
        </a>
    </li>
    <li><a href="#" class="active"><?php echo get_phrase('winners'); ?></a> </li>
</ol>
<h2><i class="fa fa-arrow-circle-o-right"></i> <?php echo $page_title; ?></h2>
<br />


<div class="panel panel-primary">
   
	<div class="panel-body">
		<div class="row">
            <div class="col-md-6">
                <label>Categories</label>
                <select class="form-control" name="categories" id="categories">
                    <option></option>
                    <?php foreach($categories->result() as $key){
                        echo '<option value="'.$key->id.'">'.$key->name.'</option>';
                    } ?>
                </select>
            </div>
            <div class="col-md-6">
                <label>Sub Categories</label>
                <select class="form-control" name="sub_categories" id="sub_categories">
                    <option></option>
                    
                </select>
            </div>
            
        </div>
	</div>
    
</div>


<div class="panel panel-primary">
     <div class="panel-header">
        <div class="row">
            <div class="col-md-12">
                <button class="btn btn-primary float-right" id="add_btn">Add</button>
                 <button class="btn btn-danger float-right" id="update">Delete</button>
            </div>
        </div>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-12 table-responsive">
                <form id="winner_form" method="POST">
                    
                </form>
            </div>
        </div>
    </div>
     
</div>

<script type="text/javascript">
    var message ;
    var type;
    var record =[];
    var record2=[];
    function show_toast(message,type,title='')
    {
        toastr[type](message, title, {
            positionClass: 'toast-top-right',
            closeButton: true,
            progressBar: true,
            newestOnTop: true,
            rtl: $("body").attr("dir") === "rtl" || $("html").attr("dir") === "rtl",
            timeOut: 5000,
        }); 
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

        $(document).off('change','#sub_categories').on('change','#sub_categories',function(){
            $('#winner_table_body').html('');
            var id = $('#sub_categories option:selected').val();
            if(id)
            {
               $.ajax({
                    url:'<?php echo base_url("admin/get_student")?>',
                    type:'POST',
                    data:{id:id},
                    dataType:'json',
                    success:function(data)
                    {
                        console.log(data);
                       $('#winner_form').html(data);  

                       $('#myTable').DataTable();  
                       
                    },
                    error:function(xhr)
                    {
                        console.log(xhr.status+ ' '+xhr.statusText);
                    }

                }); 
            }
        });

       $(document).off('click','.add_position').on('click','.add_position',function(){
           $this = $(this);
           var data = {
                id: $(this).attr('data-id'),
                sub_category_id:$(this).attr('data-sub_category_id'),
                image_url:$(this).attr('data-image_url'),
                position:$(this).closest('tr').find('td').eq(3).find('input').val()
            }
             if(!data.position)
            {
                message ='Position must be set';
                type ='error';
                show_toast(message,type);
            }
            else
            {
               if(record.length==3)
                {
                    message ='All positions are full, please remove atleast one.';
                    type ='error';
                    show_toast(message,type);
                }
                else
                {
                    record.push(data);
                    $($this).addClass('btn-success');
                     $($this).find('i').removeClass('fa-plus');
                     $($this).find('i').addClass('fa-check');
                    // console.log(record);
                } 
            }
            
           
       });
       
    
        

        // $(document).off('click','.add_position').on('click','.add_position',function(){
           
            var data = {
                id: $(this).attr('data-id'),
                sub_category_id:$(this).attr('data-sub_category_id'),
                image_url:$(this).attr('data-image_url'),
                position:$(this).closest('tr').find('td').eq(3).find('input').val()
            }
            // if(!data.position)
            // {
            //     message ='Position must be set';
            //     type ='error';
            //     show_toast(message,type);
            // }
        //     else
        //     {
        //         $.ajax({
        //             url:'<?php echo base_url('admin/add_winners')?>',
        //             type:'POST',
        //             data:data,
        //             dataType:'json',
        //             success:function(data)
        //             {
        //                 console.log(data);
        //                 if(data.result==true)
        //                 {
        //                     message =data.message;
        //                     type='success';
        //                     show_toast(message,type);
                            
                            
        //                 }
                       
        //             },
        //             error:function(xhr)
        //             {
        //                 console.log(xhr.status+' '+xhr.statusText);
        //             }
        //         });
        //     }
            

        // });

        $(document).off('click','.clear_position').on('click','.clear_position',function(){
            $(this).closest('tr').find('td').eq(3).find('input').val('');
            $(this).siblings('button').removeClass('btn-success');
            $(this).siblings('button').find('i').removeClass('fa-check');
            $(this).siblings('button').find('i').addClass('fa-plus');
            $(this).hide();
             var data = {
                id: $(this).attr('data-id'),
                sub_category_id:$(this).attr('data-sub_category_id')
            }
            
            record2.push(data);

        });
        
        $(document).off('click','#update').on('click','#update',function(){
            $.ajax({
                    url:'<?php echo base_url('admin/clear_winners')?>',
                    type:'POST',
                    data:{record2},
                    dataType:'json',
                    success:function(data)
                    {
                        console.log(data);
                        if(data.result==true)
                        {
                            message =data.message;
                            type='success';
                            show_toast(message,type);
                            setTimeout(function(){
                                location.reload();
                            },500);
                            
                        }
                       
                    },
                    error:function(xhr)
                    {
                        console.log(xhr.status+' '+xhr.statusText);
                    }
                });
        });
        


        // $(document).off('change','#student').on('change','#student',function(){
        //     var id = $('#student option:selected').val();
        //     var name = $('#student option:selected').text();
        //     var email = $('#student option:selected').attr('data-email');
        //     var sub_category_id = $('#sub_categories option:selected').val();
        //     var position = $('#winner_table_body tr').length + 1;
            
        //     $.ajax({
        //         url:'<?php echo base_url("admin/get_user_image_url")?>',
        //         type:'POST',
        //         data:{id:id},
        //         dataType:'json',
        //         success:function(data)
        //         {
        //             console.log(data);
        //              var html = '<tr>'+
        //                     '<td>'+
        //                          '<img src="'+data+'" alt="'+data+'" height="50" width="50" class="img-fluid">'+
        //                           '<input type="hidden" name="image_url[]" value="'+data+'">'+
        //                     '</td>'+
        //                     '<td>'+name+
        //                         '<input type="hidden" name="user_id[]" value="'+id+'">'+
        //                         '<input type="hidden" name="sub_category_id[]" value="'+sub_category_id+'">'+
        //                     '</td>'+
        //                     '<td>'+email+'</td>'+
                          
        //                     '<td>'+position+
        //                         '<input type="hidden" name="position[]" value="'+position+'">'+
        //                     '</td>'+
        //                     '<td>'+
        //                         '<button class="btn btn-sm btn-danger clear_btn">'+
        //                             '<i class="fa fa-times"></i>'+
        //                         '</button>'+
        //                     '</td>'+
        //                 '</tr>';
            
        //     $('#winner_table_body').append(html);

        //         },
        //         error:function(xhr)
        //         {
        //             console.log(xhr.status+' '+xhr.statusText);
        //         }   

        //     });

        // });

        $(document).off('click','.clear_btn').on('click','.clear_btn',function(){
            
            $(this).closest('tr').remove();
        });

        $(document).off('click','#add_btn').on('click','#add_btn',function(){
          
            
            $.ajax({
                url:'<?php echo base_url('admin/add_winners')?>',
                type:'POST',
                data:{record},
                dataType:'json',
                success:function(data)
                {
                    console.log(data);
                    if(data.result==true)
                    {
                        message = data.message;
                        type='success';
                        show_toast(message,type);
                        location.reload();
                    }
                },
                error:function(xhr)
                {
                    console.log(xhr.status+' '+xhr.statusText);
                }
            })
        });
    });
</script>