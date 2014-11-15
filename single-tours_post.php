<?php
     get_header(); 
     global $post;
     setup_postdata( $post );
     $tour_terms = array ();
     $tour_countries;
     $latlang=get_field("google_map");
     /**validate the quoting form and submit it***/ 
     $stripTags = '/[^_a-zA-Z0-9-]/';
     ?>
     <script type="text/javascript">
     var booked=false;
     </script>
      <?php
      if(isset($_POST["um_submitBooking"]) && $_POST["um_submitBooking"])
      {
       validate_insert();  
      }
     /****end validate quoting form***/
     $terms = get_the_terms($post->ID,"um_".toAscii('canada'));
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
      $tour_terms=implode(',',$tour_terms);
      //echo $tour_terms;
      $activity_ids= array ();
      $posts = get_field("activities");
        if($posts){
          foreach ($posts as $post) {
            setup_postdata($post);
            array_push($activity_ids,$post->ID);
            wp_reset_postdata();
          }
        }
      $activity_ids = implode(',', $activity_ids);
      //echo $activity_ids;
          ?>
 <div id="middle" class="cols2">
  <div class="container_12">
      <!-- Photo Gallery -->
        <div class="gal-wrap">
                 <?php
                 $slider= get_field('do_shortcode');
                 if($slider){
                  if (preg_match('/(\[.* )(.*?)(\])/', $slider, $matches)) {
                      putRevSlider($matches[2]);
                    }
                    else{
                      putRevSlider($slider);
                    }
                 }
                 ?>     
        </div>
        <!--/ Photo Gallery -->
        <!-- content -->
        <div class="content">
          <div class="title">
           <h1><?php the_title();?></h1>
                <span class="title_right count"><a id="tourMap"  class="link-map"><?php?></a></span>
          </div>
            <!-- offers tabs -->
           
          <div id="single_tab" class="tabs_products">
                 
            <ul class="tabs linked">     
                <li><a href="#tab_overview;?>">Activities</a></li>
                <li><a href="#tab_atractions">Overview</a></li>
                <li><a id="map_click" href="#tab_map">Maps & Weather</a></li>
                <li><a href="#tabs_notincl">Package Terms</a></li>
            </ul>
            <div class="tabcontent">
                <div id="tab_subjects" class="row topmenu" style="margin-left:0;">
                    <ul>
                        <li id="s_show_all" style="color:#a409ba;" >All </li>
                        <li id="s_arts">Arts </li>
                        <li id="s_culture">Culture </li>
                        <li id="s_history">History </li>
                        <li id="s_language">Language </li>
                        <li id="s_music">Music </li>
                        <li id="s_recreation">Recreation </li>
                        <li id="s_science">Science </li>
                    </ul>
                </div>
                <div class="row"  id="s_activity">
                  <h4>Activities included in this tour:</h4>

                <?php foreach ($tour_cities as $term):?>
                  <h3><?php echo $term; ?></h3>
                  <div class="divider"></div>
                  <div class="re-list">
                      <?php 
                        $posts = get_field("activities");
                        if($posts):
                          foreach ($posts as $post):
                                setup_postdata($post);
                                $result=false;
                                $id= get_the_ID();
                                $activity_city=get_the_terms($post->ID,"um_".toAscii($tour_countries));
                                if($activity_city){
                                  foreach($activity_city as $city){
                                      if($city->name == $term){
                                        $result=true;
                                      }
                                  }
                                }
                                if($result):
                                $link =get_field('link');
                          ?>  
                            <div <?php show_subjects($id);?> class="re-item">
                              <div class="re-image">
                                  <a href="<?php the_permalink();?>" hidefocus="true" style="outline: none; overflow:hidden;">
                                    <?php 
                                      $imag_url = wp_get_attachment_url( get_post_thumbnail_id($post->ID, 'thumbnail') );
                                      if($imag_url):?>
                                          <img src="<?php echo $imag_url; ?>">
                                    <?php else:?>
                                      <img height="150" width="200" src="http://mpoeduc.com/wp-content/uploads/2013/12/MPO-logo-shadow-2-e1386452789693.png">
                                    <?php  endif;  ?>
                                  </a>
                              </div>
                              <div class="re-short">              
                                  <div class="re-top">
                                      <h2><a href="<?php the_permalink();?>" hidefocus="true" style="outline: none;"><?php the_title(); ?></a></h2>
                                  </div>                
                                  <div class="re-descr">
                                      <p><?php 
                                      $overview = wp_trim_words($post->post_content,20,'<a href="'.get_permalink().'">...Read More</a>');
                                      echo $overview;
                                      ?></p>
                                  </div>      
                              </div>
                              <div class="re-bot">
                                        <a target="_blank" href="<?php echo $link;?>"  title="View Photos" hidefocus="true" style="outline: none;">Activity website</a>
                              </div>
                              <div class="clear"></div>
                            </div>
                          <?php
                              endif;
                            wp_reset_postdata();
                        endforeach;
                        endif;
                      ?>
                  </div>
                <?php endforeach;?>

                </div>
            </div>

            <div class="tabcontent" >
             <?php the_field('overview');?>
            </div>
            
            <div class="tabcontent">
              <div class="row">
                <h5>Map</h5>
                 <div id="googleMap" style="width:100%;height:400px;">
                 <script type="text/javascript">
                      jQuery(document).ready(function ($) {
                            var myCenter=new google.maps.LatLng(<?php echo $latlang['coordinates']; ?>);
                                var mapProp = {
                                  center:myCenter,
                                  zoom:5,
                                  mapTypeId:google.maps.MapTypeId.ROADMAP
                             };
                            var map=new google.maps.Map(document.getElementById("googleMap"),mapProp);
                            var marker=new google.maps.Marker({
                              position:myCenter,
                              });
                            var map_click =document.getElementById('map_click');
                            google.maps.event.addDomListenerOnce(map_click, 'click', function(){
                              //alert("aiyo");
                              setTimeout(function(){
                               google.maps.event.trigger(map, 'resize');
                               map.setCenter(myCenter);
                               marker.setMap(map);
                              },"100");
                              
                            });
                           

                            $("#tourMap").click(function(){
                                  $("#googleMap").bPopup({
                                    easing: 'easeOutBack', //uses jQuery easing plugin
                                    speed: 450,
                                    transition: 'fadeIn'
                                  });
                                });

                        });
                 </script>
               </div>
             </div>
               <div class="row">
                
                <?php
                  $weather_fields=get_field('weather');
                  //print_r($weather_fields);
                  if($weather_fields){
                    echo "<h5>Weather</h5>";
                    weather($weather_fields);
                  }
                ?>
               </div>
             
            </div>

            <div class="tabcontent" > 
              <?php the_field('terms');?>
            </div>
          </div>
          
          <!--comment and review-->
          <?php?>
        </div>
        <!--/end content -->
        <!-- sidebar -->
        <div class="sidebar">
      
            <!-- filter -->
          <div class="widget-container widget_item_info" id="package">
                <h3 class="widget-title">PRICE:</h3>
                <span class="price"><em>Starting From</em> 
                  <?php if(!get_field('disable_all_price','options')):?>
                  <ins><?php the_field('tour_currency');?></ins><strong><?php the_field('price');?></strong>
                  <?php endif; ?>
                </span>

                  <!--=====send quote here====-->
                  <form method="POST" action="" class="form_white">
                    <div class="row rowSubmit">
                      <input type="button" id="quoteBtn" style="width:183px;background:#ab59bc;" value="<?php _e('Quote this tour','um_lang');?>" class="btn-submit">
                      <input type="hidden" name="um_choose" value="<?php the_id();?>">
                    </div>
                  </form>   
              
                  <form method="GET" action="<?php echo site_url('request-quote');?>" class="form_white">
                    <div class="row rowSubmit">
                      <input type="submit" value="<?php _e('Customize this tour','um_lang');?>" style="background:#ab59bc;" class="btn-submit">
                      <input type="hidden" name="um_choose" value="<?php the_id();?>">
                    </div>
                  </form> 

                  <div class="row">
                    
                    <div class="item_img" >
                      <?php $image=get_field('tour_slider');
                       if($image):?>
                          <img src="<?php echo $image[0]['image'];?>">
                      <?php endif;?>
                    </div>
                      <div>                       
                        <?php the_content();?>
                      </div>
                      <div class="clear"></div>
                  </div>         
                        
                  <div class="row" style="z-index:2">
                    <h5>Tour attributes:</h5> 
                    
                      <?php
                      $numbers = get_field("tour_number");
                      $meals= get_field("meals");
                      $transportation = get_field("transportation");
                      $hotel = get_field("hotel");
                      $services = get_field("services");
                      $insurance = get_field("insurance");
                      $insurance_object = get_field_object("insurance");
                      ?>
                      <div id="package_attributes" class="row"> 
                          <?php if($meals):
                            $choices = array ("Not included","Standard", "Buffet", "Both","Dinner theatre","Thematic");
                            $dinner= " ";
                            foreach ($meals[0]['dinner'] as $number) {
                              $dinner .= $choices[$number].";";
                            }
                             
                          ?>
                            <div class="attri_row">
                                 <div class="left">
                                    <img src="<?php echo get_template_directory_uri();?>/images/icon-meals.png" heigth="25" width='25'>
                                </div>
                                <div class="right">
                                    <span><?php echo $meals[0]['breakfast_number'];?> Breakfast</span><br/>
                                    <span><?php echo $meals[0]['lunch_number'];?> Lunch</span><br/>
                                    <span><?php echo $meals[0]['dinner_number'];?> Dinner</span>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                               
                            
                          <?php endif;?>

                          <?php if($hotel):
                            $type = array ("Not included", "2 Stars","3 Stars", "4 Stars", "Youth Hotel");
                            $student = array ("Not included","Double","Quad");
                            $adult = array ("Not included","Single", "Double");
                            ?>
                              <div class="attri_row">
                                <div class="left">
                                  <img src="<?php echo get_template_directory_uri();?>/images/icon-hotel.png" heigth="25" width='25'>
                                  <!--strong>Hotel:</strong-->
                                </div>
                                <div class="right">
                                    <span>Type: <?php echo $type[$hotel[0]['hotel_type']];?></span><br/>
                                    <span>Students Room: <?php echo $student[$hotel[0]['student_r']];?></span><br/>
                                    <span>Adults room: <?php echo $adult[$hotel[0]['adult_r']];?></span>
                                </div>
                                <div class="clearfix"></div>
                              </div>
                              <?php?>
                          <?php endif; ?>
                          
                          <?php if($transportation):
                            $air = array ("Not included","Yes", "No");
                            $bus = array ("Not included","Coach", "Standard Bus", "Both bus and coah");
                            $other = array ("Not included ","Public","Taxi","Train");
                            $other1="";
                            foreach ($transportation[0]['other'] as $choice) {
                              $other1 .= $other[$choice].";";
                            }
                          ?>
                            <div class="attri_row">
                              <div class="left">
                                <img src="<?php echo get_template_directory_uri();?>/images/icon-transportation.png" heigth="25" width='25'>
                                <!--strong>Transport:</strong-->
                              </div>
                              <div class="right">
                                <span>Air: <?php echo $air[$transportation[0]['air']];?></span><br/>
                                <span>Bus: <?php echo $bus[$transportation[0]['bus']];?></span><br/>
                                <span>Other: <?php echo $other1;?> </span>
                              </div>
                              <div class="clearfix"></div>
                            </div>
                          <?php endif;?>
                        <?php if($services):
                        $choices = array ("Not include","Yes","No");
                        $languages = array ("To be assured","English","French");
                        $language="";
                        foreach ($services[0]['language'] as $choice) {
                          $language .= $languages[$choice]." ";
                        }
                        if($services[0]['other_language']){
                          $language = $services[0]['other_language'];
                        }
                        ?>  
                          <div class="attri_row">
                            <div class="left">
                              <img src="<?php echo get_template_directory_uri();?>/images/icons-services.png" heigth="25" width='25'>
                              <!--strong>Services:</strong-->
                            </div>
                            <div class="right">
                              <span>Tour director: <?php echo $choices[$services[0]["director"]];?></span><br/>
                              <span>Night Security: <?php echo $choices[$services[0]["security"]];?></span><br/>
                              <span>Language: <?php echo $language;?></span>
                            </div>
                            <div class="clearfix"></div>
                          </div>
                        <?php endif;?>
                        <?php if($insurance):
                        $choices = array ("Not included ","Yes", "No");
                        ?>
                          <div class="attri_row">
                            <div class="left">
                              <strong>Insurance: <?php echo $choices[$insurance];?></strong>
                            </div>
                          </span>
                          </div>
                        <?php endif;?>
                       </div>             
                  </div>
                  
          </div>
          <!--/ filter -->
            
          <!-- widget_newsletter -->
          <?php news_letter();?>
          <!--/ widget_newsletter -->
            
        </div>
        <!--/ sidebar -->
        <div class="clear"></div> 
    </div>                   
