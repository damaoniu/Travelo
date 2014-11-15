<?php

/*
Template Name: customization
*/

//include "includes/quote_mail.php";
//starting email
$quoted = false;

// Get a key from https://www.google.com/recaptcha/admin/create
$publickey = "6Ley2PQSAAAAAE9J8askDZ3n5irIasP1seynGn3W";
$privatekey = "6Ley2PQSAAAAALskwW69F20hwE9Pxxb39CqplOtT";

# the response from reCAPTCHA
$resp = null;
# the error code from reCAPTCHA, if any
$error = null;
$recaptcha_valid = true;
$attempted = false;

//disable for now original quote_submit
if($_POST["recaptcha_response_field"]){
    $resp = recaptcha_check_answer ($privatekey,
                                $_SERVER["REMOTE_ADDR"],
                                $_POST["recaptcha_challenge_field"],
                                $_POST["recaptcha_response_field"]);

    if ($resp->is_valid) {
            $recaptcha_valid = true;
            if(isset($_POST['quote_submit'])){

              $tour_id=$_POST['tour_id'];
              $tour_name = get_the_title($tour_id);
              $tour_link = get_permalink($tour_id);

              $mailTo1=get_option('admin_email');
              $mailTo="info@mpoeduc.com";
              $subject=$_POST['tripName']."-by".$_POST['schoolName'];
              $header="From:".strip_tags($_POST['email'])."\r\n";
              $header.="To:".strip_tags($mailTo)."\r\n";
              $header.="Content-Type: text/html; charset=ISO8859-1\r\n";

              $mailBody="<html><head><style type='text/css' media='all'>table th td {border: 1px solid black;}</style></head></head><body>";
              $mailBody.="<h1>Voila an new quote is here!</h1>";
              $mailBody.="<table rule='all' style='border-color:purple;border: 1px solid black;' cellpadding=10>";
              $mailBody.="<tr style='background-color:#eee;'><td><strong>Tour Name:</strong></td><td>".$tour_name."</td></tr>";
              $mailBody.="<tr style='background-color:#eee;'><td><strong>School Name:</strong></td><td>".strip_tags($_POST['schoolName'])."</td></tr>";
              $mailBody.="<tr style='background-color:#eee;'><td><strong>Contact Name:</strong></td><td>".strip_tags($_POST['contactName'])."</td></tr>";
              $mailBody.="<tr style='background-color:#eee;'><td><strong>Email:</strong></td><td>".strip_tags($_POST['email'])."</td></tr>";
              $mailBody.="<tr style='background-color:#eee;'><td><strong>Phone:</strong></td><td>".strip_tags($_POST['phone'])."</td></tr>";
              $address = strip_tags($_POST['street'])." ".strip_tags($_POST['city'])." ".strip_tags($_POST['province'])." ".strip_tags($_POST['country'])." ".strip_tags($_POST['post']);
              $mailBody.="<tr style='background-color:#eee;'><td><strong>Address:</strong></td><td>".$address."</td></tr>";
              if($_POST['unknown']!=="on"){
              $mailBody.="<tr style='background-color:#eee;'><td><strong>Leaving:</strong>".strip_tags($_POST['from'])."</td><td><strong>Returning:</strong>".strip_tags($_POST['to'])."</td></tr>";
                }
                else{
                    $mailBody.="<tr style='background-color:#eee;'><td>Leaving Date</td><td><strong>TBA</strong</td></tr>";
                }
              $mailBody.="<tr style='background-color:#eee;'><td><strong>Time of Year:</strong></td><td>".strip_tags($_POST['time'])."</td></tr>";
              $mailBody.="<tr style='background-color:#eee;'><td><strong>Number of children:</strong></td><td>".strip_tags($_POST['children'])."</td></tr>";
              $mailBody.="<tr style='background-color:#eee;'><td><strong>Number of Adults:</strong></td><td>".strip_tags($_POST['adult'])."</td></tr>";
              $mailBody.="<tr style='background-color:#eee;'><td><strong>Average Age:</strong></td><td>".strip_tags($_POST['age'])."</td></tr>";
              $mailBody.="<tr style='background-color:#eee;'><td><strong>Grade Level:</strong></td><td>".strip_tags($_POST['grade'])."</td></tr>";
              $mailBody.="<tr style='background-color:#eee;'><td><strong>Best Contact Time:</strong></td><td>".strip_tags($_POST['contact'])."</td></tr>";
              $mailBody.="<tr style='background-color:#eee;'><td><strong>Quote deadline:</strong></td><td>".strip_tags($_POST['by'])."</td></tr>";

              //city and Acitivity...
              $mailBody.="<tr style='background-color:#eee;'><th>City</th><th>Acitivities</th></tr>";
              if(isset($_POST['report']) && !empty($_POST['report'])){
                 $reports=$_POST['report'];
                 $reports=explode(';', $reports);
                 $count=0;
                 foreach ($reports as $report) {
                    ++$count;
                    if($count>0){
                       $report=explode(':', $report);
                       $city=$report[0];
                       $city=explode("_", $city);
                       $city=$city[0];
                       $city=explode("-", $city);
                       $city=implode(" ", $city);
                       $mailBody.="<tr style='background-color:#eee;'><td><strong>".strip_tags($city)."</strong></td><td><table>";
                       $activities=$report[1];
                       $activities=explode(',', $activities);
                       if(!empty($activities)){
                         foreach($activities as $activity) {
                          $mailBody.="<tr><td>".strip_tags($activity)."</td></tr>";
                         }
                       }
                       $mailBody.="</table></td></tr>";
                    }
                  }
              }
              /********
              Transportation and loding
              *********/
              $mailBody.="<tr style='background-color:#eee;'><td><strong>Lodging:</strong></td><td><table><tr><td><b>Hotel</b><td>".strip_tags($_POST['hotel'])."</td></tr><tr><td><b>Student Rooms</b></td><td>".strip_tags($_POST['student_rooms'])."</td></tr><tr><td><b>Adult Rooms</b</td><td>".strip_tags($_POST["adults_rooms"])."</td></tr></table></td></tr>";
              $mailBody.="<tr style='background-color:#eee;'><th>Transportation</th></tr>";
              $mailBody.="<tr style='background-color:#eee;'><td><strong>Air:</strong></td><td>".strip_tags($_POST['air'])."</td></tr>";
              $mailBody.="<tr style='background-color:#eee;'><td><strong>Bus:</strong></td><td>".strip_tags($_POST['bus'])."</td></tr>";
              $mailBody.="<tr style='background-color:#eee;'><td><strong>Other:</strong></td><td>".strip_tags($_POST['otherTrans'])."</td></tr>";
              
              //meals
              $mailBody.="<tr style='background-color:#eee;'><td><strong>Meals:</strong></td><td>";
              $mailBody.="<table>";
              if(isset($_POST["meal"])&&!empty($_POST["meal"])){
                echo "No meal selected";
              }else{
                $mailBody.="<tr><td>BreakFast:".strip_tags($_POST['brkM'])."</td>Number: ".strip_tags($_POST['brk_number'])."</td></tr>";
                $mailBody.="<tr><td>Lunch:".strip_tags($_POST['lunM'])."</td><td>Number: ".strip_tags($_POST['lunch_number'])."</td></tr>";
                $mailBody.="<tr><td>Dinner:".strip_tags($_POST['dinM']);
                 if(isset($_POST['dinT'])){
                  $mailBody.=" ".strip_tags($_POST["dinT"]);
                }
                if(isset($_POST['dinTh'])){
                  $mailBody.=" ".strip_tags($_POST['dinTh']);
                }
                $mailBody.="</td><td>Number: ".strip_tags($_POST['dinner_number'])."</td></tr>";
              }
              $mailBody.="</table></td></tr>";
              
              $mailBody.="<tr style='background-color:#eee;'><td><strong>Tour Guide:</strong></td><td>".strip_tags($_POST['guide'])."</td></tr>";
              $mailBody.="<tr style='background-color:#eee;'><td><strong>Night security:</strong></td><td>".strip_tags($_POST['secure'])."</td></tr>";
              if(isset($_POST['otherLanguage'])&&!empty($_POST['otherLanguage'])){
                $mailBody.="<tr style='background-color:#eee;'><td><strong>Language:</strong></td><td>".strip_tags($_POST['otherLanguage'])."</td></tr>";
              }else{
              $mailBody.="<tr style='background-color:#eee;'><td><strong>Language:</strong></td><td>".strip_tags($_POST['language'])."</td></tr>";
              }
              $mailBody.="<tr style='background-color:#eee;'><td><strong>Insurance:</strong></td><td>".strip_tags($_POST['insurance'])."</td></tr>";
              $mailBody.="</table>";
              $mailBody.="</body></html>";

              //mail the form
              mail($mailTo,$subject,$mailBody,$header);
              mail($mailTo1,$subject,$mailBody,$header);
              mail("mpoeduc@gmail.com",$subject,$mailBody,$header);
              mail("mplante1@mpoeduc.com",$subject,$mailBody,$header);
              mail("wanjiangmaoniu@gmail.com",$subject,$mailBody,$header);
              //$monica=get_userdate("2");
              //echo "sent! <a onclick='history.go(-1)'><p style='cursor: hand; cursor: pointer;'> <-Back </p></a>";
              $quoted=true;
            }
        
        } else {
                # set the error code so that we can display it
                $recaptcha_valid = false;
                $attempted = true;
        }
  }




