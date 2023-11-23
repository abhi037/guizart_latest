<ol class="breadcrumb bc-3">
  <li class = "active">
    <a href="<?php echo site_url('admin/dashboard'); ?>">
      <i class="entypo-folder"></i>
      <?php echo get_phrase('dashboard'); ?>
    </a>
  </li>
  <li><a href="<?php echo site_url('admin/questions'); ?>" class=""><?php echo get_phrase('questions'); ?></a> </li>
  <li><a href="#" class="active"><?php echo get_phrase('review_questions'); ?></a> </li>
</ol>
<h2><i class="fa fa-arrow-circle-o-right"></i> <?php echo $page_title; ?></h2>
<br />
<div class="row">
  <div class="col-md-12">
    <div class="panel panel-primary" data-collapsed="0">
      <div class="panel-heading">
        <div class="panel-title">
          <?php echo get_phrase('review_question'); ?>
        </div>
      </div>
      <div class="panel-body">
        <div class="row">
          <div class="col-md-12">
            <form class="" action="<?php echo site_url('admin/question_actions/edit/'.$question_id); ?>" method="post" enctype="multipart/form-data">
              <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                  
                  <div class="form-group">
                    <label class="control-label"><?php echo get_phrase('category'); ?></label>
                    <div class="controls">
                      <select class="form-control select2" id="category_id" name="category_id" data-init-plugin="select2" required>
                        <option value=""> Select Category</option>
                        <?php foreach ($categories->result_array() as $category): ?>
                          <option value="<?php echo $category['id']; ?>" <?php echo (isset($question_detail['category_id']) && $question_detail['category_id'] == $category['id'] ? 'selected' : ''); ?>><?php echo $category['name']; ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <label class="control-label"><?php echo get_phrase('sub_category'); ?></label>
                    <div class="controls">
                      <select class="form-control select2" id="sub_category_id" name="sub_category_id" data-init-plugin="select2" required> 
                        <option value="">Select Sub-Category</option>
                        <?php foreach ($sub_categories as $sub_category): ?>
                          <option value="<?php echo $sub_category['id']; ?>" <?php echo (isset($question_detail['subcategory_id']) && $question_detail['subcategory_id'] == $sub_category['id'] ? 'selected' : ''); ?>><?php echo $sub_category['name']; ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="control-label"><?php echo get_phrase('class'); ?></label>
                    <div class="controls">
                      <select class="form-control select2" id="samester" name="samester" data-init-plugin="select2" required> 
                        <option value="">Select Class</option>
                        <?php foreach ($samesters->result_array() as $samester): ?>
                          <option value="<?php echo $samester['id']; ?>" <?php echo (isset($question_detail['samester_id']) && $question_detail['samester_id'] == $samester['id'] ? 'selected' : ''); ?>><?php echo $samester['title']; ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="form-label"><?php echo get_phrase('subject'); ?></label>
                    <div class="controls">
                      <select class="form-control select2" id="subject_id" name="subject_id" data-init-plugin="select2" required>
                        <option value=""><?php echo get_phrase('select_subject'); ?></option>
                        <?php
                        foreach ($subjects->result_array() as $subject):?>
                        <option value="<?php echo $subject['id']; ?>" <?php echo (isset($question_detail['subject_id']) && $question_detail['subject_id']==$subject['id'] ? 'selected' : ''); ?>><?php echo $subject['name']; ?></option>
                        <?php endforeach; ?> 
                      </select>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="form-label"><?php echo get_phrase('chapter'); ?></label>
                    <div class="controls">
                      <select class="form-control select2" id="chapter_id" name="chapter_id" data-init-plugin="select2" required>
                        <option value=""><?php echo get_phrase('select_chapter'); ?></option>
                        <?php
                        foreach ($chapters->result_array() as $chapter):?>
                        <option value="<?php echo $chapter['id']; ?>" <?php echo (isset($question_detail['chapter_id']) && $question_detail['chapter_id']==$chapter['id'] ? 'selected' : ''); ?>><?php echo $chapter['c_name']; ?></option>
                        <?php endforeach; ?> 
                      </select>
                    </div>
                  </div> 
                  
                  <div class="form-group">
                    <label class="form-label"><?php echo get_phrase('question'); ?></label>
                    <div class="controls">
                      <?php  echo $this->ckeditor->editor("question",'', html_entity_decode($question_detail['question'])); ?>
                    </div>
                  </div>
                </div>
              </div>
              
              <div class="row">
                <div class="col-md-11 col-sm-11 col-xs-11" id = "options_area">
                  <?php
                    $counter = 0;
                    foreach (json_decode($question_detail['options']) as $option):
                    $counter++;
                  ?>
                  <div class="form-group">
                    <label class="form-label"><?php echo get_phrase('option'.$counter); ?></label>
                    <div class="controls">
                      <?php  echo $this->ckeditor->editor("option".$counter,"", html_entity_decode($option)); ?>
                    </div>
                  </div>
                  <?php endforeach; ?> 
                  
                </div>
              </div>
              
              
              <div class="form-group">
                <label class="form-label"><?php echo get_phrase('corret answer'); ?></label>
                <div class="controls">
                  <select class="form-control" name="correct_answer">
                    <option value="1" <?php if($question_detail['correct_answer']==1) echo 'selected'; ?>>1</option>
                    <option value="2" <?php if($question_detail['correct_answer']==2) echo 'selected'; ?>>2</option>
                    <option value="3" <?php if($question_detail['correct_answer']==3) echo 'selected'; ?>>3</option>
                    <option value="4" <?php if($question_detail['correct_answer']==4) echo 'selected'; ?>>4</option>
                  </select>
                </div>
              </div>
              
              <div class="form-group">
                <label class="form-label"><?php echo get_phrase('marks'); ?></label>
                <div class="controls">
                  <input type="number" name = "marks" class="form-control"  value="<?php echo $question_detail['marks']; ?>" min=1 max=1 id="marks">
                </div>
              </div>
              
              <div class="form-group">
                <label class="form-label"><?php echo get_phrase('explaination'); ?></label>
                <div class="controls">
                    <?php echo $this->ckeditor->editor("explanation",'', html_entity_decode($question_detail['explanation'])); ?>
                </div>
              </div>
              
            </div>
            
            <div class="row">
              <div class="col-md-offset-3 col-md-6 col-sm-12 col-xs-12"> 
                <a class="btn btn-info" href="<?php echo site_url('admin/question_actions/approve/'. $question_id)?>"><?php echo get_phrase('approve'); ?></a>
                <a class="btn btn-danger" href="<?php echo site_url('admin/question_actions/reject/'. $question_id)?>"><?php echo get_phrase('reject'); ?></a>
                <button class = "btn btn-success" type="submit" name="button"><?php echo get_phrase('update_question'); ?></button> 
              </div>
            </div>
            
          </form>
        </div>
      </div>
    </div>
  </div>
