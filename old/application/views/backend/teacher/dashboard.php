<style>
    .tile-red,.tile-green,.tile-aqua{
  background:#2B3A4A !important;
    }
  
</style>

<ol class="breadcrumb bc-3">
  <li class = "active">
    <a href="#">
      <i class="entypo-folder"></i>
      <?php echo get_phrase('dashboard'); ?>
    </a>
  </li>
</ol>
<h2><i class="fa fa-arrow-circle-o-right"></i> <?php echo $page_title; ?></h2>
<br />

<div class="row">
  <div class="col-md-12">
    <div class="panel panel-primary" data-collapsed="0">
      <div class="panel-heading">
        <div class="panel-title">
            <?php echo get_phrase('Teacher_dashboard'); ?>
        </div>
      </div>
      <div class="panel-body"> 
        <!-- <form action="<?php echo site_url('teacher/dashboard/assignsubject'); ?>" method="post">
          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label class="control-label"><?php echo get_phrase('select_subject'); ?></label>
                
                <select class="select2-container select2-container-multi select2 visible" id="subject" name="subject[]" multiple data-placeholder="<?php echo get_phrase('select_subject'); ?>"> 
                  <?php 
                    foreach($subjects->result_array() AS $skey => $svalue) {
                      echo "<option value='". $svalue['id'] . "'>". $svalue['name'] ."</option>";
                    }
                  ?> 
                </select>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <br/>
                <button type="submit" class="btn btn-info"><?php echo get_phrase('submit');?></button>
              </div>
            </div>
          </div>
        </form> -->

        <div class="row"> 

          <div class="col-sm-3">
            <div class="tile-progress tile-blue"> 
              <div class="tile-header">
                <h3><?php echo $quesdata['total']; ?></h3>  
                <span>Total Questions.</span> 
              </div> 
              <div class="tile-progressbar"> 
                <span data-fill="<?php echo ($quesdata['total'] > 0 ? 100 : 0) ?>%" style="width: <?php echo ($quesdata['total'] > 0 ? 100 : 0) ?>%;"></span> 
              </div> 
              <div class="tile-footer"> 
                <h4> 
                  <span class="pct-counter"><?php echo ($quesdata['total'] > 0 ? 100 : 0) ?></span>% increase
                </h4> 
              </div> 
            </div>
          </div>
          <?php
            $sent = ($quesdata['total']-$quesdata['pending']);
            $sentpr = ($quesdata['total'] > 0 ? (number_format((($quesdata['total']-$quesdata['pending'])/$quesdata['total']), 2)*100) : 0.00);
          ?>
          <div class="col-sm-3">
            <div class="tile-progress tile-cyan"> 
              <div class="tile-header">
                <h3><?php echo $sent; ?></h3>  
                <span>Questions Submitted.</span> 
              </div> 
              <div class="tile-progressbar"> 
                <span data-fill="<?php echo ($sentpr > 0 ? $sentpr : 0) ?>%" style="width: <?php echo ($sentpr > 0 ? $sentpr : 0) ?>%;"></span> 
              </div> 
              <div class="tile-footer"> 
                <h4> 
                  <span class="pct-counter"><?php echo ($sentpr > 0 ? $sentpr : 0) ?></span>% increase
                </h4> 
              </div> 
            </div>
          </div>
          <?php 
            $pendingpr = ($quesdata['total'] ? (number_format(($quesdata['pending']/$quesdata['total']), 2)*100) : 0);
          ?>
          <div class="col-sm-3">
            <div class="tile-progress tile-purple"> 
              <div class="tile-header">
                <h3><?php echo $quesdata['pending']; ?></h3>  
                <span>Pending For Submission.</span> 
              </div> 
              <div class="tile-progressbar"> 
                <span data-fill="<?php echo ($quesdata['total'] > 0 ? $pendingpr : 0) ?>%" style="width: <?php echo ($quesdata['total'] > 0 ? $pendingpr : 0) ?>%;"></span> 
              </div> 
              <div class="tile-footer"> 
                <h4> 
                  <span class="pct-counter"><?php echo ($quesdata['total'] > 0 ? $pendingpr : 0) ?></span>% increase
                </h4> 
              </div> 
            </div>
          </div> 

          <div class="col-sm-3">
            <div class="tile-progress tile-pink"> 
              <div class="tile-header">
                <h3>0</h3>  
                <span>Ranking.</span> 
              </div> 
              <div class="tile-progressbar"> 
                <span data-fill="0%" style="width: 0%;"></span> 
              </div> 
              <div class="tile-footer"> 
                <h4> 
                  <span class="pct-counter">0</span>% increase
                </h4> 
              </div> 
            </div>
          </div>

        </div>
        <div class="row">
          <div class="col-sm-3">
            <div class="tile-progress tile-purple"> 
              <div class="tile-header">
                <h3><?php echo isset($user_details['referral_code']) ? $user_details['referral_code'] : ''; ?></h3>  
                <span>Referral Code.</span> 
              </div>   
            </div>
          </div>
        </div>
        <br />
        <hr />
        <br /> 
        <h3>Submit Questions <small>(Multiple of 5 by selecting Category or Sub-Category or Class or Subject.)</small></h3> 
        <hr />
        <form action="<?php echo site_url('teacher/sendquestions'); ?>" method="post" id="myfrm"> 
          <div class="row"> 
            <div class="col-md-3 col-sm-6 form-group">
              <label class="control-label"><?php echo get_phrase('category'); ?></label>
              <div class="controls">
                <select class="form-control select2" id="category_id" name="category_id" data-init-plugin="select2">
                  <option value=""> Select Category</option>
                  <?php foreach ($categories->result_array() as $category): ?>
                    <option value="<?php echo $category['id']; ?>" <?php if(isset($sub_category_id) && $category_id == $category['id']) echo 'selected'; ?>><?php echo $category['name']; ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div> 

            <div class="col-md-3 col-sm-6 form-group">
              <label class="control-label"><?php echo get_phrase('sub_category'); ?></label>
              <div class="controls">
                <select class="form-control select2" id="sub_category_id" name="sub_category_id" data-init-plugin="select2"> 
                  <option value="">Select Sub-Category</option>
                </select>
              </div>
            </div>

            <div class="col-md-3 col-sm-6 form-group">
              <label class="control-label"><?php echo get_phrase('class'); ?></label>
              <div class="controls">
                <select class="form-control select2" id="samester" name="samester" data-init-plugin="select2"> 
                  <option value="">Select Class</option>
                </select>
              </div>
            </div>

            <div class="col-md-3 col-sm-6 form-group">
              <label class="form-label"><?php echo get_phrase('subject'); ?></label>
              <div class="controls">
                <select class="form-control select2" id="subject_id" name="subject_id" data-init-plugin="select2">
                  <option value=""><?php echo get_phrase('select_subject'); ?></option> 
                </select>
              </div>
            </div>  
          </div>
          <div class="row">
            <div class="col-sm-12"> 
               No of questions pending <span id="counts" style="font-size:15px; font-weight:600"><?php echo isset($pending_questions) ? $pending_questions : 0; ?></span>. &nbsp;
              <button type="submit" class="btn btn-info" id="btnSubmit" <?php echo (isset($pending_questions) && $pending_questions > 5 ? '' : 'disabled'); ?>> Click For Submission </button>  
            </div>
          </div>
        </form> 

      </div>
    </div>
  </div>
