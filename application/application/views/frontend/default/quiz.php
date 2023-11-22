<!-- <section class="page-header-area my-course-area">
    <div class="container">
        <div class="row">
            <div class="col">
                <h1 class="page-title"><?php echo get_phrase($page_title); ?></h1>
            </div>
        </div>
    </div>
</section> -->



  <!-- Start Banner 
    ============================================= -->
    <div class="banner-area banner-box bg-gray auto-height double-items pt-5 pb-5">
        <div class="container">
            <div class="heading-left mb-3">
                <div class="row">
                    <div class="col-lg-9">
                        <h5>Quiz<br>
                        <?php echo get_phrase($page_title); ?>
                    </h5>
                        <!-- <h>
                            
                        </h4> -->
                    </div>
                    <div class="col-lg-3">
                        <h5 class="mb-0">Time left</h5>
                        <h6 data-value="4" data-unit="hour">
                           <h6 class="pl-1 pr-1" id="timer"></h6>
                        </h6>
                        <!-- <h5 class="sidebar-heading">Pending</h5> -->
                        

                    
                        <!-- <a class="btn btn-md btn-dark border" href="#">View All <i class="fas fa-plus"></i></a> -->
                    </div>
                </div>
            </div>
        </div>
         <form class="" action="<?php echo site_url('home/result'); ?>" method="post"  id="quiz_form">
        <div id="carouselExampleIndicators" class="carousel "  data-interval="false">

            <!-- Wrapper for slides -->
            <div class="carousel-inner">
                     <?php 
                        $i=0;
                    foreach($questions->result_array() as $question): 
                        $i++;
                    ?>

                <div class="carousel-item <?php if($i==1) echo 'active'; ?>" id = "Ques<?php echo $i; ?>" >
                    <div class="box-table">
                        <div class="box-cell">
                            <div class="container">
                                <div class="row align-center">
                                    <div class="col-lg-12">
                                        <div class="content">
                                            <h4 ><strong>Question No. <?php echo $i; ?></strong></h4>
                                            <h3 ><?php echo html_entity_decode($question['question']) ?></h3>
                                           <div >
                                             <?php
                                            $options = json_decode($question['options']);
                                            $j=0;
                                            foreach($options as $option):
                                            $j++;
                                        ?>
                                                   <div class="radio">
                                                <!-- <label class=""> -->
                                                    <input style = "min-height : 0px !important ;" type="radio"  name = "que_<?php echo $question['id']; ?>" value="<?php echo $j; ?>" data-id="<?php echo $i-1; ?>" class="checkAns"><?php echo html_entity_decode($option); ?>
                                                <!-- </label> -->
                                            </div>
                                             <?php endforeach; ?>
                                        <input type="hidden" name="queId_<?php echo $i; ?>" value="<?php echo $question['id']; ?>">
                                            





                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
               <?php endforeach; ?>
                <input type="hidden" name="total_que" value="<?php echo $i; ?>">
                            <input type="hidden" name="quiz_id" value="<?php echo $quiz['id']; ?>">
                            <input type="hidden" name="minutes" value="" id="minutes">
                            <input type="hidden" name="seconds" value="" id="seconds">
                            <input type="hidden" name="message" value="You have successfully submitted your exam. You can now view your result & description." id="message">
            </div>
            <!-- End Wrapper for slides -->

            <!-- Left and right controls -->
            <!-- <a class="left carousel-control light" href="#bootcarousel" data-slide="prev">
                <i class="ti-angle-left"></i>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control light" href="#bootcarousel" data-slide="next">
                <i class="ti-angle-right"></i>
                <span class="sr-only">Next</span>
            </a> -->

        </div>
          <div class="container">
        <div class="row">
                    <div class="col-md-12 pagi-area ">
                        <nav aria-label="navigation">
                            <ul class="pagination text-center">
                                  <?php 
                        for($i=0; $i<count($questions->result_array()); $i++): ?>
                                <li data-target="#carouselExampleIndicators "  data-slide-to="<?php echo $i; ?>" id = "newclick<?php echo $i+1; ?>"  class="page-item <?php if($i==0) echo 'active'; ?>" data-id="<?php echo $i+1; ?>" ><a class="page-link" id="indicator<?php echo $i; ?>" ><?php echo $i+1; ?></a></li>
                          
                            <!-- <li data-target="#carouselExampleIndicators" data-slide-to="<?php echo $i; ?>" class="<?php if($i==0) echo 'active'; ?>" id="indicator1<?php echo $i2; ?>" ><?php echo $i+1; ?></li> -->
                    <?php
                        endfor;
                    ?>   
                                <!-- <li class="page-item"><a class="page-link" href="#"><i class="fas fa-angle-double-left"></i></a></li>
                                <li class="page-item active"><a class="page-link"  href="#bootcarousel" data-slide="prev">1</a></li>
                                <li class="page-item"><a class="page-link" href="#bootcarousel" data-slide="next">2</a></li>
                                
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item"><a class="page-link" href="#"><i class="fas fa-angle-double-right"></i></a></li> -->
                            </ul>
                        </nav>
                    </div>
                    <div class="col-md-12 pagi-area ">
                           <nav aria-label="navigation">
                            <ul class="pagination text-center">
                           <a  class="nextbtn_Slide btn btn-warning">
                                Next
                    </a>
                            <button type = "submit" id="quizBtn"  class="btn btn-success">
                                Finish
                    </button> 
                              </ul>
                        </nav>
                    </div>
                </div>
</div>
</form>
    </div>
    <!-- End Banner -->
                

               




<script src="https://quizart.co.in/assets/frontend/js/vendor/jquery-3.2.1.min.js"></script>
<script src="https://quizart.co.in/assets/backend/js/jquery-ui/js/jquery-ui-1.10.3.minimal.min.js"></script>



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
        "<span class='h5 text-primary'>" + current_minutes.toString() +  "</span> Min <span class='h5 text-primary'>" + (seconds < 10 ? "0" : "") + String(seconds) + "</span> Sec" ;
        // current_minutes.toString() + ":" + (seconds < 10 ? "0" : "") + String(seconds);
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

    
    
    
//   $('.carousel').carousel({
//       wrap: false,
//       interval: false;
//   });

  $('.checkAns').click(function(){
      var dataId = $(this).attr('data-id');
      $('#indicator'+dataId).css('background-color', 'green');
            $('#indicator'+dataId).css('color', 'white');
  });

  $(".page-item").click(function () {
   $(".page-item.active").removeClass('active');
   $(this).addClass('active');
});

  $(".nextbtn_Slide").click(function () {
 
    var dataId2 = $(".page-item.active").attr('data-id');
    var n1 = parseInt(dataId2);
    var n2 = n1 + 1 ;
            //  alert(n2);
   $(".page-item.active").removeClass('active');
    $(".carousel-item.active").removeClass('active');
   $('#newclick'+n2 ).addClass('active');
   $('#Ques'+n2).addClass('active');
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