</div>



<style media="screen">
  body {
  overflow-x: hidden;
  }
</style>
<script type="text/javascript">
  $("form").submit( function(e) {
    var messageLength = CKEDITOR.instances['question'].getData().replace(/<[^>]*>/gi, '').length;
    var option1 = CKEDITOR.instances['option1'].getData().replace(/<[^>]*>/gi, '').length;
    var option2 = CKEDITOR.instances['option2'].getData().replace(/<[^>]*>/gi, '').length;
    var option3 = CKEDITOR.instances['option3'].getData().replace(/<[^>]*>/gi, '').length;
    var option4 = CKEDITOR.instances['option4'].getData().replace(/<[^>]*>/gi, '').length;
    var explanation = CKEDITOR.instances['explanation'].getData().replace(/<[^>]*>/gi, '').length;
    var subject = $('#subject_id').val();
    var marks = $('#marks').val();
    if( !messageLength  || !option1 || !option2 || !option3 || !option4 || !explanation || subject == "" || marks == "") {
      toastr.error('Please fill all the fields');
      e.preventDefault();
    }
  });
  
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

    $('#sub_category_id').change(function() {
      var sub_category_id = $(this).val(); 
      $('#samester').find('option').remove();
      $('#s2id_samester').find('.select2-chosen').html('');
      $('#samester').append('<option value="">Select Class</option>');
      $.ajax({
        url: '<?php echo base_url('master/manage/get_samester/')?>',
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
    });

    $('#samester').change(function() {
      var samester = $(this).val(); 
      $('#subject_id').find('option').remove();
      $('#s2id_subject_id').find('.select2-chosen').html('');
      $('#subject_id').append('<option value="">Select Subject</option>');
      $.ajax({
        url: '<?php echo base_url('master/manage/get_subject/')?>',
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
    });
    
    $('#subject_id').change(function() {
      var subject_id = $(this).val(); 
      $('#chapter_id').find('option').remove();
      $('#s2id_chapter_id').find('.select2-chosen').html('');
      $('#chapter_id').append('<option value="">Select Chapter</option>');
      $.ajax({
        url: '<?php echo base_url('master/manage/get_chapter')?>',
        type:'POST',
        data: {subject_id: subject_id},
        dataType:'json',
      }).done(function(response){ 
        if(response!='0') { 
          $.each(response, function (index, value) {
            $('#chapter_id').append('<option value="'+ value.id +'">'+ value.c_name +'</option>');
          }); 
        }  
      });
    });
  });
</script>