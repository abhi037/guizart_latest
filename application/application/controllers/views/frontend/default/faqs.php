<section class="page-header-area">
    <div class="container">
        <div class="row">
            <div class="col">
                <h1 class="page-title"><?php echo $page_title; ?></h1>
            </div>
        </div>
    </div>
</section>

<section class="my-courses-area">
    <div class="container">
    <div class="row">
        <div class="col-md-12">
                    <div class="accordion" id="accordion-tab-1">
                    <?php 
                        $counter = 0;
                        foreach($faqs as $faq): 
                            $counter++;
                    ?>
                        <div class="card">
                            <div class="card-header" id="accordion-tab-<?php echo $counter; ?>-heading-<?php echo $counter; ?>">
                                    <a data-toggle="collapse" data-target="#accordion-tab-<?php echo $counter; ?>-content-<?php echo $counter; ?>" aria-expanded="false" aria-controls="accordion-tab-<?php echo $counter; ?>-content-<?php echo $counter; ?>"><?php echo $faq['que']; ?></a>
                            </div>
                            <div class="collapse <?php if($counter==1) echo 'show'; ?>" id="accordion-tab-<?php echo $counter; ?>-content-<?php echo $counter; ?>" aria-labelledby="accordion-tab-<?php echo $counter; ?>-heading-<?php echo $counter; ?>" data-parent="#accordion-tab-<?php echo $counter; ?>">
                                <div class="card-body">
                                    <?php echo html_entity_decode($faq['ans']); ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    </div>
        </div>
    </div>
</div>
</section>


