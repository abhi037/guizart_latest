<script src="<?php echo base_url().'assets/frontend/js/vendor/modernizr-3.5.0.min.js'; ?>"></script>
<script src="<?php echo base_url().'assets/frontend/js/vendor/jquery-3.2.1.min.js'; ?>"></script>
<script src="<?php echo base_url('assets/backend/js/jquery-ui/js/jquery-ui-1.10.3.minimal.min.js'); ?>"></script>
<script src="<?php echo base_url().'assets/frontend/js/popper.min.js'; ?>"></script>
<script src="<?php echo base_url().'assets/frontend/js/bootstrap.min.js'; ?>"></script>
<script src="<?php echo base_url().'assets/frontend/js/slick.min.js'; ?>"></script>
<script src="<?php echo base_url().'assets/frontend/js/select2.min.js'; ?>"></script>
<script src="<?php echo base_url().'assets/frontend/js/tinymce.min.js'; ?>"></script>
<script src="<?php echo base_url().'assets/frontend/js/multi-step-modal.js'; ?>"></script>
<script src="<?php echo base_url().'assets/frontend/js/jquery.webui-popover.min.js'; ?>"></script>
<script src="https://content.jwplatform.com/libraries/O7BMTay5.js"></script>
<script src="<?php echo base_url().'assets/frontend/js/main.js'; ?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/nestable2/1.6.0/jquery.nestable.min.js" charset="utf-8"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.min.js" integrity="sha384-FzT3vTVGXqf7wRfy8k4BiyzvbNfeYjK+frTVqZeNDFl8woCbF0CYG6g2fMEFFo/i" crossorigin="anonymous"></script>
<script src="<?php echo base_url().'assets/frontend/js/bootstrap-tagsinput.min.js'; ?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.min.js"></script>
<script src="<?php echo base_url().'assets/frontend/js/custom.js'; ?>"></script>
<script src="<?php echo base_url().'assets/frontend/js/lightbox.min.js'; ?>"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.20/af-2.3.4/b-1.6.1/b-colvis-1.6.1/b-flash-1.6.1/b-html5-1.6.1/b-print-1.6.1/cr-1.5.2/fc-3.3.0/fh-3.1.6/kt-2.5.1/r-2.2.3/rg-1.1.1/rr-1.2.6/sc-2.0.1/sp-1.0.1/sl-1.3.1/datatables.min.js"></script>


<?php if ($this->session->flashdata('flash_message') != ""):?>
  <script>
  	$(document).ready(function() {
	  	function flash_message() {
	  		jQuery('#modal-message').modal('show', {backdrop: 'static'});
	  	}
	    flash_message();
	  });
  </script> 
  <!-- (Normal Modal)-->
  <div class="modal fade" id="modal-message">
      <div class="modal-dialog">
          <div class="modal-content" style="margin-top:100px; background-color: #bdedbc;">
              <div class="modal-header"> 
                  <h4 class="modal-title" style="text-align:center; "><?php echo $this->session->flashdata('flash_message'); ?></h4>
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              </div> 
          </div>
      </div>
  </div>
<?php endif;?>
  
<?php if ($this->session->flashdata('error_message') != ""):?>
  <script>
  	$(document).ready(function() {
	  	function errormessage() {
	  		jQuery('#modal-errormessage').modal('show', {backdrop: 'static'}); 
	  	}
	    errormessage();
    });
  </script> 
  <!-- (Normal Modal)-->
  <div class="modal fade" id="modal-errormessage">
      <div class="modal-dialog">
          <div class="modal-content" style="margin-top:100px; background-color: #ffc9c9;"> 
              <div class="modal-header"> 
                <h4 class="modal-title" style="text-align:center; "><?php echo $this->session->flashdata('error_message'); ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              </div> 
          </div>
      </div>
  </div> 
<?php endif;?>
  
<!-- SHOW TOASTR NOTIFIVATION -->
<?php /*if ($this->session->flashdata('flash_message') != ""):?>
	<script type="text/javascript">
		toastr.success('<?php echo $this->session->flashdata("flash_message");?>');
	</script>
<?php endif;?>

<?php if ($this->session->flashdata('error_message') != ""):?>
	<script type="text/javascript">
		toastr.error('<?php echo $this->session->flashdata("error_message");?>');
	</script>
<?php endif; */?>
