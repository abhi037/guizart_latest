
<section class="">
    <div class="">
        <div class="row">
            <div class="col">
                <div class="">
                    <div id="bs4-slide-carousel" class="carousel slide" data-ride="carousel" >
 
                        <ol class="carousel-indicators">
                            <?php
                                for($i=0; $i<count($sliders); $i++):
                            ?>
                        
                            <li data-target="#bs4-slide-carousel" data-slide-to="<?php echo $i; ?>" class="<?php if($i==0) echo 'active'; ?>">

                            <?php
                                endfor;
                            ?>
                        
                        </ol>
                        
                        <div class="carousel-inner" style="width: 100%;height:100% !important;">

                        <?php
                            $i=-1;
                            foreach($sliders as $slider):
                                $i++;
                        ?>
                        
                            <div class="carousel-item <?php if($i==0) echo 'active'; ?>">
                        
                            <img class="d-inline w-100" src="<?php echo base_url().'uploads/pages/slider/'.$slider['image_name']; ?>" alt="">
                        
                            <!--Captions for the slides go here -->
                        <?php /* ?>
                                <div class="carousel-caption text-success d-none d-sm-block">
                        
                                <h5>The demo of using text in Slider</h5>
                        
                                <p class="text-light">Another caption line goes here
                        
                                <button class="btn btn-outline-primary btn-lg">More info</button>
                        
                                </p>
                        
                                </div>
                      <?php */ ?>
                         <div class="carousel-caption d-none d-sm-block">

                                <?php if($slider['htext']!=''): ?>
                        
                                    <h1><?php echo $slider['htext']; ?></h1>

                                <?php endif;
                                    if($slider['ptext']!=''):
                                ?>
                        
                                <p class="text-light"><?php // echo $slider['ptext']; ?>
                        
                                <a href="<?php echo $slider['blink']; ?>"><button class="btn btn-dark btn-lg"><?php  echo $slider['ptext']; ?></button></a>
                        
                                </p>
                                <?php endif; ?>

                        
                                </div>

                            <!--Captions ending here for slide 1--> 
                        
                        </div>
                        <?php
                            endforeach;
                        ?>
                        
                        
                        
                        </div>
                        
                        <a class="carousel-control-prev" href="#bs4-slide-carousel" role="button" data-slide="prev">
                        
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        
                            <span class="sr-only">Previous</span>
                        
                        </a>
                        
                        <a class="carousel-control-next" href="#bs4-slide-carousel" role="button" data-slide="next">
                        
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        
                            <span class="sr-only">Next</span>
                        
                        </a> 
                        
                        </div>
 
                </div>
            </div>
        </div>
    </div>
</section>

<section class="my-courses-area">
    <div class="container">
        <?php echo html_entity_decode(urldecode($data['content'])); ?>
    </div>
</section>
<?php if($page_title == "Contact Us"): ?>
<!-- Start Contact Area -->
        <section class="contact-area ptb-100">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-12">
                        <div class="contact-box">
                            <div class="icon">
                                <i class="icofont-phone"></i>
                            </div>
                            
                            <div class="content">
                                <h4>Phone / Fax</h4>
                                <p>(+91) 8218895206</p>
                                <br><br>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-lg-4 col-md-12">
                        <div class="contact-box">
                            <div class="icon">
                                <i class="icofont-envelope"></i>
                            </div>
                            
                            <div class="content">
                                <h4>E-mail</h4>
                                <p>info@quizart.co.in</p> <br><br>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-lg-4 col-md-12">
                        <div class="contact-box">
                            <div class="icon">
                                <i class="icofont-google-map"></i>
                            </div>
                            
                            <div class="content">
                                <h4>Location</h4>
                                <p>7/501, Malhar deluxe sahara grace, <span>Jankipuram, Lucknow (UP). PIN - 226021</span></p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-lg-12 col-md-12">
                        <!-- Map Area -->
                        <div id="googleMap"></div>
                        <!-- End Map Area -->
                    </div>
                    
                    <div class="col-lg-4 col-md-12">
                        <div class="leave-your-message">
                            <h3>Leave Your Message</h3>
                            <p>If you have any questions about the services we provide simply use the form. We try and respond to all queries and comments within 24 hours.</p>
                            
                            <div class="stay-connected">
                                <h3>Stay Connected</h3>
                                <ul>
                                    <li>
                                        <a href="https://facebook.com/QuizartAteam" target="_blank">
                                            <i class="icofont-facebook"></i>
                                            
                                            <span>Facebook</span>
                                        </a>
                                    </li>
                                    
                                    <li>
                                        <a href="https://twitter.com/QuizartATeam" target="_blank">
                                            <i class="icofont-twitter"></i>
                                            
                                            <span>Twitter</span>
                                        </a>
                                    </li>
                                    
                                    <li>
                                        <a href="https://www.instagram.com/quizart_team" target="_blank">
                                            <i class="icofont-instagram"></i>
                                            
                                            <span>Instagram</span>
                                        </a>
                                    </li>
                                    
                                    <li>
                                        <a href="https://vimeo.com/quizart" target="_blank">
                                            <i class="icofont-vimeo"></i>
                                            
                                            <span>Vimeo</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-lg-8 col-md-12">
                        <form id="contactForm" action="<?php echo site_url('home/contact_us_form'); ?>" method="post">
                            <div class="row">
                                <div class="col-lg-6 col-md-6">
                                    <div class="form-group">
                                        <label for="name">Name*</label>
                                        <input type="text" class="form-control" name="name" id="name" required data-error="Please enter your name">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                
                                <div class="col-lg-6 col-md-6">
                                    <div class="form-group">
                                        <label for="email">Email*</label>
                                        <input type="email" class="form-control" name="email" id="email" required data-error="Please enter your email">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                
                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <label for="number">Phone Number*</label>
                                        <input type="text" class="form-control" name="number" id="number" required data-error="Please enter your number">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                
                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <label for="message">Message*</label>
                                        <textarea name="message" class="form-control" id="message" cols="30" rows="4" required data-error="Write your message"></textarea>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                
                                <div class="col-lg-12 col-md-12">
                                    <button type="submit" class="btn btn-primary">Send Message</button>
                                    <div id="msgSubmit" class="h3 text-center hidden"></div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Contact Area -->

        <?php endif; ?>
