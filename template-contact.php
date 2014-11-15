<?php
/*
Template Name:Contact
*/
$contacted = FALSE;
$latlang = get_field("google_map");

get_header();

// Get a key from https://www.google.com/recaptcha/admin/create
$publickey = "6Ley2PQSAAAAAE9J8askDZ3n5irIasP1seynGn3W";
$privatekey = "6Ley2PQSAAAAALskwW69F20hwE9Pxxb39CqplOtT";

# the response from reCAPTCHA
$resp = null;
# the error code from reCAPTCHA, if any
$error = null;
$recaptcha_valid = ture;

function ContactError($fieldName)
{
    wp_die(__('Error: please fill the Field "'.$fieldName.'"!','um_lang' ) .
    __('<a onclick="history.go(-1)"><p style="cursor: hand; cursor: pointer;">Back</p></a>'));
}

 if(isset($_POST["um_submitted"]) && $_POST["um_submitted"])
 {
        
        $name = $_POST["um_name"];
        $company = $_POST['um_company_name'];
        $email = $_POST["um_email"];
        $comments = $_POST["um_comment"];
        $phone = '';
        if((isset($_POST["um_phone"]) && $_POST["um_phone"]))
        {
            $phone = $_POST['um_phone'];
        }
        if($phone != '')
        {
          $body = "Name: $name nnEmail: $email nnComments: $comments nnPhone : $phone";
        }
        else
        {
            $body = "Name: $name nnEmail: $email nnComments: $comments";
        }
        if($_POST["recaptcha_response_field"]){

            $resp = recaptcha_check_answer ($privatekey,
                                        $_SERVER["REMOTE_ADDR"],
                                        $_POST["recaptcha_challenge_field"],
                                        $_POST["recaptcha_response_field"]);

            if ($resp->is_valid) {

                    $emailTo = get_option('admin_email');
                    $martin  = "mplante1@mpoeduc.com";
                    $monica = "info@mpoeduc.com";
                    $maoniu ="wanjiangmaoniu@gmail.com";
                    $subject = 'Contact Form Submission from '.$name;
                    $headers = 'From: My Site <'.$emailTo.'>' . "rn" . 'Reply-To: ' . $email;
                    mail($emailTo, $subject, $body, $headers); 
                    mail($martin, $subject, $body, $headers); 
                    mail($monica, $subject, $body, $headers); 
                    mail($maoniu, $subject, $body, $headers); 
                    $contacted = TRUE;
                    $recaptcha_valid = true;
                
                } else {
                        # set the error code so that we can display it
                        $error = $resp->error;
                        $recaptcha_valid = false;

                }

        }

            
    
 }



?>
<script type="text/javascript">
    
     var RecaptchaOptions = {
    theme : 'clean'
 };
</script>
            
<div id="middle" class="cols2">
    <div class="container_12">
    
        <!-- breadcrumbs -->
        <div class="breadcrumbs">
            <p><a href="index.html">Homepage</a> <span class="separator">&gt;</span> <a href="about.html">About us</a> <span class="separator">&gt;</span> <span>Contact us</span></p>
        </div>
        <!--/ breadcrumbs -->
        
        <!-- content -->
        <div class="content">
            
            <!-- post details -->
            <div class="post-detail">
                <h1>Write us a message:</h1>
                                
                <div class="entry">
                    <?php setup_postdata($post);?>
                    <?php the_content();?>
                    <?php wp_reset_postdata();?>
                </div>            
              
                
            </div>
            <!--/ post details -->
            
            <!-- contact form -->
                    <div class="add-comment contact-form">
                            
                            <div class="add-comment-title">
                                <h5><b><?php the_field('contact_form_name');?></b></h5>
                            </div>
                            
                        <div id="um_contactForm" class="comment-form">
                        
                        <?php if(!$contacted):?>
                            <form action="#" method="post" id="commentForm" class="ajax_form">
                                <input type="hidden" name="um_submitted" value="true" />
                                <div class="row alignleft">
                                    <label><strong><?php _e('Name:','um_lang');?></b></strong>(required)</label>
                                    <input name="um_name" type="text" id="um_contactName" value="" class="inputtext input_middle required">
                                </div>
                                <div class="space"></div>
                                <div class="row alignleft">
                                    <label><strong><?php _e('Company/School/Organization:','um_lang');?></b></strong>(required)</label>
                                    <input name="um_company_name" type="text" id="um_company_name" value="" class="inputtext input_middle required">
                                </div>
                                <div class="clear"></div>
                                <div class="row  alignleft">
                                    <label><strong><?php _e('E-mail:','um_lang');?></strong> (required)</label>
                                    <input type="email" name ="um_email" id="um_contactEmail" value="" class="inputtext input_middle required">
                                </div>
                                <div class="space"></div>
                                <div class="row alignleft">
                                    <label><strong><?php _e('Phone:','um_lang');?></strong> (required)</label>
                                    <input type="text" name="um_phone" id="um_contactPhone" value="" class="inputtext input_middle required">
                                </div>
                                <div class="clear"></div>


                                 <div class="row">
                                    <label><strong><?php _e('Message:','um_lang')?></strong></label>
                                    <textarea cols="30" rows="10" name="um_comment" id="um_contactComment" class="textarea textarea_middle required"></textarea>
                                </div>
                                <div class="row">
                                    <?php
                                    if(!$recaptcha_valid){
                                        echo "<div>please enter correct answer in the box. </div>";
                                    }

                                    ?>
                                    Please combine the two parts together!
                                    <?php echo recaptcha_get_html($publickey, $error);?>
                                </div>
                                <div class="row rowSubmit">
                                    <input type="button" id="submitContactBtn" value="Send Message" class="btn-submit">
                                    <a onclick="document.getElementById('commentForm').reset();return false" href="#" class="link-reset">Reset all fields</a>
                                </div>
                            </form>
                        <?php else:?>
                        <div >
                            <h3 ><?php _e("Thank You.","um_lang");?></h3>
                            <p><?php _e("Your message has been sent.","um_lang");?></p>
                            <p>:)</p>
                        </div>
                        <?php endif;?>

                        </div>
                    </div>
                <!--/ contact form -->
            
        </div>
        <!--/ content -->
        <?php sidebar();?>
        <div class="clear"></div>        
    </div>
</div>
<!--/ middle -->


<?php
after_content();
?>

<?php get_footer();?>
<script>
    jQuery(document).ready(function ($) {

        /***/
        var myCenter=new google.maps.LatLng(<?php echo $latlang['coordinates']; ?>);

        function initialize()
        {
            var mapProp = {
              center:myCenter,
              zoom:5,
              mapTypeId:google.maps.MapTypeId.ROADMAP
         };

        var map=new google.maps.Map(document.getElementById("googleMap"),mapProp);

        var marker=new google.maps.Marker({
          position:myCenter,
          });

        marker.setMap(map);
        }

        google.maps.event.addDomListener(window, 'load', initialize);
    });
</script>