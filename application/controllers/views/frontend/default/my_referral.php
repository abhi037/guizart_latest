<section class="page-header-area">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <nav>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                                <li class="breadcrumb-item"><a href="#">My Referrals</a></li>
                            </ol>
                        </nav>
                        <h1 class="page-title">My Referrals</h1>
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
                                    <div class="col-sm-12 hidden-xxs hidden-xs">
                                        <div class="row">
                                            <div class="col-sm-3"> <?php echo get_phrase('date'); ?> </div>
                                            <div class="col-sm-3"> <?php echo get_phrase('name'); ?> </div>
                                            <div class="col-sm-2"> <?php echo get_phrase('amount'); ?> </div>
                                            <div class="col-sm-2"><?php echo get_phrase('enroll_status'); ?></div>
                                            <div class="col-sm-2"><?php echo get_phrase('payment_status'); ?></div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <?php if ($total_rows > 0):
                                foreach($referrals as $referral):?>
                                    <li>
                                        <div class="row">
                                            <div class="col-sm-3"><?php  echo date('D, d-M-Y', strtotime($referral['created_at'])); ?></div>
                                            <div class="col-sm-3"><?php  echo $referral['first_name'].' '.$referral['last_name']; ?></div>
                                            <div class="col-sm-2"><?php  echo $referral['amount']; ?></div>
                                            <div class="col-sm-2"><?php  if($referral['enroll_status']==0) echo 'Not Enrolled'; else echo 'Enrolled'; ?></div>
                                            <div class="col-sm-2"><?php  if($referral['payment_status']==0) echo 'Pending'; else echo 'Complete'; ?></div>
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
