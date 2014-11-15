<?php

   add_action( 'after_setup_theme', 'createBookingTable' );
   add_action( 'admin_menu', 'addBooking' );
   add_action( 'admin_print_styles', 'load_custom_admin_css' );
   add_action('admin_print_scripts', 'add_my_scripts');

function addBooking() 
{
    add_menu_page('Booking', 'Booking', 'manage_options', 'se-all-bookings', 'booking_page' );
}

function add_my_scripts()
{
    wp_enqueue_script("adminJS", get_template_directory_uri()."/includes/adminJS.js" ,array());
}

function load_custom_admin_css()
{
    wp_enqueue_style("BookingCss", get_template_directory_uri()."/includes/bookingStyle.css" , false, "1.0");
}

function booking_page()
{
    include 'booking_import.php';     
}

function ContUnapprved() 
{
    global $wpdb;
    $newitem =  $wpdb->get_results( "SELECT COUNT(*) FROM um_booking WHERE approved = 0");
    $newitem = objectToArray($newitem);
    return $newitem[0]['COUNT(*)'];
     
}
function createBookingTable()
{
    global $wpdb;
    $table_name = 'um_booking';   
    if($wpdb->get_var("show tables like '".$table_name."'" ) != $table_name) 
    {
       $sql = "CREATE TABLE $table_name (
              id bigint(20) NOT NULL AUTO_INCREMENT,
              booking_post_id bigint(20) NOT NULL,
              Email varchar(60),
              fields longtext NOT NULL,
              extra_message longtext,
              approved tinyint(1),
              UNIQUE KEY id (id)
            );";

            require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
            dbDelta( $sql );
    }
}

function validate_insert()
{
    $tourPostID='';
    $email = '';
    $extra_message ='';
    $tourPostID = $_POST['um_tourPostID'];
    $allFields = array();

	if(empty($_POST['um_checkTerms']))
    {
        wp_die(__('Error: please accept the "Terms and Condicions"!','um_lang' ) . __('<a onclick="history.go(-1)"><p style="cursor: hand; cursor: pointer;">Back</p></a>'));
    }

    if(empty($_POST['um_Email']))
   {
		if(is_email($_POST['um_Email'])) 
		{
			wp_die(__('Error: please add your Email!','um_lang' ) . __('<a onclick="history.go(-1)"><p style="cursor: hand; cursor: pointer;">Back</p></a>'));
		}
   }
   else
   {
       $email = $_POST['um_Email'];
   }
  

   $MfieldNames = $_POST['um_MendatoryFieldNames'];
    foreach( $MfieldNames as $key => $value )
    {
        if(empty($_POST[$value]))
        {
            wp_die(__('Error: please fill the required fields! ','um_lang'). __('<a onclick="history.go(-1)"><p style="cursor: hand; cursor: pointer;">Back</p></a>'));
        }
        else
        {
            array_push($allFields,array($MfieldNames[$key] => strip_tags(esc_html($_POST[$value]))));
        }
    }
           
    $OfieldNames = $_POST['um_OtherFieldNames'];
    if($OfieldNames)
    {
        foreach( $OfieldNames as $key => $value )
        {
            array_push($allFields,array($OfieldNames[$key] => strip_tags(esc_html($_POST[$value]))));
        }
    }
    if(!empty($_POST['um_ExtraMessage']))
    {
        $extra_message = strip_tags(esc_html($_POST['um_ExtraMessage']));
    } 
        global $wpdb;
        $table_name = 'um_booking';  
        $jsonEncoded = json_encode($allFields);
        $data = array(
                        'booking_post_id' => $tourPostID,
                        'Email' => $email,
                        'fields' => $jsonEncoded,
                        'extra_message'=> $extra_message,
                        'approved' =>0
                    ); 
               
            $wpdb->insert($table_name, $data);
			
			
			if(get_field('enable_email_notification','options'));
			{
				$queried_post = get_post($tourPostID);
				$title = $queried_post->post_title;

				$subject = 'Booking Form Submission';
				$body = "<table><tr><td>A new booking has been made on " .$title . "</td><td> by\n ";
				
				foreach($allFields as $f)
				{
					foreach($f as $key => $value)
					{
							$body  .=  $key. ":  ". $value."\n";	
					}
				}
        $body.="</td></tr>";
				$body =	str_replace('um_',' ',$body);
        if(isset($_POST['children'])&&!empty($_POST['children'])){
          $body.="<tr><td>Children</td><td>".$_POST['children']."</td></tr>";
        }
        if(isset($_POST['adult'])&&!empty($_POST['adult'])){
          $body.="<tr><td>Children</td><td>".$_POST['adult']."</td></tr>";
        }
        if(isset($_POST['langue'])&&!empty($_POST['language'])){
          $body.="<tr><td>Children</td><td>".$_POST['languge']."</td></tr>";
        }
        if(isset($_POST['insurance'])&&!empty($_POST['insurance'])){
          $body.="<tr><td>Children</td><td>".$_POST['insurance']."</td></tr>";
        }
        if(isset($_POST['air'])&&!empty($_POST['air'])){
          $body.="<tr><td>Children</td><td>".$_POST['air']."</td></tr>";
        }
				$body .= '<tr><td>Extra Message:</td><td> '.$extra_message."</td></tr></table>"; 
				
				if(get_field('email_address','options')){
				$emailTo = get_field('email_address','options');
				}
				else{
				$emailTo = get_option('admin_email');
				}
				
				wp_mail($emailTo, $subject, $body); 
			}
           ?>
<script>
    var booked = true;
</script>
        
            <?php
         }

 function objectToArray($d) {
		if (is_object($d)) {
			$d = get_object_vars($d);
		}
 
		if (is_array($d)) {
			return array_map(__FUNCTION__, $d);
		}
		else {
			return $d;
		}
	}
?>
