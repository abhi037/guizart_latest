<section class="page-header-area">
  <div class="container">
    <div class="row">
      <div class="col">
          <h1 class="page-title"><?php echo get_phrase('My Quizs'); ?></h1>
      </div>
    </div>
  </div>
</section>

<section class="popular-courses-area ptb-100 my_enroll">
  <div class="container"> 
    <div class="row">
        <?php
        if($this->session->userdata('new_post')!=null){
            $record = $this->session->userdata('new_post');
            //print_r($record);
        }
        foreach($my_exams as $exam):
        ?>
          <div class="col-lg-4 col-md-6">
            <div class="single-courses-item">
              <div class="courses-img">
                <?php if($exam['image_name'] != ''): ?>
                   <img src="<?php echo base_url().'uploads/subcategory/'.$exam['image_name']; ?>" alt="">
                <?php else: ?>
                    <img src="<?php echo base_url().'uploads/subcategory/quiz.jpg'; ?>" alt="">
                <?php endif; ?>
              </div>
                    
              <div class="courses-content">
                <h3><a href="#"><?php echo $exam['name']; ?></a></h3>
              </div> 
              <div class="courses-content-bottom">
                <h4 class="price">
                  <?php 
                      $prices = array_filter(array($exam['price'], $exam['half_price'], $exam['quart_price']));
                      // if(!empty($prices)) 
                      //     echo currency(min(array_filter($prices))); 
                      // else
                      echo currency($exam['price']);
                  ?> 
                </h4>
                <p class="text-center">
                  Expire on: <strong><?php echo date('d M Y', strtotime($exam['end_date']));?></strong>
                </p>
                <?php if(strtotime('now') > strtotime('-1 month',strtotime($exam['end_date']))) { ?> 
                  <a class="btn btn-primary" href="<?php echo base_url('home/checkout/').$exam['category_id']?>">Renew Now</a>
                <?php }?>
              </div>
            </div>
          </div>
        <?php
        endforeach;
        ?>                    
    </div>
  </div>
</section>



<!-- Modal -->
<div class="modal fade" id="popUpModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Payment Detail</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="table-responsive">
          <table class="table">
            <tbody>
              <?php if($this->session->userdata('new_post')!=null){ ?> 
                <tr>
                  <th><?php echo isset($record['razorpay_payment_id']) ? 'Order ID' : 'Error Message';?> </th>
                  <td><?php echo isset($record['razorpay_payment_id']) ? $record['razorpay_payment_id'] : $this->session->userdata('new_post')['error']['description'];?></td>
                </tr>
                <tr>
                  <th>Amount</th>
                  <td><?php echo $record['orderAmount'];?></td>
                </tr>
                <tr>
                  <th>Status</th>
                  <td><?php echo $record['txStatus'];?></td>
                </tr>

               <?php } ?> 
            </tbody>
          </table>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  <?php if(!empty($record) && count($record) > 0) { ?>
    $(document).ready(function(){
      var trail = JSON.parse('<?php echo json_encode($record);?>');
      if(Object.keys(trail).length)
      {
        $('#popUpModal').modal({
          backdrop:'static',
        })
      } 
    });
  <?php 
  }?>
</script>

<?php 
    $this->session->unset_userdata('new_post');
 ?>