<style>
    .tile-red,.tile-green,.tile-aqua{
        background:#2B3A4A !important;
    }

</style>

<ol class="breadcrumb bc-3">
    <li class = "active">
        <a href="#">
            <i class="entypo-folder"></i>
            <?php echo get_phrase('dashboard'); ?>
        </a>
    </li>
</ol>
<h2><i class="fa fa-arrow-circle-o-right"></i> <?php echo $page_title; ?></h2>
<br />

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary" data-collapsed="0">
            <div class="panel-heading">
                <div class="panel-title">
                    <?php echo get_phrase('admin_dashboard'); ?>
                </div>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-4">

                        <div class="tile-stats tile-red">
                            <div class="icon"><i class="entypo-user"></i></div>

                            <h3><?php echo get_phrase('new_enrollment_this_week');?></h3>
                            <?php foreach($new_enroll as $course): ?>
                                <div class="tile-stats grid-number">
                                    <h5><?php echo get_phrase($course['name']);?>&nbsp;&nbsp;:&nbsp;&nbsp;</h5>
                                    <div class="num subnum"><?php if(isset($course['users'])) echo $course['users']; else echo 0; ?></div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <div class="col-md-4">

                        <div class="tile-stats tile-green">
                            <div class="icon"><i class="entypo-user"></i></div>

                            <h3><?php echo get_phrase('attempted_quizzes_last_day');?></h3>
                            <?php foreach($attempted as $course): ?>
                                <div class="tile-stats grid-number">
                                    <h5><?php echo get_phrase($course['name']);?>&nbsp;&nbsp;:&nbsp;&nbsp;</h5>
                                    <div class="num subnum"><?php if(isset($course['users'])) echo $course['users']; else echo 0; ?></div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <div class="col-md-4">

                        <div class="tile-stats tile-aqua">
                            <div class="icon"><i class="entypo-user"></i></div>

                            <h3><?php echo get_phrase('total_enrollment');?></h3>
                            <?php foreach($course_wise as $course): ?>
                                <div class="tile-stats grid-number">
                                    <h5><?php echo get_phrase($course['name']);?>&nbsp;&nbsp;:&nbsp;&nbsp;</h5>
                                    <div class="num subnum"><?php echo $course['users']; ?></div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
