<section class="user-dashboard-area">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="user-dashboard-box">
                    <div class="user-dashboard-content" style="width: 100%;">
                        <div class="content-title-box">
                            <div class="title"><?php echo 'Your Total Marks is '.$result[0]['total_marks']; ?></div>
                            <div class="subtitle"><?php echo 'Please check detail analysis of your Exam:'; ?>.</div>
                        </div>
                            <div class="content-box-result">
                                <ol>
                            <?php 
                                $i=0;
                                foreach($result as $res): 
                                    $i++;
                            ?>
                                <li class="list-options">
                                        <div class="resQue"><?php echo html_entity_decode($res['question']); ?></div>
                                        <ul>
                                        <?php
                                            $options = json_decode($res['options']);
                                            $j=0;
                                            foreach($options as $option):
                                                $j++;
                                                $class = '';
                                            if($res['given_ans'] ==$j && $res['given_ans'] != $res['correct_ans']):
                                                $class = '<i class="fa fa-window-close cross" aria-hidden="true"></i>';
                                            elseif($res['correct_ans']==$j && $res['given_ans']==0):
                                                $class = '<i class="fa fa-check right" aria-hidden="true"></i> (Not Attempt)';
                                            elseif($res['correct_ans']==$j):
                                                $class = '<i class="fa fa-check right" aria-hidden="true"></i>';
                                            endif;

                                        ?>
                                                <li><div style="display:flex;"><span><?php echo html_entity_decode($option); ?></span><span><?php  echo $class; ?></span></div></li>
                                        <?php endforeach; ?>
                                        </ul>
                                        <div class="explaination"><span class="toggleExplaination"><i class="fa fa-plus" aria-hidden="true"></i>Explaination</span>
                                            <div style="display:none;"><?php echo html_entity_decode($res['explanation']); ?></div>
                                        </div>
                                </li>

                            <?php endforeach; ?>
                                </ol>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script type="text/javascript">
$(".toggleExplaination").click(function(){
  $(this).next("div").slideToggle();
});
</script>