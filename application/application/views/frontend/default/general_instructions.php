<section class="page-header-area my-course-area">
    <div class="container">
        <div class="row">
            <div class="col">
				<div class="alert alert-info">
                    <strong> <?php echo ucfirst("Instruction For Exam"); ?></strong> 
                </div> </div>
                <!-- <h1 class="page-title">Instruction for exam</h1> -->
            </div>
        </div>
    </div>
</section>




	<div class="container pl-0 pr-0">
		<div class="row m-3 alert alert-info">
			<div class="col-md-12">
				
				<?php 
					
					echo htmlspecialchars_decode($instruction->rules);
					
				?>

				<div class="d-flex justify-content-center">
					<?php 
						$attribute = array('id'=>'quiz_form');
						echo form_open('');?>
					 <div class="custom-control custom-checkbox">
	                  <input type="submit" class="btn btn-info" id="customCheck1" name="agree"  value="I Agree">
					  
	                  <!-- <label class="custom-control-label btn-" for="customCheck1">I Agree </label> -->

					
					  <!-- <a href="#" class="btn btn-info">I Agree </a>  -->

	                </div>
	            	</form>
				</div>
			</div>
		</div>
	</div>

<!-- 
<script type="text/javascript">
	
    $(document).off('click','#customCheck1').on('click','#customCheck1',function(){

        if($(this).prop("checked") == true)
        {
        	$(this).closest('form').submit();
        }
    });
</script> -->