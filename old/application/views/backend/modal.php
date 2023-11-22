<script type="text/javascript">
  function confirm_modal(delete_url, modal_type)
  {
    if (modal_type === 'generic_confirmation') {
        jQuery('#modal-generic_confirmation').modal('show', {backdrop: 'static'});
    document.getElementById('update_link').setAttribute('href' , delete_url);
    }
    else{
        jQuery('#modal-4').modal('show', {backdrop: 'static'});
    document.getElementById('delete_link').setAttribute('href' , delete_url);
    }
  }
</script>

<script type="text/javascript">
  function video(video_url)
  {
    jQuery('#video-model').modal('show', {backdrop: 'static'});
    document.getElementById("mp4_src").src = video_url;
    document.getElementById("ogg_src").src = video_url;
    document.getElementById("myVideo").load(); 
  }

  function doc(doc_url)
  {
    jQuery('#doc-model').modal('show', {backdrop: 'static'}); 
    jQuery("#docframe").attr("src", doc_url);
  }
</script>
<script type="text/javascript">
function showAjaxModal(url)
{
    // SHOWING AJAX PRELOADER IMAGE
    jQuery('#modal_ajax .modal-body').html('<div style="text-align:center;margin-top:200px;"><img src="<?php echo base_url().'assets/backend/img/preloader.gif'; ?>" /></div>');

    jQuery('#modal_ajax .modal-body').html('<div style="text-align:center;margin-top:200px;"><img src="<?php echo base_url().'assets/backend/img/preloader.gif'; ?>" /></div>');
    // LOADING THE AJAX MODAL
    jQuery('#modal_ajax').modal('show', {backdrop: 'true'});

    // SHOW AJAX RESPONSE ON REQUEST SUCCESS
    $.ajax({
        url: url,
        success: function(response)
        {
            jQuery('#modal_ajax .modal-body').html(response);
        }
    });
}
</script>

<script type="text/javascript">
  $(document).ready(function(){
    var trail = JSON.parse('<?php echo (isset($record) ? json_encode($record) : '');?>');
    if(Object.keys(trail).length)
    {
      jQuery('#popUpModal').modal('show', {backdrop:'static'});
    } 
  });
</script>

<!-- (Ajax Modal)-->
<div class="modal fade" id="modal_ajax">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><?php echo $system_name;?></h4>
            </div>

            <div class="modal-body" style="height:500px; overflow:auto;">



            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>



    <!-- (Normal Modal)-->
    <div class="modal fade" id="modal-4">
        <div class="modal-dialog">
            <div class="modal-content" style="margin-top:100px;">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" style="text-align:center;">Are you sure to delete this information ?</h4>
                </div>


                <div class="modal-footer" style="margin:0px; border-top:0px; text-align:center;">
                    <a href="#" class="btn btn-danger" id="delete_link"><?php echo get_phrase('delete');?></a>
                    <button type="button" class="btn btn-info" data-dismiss="modal"><?php echo get_phrase('cancel');?></button>
                </div>
            </div>
        </div>
    </div>

    <!-- (Video Modal)-->
    <div class="modal fade" id="video-model">
      <div class="modal-dialog">
        <div class="modal-content" style="margin-top:100px;"> 
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button> 
            <h4>View your video</h4>
          </div> 
          <div class="modal-header">
            <video id="myVideo" controls style="width: 100%; height: 100%;">
              <source id="mp4_src" src="#" type="video/mp4">
              <source id="ogg_src" src="#" type="video/ogg">
              Your browser does not support HTML5 video.
            </video>
          </div>
          <div class="modal-footer" style="margin:0px; border-top:0px; text-align:center;"> 
            <button type="button" class="btn btn-info" data-dismiss="modal"><?php echo get_phrase('cancel');?></button>
          </div>
        </div>
      </div>
    </div>


    <!-- (Video Modal)-->
    <div class="modal fade custom-width" id="doc-model">
      <div class="modal-dialog" style="width: 60%;">
        <div class="modal-content" style="margin-top:100px;"> 
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button> 
            <h4>View your Document</h4>
          </div> 
          <div class="modal-header" style="text-align: center;"> 
            <iframe id="docframe" style="  height: 800px; width: 700px; " ></iframe>
          </div>
          <div class="modal-footer" style="margin:0px; border-top:0px; text-align:center;"> 
            <button type="button" class="btn btn-info" data-dismiss="modal"><?php echo get_phrase('cancel');?></button>
          </div>
        </div>
      </div>
    </div>

    <!-- (generic_confirmation Modal)-->
    <div class="modal fade" id="modal-generic_confirmation">
        <div class="modal-dialog">
            <div class="modal-content" style="margin-top:100px;">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" style="text-align:center;"><?php echo get_phrase('are_you_sure_to_update_this_information'); ?> ?</h4>
                </div>


                <div class="modal-footer" style="margin:0px; border-top:0px; text-align:center;">
                    <a href="#" class="btn btn-danger" id="update_link"><?php echo get_phrase('yes');?></a>
                    <button type="button" class="btn btn-info" data-dismiss="modal"><?php echo get_phrase('no');?></button>
                </div>
            </div>
        </div>
    </div>
   
    
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