//end email
   get_header(); 
   global $post;
   setup_postdata( $post );
   
   if(isset($_GET['um_choose'])){
      $tour_id=$_GET['um_choose'];
      //echo $tour_id;
      if(!empty($tour_id)){
       $tour=get_post($tour_id);                       
        } 
     }
    if (isset($_GET['tour_city'])&&!empty($_GET['tour_city'])) {
      $tour_city=$_GET['tour_city'];

      //echo $tour_city;
      $tour_cities = explode(',', $tour_city);
    }else{
        $tour_terms = array();
            $terms = get_the_terms($tour_id,"um_".toAscii('canada'));
          if($terms){
            $tour_countries="canada";
           foreach ($terms as $term) {
             $name=$term->name;
             array_push($tour_terms, $name);
           }
          }
          $terms = get_the_terms($post->ID,"um_".toAscii('usa'));
          if($terms){
            $tour_countries="usa";
           foreach ($terms as $term) {
             $name=$term->name;
             array_push($tour_terms, $name);
           }
          } 
          $terms = get_the_terms($post->ID,"um_".toAscii('europe'));
          if($terms){
            $tour_countries="europe";
           foreach ($terms as $term) {
             $name=$term->name;
             array_push($tour_terms, $name);
           }
          }
          $terms = get_the_terms($post->ID,"um_".toAscii('asia'));
          if($terms){
            $tour_countries="asia";
           foreach ($terms as $term) {
             $name=$term->name;
             array_push($tour_terms, $name);
           }
          }
        $tour_cities=$tour_terms;
    }





    if (isset($_GET['activity_ids'])&&!empty($_GET['activity_ids'])) {
      $activity_ids=$_GET['activity_ids'];
      //echo $activity_ids;
      $activity_ids = explode(',', $activity_ids);
      //print_r($activity_ids);
    }else{
      $activity_ids = array();
        $posts = get_field("activities",$tour_id);
        if($posts){
          foreach ($posts as $post) {
            setup_postdata($post);
            array_push($activity_ids,$post->ID);
            wp_reset_postdata();
          }
        }
    }

