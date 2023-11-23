<ol class="breadcrumb bc-3">
  <li class = "active">
    <a href="<?php echo site_url('teacher/dashboard'); ?>">
      <i class="entypo-folder"></i>
      <?php echo get_phrase('dashboard'); ?>
    </a>
  </li>
  <li><a href="<?php echo site_url('teacher/videos'); ?>" class=""><?php echo get_phrase('videos'); ?></a> </li>
  <li><a href="#" class="active"><?php echo get_phrase('edit_video'); ?></a> </li>
</ol>
<h2><i class="fa fa-arrow-circle-o-right"></i> <?php echo $page_title; ?></h2>
<br />
<div class="row">
  <div class="col-md-offset-3 col-md-6">
    <div class="panel panel-primary" data-collapsed="0">
      <div class="panel-heading">
        <div class="panel-title">
          <?php echo get_phrase('edit_video_form'); ?>
        </div>
      </div>
      <div class="panel-body">
        <div class="row">
          <div class="col-md-12">
            <form class="" action="<?php echo site_url('teacher/video_actions/edit/' . $video_id); ?>" method="post" enctype="multipart/form-data">
              <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                  
                  <div class="form-group">
                    <label class="control-label"><?php echo get_phrase('category'); ?></label>
                    <div class="controls">
                      <select class="form-control select2" id="category_id" name="category_id" data-init-plugin="select2" required>
                        <option value=""> Select Category</option>
                        <?php foreach ($categories->result_array() as $category): ?>
                          <option value="<?php echo $category['id']; ?>" <?php echo (isset($video_detail['category_id']) && $video_detail['category_id'] == $category['id'] ? 'selected' : ''); ?>><?php echo $category['name']; ?></option>
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
                          <option value="<?php echo $sub_category['id']; ?>" <?php echo (isset($video_detail['subcategory_id']) && $video_detail['subcategory_id'] == $sub_category['id'] ? 'selected' : ''); ?>><?php echo $sub_category['name']; ?></option>
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
                          <option value="<?php echo $samester['id']; ?>" <?php echo (isset($video_detail['samester_id']) && $video_detail['samester_id'] == $samester['id'] ? 'selected' : ''); ?>><?php echo $samester['title']; ?></option>
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
                        <option value="<?php echo $subject['id']; ?>" <?php echo (isset($video_detail['subject_id']) && $video_detail['subject_id']==$subject['id'] ? 'selected' : ''); ?>><?php echo $subject['name']; ?></option>
                        <?php endforeach; ?> 
                      </select>
                    </div>
                  </div> 
                  
                  <div class="form-group">
                    <label class="form-label"><?php echo get_phrase('video_title'); ?></label>
                    <div class="controls">
                      <input type="text" name="video_title" id="video_title" class="form-control" value="<?php echo (isset($video_detail['video_title']) ? $video_detail['video_title'] : ''); ?>" />
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="form-label"><?php echo get_phrase('video'); ?></label>
                    <div class="controls">
                      <input type="file" name="video" id="video" class="form-control file2 inline btn btn-primary" data-label="<i class='glyphicon glyphicon-file'></i> Browse" />
                      <span class="file-input-name"><?php echo (isset($video_detail['file']) ? $video_detail['file'] : ''); ?></span>
                    </div>
                  </div>

                   <div class="form-group">
                    <label class="form-label"><?php echo get_phrase('video_description'); ?></label>
                    <div class="controls">
                      <textarea name="description" id="description" class="form-control"><?php echo (isset($video_detail['description']) ? $video_detail['description'] : ''); ?></textarea> 
                    </div>
                  </div>

                </div>
              </div>   
            
              <div class="row">
                <div class="col-md-offset-4 col-md-3 col-sm-12 col-xs-12">
                  <div class="form-group">
                    <button class = "btn btn-block btn-success" type="submit" name="button"><?php echo get_phrase('update_video'); ?></button>
                  </div>
                </div>
              </div>
            
            </form>
          </div>
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
    });
    
    $('#subject_id').change(function() {
      var subject_id = $(this).val(); 
      $('#chapter_id').find('option').remove();
      $('#s2id_chapter_id').find('.select2-chosen').html('');
      $('#chapter_id').append('<option value="">Select Chapter</option>');
      $.ajax({
        url: '<?php echo base_url('teacher/get_chapter')?>',
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