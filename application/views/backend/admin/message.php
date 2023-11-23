<hr />
<div class="mail-env">

    <!-- Mail Body -->
    <div class="mail-body">

        <!-- message page body -->
        <?php include $message_inner_page_name.'.php'; ?>
    </div>

    <!-- Sidebar -->
    <div class="mail-sidebar" style="min-height: 800px;">

        <!-- compose new email button -->
        <div class="mail-sidebar-row hidden-xs">
            <a href="<?php echo site_url('admin/message/message_new'); ?>" class="btn btn-success btn-block">
                <i class="fa fa-pencil"></i>&nbsp;
                <?php echo get_phrase('new_message'); ?>
            </a>
        </div>

        <!-- message user inbox list -->
        <ul class="mail-menu">

            <?php
            $current_user = $this->session->userdata('user_id');
            $this->db->where('sender', $current_user);
            $this->db->or_where('reciever', $current_user);
            $message_threads = $this->db->get('message_thread')->result_array();
            foreach ($message_threads as $row):

                // defining the user to show
                if ($row['sender'] == $current_user)
                    $user_to_show_id = $row['reciever'];
                if ($row['reciever'] == $current_user)
                    $user_to_show_id = $row['sender'];

                $unread_message_number = $this->crud_model->count_unread_message_of_thread($row['message_thread_code']);
                ?>
                            <li class="nav-item">
                            <a class="text-left mb-1 btn btn-light d-block <?php if (isset($current_message_thread_code) && $current_message_thread_code == $row['message_thread_code'])echo 'active';?>" href="<?php echo site_url('admin/message/message_read/' . $row['message_thread_code']);?>">

                                <?php
                                    $user_details = $this->db->get_where('users' , array('id' => $user_to_show_id))->row_array();
                                    echo $user_details['first_name'].' '.$user_details['last_name'];
                                ?>
                                <!-- <span class="badge badge-light pull-right" style="color:#aaa;"><?php echo $user_details['role_id'] == 1 ? get_phrase('admin') : get_phrase('student') ;?></span> -->

                                <?php if ($unread_message_number > 0):?>
                                    <span class="badge badge-secondary pull-right">
                                        <?php echo $unread_message_number;?>
                                    </span>
                                <?php endif;?>
                            </a>
                        </li>
            <?php endforeach; ?>
        </ul>

    </div>

</div>
