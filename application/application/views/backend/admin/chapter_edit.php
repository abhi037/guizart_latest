<ol class="breadcrumb bc-3">
  <li>
    <a href="<?php echo site_url('admin/dashboard'); ?>">
      <i class="entypo-folder"></i>
      <?php echo get_phrase('dashboard'); ?>
    </a>
  </li>
  <li><a href="<?php echo site_url('admin/categories'); ?>"><?php echo get_phrase('categories'); ?></a> </li>
  <li><a href="#" class="active"><?php echo get_phrase('edit_chapter'); ?></a> </li>
</ol>
<h2><i class="fa fa-arrow-circle-o-right"></i> <?php echo $page_title; ?></h2>
<br />

<div class="row">
  <div class="col-md-8 col-md-offset-2">
    <div class="panel panel-primary" data-collapsed="0">
      <div class="panel-heading">
        <div class="panel-title">
          <?php echo get_phrase('chapter_edit_form'); ?>
        </div>
      </div>
      <div class="panel-body">
        <form action="<?php echo site_url('master/manage/chapters/edit/'.$chapter_id); ?>" method="post" role="form" class="form-horizontal form-groups-bordered">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="form-group">
              <label class="col-sm-3 control-label"><?php echo get_phrase('chapter_code'); ?></label>
              <div class="col-sm-5">
                <input type="text" name = "code" class="form-control" readonly value="<?php echo $data['c_code']; ?>">
              </div>
            </div>

            <div class="form-group">
              <label class="col-sm-3 control-label"><?php echo get_phrase('category'); ?></label>
              <div class="col-sm-5">
                <select class="form-control select2" id="category_id" name="category_id" data-init-plugin="select2" required>
                  <option value=""> Select Category</option>
                  <?php foreach ($categories->result_array() as $category): ?>
                    <option value="<?php echo $category['id']; ?>" <?php if(isset($data['category_id']) && $data['category_id'] == $category['id']) echo 'selected'; ?>><?php echo $category['name']; ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
            
            <div class="form-group">
              <label class="col-sm-3 control-label"><?php echo get_phrase('sub_category'); ?></label>
              <div class="col-sm-5"> 
                <select class="form-control select2" id="sub_category_id" name="sub_category_id" data-init-plugin="select2" required> 
                  <option value="">Select Sub-Category</option>
                  <?php foreach ($sub_categories as $sub_category): ?>
                    <option value="<?php echo $sub_category['id']; ?>" <?php if(isset($data['sub_category_id']) && $data['sub_category_id'] == $sub_category['id']) echo 'selected'; ?>><?php echo $sub_category['name']; ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>

            <div class="form-group">
              <label class="col-sm-3 control-label"><?php echo get_phrase('class'); ?></label>
              <div class="col-sm-5">
                <select class="form-control select2" id="samester" name="samester" data-init-plugin="select2" required> 
                  <option value="">Select Class</option>
                  <?php foreach ($samesters->result_array() as $samester): ?>
                    <option value="<?php echo $samester['id']; ?>" <?php if(isset($data['samester_id']) && $data['samester_id'] == $samester['id']) echo 'selected'; ?>><?php echo $samester['title']; ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>

            <div class="form-group">
              <label class="col-sm-3 control-label"><?php echo get_phrase('subject'); ?></label>
              <div class="col-sm-5">
                <select class="form-control select2" id="subject_id" name="subject_id" data-init-plugin="select2" required> 
                  <option value="">Select Subject</option> 
                  <?php foreach ($subjects->result_array() as $subject): ?>
                    <option value="<?php echo $subject['id']; ?>" <?php if(isset($data['subject_id']) && $data['subject_id'] == $subject['id']) echo 'selected'; ?>><?php echo $subject['name']; ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>

            <div class="form-group">
              <label class="col-sm-3 control-label"><?php echo get_phrase('chapter_title'); ?></label>
              <div class="col-sm-5">
                <input type="text" name="name" id="name" class="form-control" required value="<?php echo $data['c_name']; ?>">
              </div>
            </div>
            
            <div class="form-group">
              <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('selected_icon'); ?></label>
              <div class="col-sm-5" style="margin-top: 9px;">
                <span> <i class="<?php echo $data['font_awesome_class']; ?>" style="font-size: 16px;"></i> </span>
              </div>
            </div>
            
            <div class="form-group">
              <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('pick_another_icon_picker'); ?></label> 
              <div class="col-sm-5">
                <input type="text" name="font_awesome_class" id="font_awesome_class" class="form-control icon-picker" autocomplete="off">
              </div>
            </div>
            
            <div class="form-group">
              <div class="col-sm-offset-3 col-sm-5">
                <button class = "btn btn-success" type="submit" name="button"><?php echo get_phrase('update_chapter'); ?></button>
              </div>
            </div>
          </div>
        </form>
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
  });
</script>