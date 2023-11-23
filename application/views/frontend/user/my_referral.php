<!-- <section class="page-header-area">
  <div class="row">  
    <ol class="breadcrumb bc-3">
      <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
      <li class="breadcrumb-item"><a href="#">My Referrals</a></li>
    </ol> 
    
  </div>
</section> -->
<section class="page-header-area">
<ol class="breadcrumb bc-3">
  <li class = "active">
    <a href="<?php echo site_url('home/user'); ?>">
      <i class="entypo-folder"></i>
      <?php echo get_phrase('dashboard'); ?>
    </a>
  </li> 
  <li><a href="" class="active"><?php echo get_phrase('My Referrals'); ?></a> </li>
</ol>
<h2><i class="fa fa-share"></i> <?php echo $page_title; ?></h2>
<br />  
</section>

<section class="user-dashboard-area"> 
  <div class="row">
    <div class="col-md-12"> 
      <div class="panel panel-primary" data-collapsed="0">
        <div class="panel-body">
          <table class="table table-bordered" id="table-1">
            <thead>
              <tr>
                <th><?php echo get_phrase('date'); ?></th>
                <th><?php echo get_phrase('name'); ?></th>
                <th><?php echo get_phrase('amount'); ?></th>
                <th><?php echo get_phrase('enroll_status'); ?></th>
                <th><?php echo get_phrase('payment_status'); ?></th>
              </tr>
            </thead>
            <tbody>
              <?php
              if ($total_rows > 0):
              foreach($referrals as $referral): ?> 
                <tr>
                  <td><?php  echo date('D, d-M-Y', strtotime($referral['created_at'])); ?></td>
                  <td>
                      <?php  echo $referral['first_name'].' '.$referral['last_name']; ?>
                  </td>
                  <td>
                      <?php  echo $referral['amount']; ?>
                  </td>
                   <td>
                      <?php  if($referral['enroll_status']==0) echo 'Not Enrolled'; else echo 'Enrolled'; ?>
                  </td>
                  <td>
                    <?php  if($referral['payment_status']==0) echo 'Pending'; else echo 'Complete'; ?>
                  </td>
                </tr>
              <?php endforeach; 
                endif;  ?>
            </tbody>
          </table>
        </div>
      </div> 
    </div>
  </div> 
</section>
<script type="text/javascript">
  $(document).ready(function() { 
    $('#table-1').DataTable();
  });
</script>

<nav>
  <?php echo $this->pagination->create_links(); ?>
</nav>
