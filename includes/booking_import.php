<?php
    global $wpdb;


    if(isset($_POST["um_approveID"]) && $_POST["um_approveID"])
    {
        $curentID = $_POST["um_approveID"];
        $approved = $_POST["um_approve"]; 
        if($approved == 1)
        {
            $wpdb->get_results('update um_booking set approved = 0 where id ='.$curentID.';');
        }
        else
        {
             $wpdb->get_results('update um_booking set approved = 1 where id ='.$curentID.';');
        }
    }
    if(isset($_POST["um_SendEmail"]) && $_POST["um_SendEmail"])
    {
        $to = $_POST["um_SendEmail"];
        $curentID = $_POST["um_EmailID"];
        $message = '';
        $subject = get_field('message_subject','options');
        if($curentID = 1)
        {
            $message = get_field('approved_booking_email_message','options');
        }
        else
        {
            $message = get_field('unapproved_booking_email_message','options');   
        }
        wp_mail( $to, $subject, $message);
        echo '<h2>An email was sent to "'.$to.'"</h2>';
        
    }
    if(isset($_POST["um_Delete"]) && $_POST["um_Delete"])
    {
        $curentID = $_POST["um_Delete"];
        $wpdb->get_results('delete from um_booking where id ='.$curentID.';');

    }
       

    $myRows = $wpdb->get_results
    (
        "select ".$wpdb->prefix."posts.post_title,um_booking.id ,um_booking.fields, um_booking.Email,um_booking.extra_message ,um_booking.approved
        from ".$wpdb->prefix."posts, um_booking 
        where ".$wpdb->prefix."posts.ID = um_booking.booking_post_id"
    );

    ?>
<h2>There are <?php echo ContUnapprved(); ?> unapproved bookings</h2>

<table class="widefat bookingTable">
    <thead>
        <tr>
            <h2>Booking information</h2>
        </tr>
        <tr>
            <th>ID</th>
            <th>Basic Information</th>
            <th>Personal Information</th>
        </tr>
    </thead>
    <tbody>

<?php foreach($myRows as $row):?>
        <tr <?php if($row->approved == 0)echo 'class="unApprovedBook"';?>>
            <td>
                
             <b><?php echo $row->id;?></b>   
                    
            </td>
            <td>
                <b>Tour  -  </b>
                <b><?php echo $row->post_title;?></b><br>
                <b>Email  -  </b>
				<?php $email = sanitize_email($row->Email);?>
                <?php  echo $email;?>
                <?php
                    if($row->approved == 1) echo '<br><b>Approved</b>';
                    else echo '<p class="unappruvedLable">Unapproved</p>';
                ?>
                  
                        <div class="row-actions">
                                 
                                <form method="post">
                                    <input type="hidden" name="um_approve" value="<?php echo $row->approved;?>" >
                                    <input type="hidden" name="um_approveID" value="<?php echo $row->id;?>" >
                                    <a href="" onclick="jQuery(this).closest('form').submit(); return false;">
                                    <?php if($row->approved == 1)echo 'Unapprove'; else echo 'Approve';?></a>
                                </form>
                                <form method="post">
                                    <input type="hidden" name="um_SendEmail" value="<?php echo $row->Email;?>" >
                                    <input type="hidden" name="um_EmailID" value="<?php echo $row->id;?>" >
                                    <a href="" onclick="jQuery(this).closest('form').submit(); return false;">Send e-mail</a>
                                </form>
                                <form method="post">
                                    <input type="hidden" name="um_Delete" value="<?php echo $row->id;?>" >
                                  <a href="" onclick="jQuery(this).closest('form').submit(); return false;">Delete</a>
                                </form>
                        </div>
                  
            </td>
           <td>
        <?php
        $fields = json_decode($row->fields);
        $fields = objectToArray($fields);
        foreach($fields as $field):
            foreach($field as $key => $value):
        ?>
          <div class="bookingfields">
                <?php
                  $keyReplaced = str_replace('um_','',$key);
                  $arr = preg_split('/(?=[A-Z])/',$keyReplaced);
                ?>
                    <?php foreach($arr as $word):?>
                        <b><?php echo sanitize_text_field($word); ?></b>
                        <?php endforeach;?>      
                 <?php echo sanitize_text_field($value); ?>
            </div>
               <?php
            endforeach;
        endforeach;?>
        <?php if ( !($row->extra_message == '')):?>
               <div class="adminExtraMessage">
                   <b>Extra Message </b>
                   <p><?php echo sanitize_text_field($row->extra_message); ?></p>
                </div>
               <?php endif;?>
         </td>
        </tr>
        <?php endforeach;?>
</tbody>
</table>
