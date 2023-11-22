<section class="page-header-area my-course-area">
    <div class="container">
        <div class="row">
            <div class="col">
                <h1 class="page-title">Instruction for exam</h1>
            </div>
        </div>
    </div>
</section>

<section>
	<div class="container">
		<div class="row">
			<div class="col-md-12 my-3">
				<?php 
					
					echo htmlspecialchars_decode($instruction->rules);
					
				?>

				<div class="d-flex justify-content-center">
					<?php 
						$attribute = array('id'=>'quiz_form');
						echo form_open('');?>
					 <div class="custom-control custom-checkbox">
	                  <input type="checkbox" class="custom-control-input" id="customCheck1" name="agree">
	                  <label class="custom-control-label" for="customCheck1">I Agree </label>
	                </div>
	            	</form>
				</div>
			</div>
		</div>
	</div>
</section>

<script type="text/javascript">
	
    $(document).off('click','#customCheck1').on('click','#customCheck1',function(){

        if($(this).prop("checked") == true)
        {
        	$(this).closest('form').submit();
        }
    });
</script>