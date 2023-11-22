<ol class="breadcrumb bc-3">
    <li>
        <a href="<?php echo site_url('admin/dashboard'); ?>">
            <i class="entypo-folder"></i>
            <?php echo get_phrase('dashboard'); ?>
        </a>
    </li>
    <li><a href="<?php echo site_url('admin/matrix'); ?>"><?php echo get_phrase('exam_pattern'); ?></a> </li>
    <li><a href="#" class="active"><?php echo get_phrase('edit_exam_pattern'); ?></a> </li>
</ol>
<h2><i class="fa fa-arrow-circle-o-right"></i> <?php echo $page_title; ?></h2>
<br />

<div class="row">
	<div class="col-md-8 col-md-offset-2">
		<div class="panel panel-primary" data-collapsed="0">
            <div class="panel-heading">
				<div class="panel-title">
					<?php echo get_phrase('edit_category_form'); ?>
				</div>
			</div>
			<div class="panel-body">
                <form action="<?php echo site_url('admin/matrix/edit'); ?>" method="post" role="form" class="form-horizontal form-groups-bordered">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                    <?php
                        if(!empty($subjects)):
                            foreach($subjects as $sub):
                                $key = array_search($sub['id'], array_column($exam_detail, 'subject_id'));
                                if($key !== false):
                                    $value = $exam_detail[$key]['num_of_que'];
                                else:
                                    $value = 0;
                                endif;
                    ?>
                        <div class="form-group">
                            <label class="col-sm-3 control-label"><?php echo get_phrase($sub['name']); ?></label>

                            <div class="col-sm-5">
                                <input type="hidden" name="subjects[]" value="<?php echo $sub['id']; ?>">
                                <input type="text" name = "<?php echo $sub['id'].'_noOfQue' ?>" class="form-control questionNo" value = "<?php echo $value; ?>" onchange="total_questions();">
                            </div>
                        </div>
                    <?php 
                            endforeach;
                        endif;
                    ?>
                        <div class="form-group">
                            <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('total_questions'); ?></label>

                            <div class="col-sm-5">
                                <input type="text"  class="form-control" id="total_que" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('attempt_time'); ?></label>

                            <div class="col-sm-5">
                                <input type="number" name = "attempt_time" class="form-control" required value="<?php echo $exam_detail[0]['attempt_time']; ?>">
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-5">
                                <button class = "btn btn-success" type="submit" name="button"><?php echo get_phrase('update_pattern'); ?></button>
                            </div>
                        </div>
                        <input type="hidden" name="exam_id" value="<?php echo $exam_id; ?>">
                    </div>
                </form>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
  function total_questions(){
      var total_que = 0;
      $( ".questionNo" ).each(function( index ) {
        total_que = parseInt($( this ).val()) + total_que ;
    });
        $('#total_que').val(total_que);
  }
  total_questions();
</script>
