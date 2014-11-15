<?php
/*
Template Name: customization
*/
   get_header(); 
   global $post;
   setup_postdata( $post );

   if(function_exists("sendQuote")){
    echo "exist";
   }
   // handling quoting after filling out the form
   if(isset($_POST["um_submitted"]) && $_POST["um_submitted"])
   {
      sendQuote();
   }

   //handling customizating from existing packages
   if(isset($_POST['um_choose'])){
      $tour_id=$_POST['um_choose'];
      //echo $tour_id;
      if(!empty($tour_id)){
       $tour=get_post($tour_id);                       
        } 
     }
    if (isset($_POST['tour_city'])&&!empty($_POST['tour_city'])) {
      $tour_city=$_POST['tour_city'];
      //echo $tour_city;
      $tour_cities = explode(',', $tour_city);
    }
    if (isset($_POST['activity_ids'])&&!empty($_POST['activity_ids'])) {
      $activity_ids=$_POST['activity_ids'];
      //echo $activity_ids;
      $activity_ids = explode(',', $activity_ids);
    }

?>
<div id="middle" class="full_width">
    <div class="container_12"> 
    <div class="content"> 
      <form method="post"  id="inform">
        <?php if($tour_id):?>
          <h1>You are customizing this package >> <span><?php echo get_the_title($tour_id);?></span></h1>
        <?php else:?>
          <h1>Customize a tour in just 3 steps:</h1>
        <?php endif;?>
        <!--iternary-->
          <div id="tab_main" class="tabs_framed">
            <ul class="tabs">
              <li class="current"><a  hidefocus="true" style="outline: none;">1: Information >></a></li>
              <li><a  hidefocus="true" style="outline: none;">2: Destination & Activity >></a></li>
              <li><a  hidefocus="true" style="outline: none;">3: Transportation & Lodging >></a></li>
              <li><a  hidefocus="true" style="outline: none;">Review & Send</a></li>
            </ul>
            <?php information($tour_id);?>
            <?php if($tour_id):?>
                <!--Destionation-->
                <div id="main_2" class="tabcontent" style="display: none;">
                  <div class="inner">
                      <!--header-->
                  <div class="row">
                      <!--city tab-->
                      <div class="col col_1_3 alpha">
                        <h5><?php _e('Choose your destinations or sample packages:','um_lang');?></h5>
                        <!--city tab-->
                        <div id="tabs_city" class="tabs_framed tf_sidebar_tabs">
                            <!--canada-->
                                <?php show_country_city("Canada",$tour_cities);?>
                            <!--/canada-->
                            <!--USA-->
                                <?php show_country_city("USA", $tour_cities);?>
                            <!--/USA-->
                            <!--Europe-->
                                <?php show_country_city("Europe",$tour_cities);?>
                            <!--/Europe-->
                            <!--Asia-->
                                <?php show_country_city("Asia",$tour_cities);?>
                            <!--/Asia-->
                            <ul class="tabs">
                                <li class="current"><a  hidefocus="true" style="outline: none;">Canada</a></li>
                                <li><a  hidefocus="true" style="outline: none;">USA</a></li>
                                <li><a  hidefocus="true" style="outline: none;">Europe</a></li>
                                <li><a  hidefocus="true" style="outline: none;">Asia</a></li>
                            </ul>
                        </div>
                      </div>

                    <!--/city tab-->
                    <!--Activity-->
                    <div class="col col_1_2 omega" style="width:62%;">
                        <h5><?php _e('Activities selected by cities:','um_lang');?></h5>
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
                                <div id="tab_subjects"class="small_tabs">
                                    <ul  class="tabs" style="float:right;">

                                        <li id="selected" style="color:#333333;">Selected</li>
                                        <li id="show_all">All </li>
                                        <li id="arts">Arts </li>
                                        <li id="culture">Culture </li>
                                        <li id="history">History </li>
                                        <li id="language">Language </li>
                                        <li id="music">Music </li>
                                        <li id="recreation">Recreation </li>
                                        <li id="science">Science </li>
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
                                                $activities = new WP_Query($arg);
                                                if($activities->have_posts()):
                                                  while ($activities->have_posts()):
                                                     $activities->the_post();
                                                      if(get_field('link')){
                                                          $link =get_field('link');
                                                      }
                                                  ?>
                                                  <div class="rowRadio" <?php show_subjects($id);?> <?php if(!empty($activity_ids) && !in_array($post->ID, $activity_ids)){ echo "style='display:none;'";}?> >
                                                    <div class="faq_question toggle" >
                                                      <span class="faq_q">
                                                      <input type="checkbox" <?php if(!empty($activity_ids) && in_array($post->ID, $activity_ids)){ echo "checked='checked'";}?> name="activity" id="<?php echo $post->post_name.$city;?>" name="activity" value="<?php echo $post->post_name;?>">
                                                      <label for="<?php echo $title;?>"><?php the_title();?></label>
                                                      </span>
                                                      <span class="ico"></span>
                                                    </div> 
                                                    <div class="faq_answer toggle_content" style="display: none;">
                                                      <p><?php the_content();?><a class="btn_big" target="blank" href="<?php echo $link;?>">Website</a></p>
                                                    </div>
                                                  </div>
                                                  <?php 
                                                   endwhile;
                                                   wp_reset_postdata();
                                                endif;
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
                      </div>
                    <!--/Activity-->
                   </div>
                   <div class="clear"></div>
                    <!--sample packages-->
                    <h5>Other similar packages that are offered:</h5>
                    <?php 
                      similar_products($tour_id);
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
                        <div class="pricing_box input_styled" >
                          <!--meal-->
                          <div class="row">
                          <div class="price_col_top" style="background:#a409ba;">Meal</div>
                            <ul>
                              <li>
                                  <input type="checkbox" <?php if($meals[0]['need']==2){echo "checked";} ?> id="noM" name="meal" value="No Meals"/><label for="noM"><h5>No Meals</h5></label>
                              </li>
                              <li id="breakfast"  style="<?php if($meals[0]['need']==2){echo "display:none;";}?>">
                                  <input type="checkbox" id="brk" <?php if($meals[0]['breakfast']){echo "checked";}?>  name="meals" value="Breakfirst"/><label for="brk"><h5>Breakfast</h5></label>

                                  <div id="brkb" >
                                    <input type="radio" id="bst" <?php if($meals[0]['breakfast']==1){echo "checked";}?> name="brkM" value="Continental"/><label for="bst">Continental</label>
                                    <input type="radio" id="bbu" <?php if($meals[0]['breakfast']==2){echo "checked";}?> name="brkM" value="American"/><label for="bbu">American</label>
                                    <input type="radio" id="bbo" <?php if($meals[0]['breakfast']==3){echo "checked";}?> name="brkM" value="Both"/><label for="bbo">Both</label>
                                    <label for="brk_number">Number of Breakfast:</label><input type="number" id="brk_number" value="<?php if($meals[0]['breakfast_number']){echo $meals[0]['breakfast_number'];}?>" min="0" name="brk_number"/>
                                  </div>
                              </li >
                              <li id="lunch" style="<?php if($meals[0]['need']==2){echo "display:none;";}?>">
                                  <input type="checkbox" id="lun" <?php if($meals[0]['lunch']){echo "checked";}?> name="meals" value="Lunch"/><label for="lun"><h5>Lunch</h5></label>
                                  <div id="lunb" >
                                    <input type="radio" id="lst" <?php if($meals[0]['lunch']==1){echo "checked";}?> name="lunM" value="Standard"/><label for="lst">Standard</label>
                                    <input type="radio" id="lbu" <?php if($meals[0]['lunch']==2){echo "checked";}?> name="lunM" value="Buffet"/><label for="lbu">Buffet</label>
                                    <input type="radio" id="lbo" <?php if($meals[0]['lunch']==3){echo "checked";}?> name="lunM" value="Both"/><label for="lbo">Both</label>
                                    <label for="lunch_number">Number of Lunch:</label><input type="number" id="lunch_number" value="<?php if($meals[0]['lunch_number']){echo $meals[0]['lunch_number'];}?>" min="0" name="lunch_number"/>
                                  </div>
                              </li>
                              <li id="dinner" style="<?php if($meals[0]['need']==2){echo "display:none;";}?>">
                                  <input type="checkbox" id="din" <?php if($meals[0]['dinner']){echo "checked";}?> name="meals" value="Dinner"/><label for="din"><h5>Dinner</h5></label>
                                  <div id="dinb" >
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
                                    <label for="dinner_number">Number of Dinner:</label><input type="number" id="dinner_number" value="<?php if($meals[0]['dinner_number']){echo $meals[0]['dinner_number'];}?>" min="0" name="dinner_number"/>
                                  </div>
                              </li>
                            </ul>
                          </div>
                          <!--meal-->
                          <!--transportation-->
                          <div class="row" style="display:none;">
                            <div class="price_col_top" style="background:#a409ba;">Transportation</div>
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
                                  <input type="checkbox" id="pu" <?php if(in_array(1, $transportation[0]['other'])){echo "checked";}?> name="otherTrans" value="Public"/><label for="pu">Public (Subway)</label>
                                  <input type="checkbox" id="ta" <?php if(in_array(2, $transportation[0]['other'])){echo "checked";}?> name="otherTrans" value="Taxi"/><label for="ta">Taxi</label>
                                  <input type="checkbox" id="tr" <?php if(in_array(3, $transportation[0]['other'])){echo "checked";}?> name="otherTrans" value="Train"/><label for="tr">Train</label>
                                <?php else:?>
                                  <input type="checkbox" id="pu" name="otherTrans" value="Public"/><label for="pu">Public (Subway)</label>
                                  <input type="checkbox" id="ta" name="otherTrans" value="Taxi"/><label for="ta">Taxi</label>
                                  <input type="checkbox" id="tr" name="otherTrans" value="Train"/><label for="tr">Train</label>
                                <?php endif;?>
                              </li>
                            </ul>
                          </div>
                          <!--/transportation-->
                          <!--hotel-->
                          <div class="row" style="display:none;">
                            <div class="price_col_top" style="background:#a409ba;">Hotel</div>
                            <ul>
                              <li>
                                  <h5>Type</h5>
                                   <input type="radio" id="hotel2" <?php if($hotel[0]['type']==1){echo "checked";}?> name="hotel" value="2 and half Stars"/><label for="hotel2">2 and half Stars</label>
                                   <input type="radio" id="hotel3" <?php if($hotel[0]['type']==2){echo "checked";}?> name="hotel" value="3 and half Stars"/><label for="hotel3">3 and half Stars</label>
                                   <input type="radio" id="hotel4" <?php if($hotel[0]['type']==3){echo "checked";}?> name="hotel" value="4 and half Stars"/><label for="hotel4">4 and half Stars</label>
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
                            <div class="price_col_top" style="background:#a409ba;">Services</div>
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
                                  <input type="radio" id="fre" <?php if($services[0]['language']==2){echo "checked";}?> name="language" value="French"/><label for="fre">French</label>
                                  <input type="radio" id="oth" <?php if($services[0]['language']==3){echo "checked";}?> name="language" value="Other"/><label for="oth">Other</label><span id="othLang" style="<?php if($services[0]['language']!=3){echo "display:none;";}?>"><input class="inputField" type="text" value="<?php if($services[0]['language']==3){ echo $services[0]['other_language'];}?>" name="language" placeHolder="Please Specify"></span>
                              </li>
                            </ul>
                          </div>
                          <!--tour director--> 
                          <!--Insurance-->
                          <div class="row" style="display:none;">
                            <div class="price_col_top" style="background:#a409ba;">Insurance</div>
                            <ul>
                              <li><input type="radio" <?php if($insurance == 1){echo "checked";}?> name="insurance" id="inYes" value="Yes"/><label for="inYes">Yes</label></li>
                              <li><input type="radio" <?php if($insurance == 2){echo "checked";}?> name="insurance" id="inNo" value="No"/><label for="inNo">No</label></li>
                            </ul>
                          </div>
                          <!--/Insurance-->
                        </div>
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
                                <li>Name: <strong><span id="nameR"> </span></strong></li>
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
            <div>
                <button type="button"  class="button_styled" id="prevButton" /><< Previous</button>
                <button type="button"  class="button_styled" id="informQuote" name="Quote" style="background:#ab59bc" />Request a quote</button>
                <button type="button"  class="button_styled" id="nextButton" />Next >> </button>             
            </div>

          </div>
          
      </form>
      
    </div>
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
                           <p><?php _e("Your Quoting is sent.","um_lang");?></p>
                           <p class="smile">:)</p>
                        </div>

<?php
get_footer();
?>