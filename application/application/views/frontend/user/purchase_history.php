<!-- <section class="page-header-area">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
    <li class="breadcrumb-item"><a href="#">Purchase History</a></li>
  </ol> 
</section> -->
<?php
  
  $social_links = json_decode($user_details['social_links'], true);
?>
<ol class="breadcrumb bc-3">
  <li class = "active">
    <a href="<?php echo site_url('home/user'); ?>">
      <i class="entypo-folder"></i>
      <?php echo get_phrase('dashboard'); ?>
    </a>
  </li> 
  <li><a href="" class="active"><?php echo get_phrase('Purchase History'); ?></a> </li>
</ol>
<h2><i class="fa fa-shopping-cart"></i> <?php echo $page_title; ?></h2>
<br />  

<section class="user-dashboard-area"> 
  <div class="row">
    <div class="col-md-12"> 
      <div class="panel panel-primary" data-collapsed="0">
        <div class="panel-body">
          <table class="table table-bordered" id="table-1">
            <thead>
              <tr>
                <th>#</th> 
                <th><?php echo get_phrase('quiz'); ?></th>
                <th><?php echo get_phrase('date'); ?></th>
                <th><?php echo get_phrase('total_price'); ?></th>
                <th><?php echo get_phrase('payment_type'); ?></th> 
              </tr>
            </thead>
            <tbody>
              <?php
              if ($purchase_history->num_rows() > 0):
              foreach($purchase_history->result_array() as $each_purchase): ?> 
                <tr>
                  <td class="col-sm-1 col-md-1 col-lg-1">
                    <a href="#" class="dropdown-toggle"> 
                        <?php if($each_purchase['image_name'] != ''): ?>
                        <img src="<?php echo base_url().'uploads/subcategory/'.$each_purchase['image_name']; ?>"  class="img-rounded" width="80">
                      <?php else: ?>
                        <img src="<?php echo base_url().'uploads/subcategory/800x800_l.png'; ?>" class="img-rounded" width="80">
                      <?php endif; ?>
                      </a>
                    <!-- <div class="purchase-history-course-img">
                      <?php if($each_purchase['image_name'] != ''): ?>
                        <img src="<?php echo base_url().'uploads/subcategory/'.$each_purchase['image_name']; ?>" alt="" class="img-fluid">
                      <?php else: ?>
                        <img src="<?php echo base_url().'uploads/subcategory/quiz.jpg'; ?>" alt="" class="img-fluid">
                      <?php endif; ?>
                    </div> -->
                   
                  </td >
                   <td class= "align-middle">
                    <?php
                        echo $each_purchase['name'];
                    ?>
                    </td>
                  <td class= "align-middle"><?php echo date('D, d-M-Y', $each_purchase['date_added']); ?></td>
                  <td class= "align-middle">
                      <?php echo currency($each_purchase['amount']); ?>
                  </td>
                  <td class= "align-middle">
                      <?php echo ucfirst($each_purchase['payment_type']); ?>
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




