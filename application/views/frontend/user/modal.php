<script type="text/javascript">
  <?php if(!empty($record) && count($record) > 0) { ?>
    $(document).ready(function(){
      var trail = JSON.parse('<?php echo (isset($record) ? json_encode($record) : '');?>');
      if(Object.keys(trail).length)
      {
        jQuery('#popUpModal').modal('show', {backdrop:'static'});
      } 
    });
  <?php 
  }?>
</script>
<!-- Modal -->
<div class="modal fade" id="popUpModal">
  <div class="modal-dialog">
    <div class="modal-content" style="margin-top:100px;">
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
<?php 
  $this->session->unset_userdata('new_post');
?>