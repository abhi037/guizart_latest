<ol class="breadcrumb bc-3">
    <li>
        <a href="<?php echo site_url('admin/dashboard'); ?>">
            <i class="entypo-folder"></i>
            <?php echo get_phrase('dashboard'); ?>
        </a>
    </li>
    <li><a href="#" class="active"><?php echo get_phrase('admin_revenue'); ?></a> </li>
</ol>
<h2><i class="fa fa-arrow-circle-o-right"></i> <?php echo $page_title; ?></h2>
<br />

<div class="panel panel-primary">
    <div class="panel-body">
        <table class="table" id="myTable">
            <thead>
                <tr>
                    <th>Course Name</th>
                    <th>Student Name</th>
                    <th>Student Email</th>
                    <th>Amount Paid</th>
                    <th>Coupon<br> (If Any)</th>
                    <th>Enroll Date</th>
                    <th>Validity Date</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($record as $key){
                    echo '<tr>
                            <td>'.$key->name.'</td>
                            <td>'.$key->first_name.' '.$key->last_name.'</td>
                            <td>'.$key->email.'</td>
                            <td>'.$key->amount.'</td>
                            <td>'.$key->coupon_code.'</td>';
                            if(isset($key->date_added))
                            {
                               echo  '<td>'.date('d M Y',strtotime($key->date_added)).'</td>';
                            }
                            else
                            {
                                echo '<td></td>';
                            }
                            if(isset($key->end_date))
                            {
                               echo  '<td>'.date('d M Y',strtotime($key->end_date)).'</td>';
                            }
                            else
                            {
                                echo '<td></td>';
                            }
                            
                echo    '</tr>';
                
                } ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    $(document).ready(function(){
        $('#myTable').DataTable({
            dom: 'Bfrtip',
            buttons: [
                 'excel'
            ]
        }); 
    });
</script>