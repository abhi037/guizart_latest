<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.1/MathJax.js?config=http://visualmatheditor.equatheque.net/js/mathjax-MathEditorExtend/x-mathjax-vme-public-config.js"></script>
<ol class="breadcrumb bc-3">
    <li>
    <a href="<?php echo site_url('teacher/dashboard'); ?>">
      <i class="entypo-folder"></i>
      <?php echo get_phrase('dashboard'); ?>
    </a>
  </li>
    <li><a href="#" class="active"><?php echo get_phrase('videos'); ?></a> </li>
</ol>
<h2><i class="fa fa-arrow-circle-o-right"></i> <?php echo $page_title; ?></h2>
<br />

<div class="row">
  <div class="col-md-12">
    <div class="panel panel-primary" data-collapsed="0">
      <div class="panel-body">
        <div class="row">
          <div class="col-md-4 col-md-offset-4">
            <a href = "<?php echo site_url('teacher/video_form/add_video'); ?>" class="btn btn-block btn-info btn-lg" type="button">
              <i class="fa fa-plus"></i>&nbsp;&nbsp;<?php echo get_phrase('add_video'); ?>
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
              <th><?php echo get_phrase('video_title'); ?></th> 
              <th><?php echo get_phrase('video_link'); ?></th> 
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
              <td><?php echo $video['video_title']; ?></td>
              <td>
                <a href="javascript:;" onclick="video('<?php echo base_url() . 'uploads/video/' . $video['file'];?>');" class="btn btn-info"><?php echo $video['file']; ?> </a> 
              </td>
              <td>
                <div class="btn-group">
                  <button class="btn btn-small btn-default btn-demo-space" data-toggle="dropdown"> <i class = "fa fa-ellipsis-v"></i> </button>
                    <ul class="dropdown-menu dropdown-default" role="menu">
                      <li>
                        <a href="<?php echo site_url('teacher/video_form/video_edit/'.$video['id']); ?>">
                          <?php echo get_phrase('edit');?>
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
</script>
