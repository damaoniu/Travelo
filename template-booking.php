<?php
/*
Template Name:Booking
*/
$tour_post_id = '';

$stripTags = '/[^_a-zA-Z0-9-]/';

 if(isset($_POST["um_choose"]) && $_POST["um_choose"])
    {
        $tour_post_id  = $_POST["um_choose"];           
    }
    if(isset($_POST["um_submitBooking"]) && $_POST["um_submitBooking"])
    {
      validate_insert();  
    }
get_header();
?>
 <script>
        var tourRate = "<?php echo get_field('rating',$tour_post_id); ?>";
    </script>

 <div class="bookingContent">

 	<div class="mainContent">
				<div class = "blankBody"id ="Blank">
						<?php setup_postdata($post);?>
							<?php the_content();?>
						<?php wp_reset_postdata();?> 
				</div>
            </div>
 
     <?php $slideDown = get_field("slide_down","options")?>
     <div <?php if($slideDown){ echo "id='SlideDown'"; }?> ></div>
    <form method="post"  class="selectForm">
        <h4><b><?php _e('Booking Details','um_lang')?></b></h4>
             <div class="selectTour">
             <label><b><?php _e('Choose a Tour','um_lang')?></b></label><br/>
                     <div>
                      <select name="um_choose" class="filterSelectBox bookInputFields" id="tour_id">
                        <?php 
                        $dropDown_Query = new WP_Query(array('post_type' => 'tours_post' , 'posts_per_page' => -1));        
                         while ($dropDown_Query->have_posts())
                         {
                     	    $dropDown_Query->the_post();
                            if(!empty($tour_post_id))
                            {
                                 if(get_the_title($tour_post_id) == get_the_title(the_id()))
                                 {
                                     ?>
                                        <option value = "<?php the_id(); ?>" selected="selected"><?php the_title(); ?></option>
                                     <?php
                                 }
                                 else
                                 {
                                     ?>
                                        <option value = "<?php the_id(); ?>"><?php the_title(); ?></option>
                                     <?php
                                 }
                            }
                            else
                            {
                                ?>
                                    <option value = "<?php the_id(); ?>"><?php the_title(); ?></option>
                                <?php
                            }
                         }
                        ?>                 
                      </select>  
                    
                  </div>
                   <a href="" onclick="jQuery(this).closest('form').submit(); return false;"><p class="chooseBtn">Choose</p></a>
                   
            </div>
    </form>

       <?php if(!empty($tour_post_id)):?>
         <div class="bookingDetails">
             <?php if(has_post_thumbnail($tour_post_id))
            {
                echo get_the_post_thumbnail($tour_post_id,'tour_preview');
            }
            else
            {
                echo  '<img src="'.$deffault_image.'"/>';
            }
            ?>
            
            <div class="info">
                <h3><b><?php echo get_the_title($tour_post_id); ?></b></h3>


                         <?php
                         $available_dates = get_field('available_dates', $tour_post_id);
                            if($available_dates)
                            {
                                $count = count($available_dates);

                                if($count > 1)
                                {
                                     echo '<h6 class="blue">From <b>'.date("F d, Y", strtotime($available_dates[0]['arrival_date'])).'</b> to <b>'.date("F d, Y", strtotime($available_dates[$count - 1]['arrival_date'])).'</b></h6>';
                                }
                                else
                                {
                                     echo '<h6 class="blue">From <b>'.date("F d, Y", strtotime($available_dates[0]['arrival_date'])).'</b></h6>';
                                }
                            }
                         ?>
                <p><?php the_field('tour_description', $tour_post_id); ?></p>
            </div>
            
			
			
            <div class="elements">
                <div>
                    <p><?php _e('Stars','um_lang');?></p>
                    <div class="ratingStars"></div>
                </div>
				<?php if(!get_field('disable_all_price','options')):?>
                <div>
                    <p><?php _e('Starts from','um_lang');?></p>
                    <a><?php the_field('tour_currency',$tour_post_id); the_field('price',$tour_post_id);  ?></a>
                </div>
				<?php endif;?>        
		</div>
        </div><!--END bookingDetails-->
		
      <?php endif;?>
        
   
      <form id="submitFBooking" method="post">  
        <?php wp_reset_postdata();?>
          <input type="hidden" value="ture" name="um_submitBooking">
            <div class="stepsHeader">
                <p><span><b>Only One Step</b> - </span>Fill Information</p>
            </div>
               <div class="stepsBody">
               
                <div> 
                    <label><b><?php _e('Email','um_lang');?></b></label><br/>
                    <input type="email" name="um_Email" id="um_Email" class="bookInputFieldsTwo"/>
               </div>
                <?php  

                $MendatoryfieldNames = array();
                 array_push($MendatoryfieldNames,'um_Email');
                $OtherfieldNames = array();
                    $fields = get_field('booking_field','options');
                    if($fields):
                
                    foreach($fields as $field):
                ?>
                <div>
                   <label><b><?php echo $field['field_name'] ?></b></label><br/>
                        <?php 

                switch($field['type'])
                {
                    case 'text':
                            echo '<input type="text" name="um_'.preg_replace($stripTags, '', $field['field_name']).'" id="um_'.preg_replace($stripTags, '', $field['field_name']).'"  class="bookInputFieldsTwo"/>';
                    break;
                    case 'num':
                        echo '<input type="num" name="um_'.preg_replace($stripTags, '',$field['field_name']).'" id="um_'.preg_replace($stripTags, '', $field['field_name']).'" class="spinner bookInputFieldsThree" min="0" value="0"/>';
                    break;
                    case 'date':
                        echo '<input type="datePick" name="um_'.preg_replace($stripTags, '', $field['field_name']).'" id="um_'.preg_replace($stripTags, '', $field['field_name']).'" class="datepicker bookInputFields" value=""/>';
                    break;
                    case 'phone':
                            echo '<input type="tel" name="um_'.preg_replace($stripTags, '', $field['field_name']).'" id="um_'.preg_replace($stripTags, '', $field['field_name']).'" class="bookInputFieldsTwo"/>';
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
                        ?>
               </div>
                    <?php 
                        endforeach;
                         endif;
                    ?>
               </div>
            <?php $checkForExtra = get_field('extra_text','options');
            if($checkForExtra):?>
              <div class="stepsBody last">
                <div>
                   <label><b><?php _e('Extra Message','um_lang');?></b></label><br/>
                   <textarea name="um_ExtraMessage" class="bookInputFields"></textarea>
                </div>
            </div>
            <?php endif;?>
        <div class="submitBody">
     <?php $checkForTerms = get_field('terms_and_conditions','options');
            if($checkForTerms):?>
				<div class="termsText"><input name="um_checkTerms" id="um_checkTerms" type="checkbox"><p id="terms"><?php the_field('terms_and_conditions_short_text','options');?></p></div>
			<?php else:?>
			<input type="hidden"  name="um_checkTerms" id="um_checkTerms" value="TRUE"/> 
			<?php endif;?>
			
            <input type="hidden" name="um_tourPostID" value="<?php echo $tour_post_id ?>" >

            <?php foreach ( $MendatoryfieldNames as $key => $value ): ?>
            <input type="hidden" name="um_MendatoryFieldNames[<?php echo preg_replace($stripTags,'',$key); ?>]" value="<?php echo preg_replace($stripTags,'',$value); ?>" >
            <?php endforeach ?>

             <?php foreach ( $OtherfieldNames as $key => $value ): ?>
            <input type="hidden" name="um_OtherFieldNames[<?php echo  preg_replace($stripTags,'',$key); ?>]" value="<?php echo preg_replace($stripTags,'',$value); ?>" >
            <?php endforeach ?>

            <input type="button"  class="bookFormBtnSubmit" value="Book Now">
            <input type="reset" class="bookFormBtnReset" value="Reset">
        </div>
     </form>
     <script>
              var array = <?php echo json_encode($MendatoryfieldNames);?>;
    </script>

     <div class="termsAndConditions">
         <?php
             the_field('terms_and_conditions_long_text','options'); 
         ?>
    </div>
     
    
        <div class="resultWrapper">
            <h3 class="orange"><?php _e("Thank You.","um_lang");?></h3>
            <p><?php _e("Your booking is complete.","um_lang");?></p>
            <p class="smile">:)</p>
        </div>
		
		
	<div class="tourAlert">
		<p><?php _e("Please choose a tour first!","um_lang");?></p>       
	</div>
           
        </div><!--END bookingContent-->

<?php get_footer(); ?>