?>
<script type="text/javascript"> 
     var RecaptchaOptions = {theme : 'clean'};
</script>
<div id="middle" class="full_width">
    <div class="container_12"> 
    <div class="content"> 
    <?php if($quoted):?>
      <div class="frame_quote" id="booked">
            <blockquote>
              <div class="inner">
                Thank you
                <hr/>
                Your request has been sent to an MPO Educational Travel students groups specialist.

                We'd like to thank you for using our MPO online form to request a quote for your group's upcoming trip. One of our group travel specialists will review your request and e-mail you a quote shortly. We'll also provide you with all of the details you'll need to complete your group booking.

                We hope to welcome you and your students soon on your trip!

                <h3 style="color:#ab59bc;"> Your can request a new quote with the form below!</h3>

              </div>

            </blockquote>

      </div>
    <?php endif;?>


        <?php if($tour_id):?>

          <input type="hidden" name="tour_id" value="<?php echo $tour_id;?>">
          <h1>You Are Customizing This Package >> <span><?php echo get_the_title($tour_id);?></span></h1>
        <?php else:?>
          <h1>Customize Your Tour In Just 3 Steps:</h1>
        <?php endif;?>
        
        <!--iternary-->
        <div id="tab_main" class="tabs_framed">
            <ul class="tabs">
              <li class="current"><a  hidefocus="true" style="outline: none;">1: Your Information >></a></li>
              <li><a  hidefocus="true" style="outline: none;">2: Pick Activities >></a></li>
              <li><a  hidefocus="true" style="outline: none;">3: Pick Transportation & Lodging >></a></li>
              <li><a  hidefocus="true" style="outline: none;">Review & Send</a></li>
            </ul>
            <!--information-->
            <?php information($tour_id,$tour_cities);?>
            <!--/information-->
            <?php if($tour_id):?>
                <!--Destionation-->
                <div id="cutomization" class="tabcontent" style="display: block;">
                  <div class="inner">
                      <!--header-->
                  <div class="row">
                    <!--Activity-->
                    <h5><?php _e('Activities Selected By Cities:','um_lang');?></h5>
                    <div id="tab_activity" class="tabs_framed tf_sidebar_tabs">
                        <ul class="tabs">
                           <?php if(!empty($tour_cities)): 
                            $count=0;
                            foreach ($tour_cities as $city):
                                $e_city = explode(" ", $city);
                                $con_city = implode("-", $e_city);
                          ?>
                           <li <?php if($count==0){echo "class='current'";}?>id="<?php echo strtolower($con_city)."a";?>"><a hidefocus="true" style="outline: none;"><?php echo $city;?></a></li>
                           <?php 
                            $count++;
                           endforeach;
                                endif;
                           ?>
                        </ul>
                        <section class="row">
                            <div id="tab_subjects" class="row topmenu" style="margin-left:0;">
                                <ul >
                                    <li id="show_all">All </li>
                                    <li id="arts">Arts </li>
                                    <li id="culture">Culture </li>
                                    <li id="history">History </li>
                                    <li id="language">Language </li>
                                    <li id="music">Music </li>
                                    <li id="recreation">Recreation </li>
                                    <li id="science">Science </li>
                                    <li id="selected" style="color:#a409ba;">Selected</li>
                                </ul>
                            </div>
                        </section>
                        <?php $post = get_post($tour_id);
                                setup_postdata($post);
                                $countries= array('canada','usa','europe','asia');
                                foreach ($countries as $country):
                                  $terms = get_the_terms($post->ID,"um_".toAscii($country));
                                  if($terms):
                                    // use tour cities to ensure the same order as the tab title
                                    $count=0;
                                    foreach ($tour_cities as $city):
                                      $e_city = explode(" ", $city);
                                      $con_city = implode("-", $e_city);
                                      //echo $term->slug;
                                      ?>
                                    <!-- each tab content-->

                                    <div id="<?php echo strtolower($con_city).'_content';?>" class="tabcontent" <?php if($count>0){echo "style='display: none;'";}?>>
                                      <div class="inner">

                                          <?php
                                           $arg = array (
                                                'post_type' => "activity",
                                                'um_'.toAscii($country) => strtolower($city),
                                                'posts_per_page' => -1
                                              );
                                              //echo $country.$city;
                                            $activities = new WP_Query($arg);
                                            if($activities->have_posts()):?>
                                              <div class="widget-container widget_products" id="activity_grid">
                                                  <div class="inner">
                                                  <script type="text/javascript">
                                                    jQuery("#activity_grid .prod_itemNew").on("mouseover",function(e){
                                                       if(jQuery(this).find('.tooltip').css('display')!='block'){
                                                            jQuery(this).find('.tooltip').fadeIn('slow');
                                                            jQuery(this).css('z-index','1000');
                                                       }
                                                    }).on("mouseleave",function(){
                                                      jQuery(this).find('.tooltip').fadeOut('slow');
                                                      jQuery(this).css('z-index','auto');
                                                    });
                                                    jQuery("#activity_grid .prod_itemNew input").click(function(){
                                                      jQuery(this).closest('.prod_itemNew').find('.tooltip').fadeOut();
                                                    });
                                                  </script>
                                             <?php while ($activities->have_posts()):
                                                 $activities->the_post();
                                                  //the_title();
                                                  if(get_field('link')){
                                                      $link =get_field('link');
                                                  }
                                              ?>
                                              <div class="prod_itemNew" <?php show_subjects($id);?> <?php if(!empty($activity_ids) && !in_array($post->ID, $activity_ids)){ echo "style='display:none;'";}?>?>>
                                                <div class="prod_img">
                                                  <a target="_blank"  href="<?php the_permalink();?>" hidefocus="true" style="outline: none; overflow:hidden;">
                                                    <?php 
                                                      $imag_url = wp_get_attachment_url( get_post_thumbnail_id($post->ID, 'thumbnail') );
                                                      if($imag_url):?>
                                                          <img src="<?php echo $imag_url; ?>">
                                                    <?php else:?>
                                                      <img height="150" width="200" src="http://mpoeduc.com/wp-content/uploads/2013/12/MPO-logo-shadow-2-e1386452789693.png">
                                                    <?php  endif;  ?>
                                                  </a>
                                                  <p class="caption">
                                                    <a target="_blank"  href="<?php the_permalink();?>" hidefocus="true" style="outline:none;">
                                                       <span><input  type="checkbox" name="activity"  <?php if(!empty($activity_ids) && in_array($post->ID, $activity_ids)){ echo "checked='checked'";}?> value="<?php echo $post->post_name;?>"></span><?php the_title();?>
                                                    </a>
                                                  </p>
                                                </div>
                                                
                                                <div style="display:none" class="tooltip">
                                                    <h6><?php the_title();?></h6>
                                                    <p>
                                                      <?php 
                                                        $overview = wp_trim_words(get_the_content(),20,'<a href="'.get_permalink().'">...Read More</a>');
                                                        echo $overview;
                                                      ?>
                                                    </p>
                                                     <p><a target="_blank" href="<?php the_permalink();?>">Read more</a><a target="_blank" href="<?php echo $link;?>">|Activity website</a></p>
                                                </div>
                                              </div>
                                              <?php 
                                               endwhile;
                                               wp_reset_postdata();?>
                                                </div>
                                              </div>
                                            <?php endif;
                                            ?>
                                       </div>
                                    </div>
                                    <!--/each tab content-->
                                  <?php 
                                    $count++;
                                  endforeach;
                               endif;
                             endforeach;
                             ?>
                    </div>
                  
                    <!--/Activity-->
                   </div>
                   <div class="clear"></div>
                    <!--sample packages-->
                    <!--h5>Other similar packages:</h5-->
                    <?php 
                      //similar_products($tour_id);
                    ?>
                    <!--/sample packages-->

                </div><!--/inner-->
            </div>
            <!--/destination-->
              <?php else:
                destination();
              endif;
            ?>
            
            <!--Transportation-->
            <div id="main_3" class="tabcontent"  style="display:none;">
              <div class="inner">

                 <?php 
                  if($tour_id){
                    $meals= get_field("meals",$tour_id);
                    $transportation = get_field("transportation",$tour_id);
                    $hotel = get_field("hotel",$tour_id); 
                    $services = get_field("services",$tour_id);
                    $insurance = get_field("insurance",$tour_id);
                    }
                  ?>
                <div id="serviceToggle" class="row">
                  
                    <div class="col col_1_3  alpha">
                      <div class="inner">
                        <h3 class="toggle box active" >Meal<span class="ico"></span></h3>
                        <h3 class="toggle box ">Transportation<span class="ico"></span></h3>
                        <h3 class="toggle box ">Hotel<span class="ico"></span></h3>
                        <h3 class="toggle box ">Tour Director<span class="ico"></span></h3>
                        <h3 class="toggle box ">Insurance<span class="ico"></span></h3>
                      </div>
                    </div>                  
                    <div class="col col_1_2  omega">
                      <div class="inner">
                      <!-- transportation form-->
                      <form id="transportForm" method="POST" action="#">
                        <div class="pricing_box input_styled" >
                          <!--meal-->
                          <div class="row">
                          <div class="price_col_top" style="background:#a409ba;">Pick Meals</div>
                            <ul>
                              <li>
                                  <input type="checkbox" <?php if($meals[0]['need']==2){echo "checked";} ?> id="noM" name="meal" value="No Meals"/><label for="noM"><strong>No Meals</strong></label>
                              </li>
                              <li id="breakfast"  style="<?php if($meals[0]['need']==2){echo "display:none;";}?>">
                                  <span><input type="checkbox" id="brk" <?php if($meals[0]['breakfast']){echo "checked";}?>  name="meals" value="Breakfirst"/><label for="brk"><strong>Breakfast</strong></label></span>

                                  <div id="brkb" style="<?php if(!$meals[0]['breakfast']){echo 'display:none;';}?>"  >
                                    <input type="radio" id="bst" <?php if($meals[0]['breakfast']==1){echo "checked";}?> name="brkM" value="Continental"/><label for="bst">Continental</label>
                                    <input type="radio" id="bbu" <?php if($meals[0]['breakfast']==2){echo "checked";}?> name="brkM" value="American"/><label for="bbu">American</label>
                                    <input type="radio" id="bbo" <?php if($meals[0]['breakfast']==3){echo "checked";}?> name="brkM" value="Both"/><label for="bbo">Both Continental and American</label>
                                    <label for="brk_number">Number of Breakfast:</label><input type="number" class="inputField" id="brk_number" value="<?php if($meals[0]['breakfast_number']){echo $meals[0]['breakfast_number'];}?>" min="0" name="brk_number"/>
                                  </div>
                              </li >
                              <li id="lunch" style="<?php if($meals[0]['need']==2){echo "display:none;";}?>">
                                  <input type="checkbox" id="lun" <?php if($meals[0]['lunch']){echo "checked";}?> name="meals" value="Lunch"/><label for="lun"><strong>Lunch</strong></label>
                                  <div id="lunb" style="<?php if(!$meals[0]['lunch']){echo 'display:none;';}?>" >
                                    <input type="radio" id="lst" <?php if($meals[0]['lunch']==1){echo "checked";}?> name="lunM" value="Standard"/><label for="lst">Standard</label>
                                    <input type="radio" id="lbu" <?php if($meals[0]['lunch']==2){echo "checked";}?> name="lunM" value="Buffet"/><label for="lbu">Buffet</label>
                                    <input type="radio" id="lbo" <?php if($meals[0]['lunch']==3){echo "checked";}?> name="lunM" value="Both"/><label for="lbo">Both Standard and Buffet</label>
                                    <label for="lunch_number">Number of Lunch:</label><input type="number" class="inputField" id="lunch_number" value="<?php if($meals[0]['lunch_number']){echo $meals[0]['lunch_number'];}?>" min="0" name="lunch_number"/>
                                  </div>
                              </li>
                              <li id="dinner" style="<?php if($meals[0]['need']==2){echo "display:none;";}?>">
                                  <input type="checkbox" id="din" <?php if($meals[0]['dinner']){echo "checked";}?> name="meals" value="Dinner"/><label for="din"><strong>Dinner</strong></label>
                                  <div id="dinb" style="<?php if(!$meals[0]['dinner']){echo 'display:none;';}?>">
                                  <?php if($tour_id):?>
                                    <input type="radio" id="dst" <?php if(in_array(1, $meals[0]['dinner'])){echo "checked";}?> name="dinM" value="Standard"/><label for="dst">Standard</label>
                                    <input type="radio" id="dbu" <?php if(in_array(2, $meals[0]['dinner'])){echo "checked";}?> name="dinM" value="Buffet"/><label for="dbu">Buffet</label>
                                    <input type="radio" id="dbo" <?php if(in_array(3, $meals[0]['dinner'])){echo "checked";}?> name="dinM" value="Both"/><label for="dbo">Both Standard  and Buffet</label>
                                    <input type="checkbox" id="dth" <?php if(in_array(4, $meals[0]['dinner'])){echo "checked";}?> name="dinT" value="DinnerTheatre"/><label for="dth">Dinner Theatre</label>
                                    <input type="checkbox" id="dtm" <?php if(in_array(5, $meals[0]['dinner'])){echo "checked";}?> name="dinTh" value="Thematic Dinner"/><label for="dtm">Thematic Dinner</label>
                                  <?php else:?>
                                    <input type="radio" id="dst" name="dinM" value="Standard"/><label for="dst">Standard</label>
                                    <input type="radio" id="dbu" name="dinM" value="Buffet"/><label for="dbu">Buffet</label>
                                    <input type="radio" id="dbo" name="dinM" value="Both"/><label for="dbo">Both Standard  and Buffet</label>
                                    <input type="checkbox" id="dth" name="dinT" value="Dinner Theatre"/><label for="dth">Dinner Theatre</label>
                                    <input type="checkbox" id="dtm" name="dinTh" value="Thematic Dinner"/><label for="dtm">Thematic Dinner</label>
                                  <?php endif;?>
                                    <label for="dinner_number">Number of Dinner:</label><input type="number" class="inputField" id="dinner_number" value="<?php if($meals[0]['dinner_number']){echo $meals[0]['dinner_number'];}?>" min="0" name="dinner_number"/>
                                  </div>
                              </li>
                            </ul>
                          </div>
                          <!--meal-->
                          <!--transportation-->
                          <div class="row" style="display:none;">
                            <div class="price_col_top" style="background:#a409ba;">Pick Transportations</div>
                            <ul>
                              <li>
                                  <h5>Air:</h5>
                                  <input id="airY" type="radio" <?php if($transportation[0]['air']==1){echo "checked";}?> name="air" value="Yes"/><label for="airY">Yes</label>
                                  <input id="airN" type="radio" <?php if($transportation[0]['air']==2){echo "checked";}?> name="air" value="No"/><label for="airN">No</label>
                              </li>
                              <li>
                                  <h5>Bus:</h5>
                                  <input type="radio" id="co" <?php if($transportation[0]['bus']==1){echo "checked";}?> name="bus" value="Coach Only"/><label for="co">Coach</label>
                                  <input type="radio" id="sh" <?php if($transportation[0]['bus']==2){echo "checked";}?> name="bus" value="School Bus Only"/><label for="sh">School Bus</label>
                                  <input type="radio" id="bo" <?php if($transportation[0]['bus']==3){echo "checked";}?> name="bus" value="Both"/><label for="bo">Both</label>
                              </li>
                              <li>
                                  <h5>Other:</h5>
                                <?php if($tour_id):?>
                                  <input type="checkbox" id="pu" <?php if(in_array(1, $transportation[0]['other'])){echo "checked";}?> name="otherTrans" value="Public"/><label for="pu">Public (i.e Subway)</label>
                                  <input type="checkbox" id="ta" <?php if(in_array(2, $transportation[0]['other'])){echo "checked";}?> name="otherTrans" value="Taxi"/><label for="ta">Taxi</label>
                                  <input type="checkbox" id="tr" <?php if(in_array(3, $transportation[0]['other'])){echo "checked";}?> name="otherTrans" value="Train"/><label for="tr">Train</label>
                                <?php else:?>
                                  <input type="checkbox" id="pu" name="otherTrans" value="Public"/><label for="pu">Public (i,e Subway)</label>
                                  <input type="checkbox" id="ta" name="otherTrans" value="Taxi"/><label for="ta">Taxi</label>
                                  <input type="checkbox" id="tr" name="otherTrans" value="Train"/><label for="tr">Train</label>
                                <?php endif;?>
                              </li>
                            </ul>
                          </div>
                          <!--/transportation-->
                          <!--hotel-->
                          <div class="row" style="display:none;">
                            <div class="price_col_top" style="background:#a409ba;">Pick Hotels</div>
                            <ul>
                              <li>
                                  <h5>Type</h5>
                                   <input type="radio" id="hotel2" <?php if($hotel[0]['type']==1){echo "checked";}?> name="hotel" value="2 Stars"/><label for="hotel2">2 Stars</label>
                                   <input type="radio" id="hotel3" <?php if($hotel[0]['type']==2){echo "checked";}?> name="hotel" value="3 Stars"/><label for="hotel3">3 Stars</label>
                                   <input type="radio" id="hotel4" <?php if($hotel[0]['type']==3){echo "checked";}?> name="hotel" value="4 Stars"/><label for="hotel4">4 Stars</label>
                                   <input type="radio" id="hotel5" <?php if($hotel[0]['type']==4){echo "checked";}?> name="hotel" value="Youth Hotel"/><label for="hotel5">Youth Hotel</label>
                              </li>
                              <li>
                                   <h5>Students Rooms</h5>
                                   <input type="radio" id="roomD" <?php if($hotel[0]['student_r']==1){echo "checked";}?> name="student_rooms" value="Double"/><label for="roomD">Double</label>
                                   <input type="radio" id="roomQ" <?php if($hotel[0]['student_r']==2){echo "checked";}?> name="student_rooms" value="Quad"/><label for="roomQ">Quad</label>
                              </li>
                              <li>
                                  <h5>Adults Rooms</h5>
                                  <input type="radio" id="roomS" <?php if($hotel[0]['adult_r']==1){echo "checked";}?> name="adults_rooms" value="Single"/><label for="roomS">Single</label>
                                  <input type="radio" id="roomA" <?php if($hotel[0]['adult_r']==2){echo "checked";}?> name="adults_rooms" value="Double"/><label for="roomA">Double</label>
                              </li>
                            </ul>
                          </div>
                          <!--/hotel-->
                          <!--tour director--> 
                          <div class="row" style="display:none;">
                            <div class="price_col_top" style="background:#a409ba;">Pick Services</div>
                            <ul>
                              <li>
                                  <h5>Tour Director</h5>
                                  <input type="radio" id="guideY" <?php if($services[0]['director']==1){echo "checked";}?> name="guide" value="Yes"/><label for="guideY">Yes</label>
                                  <input type="radio" id="guideN" <?php if($services[0]['director']==2){echo "checked";}?> name="guide" value="No"/><label for="guideN">No</label>
                              </li>
                              <li>
                                  <h5>Night Security</h5>
                                  <input type="radio" id="seY" <?php if($services[0]['security']==1){echo "checked";}?> name="secure" value="Yes"/><label for="seY">Yes</label>
                                  <input type="radio" id="seN" <?php if($services[0]['security']==2){echo "checked";}?> name="secure" value="No"/><label for="seN">No</label>
                              </li>
                              <li>
                                  <h5>Tour Language</h5>
                                  <input type="radio" id="eng" <?php if($services[0]['language']==1){echo "checked";}?> name="language" value="English"/><label for="eng">English</label>
                                  <input type="radio" id="fre" <?php if($services[0]['language']==2){echo "checked";}?> name="language" value="French"/><label for="fre">French Immersion</label>
                                  <input type="radio" id="oth" <?php if($services[0]['language']==3){echo "checked";}?> name="language" value="Other"/><label for="oth">Other</label><span id="othLang" style="<?php if($services[0]['language']!=3){echo "display:none;";}?>"><input class="inputField" type="text" value="<?php if($services[0]['language']==3){ echo $services[0]['other_language'];}?>" name="otherLanguage" placeHolder="Please Specify"></span>
                              </li>
                            </ul>
                          </div>
                          <!--tour director--> 
                          <!--Insurance-->
                          <div class="row" style="display:none;">
                            <div class="price_col_top" style="background:#a409ba;">Pick Insurance</div>
                            <ul>
                              <li><input type="radio" <?php if($insurance == 1){echo "checked";}?> name="insurance" id="inYes" value="Yes"/><label for="inYes">Yes</label></li>
                              <li><input type="radio" <?php if($insurance == 2){echo "checked";}?> name="insurance" id="inNo" value="No"/><label for="inNo">No</label></li>
                            </ul>
                          </div>
                          <!--/Insurance-->
                        </div>
                        </form>
                        <!--end transportation form-->
                      </div>
                      <div class="clear"></div>
                    </div>
                   
                </div>
              <div class="clear"></div>
              </div>
            </div>
            <!--/Transportation-->
            <!--Review-->
            <div id="quote_review" class="tabcontent" style="display: none;">
              <div class="inner">
                <div class="row">
                  <div class="col col_1_3 alpha" style="width:30%">
                    <div class="inner">
                        <h4>Information</h4>
                          <div>       
                              <ul>
                                <li>School/Organization: <strong><span id="schoolR"></span></strong></li>
                                <li>Name: <strong><span id="contactNameR"> </span></strong></li>
                                <li>Phone: <strong><span id="phoneR"></span></strong></li>
                                <li>Email: <strong><span id="emailR"></span></strong></li>
                                <li>Street: <strong><span id="streetR"></span></strong></li>
                                <li>City: <strong><span id="cityR"></span></strong></li>
                                <li>Province: <strong><span id="provinceR"></span></strong></li>
                                <li>Country: <strong><span id="countryR"></span></strong></li>
                                <li>Post Code: <strong><span id="postR"></span></strong></li>
                                <li>From: <strong><span id="fromR"></span></strong></li>
                                <li>To: <strong><span id="toR"></span></strong></li>
                                <li>Time of Year: <strong><span id="timeR"></span></strong></li>
                                <li>Children: <strong><span id="childrenR"></span></strong></li>
                                <li>Adults: <strong><span id="adultR"></span></strong></li>
                                <li>Average age: <strong><span id="ageR"></span></strong></li>
                                <li>Grade Level: <strong><span id="gradeR"></span></strong></li>
                                <li>Contact time: <strong><span id="contactR"></span></strong></li>
                                <li>Quote by: <strong><span id="byR"></span></strong></li>
                              </ul>
                          </div>
                          <a id="edit_1" class="btn_big" >Edit</a>
                    </div>
                  </div>
                  <div class="col col_1_3" style="width:30%">
                    <div class="inner">
                        <h4>Destination</h4>
                          <div id="des_act">  
                              
                          </div>
                          <a id="edit_2" class="btn_big" >Edit</a>
                    </div> 
                  </div>
                  <div class="col col_1_3 omega" style="width:30%">
                    <div class="inner">
                        <h4>Transportation</h4>
                          <div >  
                              <h6>Meals</h6>     
                              <ul id="meals">
                                <li>Breakfast: <strong><span id="brkMR"></span></strong></li>
                                <li>Lunch: <strong><span id="lunMR"></span></strong></li>
                                <li>Dinner: <strong><span id="dinMR"></span></strong></li>
                              </ul>
                              <h6>Transportation</h6>
                              <ul>
                                <li>Air: <strong><span id="airR"></span></strong></li>
                                <li>Bus: <strong><span id="busR"></span></strong></li>
                                <li>Other: <strong><span id="otherR"></span></strong></li>
                              </ul>
                              <h6>Hotel</h6>
                              <ul>
                                <li>Type: <strong><span id="hotelR"></span></strong></li>
                                <li>Students Rooms: <strong><span id="student_roomsR"></span></strong></li>
                                <li>Adults Rooms: <strong><span id="adults_roomsR"></span></strong></li>
                              </ul>
                              <h6>Services</h6>
                              <ul>
                                <li>Tour Director: <strong><span id="guideR"></span></strong></li>
                                <li>Night Security: <strong><span id="secureR"></span></strong></li>
                                <li>Language: <strong><span id="languageR"></span></strong></li>
                              </ul> 
                              <h6>Insurance</h6>
                              <ul>
                                <li>Insurance: <strong><span id="insuranceR"></span></strong></li>
                              </ul>
                          </div>
                          <a id="edit_3" class="btn_big">Edit</a>
                    </div>       
                </div>
                        
                </div>
                 
                <div class="clear"></div>
                <div class="row input_styled">
                        <?php wp_reset_postdata();?>
                      <?php $checkForTerms = get_field('terms_and_conditions','options');
                      if($checkForTerms):?>
                      <div class="termsText">
                        <input name="um_checkTerms" id="um_checkTerms" type="checkbox"><label for="um_checkTerms"> Terms and Conditions</label>
                        <p id="terms"><?php the_field('terms_and_conditions');?></p>
                      </div>
                      <?php else:?>
                      <input type="hidden"  name="um_checkTerms" id="um_checkTerms" value="TRUE"/> 
                      <?php endif;?>
                      <input type="hidden" name="um_submitted" value="true" />
                      
                </div>
              </div>
            </div>
            <!--/Review-->
            <!--buttons-->
            <br/>
            <br/>
            <div class="button-group" align="center">
              <div class="row" style="">
                <?php
                  if(!$recaptcha_valid){
                      echo "<div>please enter correct answer in the box. </div>";
                  }
                ?>
                  <h4 style="color:#ab59bc;">Please enter the verification code that you see bellow.</h4>
                <?php echo recaptcha_get_html($publickey, $error);?>


              </div>
              <br/>

                <button type="button"  class="btn_big" id="prevButton" /><< Previous</button>
                <button type="button"  class="btn_big" id="informQuote" name="Quote" style="background:#ab59bc" />Send Your Quote</button>
                <button type="button"  class="btn_big" id="nextButton" />Next >> </button>             
            </div>

          </div>
          
     
      
    </div>
    <div class="clear"></div>  
  </div>
</div>

<div class="clear"></div>
<?php after_content();?>

    <!--check validity-->
                        <div class="hiddenActivity " id="fillForm">
                              <p><strong>Please fill at least Name, Phone and Email address on the <a href="http://localhost/projects/mpoeduc/?page_id=7">Information & Iternary</a> page!</strong></p>
                        </div>
    <!--sucess or fail-->
                        <div class="hiddenActivity termsAndConditions resultWrapper" id="sucessOrFail" >
                          <h3 class="orange"><?php _e("Thank You.","um_lang");?></h3>
                           <p><?php _e("Sending your quote......","um_lang");?></p>
                           <p class="smile">:)</p>
                        </div>

<?php
get_footer();
?>