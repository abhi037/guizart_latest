<ol class="breadcrumb bc-3">
  <li class = "active">
    <a href="<?php echo site_url('admin/dashboard'); ?>">
      <i class="entypo-folder"></i>
      <?php echo get_phrase('dashboard'); ?>
    </a>
  </li>
  <li><a href="<?php echo site_url('admin/highlight_quiz'); ?>" class=""><?php echo get_phrase('highlight_quiz'); ?></a> </li>
  <li><a href="#" class="active"><?php echo get_phrase('highlight_quiz_form'); ?></a> </li>
</ol>
<h2><i class="fa fa-arrow-circle-o-right"></i> <?php echo $page_title; ?></h2>
<br />
<div class="row">
  <div class="col-md-12">
    <div class="panel panel-primary" data-collapsed="0">
      <div class="panel-heading">
        <div class="panel-title">
          <?php echo isset($formdata[0]) ? get_phrase('edit_highlight_quiz_detail') : get_phrase('add_highlight_quiz_detail'); ?>
        </div>
      </div>
      <div class="panel-body">
        <div class="row">
          <div class="col-md-12">
            <?php $url= 'admin/highlight_quiz/'. (isset($formdata[0]->id) ? 'edit/'. $formdata[0]->id : 'add'); ?>
            <form class="" action="<?php echo site_url($url); ?>" method="post" enctype="multipart/form-data" >
              <div class="row">
                <div class="col-md-8 col-sm-8 col-xs-8"> 
                  <div class="form-group">
                    <label class="form-label"><?php echo get_phrase('title'); ?></label>
                    <div class="controls">
                      <input type="text" name="title" class="form-control" id="title" value="<?php echo (isset($formdata[0]->title) ? $formdata[0]->title : ''); ?>" required="required"/>
                    </div>
                  </div>  
                  <div class="form-group">
                    <label class="form-label"><?php echo get_phrase('description'); ?></label>
                    <div class="controls">
                      <?php echo $this->ckeditor->editor("descriptions" , "", html_entity_decode((isset($formdata[0]->description) ? $formdata[0]->description : ''))); ?>
                    </div>
                  </div>  
                  <div class="form-group">
                    <label class="form-label"><?php echo get_phrase('upload_banner'); ?></label>

                    <div class="controls">
                      <input type="file" name="banner" id="banner"  class="form-control file2 inline btn btn-primary" data-label="<i class='glyphicon glyphicon-file'></i> Browse" id="banner">
                      <span class="file-input-name"><?php echo (isset($formdata[0]->file) ? $formdata[0]->file : ''); ?></span>
                    </div>
                  </div>  
                  <div class="form-group">
                    <label class="form-label"><?php echo get_phrase('price'); ?></label>
                    <div class="controls">
                      <input type="number" name="price" class="form-control" id="price" value="<?php echo (isset($formdata[0]->price) ? $formdata[0]->price : ''); ?>" required="required">
                    </div>
                  </div>  
                  <div class="form-group">
                    <label class="form-label"><?php echo get_phrase('quize_start_time'); ?></label>
                    <div class="controls">
                      <div class="row">
                        <div class="col-md-6">
                          <input type="date" name="date" class="form-control" id="date" value="<?php echo (isset($formdata[0]->startdate) ? date('Y-m-d', strtotime($formdata[0]->startdate)) : date('Y-m-d')); ?>" >
                        </div>
                        <div class="col-md-6">
                          <input type="time" name="time" class="form-control" id="time" value="<?php echo (isset($formdata[0]->startdate) ? date('H:i', strtotime($formdata[0]->startdate)) : date('H:i')); ?>">
                        </div>
                      </div> 
                    </div>
                  </div> 
                </div>
              </div>  
              <div class="row">
                <div class="col-md-offset-3 col-md-3 col-sm-12 col-xs-12">
                  <div class="form-group">
                    <button class = "btn btn-block btn-success" type="submit" name="button"> <?php echo isset($formdata[0]) ? get_phrase('update_detail') : get_phrase('add_detail'); ?></button>
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