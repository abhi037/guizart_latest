<style>
    html, body {
  height: 100%;
}

.full-height {
  height: 100%;
  background:#43c5bb;
}
</style>



    <div class= "align-middle full-height pt-5 text-white" >
    <?php 
        // print_r($this->input->post());
        echo '<h1 class="text-center">'.$this->input->post('message').'</h1>';
        // echo '<p class="text-center">Redirecting in 5 Seconds</p>';
        header( "refresh:5;url=https://quizart.co.in/home/getResult/".$quiz_id);
    ?>
    </div>



