

  <!-- Start Breadcrumb 
    ============================================= -->
    <div class="breadcrumb-area bg-gray text-center shadow dark text-light bg-cover" style="background-image: url(assets/frontend/img/2440x1578.png);">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 ">
                    <h1><?php echo $page_title; ?></h1>
                    <ul class="breadcrumb">
                        <li><a href="<?php echo base_url(); ?>"><i class="fas fa-home"></i> Home</a></li>
                        <li class="active"><?php echo $page_title; ?></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumb -->

    <!-- Star Faq
    ============================================= -->
    <div class="faq-area default-padding">
        <div class="container">
            <div class="faq-items">
                <div class="row align-center">

                    <div class="col-lg-10 offset-lg-1">
                        <div class="faq-content wow fadeInUp">
                            <div class="accordion" id="accordionExample">
                                  <?php 
                        $counter = 0;
                        foreach($faqs as $faq): 
                            $counter++;
                    ?>
                                <div class="card">
                                    <div class="card-header" id="heading-<?php echo $counter; ?>">
                                        <h4 class="mb-0" data-toggle="collapse" data-target="#collapse-<?php echo $counter; ?>" aria-expanded="true" aria-controls="collapse-<?php echo $counter; ?>">
                                               <?php echo $faq['que']; ?>
                                        </h4>
                                    </div>

                                    <div id="collapse-<?php echo $counter; ?>" class="collapse <?php if($counter==1) echo 'show'; ?>" aria-labelledby="heading-<?php echo $counter; ?>" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <p>
                                               <?php echo html_entity_decode($faq['ans']); ?>
                                            </p>
                                            <div class="ask-question">
                                                <span>Still no luck?</span> <a href="#">Ask a question</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="card">
                                    <div class="card-header" id="headingTwo">
                                        <h4 class="mb-0 collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                              Do you offer free trials?
                                        </h4>
                                    </div>
                                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <p>
                                                Companions shy had solicitude favourable own. Which could saw guest man now heard but. Lasted my coming uneasy marked so should. Gravity letters it amongst herself dearest an windows by. Wooded ladies she basket season age her uneasy saw. Discourse unwilling am no described dejection incommode no listening of. Before nature his parish boy. 
                                            </p>
                                            <div class="ask-question">
                                                <span>Still no luck?</span> <a href="#">Ask a question</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header" id="headingThree">
                                        <h4 class="mb-0 collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                          What kind of support do you offer?
                                      </h4>
                                    </div>
                                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <p>
                                                Companions shy had solicitude favourable own. Which could saw guest man now heard but. Lasted my coming uneasy marked so should. Gravity letters it amongst herself dearest an windows by. Wooded ladies she basket season age her uneasy saw. Discourse unwilling am no described dejection incommode no listening of. Before nature his parish boy. 
                                            </p>
                                            <div class="ask-question">
                                                <span>Still no luck?</span> <a href="#">Ask a question</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header" id="headingFour">
                                        <h4 class="mb-0 collapsed" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                          Can I share my courses with non-registered users?
                                      </h4>
                                    </div>
                                    <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <p>
                                                Companions shy had solicitude favourable own. Which could saw guest man now heard but. Lasted my coming uneasy marked so should. Gravity letters it amongst herself dearest an windows by. Wooded ladies she basket season age her uneasy saw. Discourse unwilling am no described dejection incommode no listening of. Before nature his parish boy. 
                                            </p>
                                            <div class="ask-question">
                                                <span>Still no luck?</span> <a href="#">Ask a question</a>
                                            </div>
                                        </div>
                                    </div>
                                </div> -->
                                  <?php endforeach; ?>
                    </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
    <!-- End Faq -->


