  <!-- Start Breadcrumb 
    ============================================= -->
    <div class="breadcrumb-area bg-primary text-center shadow dark text-light bg-cover" >
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <h1><?php echo 'Your Total Marks is '. (isset($result[0]['total_marks']) ? $result[0]['total_marks'] : 0); ?></h1>
                    <ul class="breadcrumb">
                        <li><a href="#"><?php echo 'Please check detail analysis of your Exam '?>.</a></li>
                        <!-- <li class="active">Blog Single</li> -->
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumb -->


    
      <div class="faq-area default-padding">
        <div class="container">
            <div class="bd-callout bd-callout-info">
<h4 id="dealing-with-specificity">**Notes</h4>
<div class="alert  bg-success text-light" role="alert">
  Mcq's selected With Green is Correct Ans!
</div>
<div class="alert bg-danger text-light" role="alert">
 Mcq's selected With Red is Wrong Ans!
</div>
<div class="alert bg-secondary text-light" role="alert">
  Mcq's selected With Grey is Correct Ans & (Not Attempt)!
</div>

<!-- <p>Sometimes contextual classes cannot be applied due to the specificity of another selector. In some cases, a sufficient workaround is to wrap your element’s content in a <code class="highlighter-rouge">&lt;div&gt;</code> with the class.</p> -->
</div>
            <div class="faq-items">
                <div class="row align-center">

                    <div class="col-lg-12">
                        <div class="faq-content wow fadeInUp">
                            <div class="accordion" id="accordionExample">
                                
                                      
                            <?php 
                                $i=0;
                                foreach($result as $res): 
                                    $i++;
                            ?>
                                <div class="card">
                                    <div class="card-header" id="heading_<?php echo $i ;?>">
                                        <h4 class="mb-0 collapsed " data-toggle="collapse" data-target="#collapse_<?php echo $i ;?>" aria-expanded="false" aria-controls="collapseThree">
                                          Question No. <?php echo $i ;?>
                                      </h4>
                                    </div>
                                    <div id="collapse_<?php echo $i ;?>" class= "collapse" aria-labelledby="heading_<?php echo $i ;?>" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <p>
                                              <?php echo html_entity_decode($res['question']); ?>  
                                            </p>

                                             <?php
                                            $options = json_decode($res['options']);
                                            $j=0;
                                            foreach($options as $option):
                                                $j++;
                                                $class = '';
                                            if($res['given_ans'] ==$j && $res['given_ans'] != $res['correct_ans']):
                                                $class = 'bg-danger text-light' ;
                                            elseif($res['correct_ans']==$j && $res['given_ans']==0):
                                                $class = 'bg-secondary text-light';
                                            elseif($res['correct_ans']==$j):
                                                $class = 'bg-success text-light';
                                            elseif($res['given_ans']!=0):
                                                $class = 'bg-light';
                                            endif;

                                        ?>
                                           
                                            <div class="p-3 mb-2 <?php  echo $class; ?>"><?php echo html_entity_decode($option); ?></div>

                                           <?php endforeach; ?>
                                            <div class="explaination ask-question mt-3">
                                               
                                       
                                        <span type="button" class="badge badge-pill badge-warning p-2"  data-toggle="collapse" data-target="#coll_<?php echo $i ;?>" aria-expanded="false" aria-controls="collapseExample">Explanation</span>
 <?php if(isset($res['subject_id'])) { ?>
                                        <span type="button" onclick="doc('<?php echo $res['subject_id']; ?>')" class="badge badge-pill badge-info p-2">Check Study Materials</span>
                                     <?php } ?>      
                                    </div>

                                            <div class="collapse mt-3" id="coll_<?php echo $i ;?>">
  <div class="card card-body">
    <?php echo html_entity_decode($res['explanation']); ?>
 
  </div>
</div>
                                            
                                        </div>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>


<script type="text/javascript">
$(".Explaination").click(function(){
  $(this).next("div").slideToggle();
});
</script>