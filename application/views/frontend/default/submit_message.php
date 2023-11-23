<style>
    html, body {
  height: 100%;
}

.bg-green-light {
  /* height: 100%; */
  background:#CADFF2;
}
</style>



   
      <div class="error-page-area overflow-hidden pt-5 pb-5 bg-green-light">
        <div class="container">
            <div class="row align-center">
                <div class="col-lg-6 thumb">
                    <img src="../assets/frontend/img/illustration/success_1.svg" alt="Thumb">
                </div>
                <div class="col-lg-6">
                    <div class="error-box">
                        <h2 class = "text-primary">Successfully Submitted!</h2>
                        <h4>
                          <?php 
                            echo $this->input->post('message');
                            // header( "refresh:5;url=https://demousa.online/home/getResult/".$quiz_id);
                             header( "refresh:5;url=https://quizart.co.in/home/getResult/".$quiz_id);
                            ?>
                        </h4>
                        <!-- <p>
                         <?php 
                            //echo $this->input->post('message');
                            // header( "refresh:5;url=https://quizart.co.in/home/getResult/".$quiz_id);
                            ?>
                        </p> -->
                        <!-- <a class="btn circle btn-md btn-gradient" href="#">Back to home</a> -->
                    </div>
                </div>
            </div>
        </div>
    </div>  
    <!-- <?php 
        // print_r($this->input->post());
      //  echo '<h1 class="text-center">'.$this->input->post('message').'</h1>';
        // echo '<p class="text-center">Redirecting in 5 Seconds</p>';
      //  header( "refresh:5;url=https://quizart.co.in/home/getResult/".$quiz_id);
    ?> -->
  


