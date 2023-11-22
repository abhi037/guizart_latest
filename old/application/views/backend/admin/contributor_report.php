<ol class="breadcrumb bc-3">
    <li>
        <a href="<?php echo site_url('admin/dashboard'); ?>">
            <i class="entypo-folder"></i>
            <?php echo get_phrase('report'); ?>
        </a>
    </li>
    <li><a href="#" class="active"><?php echo get_phrase('contributor_report'); ?></a> </li>
</ol>
<h2><i class="fa fa-arrow-circle-o-right"></i> <?php echo $page_title; ?></h2>
<br />
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
			<div class="panel-body">
		    <table class="table table-bordered datatable" id="table-1">
	        <thead>
            <tr> 
              <th>Maximum No of question</th>
              <th>Contributar Name</th> 
              <th>Subject</th> 
              <th>No of question verified</th> 
              <th>No of question rejected</th> 
              <th>Month</th> 
            </tr>
	        </thead>
	        <tbody>
            <?php  
              foreach($total_question as $key=>$value)
              {
            ?>
              <tr> 
                <td><?php echo $value['total']; ?></td> 
                <td><?php echo $value['username']; ?></td>
                <td><?php echo $value['subject_name']; ?></td>
                <td><?php echo $value['approve']; ?></td>
                <td><?php echo $value['rejected']; ?></td>
                <td><?php echo $value['month']; ?></td>
              </tr>
            <?php  
              }
            ?>
	        </tbody>
		    </table>
			</div>
	  </div>
	</div>
</div>	



<script>
    $(document).ready(function(){
        $('#table-1').DataTable({
           'dom':"<'row'<'col-sm-12 col-md-6 mb-2'B>>"+
					"<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
						"<'row'<'col-sm-12'tr>>" +
						"<'row'<'col-sm-12 col-md-6 mt-2'i><'col-sm-12 mt-2 col-md-6'p>>",
            buttons: [
                'csvHtml5',
                'excelHtml5'
            ]
        });
    });
</script>