<link rel="stylesheet" href="<?php echo base_url('assets/backend/js/jvectormap/jquery-jvectormap-1.2.2.css'); ?>">
<link rel="stylesheet" href="<?php echo base_url('assets/backend/js/rickshaw/rickshaw.min.css'); ?>">
<!-- Bottom Scripts -->
<script src="<?php echo base_url('assets/backend/js/gsap/main-gsap.js'); ?>"></script>
<script src="<?php echo base_url('assets/backend/js/jquery-ui/js/jquery-ui-1.10.3.minimal.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/backend/js/bootstrap.js'); ?>"></script>
<script src="<?php echo base_url('assets/backend/js/joinable.js'); ?>"></script>
<script src="<?php echo base_url('assets/backend/js/resizeable.js'); ?>"></script>
<script src="<?php echo base_url('assets/backend/js/neon-api.js'); ?>"></script>
<script src="<?php echo base_url('assets/backend/js/jvectormap/jquery-jvectormap-1.2.2.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/backend/js/jvectormap/jquery-jvectormap-europe-merc-en.js'); ?>"></script>
<script src="<?php echo base_url('assets/backend/js/jquery.sparkline.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/backend/js/rickshaw/vendor/d3.v3.js'); ?>"></script>
<script src="<?php echo base_url('assets/backend/js/rickshaw/rickshaw.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/backend/js/raphael-min.js'); ?>"></script>
<script src="<?php echo base_url('assets/backend/js/morris.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/backend/js/toastr.js'); ?>"></script>
<script src="<?php echo base_url('assets/backend/js/neon-chat.js'); ?>"></script>
<script src="<?php echo base_url('assets/backend/js/neon-custom.js'); ?>"></script>
<script src="<?php echo base_url('assets/backend/js/neon-demo.js'); ?>"></script>
<!--<script src="<?php echo base_url('assets/backend/js/jquery.dataTables.min.js'); ?>"></script>-->
<!--<script src="<?php echo base_url('assets/backend/js/datatables/TableTools.min.js'); ?>"></script>-->
<!--<script src="<?php echo base_url('assets/backend/js/dataTables.bootstrap.js'); ?>"></script>-->
<!--<script src="<?php echo base_url('assets/backend/js/datatables/jquery.dataTables.columnFilter.js'); ?>"></script>-->
<!--<script src="<?php echo base_url('assets/backend/js/datatables/lodash.min.js'); ?>"></script>-->
<!--<script src="<?php echo base_url('assets/backend/js/datatables/responsive/js/datatables.responsive.js'); ?>"></script>-->
<script src="<?php echo base_url('assets/backend/js/select2/select2.min.js'); ?>"></script>
<!--<script src="<?php echo base_url('assets/backend/js/custom-datatable.js'); ?>"></script>-->
<script src="<?php echo base_url('assets/backend/js/jquery.nestable.js'); ?>"></script>
<!-- <script src="<?php echo base_url('assets/backend/css/font-icons/simple-line-icon/js/icons-lte.js'); ?>"></script> -->
<script src="<?php echo base_url('assets/backend/js/selectboxit/jquery.selectBoxIt.min.js');?>"></script>
<script src="<?php echo base_url('assets/backend/js/wysihtml5/wysihtml5-0.4.0pre.min.js');?>"></script>
<script src="<?php echo base_url('assets/backend/js/wysihtml5/bootstrap-wysihtml5.js');?>"></script>
<script src="<?php echo base_url('assets/backend/js/fileinput.js');?>"></script>
<script src="<?php echo base_url('assets/backend/js/daterangepicker/moment.min.js');?>"></script>
<script src="<?php echo base_url('assets/backend/js/daterangepicker/daterangepicker.js');?>"></script>
<script src="<?php echo base_url('assets/backend/js/font-awesome-icon-picker/fontawesome-four-iconpicker.min.js');?>" charset="utf-8"></script>
<!-- <script src="<?php echo base_url('assets/backend/js/font-awesome-icon-picker/fontawesome-iconpicker.min.js');?>" charset="utf-8"></script> -->
<script src="<?php echo base_url('assets/backend/js/bootstrap-tagsinput.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/backend/js/bootstrap-timepicker.min.js');?>"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.20/af-2.3.4/b-1.6.1/b-colvis-1.6.1/b-flash-1.6.1/b-html5-1.6.1/b-print-1.6.1/cr-1.5.2/fc-3.3.0/fh-3.1.6/kt-2.5.1/r-2.2.3/rg-1.1.1/rr-1.2.6/sc-2.0.1/sp-1.0.1/sl-1.3.1/datatables.min.js"></script>

<script>
$(document).ready(function() {
    $(".html5editor").each(function(){$(this).wysihtml5();});
});
$(function() {
   $('.icon-picker').iconpicker();
 });
</script>

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

<?php endif;*/?>
