
                <table class="table table-bordered datatable" id="table-1">
                  <thead>
                    <tr>
                      <th><?php echo get_phrase('sub_categories'); ?></th>
                      <th><?php echo get_phrase('subject : num of question'); ?></th>
                      <th><?php echo get_phrase('attempt_time'); ?></th>
                      <th><?php echo get_phrase('actions'); ?></th>
                    </tr>
                  </thead>
                  <tbody>
                      <?php
                      $counter = 1;
                      foreach ($exam_pattern as $pattern):
                       ?>
                          <tr class= "<?php if( $counter % 2 == 0) echo 'odd gradeX'; else echo 'even gradeC'; $counter++;?>">
                            <td><?php echo $pattern['name']; ?></td>
                            <td><?php if(isset($pattern['right_numOfQue'])) echo $pattern['right_numOfQue']; else echo ''; ?></td>
                            <td><?php if(isset($pattern['right_attempt_time'])) echo $pattern['right_attempt_time']; else echo ''; ?></td>
                            
                            <td>

                                <div class="btn-group">
                                    <button class="btn btn-small btn-default btn-demo-space" data-toggle="dropdown"> <i class = "fa fa-ellipsis-v"></i> </button>
                                    <ul class="dropdown-menu dropdown-default" role="menu">
                                        <?php if(isset($pattern['right_id'])): ?>
                                        <li>
                                            <a href="<?php echo site_url('admin/pattern_form/edit_pattern/'.$pattern['right_id'].'/'.$pattern["id"]); ?>">
                                                <?php echo get_phrase('edit');?>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="<?php echo site_url('admin/matrix/delete/'.$pattern['right_id']); ?>">
                                                <?php echo get_phrase('delete');?>
                                            </a>
                                        </li>
                                        <?php else: ?>
                                        <li>
                                            <a href="<?php echo site_url('admin/pattern_form/add_pattern/'.$pattern["parent"].'/'.$pattern["id"]); ?>" >
                                                <?php echo get_phrase('add');?>
                                            </a>
                                        </li>
                                        <?php endif; ?>
                                    </ul>
                                </div>
                            </td>
                          </tr>
                      <?php endforeach; ?>
                  </tbody>
                </table>