</div><!-- /middle content -->
<!-- after content -->
<!--div class="after_content wide">
  <div class="after_inner">
    <div class="container_12">
          <h5>Similar Packages:</h5>
            
          <div class="widgetarea widget_col_1">
            <?php //similar_products($post->ID);?>
          </div>
                
          <div class="clear"></div>
      </div>
      <?php //if(get_field('show_reviews_on_page')){comments_template();}?>
  </div>

</div-->
<!--/ after content -->

<!--quoting form in a bpop up-->
<div id="quotePop" style="display:none;" class="add-comment contact-form" >
    <div class="add-comment-title">
      <h3>Your are quoting package:<span class="author"><?php the_title();?></span></h3>
    </div>
    <div  class="comment-form">
      <form id="quoteForm" method="POST" action="#" class="ajax_form">
        <input type="hidden" value="ture" name="um_submitBooking">
        <div class="row alignleft">
            <label><strong><?php _e('Email','um_lang');?></strong></label>
            <input type="email" name="um_Email" id="um_Email" class="inputtext input_middle required"/>
        </div>
        <div class="space"></div>
        <?php  
          $count=1;
          $MendatoryfieldNames = array();
           array_push($MendatoryfieldNames,'um_Email');
          $OtherfieldNames = array();
              $fields = get_field('booking_field','options');
              if($fields):
          
              foreach($fields as $field):
                
        ?>
          <div class="row alignleft">
           <label><strong><?php echo $field['field_name'];?></strong></label>
            <?php 

                switch($field['type'])
                {
                    case 'text':
                            echo '<input type="text" name="um_'.preg_replace($stripTags, '', $field['field_name']).'" id="um_'.preg_replace($stripTags, '', $field['field_name']).'"  class="inputtext input_middle"/>';
                    break;
                    case 'num':
                        echo '<input type="num" name="um_'.preg_replace($stripTags, '',$field['field_name']).'" id="um_'.preg_replace($stripTags, '', $field['field_name']).'" class="inputtext input_middle" min="0" value="0"/>';
                    break;
                    case 'date':
                        echo '<input type="datePick" name="um_'.preg_replace($stripTags, '', $field['field_name']).'" id="um_'.preg_replace($stripTags, '', $field['field_name']).'" class="inputtext hasDatepicker" value=""/>';
                    break;
                    case 'phone':
                            echo '<input type="tel" name="um_'.preg_replace($stripTags, '', $field['field_name']).'" id="um_'.preg_replace($stripTags, '', $field['field_name']).'" class="inputtext input_middle"/>';
                    break;
                }

                    if($field['is_mandatory'])
                    {
                        array_push($MendatoryfieldNames,'um_'.preg_replace($stripTags, '', $field['field_name']));
                    }
                    else
                    {
                        array_push($OtherfieldNames,'um_'.preg_replace($stripTags, '', $field['field_name']));
                    }
                     $count++;  
                    ?>

              </div>
              <?php if($count%2==0):?>

                <div class="clear"></div>
              <?php else:?>
                <div class="space"></div>
              <?php endif;?>

        <?php
          endforeach;
          endif;
        ?>
          <div class="clear"></div>
          <!--four mandatory fields-->
          <div class="row alignleft">
            <label><strong>Number of Children(required):</strong></label>
            <input  type="number" min="0" name="children" class="inputtext">
          </div>
          <div class="space"></div>
          <div class="row alignleft">
            <label><strong>Number of Adults:</strong></label>
            <input  type="number"  min="0" name="adult" class="inputtext">
          </div>
          <div class="clear"></div>
          <div class="row alignleft">
            <label><strong>Language:</strong></label>
            <input type='text' name="language" list="languages" class="inputtext">
            <datalist id="languages">
              <option>French</option>
              <option>English</option>
              <option>Other Please Enter</option>
            </datalist>
          </div>
          <div class="space"></div>
          <div class="row alignleft input_styled inlinelist">
            <div class="rowRadio" style="width:100px">
              <input type="checkbox" name="insurance" value="yes" id="insurancec">
              <label for="insurancec">Insurance</label>
            </div>
            <div class="rowRadio" style="width:100px">
              <input type="checkbox" name="air" id="air" value="yes">
              <label for="air">Air Faire</label>
            </div>
          </div>
          <!--/four mandatory fields-->
          <div class="clear"></div>
          <?php $checkForExtra = get_field('extra_text','options');
            if($checkForExtra):?>
          <div class="row">
              <label><strong><?php _e('Message','um_lang');?></strong></label>
              <textarea cols="30" rows="10" name="um_ExtraMessage" class="textarea textarea_middle required"></textarea>
          </div>
          <?php endif;?>
          <?php $checkForTerms = get_field('terms_and_conditions','options');
            if($checkForTerms):?>
            <div class="row">
              <div class="rowRadio input_styled checklist">
                <input name="um_checkTerms" id="um_checkTerms" type="checkbox">
                <label for="um_checkTerms" id="terms"><?php the_field('terms_and_conditions_short_text','options');?></label>
              </div>
              <div id="termText" style="display:none;width:600px;">
                   <?php
                       the_field('terms'); 
                   ?>
              </div>
            </div>
            <?php else:?>
            <input type="hidden"  name="um_checkTerms" id="um_checkTerms" value="TRUE"/> 
            <?php endif;?>
      
            <input type="hidden" name="um_tourPostID" value="<?php echo $post->ID; ?>" >

            <?php foreach ( $MendatoryfieldNames as $key => $value ): ?>
            <input type="hidden" name="um_MendatoryFieldNames[<?php echo preg_replace($stripTags,'',$key); ?>]" value="<?php echo preg_replace($stripTags,'',$value); ?>" >
            <?php endforeach ?>


          <div class="row rowSubmit">
              <input type="button" id="sendQuote" value="<?php _e('Quote','um_lang');?>" class="btn-submit">                     
              <a onclick="document.getElementById('quoteForm').reset();return false" href="#" class="link-reset">Reset all fields</a>
          </div>
      </form>
      <script>
              var array = <?php echo json_encode($MendatoryfieldNames);?>;
      </script>
    </div>
