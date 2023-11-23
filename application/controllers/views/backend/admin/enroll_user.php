<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.1/MathJax.js?config=http://visualmatheditor.equatheque.net/js/mathjax-MathEditorExtend/x-mathjax-vme-public-config.js"></script>
<ol class="breadcrumb bc-3">
    <li>
      <a href="<?php echo site_url('admin/dashboard'); ?>">
        <i class="entypo-folder"></i>
        <?php echo get_phrase('dashboard'); ?>
      </a>
    </li>
    <li>
      <a href="<?php echo site_url('admin/highlight_quiz'); ?>" class="active">
        <i class="entypo-folder"></i>
        <?php echo get_phrase('highlight_quiz'); ?>    
      </a> 
    </li>
    <li>
      <a href="#">
        <?php echo get_phrase('enroll_user'); ?> 
      </a> 
    </li>
</ol>
<h2><i class="fa fa-arrow-circle-o-right"></i> <?php echo $page_title; ?></h2>
<br /> 
<div class="row">
  <div class="col-md-10 col-md-offset-1">
    <div class="panel panel-primary" data-collapsed="0">
      <div class="panel-body"> 
        <table class="table table-bordered datatable" id="table-1">
          <thead>
            <tr>
              <th><?php echo get_phrase('user_name'); ?></th>
              <th><?php echo get_phrase('email'); ?></th>
              <th><?php echo get_phrase('mobile'); ?></th>
              <th><?php echo get_phrase('payment_id'); ?></th>
              <th><?php echo get_phrase('payment_date'); ?></th> 
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
        url:'<?php echo base_url('admin/get_all_enroll_user/'. $this->uri->segment(3) .'/'. $this->uri->segment(4)); ?>',
        type:'POST', 
      },
      "columns":[{'data':'name','name':'name'},
      {'data':'email','name':'email'},
      {'data':'mobile','name':'mobile'},
      {'data':'payment_id','name':'payment_id'},
      {'data':'payment_date','name':'payment_date'},
      ],
      "drawCallback":function(settings){ 
        $('#table-1 tbody tr td:nth-of-type(2)').addClass('image');
      },
    });
  });
</script>
