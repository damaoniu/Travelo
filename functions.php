<?php
$theme_name = "Travelo-MPO Educational Travel";
$theme_version = "2.2";
global $theme_name;
global $theme_version;

define( 'ACF_LITE' , true );
include_once('advanced-custom-fields/acf.php' );
include "includes/post-types.php";
include "includes/filter-search.php";
include "includes/pagination.php";
include "includes/comment.php";
include "includes/booking.php";
include "includes/register-sidebar.php";
include 'includes/shortcodes.php';
include "includes/fragments.php";
include "includes/recaptchalib.php";
include "includes/custom-ajax.php";
//include "includes/quote_mail.php";
//include "googlemap/location-field.php";
include "includes/costume_fields.php";
include "widgets/widget-search-filter.php";
//include 'includes/quote_mail.php';
wp_require_once("/tgm/plugins.php");

add_action('acf/register_fields', 'register_fields');
function register_fields()
{
	include_once('registered-fields/presets/acf-presets.php');
	include_once('registered-fields/google-font/acf-googlefonts.php');
	include_once('registered-fields/googlemap/acf-googlemap.php');

	include_once('registered-fields/presets/acf-presets.php');
	include_once('registered-fields/google-font/acf-googlefonts.php');
	include_once('registered-fields/googlemap/acf-googlemap.php');
}

function my_acf_settings( $options )
{
    // activate add-ons
    $options['activation_codes']['repeater'] = 'QJF7-L4IX-UCNP-RF2W';
    $options['activation_codes']['options_page'] = 'OPN8-FA4J-Y2LW-81LS';
    $options['activation_codes']['flexible_content'] = 'FC9O-H6VN-E4CL-LT33';

    // set options page structure
    $options['options_page']['title'] = 'Umbrella';
    $options['options_page']['pages'] = array('Main', 'Filter' , 'Default Tour Attibutes' , 'Booking Options','Footer');

    return $options;
}
add_filter('acf_settings', 'my_acf_settings');


//register_field('register_field_group', dirname(__File__) . '/includes/costume_fields.php');

if(function_exists("register_options_page"))
{
	if(current_user_can('edit_theme_options')){
	    //$ico_dir = get_template_directory_uri()."/images/icons/small_icons/";
        register_options_page('Main','');
        register_options_page('Filter','');
        register_options_page('Default Tour Attibutes','');
        register_options_page('Booking Options','');
        register_options_page('Footer','');
		register_options_page('Shortcode Sliders','');
	}
}


load_theme_textdomain('um_lang', get_template_directory().'/lang');

add_action('after_setup_theme', 'my_theme_setup');
function my_theme_setup(){
	load_theme_textdomain('um_lang', get_template_directory().'/lang');
}

function wpex_clean_shortcodes($content){
$array = array (
    '<p>[' => '[',
    ']</p>' => ']',
    ']<br />' => ']'
);
$content = strtr($content, $array);
return $content;
}
add_filter('the_content', 'wpex_clean_shortcodes');


if ( !isset( $content_width ) ) $content_width = 900;

add_image_size("tour_preview", 300 , 165 , true);
add_image_size("staff_preview", 300 , 169 , true);
add_image_size("tour_footer", 65 , 65 , true);
add_image_size("logo", 153 , 41 , true);
add_image_size("page_featured_image", 1600 , 362 ,true);
add_image_size("home_slider_featured_image", 1600 , 550 ,true);
add_image_size("skitter-large",  800 , 300, true);
add_image_size("skitter-medium",  500 , 200, true);
add_image_size("skitter-small",  200 , 100, true);

$deffault_image = get_field('default_image','options');

if(isset($_POST["um_FilterSearch"]) && $_POST["um_FilterSearch"]){
    $_SESSION['filter_session'] = search_filter();
}

add_theme_support( 'automatic-feed-links' );
add_theme_support( 'post-thumbnails' );
/*
if(!get_option('acf_repeater_ac'))
{
	update_option('acf_repeater_ac', "QJF7-L4IX-UCNP-RF2W");
}
if(!get_option('acf_options_page_ac'))
{
	update_option('acf_options_page_ac', "OPN8-FA4J-Y2LW-81LS");
}
if(!get_option('acf_flexible_content_ac')){
	update_option('acf_flexible_content_ac', "FC9O-H6VN-E4CL-LT33");
}
*/

	function curPageURL() {
	 $pageURL = 'http';
	 if(isset($_SERVER["HTTPS"]))
	 {
	 if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
	 }
	 $pageURL .= "://";
	 if ($_SERVER["SERVER_PORT"] != "80") {
	  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
	 } else {
	  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
	 }
	 return $pageURL;
	}


