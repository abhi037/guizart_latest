<style>
    .d-none{
  display:none;
    }
</style>

<ol class="breadcrumb bc-3">
    <li>
        <a href="<?php echo site_url('admin/dashboard'); ?>">
            <i class="entypo-folder"></i>
            <?php echo get_phrase('dashboard'); ?>
    </a>
  </li>
    <li><a href="#" class="active"><?php echo get_phrase('students'); ?></a> </li>
</ol>
<h2><i class="fa fa-arrow-circle-o-right"></i> <?php echo $page_title; ?></h2>
<br />

<div class="row">
  <div class="col-md-12">
    <div class="panel panel-primary" data-collapsed="0">
      <div class="panel-body"> 
          <table class="table table-bordered datatable" id="table-1">
            <thead>
              <tr>
                <th><?php echo get_phrase('photo'); ?></th>
                <th><?php echo get_phrase('name'); ?></th>
                <th><?php echo get_phrase('email'); ?></th>
                <th><?php echo get_phrase('date_added'); ?></th>
                <th><?php echo get_phrase('enrolled_quizzes'); ?></th>
                <th class="d-none">Biography</th>
                <th class="d-none">Refferal Code</th>
                <th class="d-none">Twitter Link</th>
                <th class="d-none">Facebook Link</th>
                <th class="d-none">Linked In Link</th>
                <th class="d-none">Bank Name</th>
                <th class="d-none">Account Name</th>
                <th class="d-none">Account Number</th>
                <th class="d-none">Branch Address</th>
                <th class="d-none">IFSC Code</th>
                <th class="d-none">Refered By Email</th>
                <th class="d-none">Refered By Code</th>
                
                <th><?php echo get_phrase('actions'); ?></th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($users->result_array() as $user):
                $social = json_decode($user['social_links'],TRUE);
                // print_r($social);
              ?>
                            <tr class="gradeU">
                <td>
                  <img src="<?php echo $this->user_model->get_user_image_url($user['id']);?>" alt="<?php echo $this->user_model->get_user_image_url($user['id']);?>" height="50" width="50" class="img-fluid">
                  <span class="d-none"><?php echo $this->user_model->get_user_image_url($user['id']);?></span>
                </td>
                <td><?php echo $user['first_name'].' '.$user['last_name']; ?></td>
                <td><?php echo $user['email']; ?></td>
                <td><?php echo date('D, d-M-Y', $user['date_added']); ?></td>
                <td>
                  <?php $enrolled_courses = explode(',', $user['sub_category']); ?>
                                    <ul>
                                        <?php foreach ($enrolled_courses as $enrolled_course): ?>
                    <li><?php echo $enrolled_course; ?></li>
                                        <?php endforeach; ?>
                  </ul>
                </td>
                <td class="d-none"><?php echo $user['biography'];?></td>
                <td class="d-none"><?php echo $user['referral_code'];?></td>
                <td class="d-none"><?php echo $social['twitter'];?></td>
                <td class="d-none"><?php echo $social['facebook'];?></td>
                <td class="d-none"><?php echo $social['linkedin'];?></td>
                <td class="d-none"><?php echo $user['bank_name'];?></td>
                <td class="d-none"><?php echo $user['user_name'];?></td>
                <td class="d-none"><?php echo $user['account_number'];?></td>
                
                <td class="d-none"><?php echo $user['branch_address'];?></td>
                <td class="d-none"><?php echo $user['ifsc'];?></td>
                <td class="d-none"><?php echo $user['refered_by_email'];?></td>
                <td class="d-none"><?php echo $user['refered_by_code'];?></td>
                
                <td>
                  <div class="btn-group">
                    <button type="button" class="btn btn-default" data-toggle="dropdown"> <i class = "fa fa-ellipsis-v"></i> </button>
                    <ul class="dropdown-menu">
                      <!-- <li>
                        <a href="">
                        <?php echo get_phrase('view_profile');?>
                        </a>
                      </li> -->
                      <li>
                        <a href="<?php echo site_url('admin/user_form/edit_user_form/'.$user['id']) ?>">
                          <?php echo get_phrase('edit');?>
                        </a>
                      </li>
                      <li class="divider"></li>
                      <li>
                        <a href="#" onclick="confirm_modal('<?php echo site_url('admin/users/delete/'.$user['id']); ?>');">
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


<div class="row">
    <div class="col-md-12">
    <div class="grid simple">
      <div class="grid-body no-border"> 
        <div class="row">
          <br> 
        </div>
      </div>
    </div>
  </div>
</div>


<script>
    $(document).ready(function(){
        $('#table-1').DataTable({
      'dom':"<'row'<'col-sm-12 col-md-6 mb-2'B>>"+
      "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
      "<'row'<'col-sm-12'tr>>" +
      "<'row'<'col-sm-12 col-md-6 mt-2'i><'col-sm-12 mt-2 col-md-6'p>>",
            buttons: [
      'csvHtml5',
      'excelHtml5'
            ]
    });
  });
</script>