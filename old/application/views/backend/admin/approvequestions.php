<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.1/MathJax.js?config=http://visualmatheditor.equatheque.net/js/mathjax-MathEditorExtend/x-mathjax-vme-public-config.js"></script>
<ol class="breadcrumb bc-3">
    <li>
    <a href="<?php echo site_url('admin/dashboard'); ?>">
      <i class="entypo-folder"></i>
      <?php echo get_phrase('dashboard'); ?>
    </a>
  </li>
    <li><a href="#" class="active"><?php echo get_phrase('questions'); ?></a> </li>
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

            <div class="col-md-3">
              <label class="form-label"><?php echo get_phrase('chapter'); ?></label>
              <div class="controls">
                <select class="form-control select2" id="chapter_id" name="chapter_id" data-init-plugin="select2" >
                  <option value=""><?php echo get_phrase('select_chapter'); ?></option>
                  <?php
                    foreach ($chapters->result_array() as $chapter):?>
                    <option value="<?php echo $chapter['id']; ?>" <?php echo ($this->input->post('chapter_id')==$chapter['id'] ? 'selected' : ''); ?>><?php echo $chapter['c_name']; ?></option>
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
        <hr />
        <div class="row">
          <div class="col-md-offset-4 col-md-2">
            <button type="button" class="btn btn-info" id="approve"><?php echo get_phrase('approve'); ?></button>  
          </div>
          <div class="col-md-1">
            <button type="button" class="btn btn-danger" id="reject"><?php echo get_phrase('reject'); ?></button>
          </div>
        </div>
        <table class="table table-bordered datatable display select" id="table-1">
          <thead>
            <tr>
              <th><input type="checkbox" name="select_all" value="1" id="example-select-all"></th>
              <th><?php echo get_phrase('Teacher'); ?></th>
              <th><?php echo get_phrase('category'); ?></th>
              <th><?php echo get_phrase('sub_category'); ?></th>
              <th><?php echo get_phrase('class'); ?></th>
              <th><?php echo get_phrase('subject'); ?></th>
              <th><?php echo get_phrase('chapter'); ?></th>
              <th><?php echo get_phrase('question'); ?></th>
              <th><?php echo get_phrase('correct_answer'); ?></th>
              <th><?php echo get_phrase('actions'); ?></th>
            </tr>
          </thead>
          <tbody> 
          </tbody>
        </table> 
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  function ajax_get_sub_category(category_id) {
    $.ajax({
      url: '<?php echo site_url('admin/ajax_get_sub_category/');?>' + category_id ,
      success: function(response)
      {
        jQuery('#sub_category_id').html(response);
        console.log(response);
      }
    });
  }
    
  $(document).ready(function(){ 
    var teacher = $('#teacher').val();
    var subject = $('#subject_id').val();
    var category_id = $('#category_id').val();
    var sub_category_id = $('#sub_category_id').val();
    var samester = $('#samester').val();
    var chapter_id = $('#chapter_id').val();
    var table = $('#table-1').DataTable({
      "processing":true,  
      "serverSide":true, 
      "ajax":{
        url:'<?php echo base_url('admin/get_all_pendingquestions')?>',
        type:'POST',
        data:{subject:subject, teacher:teacher, category_id:category_id, sub_category_id:sub_category_id, samester:samester, chapter_id:chapter_id},
      },
      "columns":[{'data':'id','name':'id'},
      {'data':'teacher','name':'Teacher'},
      {'data':'category','name':'category'},
      {'data':'subcategory','name':'subcategory'},
      {'data':'samester','name':'samester'},
      {'data':'subject','name':'Name'},
      {'data':'chapter', 'name':'chapter'},
      {'data':'question','name':'Branch'},
      {'data':'correct_answer'},
      {'data':'action'}
      ],
      'columnDefs': [{
        'targets': 0,
        'searchable': false,
        'orderable': false,
        'className': 'dt-body-center',
        'render': function (data, type, full, meta){ 
          return '<input type="checkbox" name="id' + $('<div/>').text(data).html() +'" value="' + $('<div/>').text(data).html() + '">';
        }
      }],
      "drawCallback":function(settings){ 
        $('#table-1 tbody tr td:nth-of-type(2)').addClass('image');
      },
    }); 
    
    $('#example-select-all').on('click', function(){
      // Get all rows with search applied
      var rows = table.rows({ 'search': 'applied' }).nodes();
      // Check/uncheck checkboxes for all rows in the table
      $('input[type="checkbox"]', rows).prop('checked', this.checked);
    });
    
    // Handle click on checkbox to set state of "Select all" control
    $('#table-1 tbody').on('change', 'input[type="checkbox"]', function(){
      // If checkbox is not checked
      if(!this.checked){
        var el = $('#example-select-all').get(0);
        // If "Select all" control is checked and has 'indeterminate' property
        if(el && el.checked && ('indeterminate' in el)){
          // Set visual state of "Select all" control
          // as 'indeterminate'
          el.indeterminate = true;
        }
      }
    });
    
    // Handle form submission event
    $('#approve').on('click', function(e){ 
      // Iterate over all checkboxes in the table
      var data = table.$('input[type="checkbox"]').serializeArray();  
      $.ajax({
        url: '<?php echo base_url('admin/change_questionstatus/1')?>',
        type:'POST',
        data: data
        }).done(function(response){
        alert('Approved');
        location.reload();
      });
    });
    
    $('#reject').on('click', function(e){ 
      // Iterate over all checkboxes in the table
      var data = table.$('input[type="checkbox"]').serializeArray();  
      $.ajax({
        url: '<?php echo base_url('admin/change_questionstatus/2')?>',
        type:'POST',
        data: data
        }).done(function(response){
        alert('Reject');
        location.reload();
      });
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
