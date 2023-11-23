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
      <div class="panel-heading" >
        <div class="panel-title" style="font-weight:800px;color:black; background: linear-gradient(#cadc68,#f1f363,#caa82d); text-align:center;">
            <marquee direction="Left" height="20" width="900" >Hurry Up!!!! Pay Now...5Days Left!!!</marquee>
            <!--<?php echo get_phrase('Mind Is The Key Of The Tressure..'); ?>-->
        </div>
      </div>
      <div class="panel-body" style="background-color:#0d0d2d";>  

        <!--<div class="row">
          <div class="col-md-12">
            <div class="panel panel-default" style="text-align: center;">
              <div class="panel-body">
                <marquee direction="Left" height="20" width="900" bgcolor="white">Hurry Up!!!! Pay Now...5Days Left!!!</marquee>
              </div>
            </div>
          </div>
        </div>-->

        <div class="row">  
          <div class="col-sm-3">
            <div class="tile-progress tile-blue"> 
              <div class="tile-header">
                <h3><?php echo isset($my_exams) ? $my_exams : 0; ?></h3>  
                <span>Enrolled Quizes.</span> 
              </div>  
            </div>
          </div>
          
          <div class="col-sm-3">
            <div class="tile-progress tile-purple"> 
              <div class="tile-header">
                <h3><?php echo isset($exams) ? $exams : 0; ?></h3>  
                <span>Quizes Attempted.</span> 
              </div>  
            </div>
          </div>

          <div class="col-sm-3">
            <div class="tile-progress tile-pink"> 
              <div class="tile-header">
                <h3><?php echo isset($referrals) ? $referrals : 0; ?></h3>  
                <span>Referrals.</span> 
              </div>  
            </div>
          </div>

          <div class="col-sm-3">
            <div class="tile-progress tile-green"> 
              <div class="tile-header">
                <h3>0</h3>  
                <span>Ranking.</span> 
              </div>  
            </div>
          </div>
        </div> 
        
        <div class="row">
          <div class="col-md-3"> 
            <div class="row">
              <div class="col-md-12">
                <div class="panel panel-default" style="text-align: center;background-color: lightpink;padding:1px;">
                  <div class="panel-body" style="padding:5px;">   <img src="https://www.pinclipart.com/picdir/middle/172-1721095_wednesday-6th-july-pink-calendar-icon-png-clipart.png" alt="" class="img-thumbnail" style="text-align: left;height:40px; width:40px;background-color:transparent;margin-right:10px; ">Date (<?php echo date('dS M,Y'); ?>)</div>
               
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="panel panel-default" style="text-align: center;background-color: lightgreen;">
                  <div class="panel-body" style="padding:5px";><img src="https://images.assetsdelivery.com/compings_v2/ahasoft2000/ahasoft20001511/ahasoft2000151101747.jpg" alt="" class="img-thumbnail" style="text-align: left;width:40px;background-color:transparent;margin-right:10px; "><?php echo date('l'); ?> / <span id="demo"><?php echo date('h:i:s A'); ?></span> </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="panel panel-default" style="text-align: center;background-color: #f9aa66;">
                  <div class="panel-body" style="padding:5px";><img src="https://png.pngitem.com/pimgs/s/80-805441_internal-referrals-icon-referral-png-transparent-png.png" alt="" class="img-thumbnail" style="text-align: left;width:35px;height:35px;background-color:transparent;margin-right:10px; ">Ref. Code  <?php echo isset($user_details['referral_code']) ? $user_details['referral_code'] : ''; ?></div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="row">
              <div class="col-md-3">
              </div>
              <div class="col-md-5">
                <a href="<?php echo site_url('home/my_exam'); ?>">
                  <div class="panel panel-default rounded-circle" style="text-align: center; border-color: white; height: 181px; border-radius: 200px; ">
                    <div class="panel-body" style="text-align: center; overflow: auto; padding: 25px 0;"> 
                      <img src="http://checklive.in/assets/backend/images/Start.jpg"); alt="" class="img-thumbnail" style="text-align: center; border-color: white; height: 125px; width: 150px; margin-left: 4px;  " /> 
                    </div>
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
                <img src="<?php echo base_url('uploads/user_image/'.$this->session->userdata('user_id').'.jpg'); ?>" alt="" class="img-thumbnail" style="text-align: center; border-color: black; height: 125px; width: 150px; margin-left: 50px;  " />
              </div>
            </div> 
            <div class="row">
              <div class="col-md-12">
                <div class="panel panel-default" style="text-align: center;background-color: #f9f589;">
                  <div class="panel-body" style="padding:5px;">
                      <!--<img src="https://i7.pngguru.com/preview/148/892/848/computer-icons-user-symbol-light-client-icon.jpg" alt="" class="img-thumbnail" style="text-align: left;width:35px;height:35px;background-color:transparent; ">-->
                    <?php echo $admin_details['first_name'].' '.$admin_details['last_name']; ?>
                  </div>
                </div>
              </div>
            </div> 
          </div> 
        </div>

        <div class="row">
          <div class="col-md-9">
            <img src="<?php echo base_url('assets/backend/images/motivate.jpg'); ?>" width="100%" style="height:350px !important" alt="" class="img-thumbnail" />
          </div>
          <div class="col-md-3">
            <div class="row">
              <div class="col-md-12">
                <div class="panel panel-default" style="text-align: center; border-color: black; height: 350px">
                  <div class="panel-body">
                    <h3 style="text-decoration: underline;">My Score</h3>
                    <br>    Quiz-1  : 0/0
                    <br>    Quiz-2  : 0/0
                    <br>    Quiz-3  : 0/0
                    <br>    Quiz-4  : 0/0
                    <br>    Quiz-5  : 0/0
                    <br>    Quiz-6  : 0/0
                    <br>    Quiz-7  : 0/0
                    <br>    Quiz-8  : 0/0
                    <br>    Quiz-9  : 0/0
                     <br/>
                    <br/>
                    <br/>
                    <br/>
                       <br/>
                       <br/>
                       <br/>
                       <br/>
                       <br/>
                  </div>
                </div>
              </div>
            </div> 
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  var myVar = setInterval(myTimer ,1000);
  function myTimer() {
    var d = new Date();
    document.getElementById("demo").innerHTML = d.toLocaleTimeString();
  }
</script>