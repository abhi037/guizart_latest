<section class="page-header-area">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <nav>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                                <li class="breadcrumb-item"><a href="#">Purchase History</a></li>
                            </ol>
                        </nav>
                        <h1 class="page-title">Purchase History</h1>
                    </div>
                </div>
            </div>
        </section>


        <section class="purchase-history-list-area">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <ul class="purchase-history-list">
                            <li class="purchase-history-list-header">
                                <div class="row">
                                    <div class="col-sm-6"><h4 class="purchase-history-list-title"> <?php echo get_phrase('purchase_history'); ?> </h4></div>
                                    <div class="col-sm-6 hidden-xxs hidden-xs">
                                        <div class="row">
                                            <div class="col-sm-3"> <?php echo get_phrase('date'); ?> </div>
                                            <div class="col-sm-3"> <?php echo get_phrase('total_price'); ?> </div>
                                            <div class="col-sm-4"> <?php echo get_phrase('payment_type'); ?> </div>
                                            <div class="col-sm-2"> </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <?php if ($purchase_history->num_rows() > 0):
                                foreach($purchase_history->result_array() as $each_purchase):?>
                                    <li>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="purchase-history-course-img">
                                                    <?php if($each_purchase['image_name'] != ''): ?>
                                                        <img src="<?php echo base_url().'uploads/subcategory/'.$each_purchase['image_name']; ?>" alt="" class="img-fluid">
                                                    <?php else: ?>
                                                        <img src="<?php echo base_url().'uploads/subcategory/quiz.jpg'; ?>" alt="" class="img-fluid">
                                                    <?php endif; ?>
                                                </div>
                                                    <?php
                                                        echo $each_purchase['name'];
                                                    ?>
                                            </div>
                                            <div class="col-sm-6 purchase-history-detail">
                                                <div class="row">
                                                    <div class="col-sm-3 date">
                                                        <?php echo date('D, d-M-Y', $each_purchase['date_added']); ?>
                                                    </div>
                                                    <div class="col-sm-3 price"><b>
                                                        <?php echo currency($each_purchase['amount']); ?>
                                                    </b></div>
                                                    <div class="col-sm-4 payment-type">
                                                        <?php echo ucfirst($each_purchase['payment_type']); ?>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <!-- <a href="" class="btn btn-receipt">Receipt</a> -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <li>
                                    <div class="row" style="text-align: center;">
                                        <?php echo get_phrase('no_records_found'); ?>
                                    </div>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
        <nav>
            <?php echo $this->pagination->create_links(); ?>
        </nav>