function print_title()
{
    $title_layout = get_field("title_display_style","options");
    if(is_tag()){
        echo get_query_var("tag");
    }
    else if(is_category()){
        echo get_query_var("category_name");
    }
    else{
        if($title_layout == "name_title"){
        ?>
            <?php bloginfo("name"); ?> : <?php the_title(); ?>
        <?php
        }
        else if ($title_layout == "name"){
            bloginfo("name");
        }
        else{
            the_title();
        }
    }
}


/*Add Menu Support*/
	add_action( 'init', 'register_my_menus' );

	function register_my_menus() {
		register_nav_menus(
			array(
			'main_menu' => __( 'Main Menu',"um-lang" )

			)
		);
	}
/*Add Menu Support*/



add_action( 'admin_menu', 'my_remove_menu_pages' );

function my_remove_menu_pages() {
	global $wp_admin_bar;
	//remove_menu_page('edit.php?post_type=acf');
}


add_action( 'wp_enqueue_scripts', 'add_external_stylesheets' );
function add_external_stylesheets() {
wp_enqueue_style("main", get_stylesheet_uri() , false, "1.0");
//from right one
wp_enqueue_style("screen-css", get_template_directory_uri()."/screen.css" , false, "1.0");
wp_enqueue_style("custom-css", get_template_directory_uri()."/custom.css" , false, "1.0");
wp_enqueue_style("jslider-css", get_template_directory_uri()."/css/jslider.css" , false, "1.0");
wp_enqueue_style("customInput-css", get_template_directory_uri()."/css/customInput.css" , false, "1.0");
wp_enqueue_style("custom-theme-css", get_template_directory_uri()."/css/custom-theme/jquery-ui-1.8.20.custom.css" , false, "1.0");
//wp_enqueue_style("custom-theme-css-1", get_template_directory_uri()."/css/custom-theme/jquery-ui-1.10.3.custom.css" , false, "1.0");

wp_enqueue_style("cusel-css", get_template_directory_uri()."/css/cusel.css" , false, "1.0");
wp_enqueue_style("galleriffic-css", get_template_directory_uri()."/css/galleriffic.css" , false, "1.0");
wp_enqueue_style("qtip-css", get_template_directory_uri()."/css/jquery.qtip.css" , false, "1.0");
wp_enqueue_style("prettyPhoto-css", get_template_directory_uri()."/css/prettyPhoto.css" , false, "1.0");
wp_enqueue_style("shCore-css", get_template_directory_uri()."/css/shCore.css" , false, "1.0");
wp_enqueue_style("shThemeDefault-css", get_template_directory_uri()."/css/shThemeDefault.css" , false, "1.0");

//custom css
wp_enqueue_style("mpocss", get_template_directory_uri()."/css/mpo.css" , false, "1.0");



}

