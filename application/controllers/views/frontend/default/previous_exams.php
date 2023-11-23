<section class="page-header-area my-course-area">
    <div class="container">
        <div class="row">
            <div class="col">
                <h1 class="page-title"><?php echo get_phrase($page_title); ?></h1>
            </div>
        </div>
    </div>
</section>
<section class="user-dashboard-area">
    <div class="container">
        <div class="row">
            <div class="col">
            <div class="row">
                <?php /*?>
                    <div class="col-md-4 col-md-offset-4">
                        <div class="form-group">
                            <div class="controls">
                                <select class="form-control" id="category_id" name="category_id" required onchange="ajax_get_exam_pattern(this.value)">
                                    <option value=""><?php echo get_phrase('select_category'); ?></option>
                                    <?php
                                        foreach ($subCategories as $category):?>
                                        <option value="<?php echo $category['id']; ?>"><?php echo $category['name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-md-offset-4">
                        <div class="form-group">
                            <div class="controls">
                                <input type="text" class="form-control datepicker" placeholder="Select Date">
                                <div class="input-group-addon">
                                    <span class="glyphicon glyphicon-th"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php */ ?>
                </div>
            <table class="table table-bordered datatable" id="table-1">
                  <thead>
                    <tr>
                      <th><?php echo get_phrase('category_title'); ?></th>
                      <th><?php echo get_phrase('submitted_time'); ?></th>
                      <th><?php echo get_phrase('total_marks'); ?></th>
                      <th><?php echo get_phrase('percentage'); ?></th>
                      <th><?php echo get_phrase('view'); ?></th>
                    </tr>
                  </thead>
                  <tbody>
                      <?php
                      $counter = 1;
                      foreach ($exams->result_array() as $exam): ?>
                      <?php // print_r($exam); exit();?>
                          <tr class= "<?php if( $counter % 2 == 0) echo 'odd gradeX'; else echo 'even gradeC'; $counter++;?>">
                            <td><?php echo $exam['name']; ?></td>
                            <td>
                                <?php echo $exam['submitted_time']; ?>
                            </td>
                            <td>
                                <?php echo $exam['marks_obt']; ?>
                            </td>
                             <td>
                                <?php echo ($exam['marks_obt']/$exam['total_marks'])*100; ?>
                            </td>
                            <td><a href="<?php echo site_url('home/getResult/').$exam['quiz_id']; ?>"><?php echo get_phrase('view'); ?></a></td>
                          </tr>
                      <?php endforeach; ?>
                  </tbody>
                </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script type="text/javascript">
$(document).ready(function() {
    $('.datepicker').datepicker({
        autoclose: true,
        todayHighlight: true
    });
    $('#table-1').DataTable();
});
</script>