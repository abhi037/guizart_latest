<ol class="breadcrumb bc-3">
    <li>
        <a href="<?php echo site_url('admin/dashboard'); ?>">
            <i class="entypo-folder"></i>
            <?php echo get_phrase('dashboard'); ?>
        </a>
    </li>
    <li><a href="<?php echo site_url('admin/faq'); ?>"><?php echo get_phrase('faqs'); ?></a> </li>
    <li><a href="#" class="active"><?php echo get_phrase('edit_faq'); ?></a> </li>
</ol>
<h2><i class="fa fa-arrow-circle-o-right"></i> <?php echo $page_title; ?></h2>
<br />

<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
            <div class="panel-heading">
				<div class="panel-title">
					<?php echo get_phrase('edit_faq_form'); ?>
				</div>
			</div>
			<div class="panel-body">
                <form action="<?php echo site_url('admin/faq/edit/'.$faq_id); ?>" method="post" role="form" class="form-horizontal form-groups-bordered">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label class="col-sm-3 control-label"><?php echo get_phrase('question'); ?></label>
                            <div class="col-sm-8">
                                <input type="text" name = "que" class="form-control" value="<?php echo $faq['que']; ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('answer'); ?></label>

                            <div class="col-sm-8">
                                <?php echo $this->ckeditor->editor("ans",'', html_entity_decode($faq['ans'])); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('status'); ?></label>
                            <div class="col-sm-8">
                                <select name = "status" class="form-control" required>
                                    <option value="1" <?php if($faq['status']==1) echo 'selected'; ?> >Active</option>
                                    <option value="0" <?php if($faq['status']==0) echo 'selected'; ?> >Inactive</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-5">
                                <button class = "btn btn-success" type="submit"><?php echo get_phrase('update_faq'); ?></button>
                            </div>
                        </div>
                    </div>
                </form>
			</div>
		</div>
	</div>
</div>