add_action( 'wp_enqueue_scripts', 'add_external_JS' );
function add_external_JS(){
		wp_enqueue_script('jquery');
		//use my own jquery
		//wp_enqueue_script("jquery", get_template_directory_uri()."/js/libs/jquery.min.js" , array(),'',TRUE);
		//wp_enqueue_script("customtheme-js", get_template_directory_uri()."/js/jquery-ui-1.8.20.custom.min.js" , array(),'',TRUE);
		//wp_enqueue_script("jquery_2", get_template_directory_uri()."/js/libs/jquery-1.10.2.js" , array(),'',TRUE);
		wp_enqueue_script("customtheme-js-1", get_template_directory_uri()."/js/jquery-ui-1.10.3.custom.js" , array(),'',TRUE);
		wp_enqueue_script("mpo", get_template_directory_uri()."/js/mpo.js" , array(),'',TRUE);

		wp_enqueue_script("google_map","https://maps.googleapis.com/maps/api/js?sensor=true",'','',TRUE);
		//wp_enqueue_script("script-js", get_template_directory_uri()."/js/script.js" , array(),'',TRUE);
		wp_enqueue_script("script_text-js", get_template_directory_uri()."/js/script_text.js" , array(),'',TRUE);

		wp_enqueue_script("cookie-js", get_template_directory_uri()."/js/jquery.cookie.js" , array(),'',TRUE);
		wp_enqueue_script("raty-js", get_template_directory_uri()."/js/jquery.raty.js" , array(),'',TRUE);
		wp_enqueue_script("rating-js", get_template_directory_uri()."/js/rating.js" , array(),'',TRUE);
		wp_enqueue_script("bookingFormValidator-js", get_template_directory_uri()."/js/bookingFormValidator.js" , array(),'',TRUE);
		wp_enqueue_script("bPopup-js", get_template_directory_uri()."/js/bPopup.js" , array(),'',TRUE);
		wp_enqueue_script("contactFormWidth-js", get_template_directory_uri()."/js/contactFormWidth.js" , array(),'',TRUE);
		wp_enqueue_script("shortcodesScript-js", get_template_directory_uri()."/js/shortcodesScript.js" , array(),'',TRUE);
		//from right one

		wp_enqueue_script("respond", get_template_directory_uri()."/js/libs/respond.min.js" , array(),'',TRUE);
		wp_enqueue_script("Modenizer-js", get_template_directory_uri()."/js/libs/modernizr-2.5.3.min.js" , array(),'',TRUE);
		wp_enqueue_script("easing-js", get_template_directory_uri()."/js/jquery.easing.1.3.min.js" , array(),'',TRUE);
		wp_enqueue_script("hoverIntent", get_template_directory_uri()."/js/hoverIntent.js" , array(),'',TRUE);
		wp_enqueue_script("general", get_template_directory_uri()."/js/general.js" , array(),'',TRUE);
		wp_enqueue_script("custom", get_template_directory_uri()."/js/custom.js" , array(),'',TRUE);
		wp_enqueue_script("slide-min", get_template_directory_uri()."/js/slides.min.jquery.js" , array(),'',TRUE);
		wp_enqueue_script("slider-bundle", get_template_directory_uri()."/js/jquery.slider.bundle.js" , array(),'',TRUE);
		wp_enqueue_script("jquery-slider", get_template_directory_uri()."/js/jquery.slider.js" , array(),'',TRUE);
		wp_enqueue_script("slider-bundle", get_template_directory_uri()."/js/jquery.slider.bundle.js" , array(),'',TRUE);
		wp_enqueue_script("customInput-js", get_template_directory_uri()."/js/jquery.customInput.js" , array(),'',TRUE);

		wp_enqueue_script("datespicker-js", get_template_directory_uri()."/js/jquery-ui.multidatespicker.js" , array(),'',TRUE);
		wp_enqueue_script("gallerif-js", get_template_directory_uri()."/js/jquery.galleriffic.min.js" , array(),'',TRUE);
		wp_enqueue_script("opacityrollover-js", get_template_directory_uri()."/js/jquery.opacityrollover.js" , array(),'',TRUE);
		wp_enqueue_script("prettyPhoto-js", get_template_directory_uri()."/js/jquery.prettyPhoto.js" , array(),'',TRUE);
		wp_enqueue_script("mousewheel-js", get_template_directory_uri()."/js/jquery.mousewheel.js" , array(),'',TRUE);
		wp_enqueue_script("jScrollpane-js", get_template_directory_uri()."/js/jScrollPane.min.js" , array(),'',TRUE);
		wp_enqueue_script("jcarousel-js", get_template_directory_uri()."/js/jquery.jcarousel.min.js" , array(),'',TRUE);
		wp_enqueue_script("tools-js", get_template_directory_uri()."/js/jquery.tools.min.js" , array(),'',TRUE);
		wp_enqueue_script("cusel-min-js", get_template_directory_uri()."/js/cusel-min.js" , array(),'',TRUE);
		wp_enqueue_script("shCore-js", get_template_directory_uri()."/js/shCore.js" , array(),'',TRUE);
		wp_enqueue_script("gmap-js", get_template_directory_uri()."/js/jquery.gmap.min.js" , array(),'',TRUE);
		wp_enqueue_script("cusel-min-js", get_template_directory_uri()."/js/shBrushPlain.js" , array(),'',TRUE);


		//end right one


		if ( is_singular() ){
			wp_enqueue_script( 'comment-reply','',array(),'',TRUE );
		}

}

