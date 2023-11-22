<style>
    .tile-red,.tile-green,.tile-aqua{
  background:#2B3A4A !important;
    }
  
</style>

<ol class="breadcrumb bc-3" style="margin-bottom:0px; padding-bottom:0px;">
  <li class = "active">
    <a href="#">
      <i class="entypo-folder"></i>
      <?php echo get_phrase('dashboard'); ?>
    </a>
  </li>
</ol>
<!--<h2><i class="fa fa-arrow-circle-o-right"></i> <?php echo $page_title; ?></h2>-->
<br />

<div class="row">
  <div class="col-md-12">
    <div class="panel panel-primary" data-collapsed="0">
      <!--<div class="panel-heading" >
        <div class="panel-title" style="font-weight:800px;color:black; background: linear-gradient(#cadc68,#f1f363,#caa82d); text-align:center;">
            <marquee direction="Left" height="20" width="1015" >Your Mind Is The Key Of The Treasure..</marquee>
            <!--<?php echo get_phrase('Mind Is The Key Of The Tressure..'); ?>
        </div>-->
    </div>
    <div class="panel-body" style="background-color:white";>  

      <div class="row">  
        <div class="col-sm-3">
          <div class="tile-progress tile-blue" style="-webkit-box-shadow: 3px 3px 6px 2px #403e3e; background-color:#0ea985; border-radius:15px"> 
            <div class="tile-header">
              <h3><?php echo isset($my_exams) ? $my_exams : 0; ?></h3>  
              <br><br>
              <span style="font-size: small;">Enrolled Quizzes.</span> 
            </div>  
          </div>
        </div>
        
        <div class="col-sm-3">
          <div class="tile-progress tile-purple" style="-webkit-box-shadow: 3px 3px 6px 2px #403e3e; background-color:#73d618; border-radius:15px"> 
            <div class="tile-header">
              <h3><?php echo isset($exams) ? $exams : 0; ?></h3>  
              <br><br>
              <span style="font-size: small;">Attempted Quizzes.</span> 
            </div>  
          </div>
        </div>

        <div class="col-sm-3">
          <div class="tile-progress tile-pink" style="-webkit-box-shadow: 3px 3px 6px 2px #403e3e; background-color:#536561; border-radius:15px"> 
            <div class="tile-header">
              <h3><?php echo isset($referrals) ? $referrals : 0; ?></h3>  
              <br><br>
              <span style="font-size: small;">Referrals.</span> 
            </div>  
          </div>
        </div>

        <div class="col-sm-3">
          <div class="tile-progress tile-green" style="-webkit-box-shadow: 3px 3px 6px 2px #403e3e; background-color:#f5c104 !important; border-radius:15px"> 
            <div class="tile-header">
              <h3>0</h3>  
              <br><br>
              <span style="font-size: small;">Ranking.</span> 
            </div>  
          </div>
        </div>
      </div> 
      
      <div class="row" style="margin-bottom:5%;margin-top:2%;">
        <div class="col-md-3"> 
          <div class="row">
            <div class="col-md-12">
              
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
            
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="row">
            <div class="col-md-3">
            </div>
            <div class="col-md-5" style="border-radius: 2px; border: solid; border-color: red;-webkit-box-shadow: 3px 3px 8px 2px #403e3e;border-radius:15px; width:50%; height:50%;">
              <a href="<?php echo site_url('home/my_exam'); ?>">
                <!--<div class="panel panel-default rounded-circle" style="text-align: center; border-color:white; height: 181px; border-radius: 200px; "></div>-->
                  <div class="panel-body" style="text-align: center; overflow: auto; padding: 25px 0;"> 
                    <img src="https://www.quizart.co.in/assets/backend/images/Untitled-2-01 (1).jpg"); alt="" class="img-thumbnail" style="text-align: center; border-color: white; height: 125px; width: 150px; margin-left: 0px;" /> 
                    <h2 style="background-color: lightblue;border-color: black;-webkit-box-shadow: 3px 3px 8px 2px #403e3e;background-color:white;border-radius:15px;width: 90%;margin-left: 4%"> Start Quiz </h2>
                  
                </div>
              </a>
            </div>
            <div class="col-md-3">
            </div>
          </div> 
        </div>
        <div class="col-md-3">
          <div class="row" style="margin-bottom: 10px;">
            <div class="col-md-12">
              <?php
              if (file_exists('uploads/user_image/'.$this->session->userdata('user_id').'.jpg') || file_exists(base_url().'uploads/user_image/'.$this->session->userdata('user_id').'.jpg')): ?>
                <img src="<?php echo base_url('uploads/user_image/'.$this->session->userdata('user_id').'.jpg'); ?>" alt="" class="img-thumbnail" style="text-align: center; border-color: black; height: 125px; width: 150px; margin-left: 50px;  " />
              <?php else: ?>
                <img src="<?php echo base_url('uploads/user_image/placeholder.png'); ?>" alt="" class="img-thumbnail" style="text-align: center; border-color: white; height: 125px; width: 150px; margin-left:25%;  " /> 
              <?php endif; ?> 
              
            </div>
          </div> 
          <!--<div class="row">-->
          <!--  <div class="col-md-12">-->
          <!--    <div class="panel panel-default" style="text-align: center;background-color: #f9f589;">-->
          <!--      <div class="panel-body" style="padding:5px;">-->
                    <!--<img src="https://i7.pngguru.com/preview/148/892/848/computer-icons-user-symbol-light-client-icon.jpg" alt="" class="img-thumbnail" style="text-align: left;width:35px;height:35px;background-color:transparent; ">-->
          <!--        <?php echo $admin_details['first_name'].' '.$admin_details['last_name']; ?>-->
          <!--      </div>-->
          <!--    </div>-->
          <!--  </div>-->
          <!--</div> -->
        </div> 
      </div>

      <div class="row">
        <div class="col-md-8">
          <div id="chartContainer" style="height: 300px; -webkit-box-shadow: 3px 3px 8px 2px #403e3e"></div>
        </div> 
        <!--<div class="col-md-3">-->
        <!--  <div class="row">-->
        <!--    <div class="col-md-12">-->
        <!--      <div class="panel panel-default" style="text-align: center; border-color: black; height: 350px;background-color: bisque;">-->
        <!--        <div class="panel-body">-->
        <!--          <h3 style="text-decoration: underline;">Score Board</h3>-->
        <!--          <?php foreach ($daily_score as $key1 => $value1) { ?>-->
        <!--            <br>    Quiz-<?php echo $key1+1;?>  : <?php echo $value1['marks'];?>  -->
        <!--          <?php }?> -->
        <!--        </div>-->
        <!--      </div>-->
        <!--    </div>-->
        <!--  </div> -->
        <!--</div>-->
        <div class="col-md-3" style="padding-top:2%; padding-bottom:2%;margin-right; -webkit-box-shadow: 3px 3px 8px 2px #403e3e;"> 
          <div class="row">
            <div class="col-md-12">
              <div class="panel panel-default" style="text-align: center;background-color: lightpink;padding:1px;-webkit-box-shadow: 3px 3px 8px 2px #403e3e; background-color:white; border-radius:15px">
                <div class="panel-body" style="padding:5px;">   <img src="https://www.pinclipart.com/picdir/middle/172-1721095_wednesday-6th-july-pink-calendar-icon-png-clipart.png" alt="" class="img-thumbnail" style="text-align: left;height:40px; width:40px;background-color:transparent;margin-right:32px; -webkit-box-shadow: 3px 3px 8px 2px #403e3e; background-color:white; border-radius:15px">Date (<?php echo date('dS M,Y'); ?>)</div>
             
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="panel panel-default" style="text-align: center;background-color: lightgreen;-webkit-box-shadow: 3px 3px 8px 2px #403e3e; background-color:white; border-radius:15px">
                <div class="panel-body" style="padding:5px;-webkit-box-shadow: 3px 3px 8px 2px #403e3e; background-color:white; border-radius:15px"><img src="https://images.assetsdelivery.com/compings_v2/ahasoft2000/ahasoft20001511/ahasoft2000151101747.jpg" alt="" class="img-thumbnail" style="text-align: left;width:40px;background-color:transparent;margin-right:10px;-webkit-box-shadow: 3px 3px 8px 2px #403e3e; background-color:white; border-radius:15px"><?php echo date('l'); ?> / <span id="demo"><?php echo date('h:i:s A'); ?></span> </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="panel panel-default" style="text-align: center;background-color: #f9aa66;-webkit-box-shadow: 3px 3px 8px 2px #403e3e; background-color:white; border-radius:15px">
                <div class="panel-body" style="padding:8px;-webkit-box-shadow: 3px 3px 8px 2px #403e3e; background-color:white; border-radius:15px";><img src="https://png.pngitem.com/pimgs/s/80-805441_internal-referrals-icon-referral-png-transparent-png.png" alt="" class="img-thumbnail" style="text-align: left;width:35px;height:35px;background-color:transparent;margin-right:25px;-webkit-box-shadow: 3px 3px 8px 2px #403e3e; background-color:white; border-radius:15px">Ref. Code  <?php echo isset($user_details['referral_code']) ? $user_details['referral_code'] : ''; ?></div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-6">
          
        </div>
      </div>
    </div>
  </div>
</div> 
<script src="https://canvasjs.com/assets/script/jquery.canvasjs.min.js"></script>
<script>
window.onload = function () {

var options = {
  animationEnabled: true,  
  title:{
    text: "Daily Score"
  },
  axisX: {
    valueFormatString: "DD-MM"
  },
  axisY: {
    title: "MARKS",
    prefix: ""
  },
  data: [{
    yValueFormatString: "#,###",
    xValueFormatString: "D-DDD",
    type: "line",
    dataPoints: [
      <?php foreach ($daily_score as $key => $value) { ?>
      { x: new Date(<?php echo $value['submitted_time'];?>), y: <?php echo $value['marks'];?> }, 
      <?php }?>
    ]
  }]
};
$("#chartContainer").CanvasJSChart(options);

}
</script>
<script>
  var myVar = setInterval(myTimer ,1000);
  function myTimer() {
    var d = new Date();
    document.getElementById("demo").innerHTML = d.toLocaleTimeString();
  }
</script>