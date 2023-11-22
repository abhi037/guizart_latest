<section class="page-header-area">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
    <li class="breadcrumb-item"><a href="#">Purchase History</a></li>
  </ol> 
</section>
<h1 class="page-title">Purchase History</h1>

<section class="user-dashboard-area"> 
  <div class="row">
    <div class="col-md-12"> 
      <div class="panel panel-primary" data-collapsed="0">
        <div class="panel-body">
          <table class="table table-bordered" id="table-1">
            <thead>
              <tr>
                <th> </th> 
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
                  <td>
                    <div class="purchase-history-course-img">
                      <?php if($each_purchase['image_name'] != ''): ?>
                        <img src="<?php echo base_url().'uploads/subcategory/'.$each_purchase['image_name']; ?>" alt="" class="img-fluid">
                      <?php else: ?>
                        <img src="<?php echo base_url().'uploads/subcategory/quiz.jpg'; ?>" alt="" class="img-fluid">
                      <?php endif; ?>
                    </div>
                    <?php
                        echo $each_purchase['name'];
                    ?>
                  </td>
                  <td><?php echo date('D, d-M-Y', $each_purchase['date_added']); ?></td>
                  <td>
                      <?php echo currency($each_purchase['amount']); ?>
                  </td>
                  <td>
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