function wp_require_once($path)
{
    $UM_TEMPLATEPATH = str_replace("\\", "/", get_template_directory());
    $UM_STYLESHEETPATH = str_replace("\\", "/", get_stylesheet_directory());
    if( $UM_TEMPLATEPATH != $UM_STYLESHEETPATH && is_file($UM_STYLESHEETPATH . $path) )
        require_once ($UM_STYLESHEETPATH . $path);
    else
        require_once ($UM_TEMPLATEPATH . $path);
}


/*****************************************
now choose tours according to chosen city
******************************************/
function samplePackage(){
  ?>
  <div class="inner">
 	<?php
        if(isset($_POST['cities'])):
     		$queries=$_POST['cities'];
        $queries= strtolower($queries);
        $queries = explode(",", $queries);
        $query_ids = array ();
     		foreach ($queries as $query):
            $query = explode(":", $query);
            $city = trim($query[0]);
            $country = trim($query[1]);
            $arg = array (
              'post_type' => 'tours_post',
              'um_'.toAscii($country) => $city,
              'sample_tour' => 'no',
              'posts_per_page'=> -1
              );
            $maybes = new WP_Query($arg);
            while ($maybes->have_posts()):
                    $maybes->the_post();
                    $id=get_the_ID();
                   if(!in_array($id, $query_ids)):
                     array_push($query_ids, $id);
            ?>
                <div class="prod_itemNew">
                  <div class="prod_image">
                    <?php
                    $tour_images = get_field('tour_slider');
                     if ($tour_images):
                    ?>
                    <a href="<?php the_permalink();?>">
                    <img src="<?php echo $tour_images[0]['image'];?>" width="140" height="98" alt="">
                    </a>
                    <?php endif;?>
                  </div>
                  <span class="price_box">
                    <?php if(!get_field('disable_all_price','options')):?>
                    <ins><?php the_field('tour_currency');?></ins><strong><?php the_field('price');?></strong>
                    <?php endif; ?>
                  </span>
                  <div class="prod_title">
                      <a href="<?php the_permalink();?>"><strong><?php the_title();?></strong></a><br>
                    <span class="title"><a href="<?php the_permalink();?>" class="link-map" hidefocus="true" style="outline:none;"></a></span>
                  </div>
                </div>
          <?php
            endif;
           endwhile;
           wp_reset_postdata();
          endforeach;
          $query_ids = array ();
      endif;
          ?>
    <div class="clear"></div>
  </div>
<?php
die();
 }
 add_action( 'wp_ajax_nopriv_samplePackage', 'samplePackage' );
 add_action( 'wp_ajax_samplePackage', 'samplePackage' );
/**********************************************
  To get the activities in a City
***********************************************/
function sampleActivity(){

  	if(isset($_POST['city'])&&isset($_POST['country'])):
 		$city=strtolower($_POST['city']);
 		$country=strtolower($_POST['country']);
 		$country = explode("_", $country);
 		$country = $country[0];
    //echo $city.$country;
        $arg=array(
     			'post_type'=>'activity',
     			'um_'.toAscii($country)=>$city,
     			'posts_per_page'=>-1
     			);
 			  $activity_query=new WP_Query($arg);
        if($activity_query->have_posts()):?>
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
 			  <?php while($activity_query->have_posts()):
 					$activity_query->the_post();
          $title=get_the_title();
          $id=get_the_ID();
          if(get_field('link')){
              $link =get_field('link');
          }
 					?>
 					<div class="prod_itemNew"<?php show_subjects_new($id);?>>
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
                  <span><input  type="checkbox" name="activity" id="<?php echo $title;?>" value="<?php echo $title;?>"></span><?php the_title();?>
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
            <!--span class="faq_question toggle" >
              <span class="faq_q">
              <label for="<?php //echo $title;?>"><?php //the_title();?></label>
              </span>
              <span class="ico"></span>
            </span>
            <div class="faq_answer toggle_content" style="display: none;">
              <p><?php the_content();?><a class="btn_big" target="blank" href="<?php //echo $link;?>">Website</a></p>
            </div-->
          </div>


	      <?php endwhile;
	        wp_reset_postdata();?>
          </div>
        </div>
        <?php else:
          echo "<em>Activities in this city will come up soon!</em>";
        endif;
  	endif;
 	die();
 }

add_action( 'wp_ajax_nopriv_sampleActivity', 'sampleActivity' );
add_action( 'wp_ajax_sampleActivity', 'sampleActivity' );

