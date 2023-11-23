<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.1/MathJax.js?config=http://visualmatheditor.equatheque.net/js/mathjax-MathEditorExtend/x-mathjax-vme-public-config.js"></script>
<ol class="breadcrumb bc-3">
    <li>
    <a href="<?php echo site_url('admin/dashboard'); ?>">
      <i class="entypo-folder"></i>
      <?php echo get_phrase('dashboard'); ?>
    </a>
  </li>
    <li><a href="#" class="active"><?php echo get_phrase('study_material'); ?></a> </li>
</ol>
<h2><i class="fa fa-arrow-circle-o-right"></i> <?php echo $page_title; ?></h2>
<br />

<div class="row">
  <div class="col-md-12">
    <div class="panel panel-primary" data-collapsed="0">
      <div class="panel-body">
        <form id="myform" method="post">
          <div class="row">
            <div class="col-md-3"> 
              <label><?php echo get_phrase('teacher'); ?></label>
              <select class="form-control select2" name="teacher" id="teacher" data-init-plugin="select2">
                <option value=""><?php echo get_phrase('select_teacher'); ?></option>
                <?php foreach ($teacher->result_array() as $key => $value) {?>
                  <option value="<?php echo $value['id'];?>" <?php echo (($this->input->post('teacher') == $value['id']) ? 'selected="selected"' : '')?>> <?php echo $value['first_name'] .' '. $value['last_name'];?> </option>
                <?php }?> 
              </select>
            </div>

            <div class="col-md-3">
              <label class="control-label"><?php echo get_phrase('category'); ?></label>
              <div class="controls">
                <select class="form-control select2" id="category_id" name="category_id" data-init-plugin="select2">
                  <option value=""> Select Category</option>
                  <?php foreach ($categories->result_array() as $category): ?>
                    <option value="<?php echo $category['id']; ?>" <?php echo (($this->input->post('category_id') == $category['id']) ? 'selected="selected"' : '')?>><?php echo $category['name']; ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
            
            <div class="col-md-3">
              <label class="control-label"><?php echo get_phrase('sub_category'); ?></label>
              <div class="controls">
                <select class="form-control select2" id="sub_category_id" name="sub_category_id" data-init-plugin="select2" > 
                  <option value="">Select Sub-Category</option>
                  <?php foreach ($sub_categories as $sub_category): ?>
                    <option value="<?php echo $sub_category['id']; ?>" <?php echo ($this->input->post('sub_category_id') == $sub_category['id'] ? 'selected' : ''); ?>><?php echo $sub_category['name']; ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>

            <div class="col-md-3">
              <label class="control-label"><?php echo get_phrase('class'); ?></label>
              <div class="controls">
                <select class="form-control select2" id="samester" name="samester" data-init-plugin="select2" > 
                  <option value="">Select Class</option>
                  <?php foreach ($samesters->result_array() as $samester): ?>
                    <option value="<?php echo $samester['id']; ?>" <?php echo ($this->input->post('samester') == $samester['id'] ? 'selected' : ''); ?>><?php echo $samester['title']; ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
          </div>
          <br />
          <div class="row">
            <div class="col-md-3">
              <label class="form-label"><?php echo get_phrase('subject'); ?></label>
              <div class="controls">
                <select class="form-control select2" id="subject_id" name="subject_id" data-init-plugin="select2" >
                  <option value=""><?php echo get_phrase('select_subject'); ?></option>
                  <?php
                  foreach ($subjects->result_array() as $subject):?>
                  <option value="<?php echo $subject['id']; ?>" <?php echo ($this->input->post('subject_id') == $subject['id'] ? 'selected' : ''); ?>><?php echo $subject['name']; ?></option>
                  <?php endforeach; ?> 
                </select>
              </div>
            </div> 
          </div>
          <br />
          <div class="row"> 
            <div class="col-md-offset-4 col-md-3">
              <button type="submit" class="btn btn-info" id="submitBtn"><?php echo get_phrase('submit'); ?></button>
            </div>
          </div> 
        </form> 
        <hr>
        <div class="row">
          <div class="col-md-4 col-md-offset-4">
            <a href = "<?php echo site_url('admin/studymaterial_form/add_studymaterial'); ?>" class="btn btn-block btn-info btn-lg" type="button">
              <i class="fa fa-plus"></i>&nbsp;&nbsp;<?php echo get_phrase('add_study_material'); ?>
            </a>
          </div>
        </div>
        <hr>
        <table class="table table-bordered datatable" id="table-1">
          <thead>
            <tr>
              <th><?php echo get_phrase('category'); ?></th>
              <th><?php echo get_phrase('sub_category'); ?></th>
              <th><?php echo get_phrase('class'); ?></th>
              <th><?php echo get_phrase('subject'); ?></th> 
              <th><?php echo get_phrase('teacher_name'); ?></th> 
              <th><?php echo get_phrase('doc_title'); ?></th> 
              <th><?php echo get_phrase('doc_link'); ?></th> 
              <th><?php echo get_phrase('actions'); ?></th>
            </tr>
          </thead>
          <tbody>
            <?php
            $counter = 1;
            foreach ($videos->result_array() as $video): ?>
            <tr class= "<?php if( $counter % 2 == 0) echo 'odd gradeX'; else echo 'even gradeC'; $counter++;?>">
              <td><?php echo $video['category_name']; ?></td>
              <td><?php echo $video['sub_category_name']; ?></td>
              <td><?php echo $video['samester_name']; ?></td>
              <td><?php echo $video['name']; ?></td>
              <td><?php echo $video['first_name'] . ' ' . $video['last_name']; ?></td>
              <td><?php echo $video['doc_title']; ?></td>
              <td>
                <a href="javascript:;" onclick="doc('<?php echo base_url() . 'uploads/doc/' . $video['file'];?>');" class="btn btn-info"><?php echo $video['file']; ?> </a> 
              </td>
              <td>
                <div class="btn-group">
                  <button class="btn btn-small btn-default btn-demo-space" data-toggle="dropdown"> <i class = "fa fa-ellipsis-v"></i> </button>
                    <ul class="dropdown-menu dropdown-default" role="menu">
                      <li>
                        <a href="<?php echo site_url('admin/studymaterial_form/studymaterial_edit/' . $video['id']); ?>">
                          <?php echo get_phrase('edit');?>
                        </a>
                      </li> 
                      <li class="divider"></li>
                      <li>
                        <a href="#" onclick="confirm_modal('<?php echo site_url('admin/studymaterial_actions/delete/' . $video['id']); ?>');">
                          <?php echo get_phrase('delete');?>
                        </a>
                      </li>
                    </ul>
                </div>
              </td>
            </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
            
      </div>
    </div>
  </div>
</div>



<script type="text/javascript">  
  $(document).ready(function(){  
    $('#table-1').DataTable({});
  });  

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
</script>
