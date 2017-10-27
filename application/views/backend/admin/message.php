<hr />
<div class="mail-env">

    <!-- Mail Body -->
    <div class="mail-body">

        <!-- message page body -->
        <?php include $message_inner_page_name . '.php'; ?>
    </div>

    <!-- Sidebar -->
    <div class="mail-sidebar" style="min-height: 800px;">

        <!-- compose new email button -->
        <div class="mail-sidebar-row hidden-xs">
            <a href="<?php echo base_url(); ?>admin/message/message_new" class="btn btn-success btn-icon btn-block">
                <?php echo get_phrase('new_message'); ?>
                <i class="entypo-pencil"></i>
            </a>
        </div>

        <!-- message user inbox list -->
        <ul class="mail-menu">

            <?php
            $current_user = $this->session->userdata('login_type') . '-' . $this->session->userdata('login_user_id');

            $this->db->where('sender', $current_user);
            $this->db->or_where('reciever', $current_user);
            $message_threads = $this->db->get('message_thread')->result_array();
            foreach ($message_threads as $row):

                // defining the user to show
                if ($row['sender'] == $current_user)
                    $user_to_show = explode('-', $row['reciever']);
                if ($row['reciever'] == $current_user)
                    $user_to_show = explode('-', $row['sender']);

                $user_to_show_type = $user_to_show[0];
                $user_to_show_id = $user_to_show[1];
                $unread_message_number = $this->crud_model->count_unread_message_of_thread($row['message_thread_code']);
                ?>
                <li class="<?php if (isset($current_message_thread_code) && $current_message_thread_code == $row['message_thread_code']) echo 'active'; ?>">
                    <a href="<?php echo base_url(); ?>admin/message/message_read/<?php echo $row['message_thread_code']; ?>" style="padding:12px;">
                        <i class="entypo-dot"></i>

                        <?php echo $this->db->get_where($user_to_show_type, array($user_to_show_type . '_id' => $user_to_show_id))->row()->name; ?>

                        <span class="badge badge-default pull-right" style="color:#aaa;"><?php echo $user_to_show_type; ?></span>

                        <?php if ($unread_message_number > 0): ?>
                            <span class="badge badge-secondary pull-right">
                                <?php echo $unread_message_number; ?>
                            </span>
                        <?php endif; ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>

    </div>

</div>

<script type="text/javascript">
jQuery(document).ready(function($)
{


    });

    function get_sede_sections(id) {

      $.ajax({
            url: '<?php echo base_url();?>admin/get_parent_section/' + id ,
            success: function(response)
            {
                jQuery('#parent_selector_holder').html(response);
            }
        });

        $.ajax({
              url: '<?php echo base_url();?>admin/get_teacher_section/' + id ,
              success: function(response)
              {
                  jQuery('#teacher_selector_holder').html(response);
              }
          });

          $.ajax({
                url: '<?php echo base_url();?>admin/get_student_section_message/' + id ,
                success: function(response)
                {
                    jQuery('#student_selector_holder').html(response);
                }
            });

      }


</script>