</div>
<script src="<?php echo base_url().'assets/backend/plugins/bootstrap-select2/select2.min.js'; ?>" type="text/javascript"></script>

<script type="text/javascript">
  $(document).ready(function(){
    $('#category_id').change(function() {
      var category_id = $(this).val(); 
      $('#sub_category_id').find('option').remove();
      $('#s2id_sub_category_id').find('.select2-chosen').html('');
      $('#sub_category_id').append('<option value="">Select Sub-Category</option>');
      $.ajax({
        url: '<?php echo base_url('teacher/sub_categories/')?>',
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
      GetCount();
    });

    $('#sub_category_id').change(function() {
      var sub_category_id = $(this).val(); 
      $('#samester').find('option').remove();
      $('#s2id_samester').find('.select2-chosen').html('');
      $('#samester').append('<option value="">Select Class</option>');
      $.ajax({
        url: '<?php echo base_url('teacher/get_samester/')?>',
        type:'POST',
        data: {sub_category_id: sub_category_id},
        dataType:'json',
      }).done(function(response){ 
        if(response!='0') { 
          $.each(response, function (index, value) {
            $('#samester').append('<option value="'+ value.id +'">'+ value.title +'</option>');
          }); 
        }  
      });
      GetCount();
    });

    $('#samester').change(function() {
      var samester = $(this).val(); 
      $('#subject_id').find('option').remove();
      $('#s2id_subject_id').find('.select2-chosen').html('');
      $('#subject_id').append('<option value="">Select Subject</option>');
      $.ajax({
        url: '<?php echo base_url('teacher/get_subject/')?>',
        type:'POST',
        data: {samester: samester},
        dataType:'json',
      }).done(function(response){ 
        if(response!='0') { 
          $.each(response, function (index, value) {
            $('#subject_id').append('<option value="'+ value.id +'">'+ value.name +'</option>');
          }); 
        }  
      });
      GetCount();
    }); 
    $('#subject_id').change(function() {
      GetCount();
    });
    function GetCount() {
      var form = $("#myfrm").get(); 
      $.ajax({
        url: '<?php echo base_url('teacher/GetQuesCount/')?>',
        type:'POST',
        data: $(form).serialize()
      }).done(function(response){ 
        $('#counts').html(response);
        if(response > 0) {
          $("#btnSubmit").removeAttr("disabled");
        } else {
          $("#btnSubmit").attr("disabled", true);
        }
      });
    }
  });
</script>

<?php
if($this->session->userdata('new_post')!=null){
  $record = $this->session->userdata('new_post');
  //print_r($record);
}
?>