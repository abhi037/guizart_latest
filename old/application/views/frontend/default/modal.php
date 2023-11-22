<script type="text/javascript">
function showAjaxModal(url)
{
// SHOWING AJAX PRELOADER IMAGE
jQuery('#modal_ajax .modal-body').html('<div style="text-align:center;margin-top:200px;"><img src="assets/images/preloader.gif" /></div>');

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

<!-- (Ajax Modal)-->
<div class="modal fade" id="modal_ajax">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><?php echo "Modal";?></h4>
            </div>

            <div class="modal-body" style="height:500px; overflow:auto;">



            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>




<script type="text/javascript">
function confirm_modal(delete_url)
{
  jQuery('#modal-4').modal('show', {backdrop: 'static'});
  document.getElementById('delete_link').setAttribute('href' , delete_url);
}

function doc(subject_id)
{
  $.ajax({
    url: '<?php echo base_url('home/getDoc/')?>',
    type:'POST',
    data: {subject_id: subject_id},
    dataType:'text',
  }).done(function(response){ 
    if(response!='') { 
      jQuery('#doc-model').modal('show', {backdrop: 'static'}); 
      jQuery("#framediv").show();
      jQuery("#docdiv").hide();
      jQuery("#docframe").attr("src", response);
    }  else {
      jQuery('#doc-model').modal('show', {backdrop: 'static'}); 
      jQuery("#framediv").hide();
      jQuery("#docdiv").show();
      jQuery("#docspan").html('No study material uploaded');
    }
  });  
}
</script>

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

<!-- (Doc Modal)-->
<div class="modal fade" id="doc-model">
  <div class="modal-dialog" style="width: 80%;">
    <div class="modal-content" style="margin-top:100px;"> 
      <div class="modal-header">
         
        <h4 class="modal-title">View study material</h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
      </div> 
      <div class="modal-header" id="framediv" style="text-align: center;"> 
        <iframe id="docframe" style="  height: 800px; width: 700px; " ></iframe>
      </div>
      <div class="modal-header" id="docdiv" style="text-align: center; display: none;"> 
        <span id="docspan"></span>
      </div>
      <div class="modal-footer" style="margin:0px; border-top:0px; text-align:center;"> 
        <button type="button" class="btn btn-info" data-dismiss="modal"><?php echo get_phrase('cancel');?></button>
      </div>
    </div>
  </div>
</div>