</div>
<!--quoting form in a bpop up-->

<!---booking complete-->
<div class="add-comment contact-form" id="sucessPop" style="display:none">
  <h3 class=""><?php _e("Thank You.","um_lang");?></h3>
  <div class="tagcloud">
  <a><?php _e("Your quoting is complete.","um_lang");?></a><br>
  <a>:)</a>
  </div>
</div>
<!---/booking complete-->

<script type="text/javascript">
jQuery(document).ready(function($){

/***pop up for the quoting of the package**/
if(booked){
  $("#sucessPop").bPopup({
    easing: 'easeOutBack', //uses jQuery easing plugin
    speed: 450,
    transition: 'fadeIn'
  });
}
$("#quoteBtn").click(function(){
 
  if(booked){
    $("#sucessPop").bPopup({
    easing: 'easeOutBack', //uses jQuery easing plugin
    speed: 450,
    transition: 'fadeIn'
  });
  
  }else{
    $("#quotePop").bPopup({
    easing: 'easeOutBack', //uses jQuery easing plugin
    speed: 450,
    transition: 'fadeIn'
  });
  }
  });
/***********end popup Management**************/
$(".hasDatepicker").datepicker();
$("#terms").hover(function(){
  if(!$("#um_checkTerms").is(":checked")){
  $("#termText").show();
}
});
$("#um_checkTerms").change(function(){
  if($(this).is(":checked")){
     $("#termText").hide();
  }
});
});
</script>

<?php get_footer(); ?>

          