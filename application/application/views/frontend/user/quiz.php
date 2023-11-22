<section class="page-header-area my-course-area">
    <div class="container">
        <div class="row">
            <div class="col">
                <h1 class="page-title"><?php echo get_phrase($page_title); ?></h1>
            </div>
        </div>
    </div>
</section>



<section class="my-courses-area">
    <div class="container">
        <div class="row align-items-baseline">
            <div class="col-lg-6">
            </div>
            <div class="col-lg-6">
                <div class="my-course-search-bar">
                        <div class="input-group" id="timer">
                        </div>
                </div>
            </div>
        </div>

                        <form class="" action="<?php echo site_url('home/result'); ?>" method="post"  id="quiz_form">
        <div class="row">
            <div class="user-dashboard-box col">
                <div class="carousel" id="carouselExampleIndicators">
                    <ol class="carousel-indicators">
                    <?php 
                        for($i=0; $i<count($questions->result_array()); $i++): ?>
                            <li data-target="#carouselExampleIndicators" data-slide-to="<?php echo $i; ?>" class="<?php if($i==0) echo 'active'; ?>" id="indicator<?php echo $i; ?>" ><?php echo $i+1; ?></li>
                    <?php
                        endfor;
                    ?>
                    </ol>
                    <div class="carousel-inner">
                            <?php 
                                $i=0;
                            foreach($questions->result_array() as $question): 
                                $i++;
                            ?>
                                <div class="user-dashboard-content carousel-item <?php if($i==1) echo 'active'; ?>">
                                    <div class="content-title-box">
                                        <div class="subtitle" style="font-weight:600"><?php echo html_entity_decode($question['question']) ?></div>
                                    </div>
                                        <?php
                                            $options = json_decode($question['options']);
                                            $j=0;
                                            foreach($options as $option):
                                            $j++;
                                        ?>
                                            <div class="radio">
                                                <label class=""><input type="radio"  name = "que_<?php echo $question['id']; ?>" value="<?php echo $j; ?>" data-id="<?php echo $i-1; ?>" class="checkAns"><?php echo html_entity_decode($option); ?></label>
                                            </div>
                                        <?php endforeach; ?>
                                        <input type="hidden" name="queId_<?php echo $i; ?>" value="<?php echo $question['id']; ?>">
                                </div>
                            <?php endforeach; ?>
                            <input type="hidden" name="total_que" value="<?php echo $i; ?>">
                            <input type="hidden" name="quiz_id" value="<?php echo $quiz['id']; ?>">
                            <input type="hidden" name="minutes" value="" id="minutes">
                            <input type="hidden" name="seconds" value="" id="seconds">
                            <input type="hidden" name="message" value="You have successfully submitted your exam. You can now view your result & description." id="message">
                    </div>
                            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                                <button class="btn btn-primary"><span>Next</span></button>
                            </a>
                </div>
            </div>
        </div>
                            <button class="btn btn-primary quizBtn" type="submit" ><span>Finish</span></button>
                        </form>
    </div>
</section>





<script type="text/javascript">
var attempt_time = '<?php echo $quiz['attempt_time']?>';
var message;
var type;
function show_toast(message,type,title='')
	{
		toastr[type](message, title, {
			positionClass: 'toast-top-right',
			closeButton: true,
			progressBar: false,
			newestOnTop: true,
			rtl: $("body").attr("dir") === "rtl" || $("html").attr("dir") === "rtl",
			timeOut: 5000,
		});	
	}
// console.log(attempt_time);
var timeoutHandle;
function countdown(minutes) {
    var seconds = 60;
    var mins = minutes
    function tick() {
        var counter = document.getElementById("timer");
        var current_minutes = mins-1
        seconds--;
        counter.innerHTML =
        current_minutes.toString() + ":" + (seconds < 10 ? "0" : "") + String(seconds);
        document.getElementById("minutes").value = current_minutes;
        document.getElementById("seconds").value = seconds;
        if( seconds > 0 ) {
            timeoutHandle=setTimeout(tick, 1000);
        } else {

            if(mins > 1){
               // countdown(mins-1);   never reach “00″ issue solved:Contributed by Victor Streithorst
               setTimeout(function () { countdown(mins - 1); }, 1000);

            }else{
                // alert('time up');
                message = 'Time Up';
                type = 'success';
                show_toast(message,type);
                $('#message').val('Your time is up! Your quiz submitted successfully. Now you can view your result & description.');
                
                document.getElementById('quiz_form').submit();
            }
        }
    }
    tick();
}



$(document).ready(function() {
     countdown(attempt_time);

    
    
    
  $('.carousel').carousel({
      wrap: false,
      interval: false
  });

  $('.checkAns').click(function(){
      var dataId = $(this).attr('data-id');
      $('#indicator'+dataId).css('background-color', 'green');
  });




});

 // $(window).on('beforeunload', function(event) {
        
       
 //        document.getElementById('quiz_form').submit();
 //         console.log('Ok');
 //        return 'Your own message goes here...';
 //    });


//  window.addEventListener('beforeunload', (event) => {
//   // Cancel the event as stated by the standard.
//   event.preventDefault();
//   // Chrome requires returnValue to be set.

//      // document.getElementById('quiz_form').submit();
//   event.returnValue = '';

//          var __type= event.currentTarget.performance.navigation.type;
            
//                 if(__type === 1 || __type === 0){
//                     // alert("Browser refresh button is clicked...");
//                     document.getElementById('quiz_form').submit();
//                 }
//                 else if(__type ==2){
//                   document.getElementById('quiz_form').submit();
//                 }

// });

  

</script>
