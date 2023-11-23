<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.1/MathJax.js?config=http://visualmatheditor.equatheque.net/js/mathjax-MathEditorExtend/x-mathjax-vme-public-config.js"></script>
<ol class="breadcrumb bc-3">
    <li>
    <a href="<?php echo site_url('teacher/dashboard'); ?>">
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
        <div class="row">
          <div class="col-md-4 col-md-offset-4">
              <a href = "<?php echo site_url('teacher/question_form/add_question'); ?>" class="btn btn-block btn-info btn-lg" type="button">
                <i class="fa fa-plus"></i>&nbsp;&nbsp;<?php echo get_phrase('add_question'); ?>
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
      url: '<?php echo site_url('teacher/ajax_get_sub_category/');?>' + category_id ,
      success: function(response) {
        jQuery('#sub_category_id').html(response);
        console.log(response);
      }
    });
  }
    
  $(document).ready(function(){ 
        
    $('#table-1').DataTable({
      "processing":true,  
      "serverSide":true, 
      "ajax":{
        url:'<?php echo base_url('teacher/get_all_questions')?>',
        type:'POST', 
        
      },
      "columns":[{'data':'category','name':'category'},
      {'data':'subcategory','name':'subcategory'},
      {'data':'samester','name':'samester'},
      {'data':'subject','name':'Name'},
      {'data':'chapter', 'name':'chapter'},
      {'data':'question','name':'Branch'},
      {'data':'correct_answer'}, 
      {'data':'action'}
      ],
      "drawCallback":function(settings){
        
        $('#table-1 tbody tr td:nth-of-type(2)').addClass('image');
      },
    });
  });
    
  
</script>