function show_subjects($ID){
    $subjects=get_the_terms($ID,'um_'.toAscii("subjects"));
    if($subjects):
      foreach ($subjects as $subject):
        echo $subject->slug."=$subject->slug ";
      endforeach;
    endif;
}
function show_subjects_new($id){
  $subjects=get_the_terms($ID,'um_'.toAscii("subjects"));
    $art = false;
    if($subjects):
      foreach ($subjects as $subject):
        if($subject->slug=="arts"){
          $art=true;
        }
        echo $subject->slug."=$subject->slug ";
      endforeach;
    endif;
    if(!$art){
      //echo "style='display:none;'";
    }
}

/**********************************************************************************
function used in the before_content filter to  filter the packages for the customer
***********************************************************************************/
function packages(){
                    $arg = search_filter();
                    $packages= new WP_Query($arg);
                    $number=$packages->found_posts;
                    $city = $_POST['city_auto'];
                    $country =$_POST['country'];

                    ?>

                    <div class="title">
                    	<?php
                    	if($city&&$country):
                    	?>
                        <h1>Packages IN <span><?php echo $_POST['city'] ?>:</span></h1>
                        <?php else:?>
                        <h1>All packages: </h1><span>Please specify more terms!</span>
                    	<?php endif;?>
                        <span class="title_right count"><span class="author"><?php echo $number;?></span> available packages</span>
                    </div>
                	<!-- sorting,pagination pages -->

                    <?php if($packages->max_num_pages > 1):
                          if (function_exists("pagination")) {
                             pagination($packages->max_num_pages,1);
                            }
                    endif;
                    ?>
                    <!--/ sorting, pages -->
                    <!--package list-->
                    <?php if($packages->have_posts()):?>
                    <div class="re-list">
                        <?php
                             while($packages->have_posts()):
                                if (!get_field('sample_tour')):
                                    $packages->the_post();
                                    $price=get_field('price');
                                    $currency=get_field('currency');
                            ?>
                            <div class="re-item">
                                <div class="re-image">
                                    <a href="<?php the_permalink();?>" hidefocus="true" style="outline: none; overflow:hidden;">
                                        <?php
                                            $tour_images = get_field('tour_slider');
                                            if($tour_images):

                                            ?>
                                                <img src="<?php echo $tour_images[0]['image']; ?>">
                                            <?php

                                                endif;
                                        ?>
                                        <span class="caption">View More Details</span>
                                    </a>
                                </div>

                                <div class="re-short">
                                    <div class="re-top">
                                        <h2><a href="<?php the_permalink();?>" hidefocus="true" style="outline: none;"><?php the_title();?></a></h2>
                                    </div>
                                    <div class="re-descr">
                                        <p><?php the_content();?></p>
                                    </div>

                                </div>
                                <div class="re-bot">
                                        <span class="re-price">Price: <strong><?php echo $currency.$price;?></strong></span>
                                        <a href="<?php the_permalink();?>" class="link-viewimages" title="View Photos" hidefocus="true" style="outline: none;">Photos</a>
                                </div>
                                <div class="clear"></div>
                            </div>
                        <?php
                        	 endif;
                            endwhile;
                            else:
                            ?>
                            <div class="resultWrapper">
	                            <h3 class="orange"> <?php  _e('No results.','um_lang'); ?> </h3>
	                            <p> <?php  _e("Sorry we couldn't find any results.","um_lang"); ?></p>
	                            <p class="smile">:(</p>
	                        </div>
                        <?php endif;?>
                    </div>
<?php wp_reset_postdata();
die();
}
add_action('wp_ajax_nopriv_packages','packages');
add_action('wp_ajax_packages','packages');

//stop csrf from the search form
function SearchFilter($query) {

    // If 's' request variable is set but empty
  if(!is_admin()){
    if (isset($_GET['s'])){
      $nonce = $_GET['search_nonce'];
      if(!wp_verify_nonce($nonce,'search_nonce')){
        die('sorry no csrf is allowed');
       }else{
        $query->is_search = true;
        $query->is_home = false;
        return $query;
       }

    }
  }


}
add_action('pre_get_posts','SearchFilter');

#stop wordpress from redirecting


#remove_action('template_redirect', 'redirect_canonical');
#remove_filter('template_redirect', 'redirect_canonical');

include_once 'includes/surgewp_functions.php';

?>