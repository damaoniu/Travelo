<?php
/*shortcode*/

/*blockqute*/
add_shortcode('blockquote', 'umbrella_blockquotes_shortcode');
function umbrella_blockquotes_shortcode($atts, $content)
{
	extract(shortcode_atts( array('type' => ''), $atts));
		return '<div class="blockquoteBody"><blockquote>'.$content.'</blockquote></div>';	
}
add_action('init', 'blockquote_btn');
function blockquote_btn() {	 
		if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') ) {
			return;
		}	 
		add_filter( 'mce_external_plugins', 'add_plugin' ); 
        add_filter( 'mce_buttons_3', 'register_button' );
	}
/*blockqute*/
/*h1*/
add_shortcode('h1', 'umbrella_h1_shortcode');
function umbrella_h1_shortcode($atts, $content)
{
	extract(shortcode_atts( array('type' => ''), $atts));
		return '  <h1 class="heading1">'.$content.'</h1>';	
}
add_action('init', 'h1_btn');
function h1_btn() {	 
		if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') ) {
			return;
		}	 
		add_filter( 'mce_external_plugins', 'add_plugin' ); 
        add_filter( 'mce_buttons_3', 'register_button' );
	}
/*h1*/
/*h2*/
add_shortcode('h2', 'umbrella_h2_shortcode');
function umbrella_h2_shortcode($atts, $content)
{
	extract(shortcode_atts( array('type' => ''), $atts));
		return '  <h2 class="heading2">'.$content.'</h2>';	
}
add_action('init', 'h2_btn');
function h2_btn() {	 
		if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') ) {
			return;
		}	 
		add_filter( 'mce_external_plugins', 'add_plugin' ); 
        add_filter( 'mce_buttons_3', 'register_button' );
	}
/*h2*/
/*h3*/
add_shortcode('h3', 'umbrella_h3_shortcode');
function umbrella_h3_shortcode($atts, $content)
{
	extract(shortcode_atts( array('type' => ''), $atts));
		return '  <h3 class="heading3">'.$content.'</h3>';	
}
add_action('init', 'h3_btn');
function h3_btn() {	 
		if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') ) {
			return;
		}	 
		add_filter( 'mce_external_plugins', 'add_plugin' ); 
        add_filter( 'mce_buttons_3', 'register_button' );
	}
/*h3*/
/*h4*/
add_shortcode('h4', 'umbrella_h4_shortcode');
function umbrella_h4_shortcode($atts, $content)
{
	extract(shortcode_atts( array('type' => ''), $atts));
		return '  <h4 class="heading4">'.$content.'</h4>';	
}
add_action('init', 'h4_btn');
function h4_btn() {	 
		if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') ) {
			return;
		}	 
		add_filter( 'mce_external_plugins', 'add_plugin' ); 
        add_filter( 'mce_buttons_3', 'register_button' );
	}
/*h4*/
/*h5*/
add_shortcode('h5', 'umbrella_h5_shortcode');
function umbrella_h5_shortcode($atts, $content)
{
	extract(shortcode_atts( array('type' => ''), $atts));
		return '  <h5 class="heading5">'.$content.'</h5>';	
}
add_action('init', 'h5_btn');
function h5_btn() {	 
		if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') ) {
			return;
		}	 
		add_filter( 'mce_external_plugins', 'add_plugin' ); 
        add_filter( 'mce_buttons_3', 'register_button' );
	}
/*h5*/
/*h6*/
add_shortcode('h6', 'umbrella_h6_shortcode');
function umbrella_h6_shortcode($atts, $content)
{
	extract(shortcode_atts( array('type' => ''), $atts));
		return '  <h6 class="heading6">'.$content.'</h6>';	
}
add_action('init', 'h6_btn');
function h6_btn() {	 
		if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') ) {
			return;
		}	 
		add_filter( 'mce_external_plugins', 'add_plugin' ); 
        add_filter( 'mce_buttons_3', 'register_button' );
	}
/*h6*/









/*Accordion Item*/
function umbrella_accordion_item_shortcode($atts, $content){
	extract(shortcode_atts( array('title' => ''), $atts)); 
	$return_statement = '<div class="accHeader"><h5>'.$title.'</h5></div><div class="accBody"><p>'.$content.'</p></div>';
return $return_statement;
}

add_shortcode('accordion_item', 'umbrella_accordion_item_shortcode');
/*Accordion Item*/
/*Accordion*/
function umbrella_accordion_shortcode($atts, $content){
	$content = do_shortcode($content);
	$return_statement = "
 <div class=\"accordion\">
		{$content}
    </div>";
	return $return_statement;
}
add_shortcode('accordion', 'umbrella_accordion_shortcode');
/*Accordion*/

/*Tab*/
function umbrella_tab_shortcode($atts, $content){
	extract(shortcode_atts( array('title' => ''), $atts)); 
	$return_statement = '<div class="tab-all" data-title='.$title.'>'.$content.'</div>';
	return $return_statement;
}
add_shortcode('tab', 'umbrella_tab_shortcode');
/*Tab*/


/*Tab Group*/
function umbrella_tabgroup_shortcode($atts, $content){
	$content = do_shortcode($content);
	$return_statement ='<div class="tabsWrapper">
                            <div class="tabs">
                                <div class="tabsHeader"></div>
                                <div class ="tabsBody"></div>
                            </div>
                        
                            <div class="tabAllHolder">'.$content.'</div>
                        </div>';
	return $return_statement;
}
add_shortcode('tabgroup', 'umbrella_tabgroup_shortcode');
/*Tab Group*/


/*Button*/
function umbrella_button_shortcode($atts, $content){
	extract(shortcode_atts( array('link' => ''), $atts)); 
	$return_statement = '<a href="'.$link.'">'.$content.'</a>';
	return $return_statement;
}
add_shortcode('button', 'umbrella_button_shortcode');
/*Button*/

/*buttonWhite*/
function umbrella_buttonWhite_shortcode($atts, $content){
	$content = do_shortcode($content);
	$return_statement =' <div class="button type1">'.$content.'</div>';
	return $return_statement;
}
add_shortcode('buttonWhite', 'umbrella_buttonWhite_shortcode');
/*buttonWhite*/
/*buttonBlack*/
function umbrella_buttonBlack_shortcode($atts, $content){
	$content = do_shortcode($content);
	$return_statement =' <div class="button type6">'.$content.'</div>';
	return $return_statement;
}
add_shortcode('buttonBlack', 'umbrella_buttonBlack_shortcode');
/*buttonBlack*/
/*buttonBlue*/
function umbrella_buttonBlue_shortcode($atts, $content){
	$content = do_shortcode($content);
	$return_statement =' <div class="button type2">'.$content.'</div>';
	return $return_statement;
}
add_shortcode('buttonBlue', 'umbrella_buttonBlue_shortcode');
/*buttonBlue*/
/*buttonGreen*/
function umbrella_buttonGreen_shortcode($atts, $content){
	$content = do_shortcode($content);
	$return_statement =' <div class="button type3">'.$content.'</div>';
	return $return_statement;
}
add_shortcode('buttonGreen', 'umbrella_buttonGreen_shortcode');
/*buttonGreen*/
/*buttonOrange*/
function umbrella_buttonOrange_shortcode($atts, $content){
	$content = do_shortcode($content);
	$return_statement =' <div class="button type5">'.$content.'</div>';
	return $return_statement;
}
add_shortcode('buttonOrange', 'umbrella_buttonOrange_shortcode');
/*buttonOrange*/
/*buttonRed*/
function umbrella_buttonRed_shortcode($atts, $content){
	$content = do_shortcode($content);
	$return_statement =' <div class="button type4">'.$content.'</div>';
	return $return_statement;
}
add_shortcode('buttonRed', 'umbrella_buttonRed_shortcode');
/*buttonRed*/




/*tours*/
function umbrella_tours_shortcode(){
	
	$args1 = array(
    'post_type' => 'tours_post',
    'posts_per_page' => -1
    );
	global $post;
$the_query = new WP_Query($args1);
	
	
	$return_statement = '<div class="bucketWrapper toursShortcode"><ul class="prettyGallery">';

		while ( $the_query->have_posts() ) {
			$the_query->the_post();
			$return_statement .= '<li><div class="bucket">';
			if(!get_field('disable_all_price','options'))
			{
				$return_statement .= '<h5><b>'. get_field('tour_currency') .' '. get_field('price').'</b></h5>';
			}
				$return_statement .= '<div class="imgHover"></div>';
                        if ( has_post_thumbnail() ) {
	                        
							
							$return_statement .=  get_the_post_thumbnail( $post->ID, 'tour_preview');
							
						}
                        else {
	                       $return_statement .=  '<div class="bucketImgDefault"></div>';
                        }
                $return_statement .= '<div class="bucketContent"><a href="'.get_permalink().'"><h3>'.get_the_title().'</h3></a>';
		}
    $return_statement .= '</ul></div>';
	return $return_statement;
}
add_shortcode('tours', 'umbrella_tours_shortcode');
/*tours*/

/*fontAwesome*/
function umbrella_fontAwesome_shortcode($atts, $content){
    $content = do_shortcode($content);
    extract(shortcode_atts( array('name' => ''), $atts));
	extract(shortcode_atts( array('size' => ''), $atts));
    

    $size = $atts['size'];
	$name = $atts['name'];
    
   
    $return_statement = '<i class="um_icon '.$name.' '.$size.'"></i>';
    return $return_statement;
}
add_shortcode('fontAwesome', 'umbrella_fontAwesome_shortcode');

/*fontAwesome*/

/*1/2*/
function umbrella_column_1_2_shortcode($atts, $content){
    $content = do_shortcode($content);
    $return_statement = '<div class="half"><p>'. $content.'</p></div>';
    return $return_statement;
}
add_shortcode('column_1_2', 'umbrella_column_1_2_shortcode');
/*1/2*/
/*1/3*/
function umbrella_column_1_3_shortcode($atts, $content){
    $content = do_shortcode($content);
    $return_statement = "<div class=\"third\"><p>". $content."</p></div>";
    return $return_statement;
}
add_shortcode('column_1_3', 'umbrella_column_1_3_shortcode');
/*1/3*/
/*1/4*/
function umbrella_column_1_4_shortcode($atts, $content){
    $content = do_shortcode($content);
    $return_statement = "<div class=\"quarter\"><p>".$content."</p></div>";
    return $return_statement;
}
add_shortcode('column_1_4', 'umbrella_column_1_4_shortcode');
/*1/4*/
/*1/6*/
function umbrella_column_1_6_shortcode($atts, $content){
    $content = do_shortcode($content);
    $return_statement = "<div class=\"sixth\"><p>". $content."</p></div>";
    return $return_statement;
}
add_shortcode('column_1_6', 'umbrella_column_1_6_shortcode');
/*1/6*/




/*Slider*/
function umbrella_Slider_shortcode($atts){
    //$content = do_shortcode($content);
    extract(shortcode_atts( array('name' => ''), $atts));
    $name = $atts['name'];
	$return_statement = "";
	$sliders = get_field('sliders','options');
	if($sliders)
	{
		foreach( $sliders as $slider)
		{
			if($slider['slider_name'] == $name)
			{
					$theme = 'skitter-'.$slider['theme'];
					$size = 'box_skitter_'.$slider['size'];
				
					if($slider['size'] == 'large')
					{
						$imageSize = 'skitter-large';
					}
					elseif($slider['size'] == 'medium')
					{
						$imageSize = 'skitter-medium';
					}
					else
					{
						$imageSize = 'skitter-small';
					}
						
					$images = $slider['images'];
					if($images)
					{
						$return_statement = '<div class="'.$theme.' box_skitter '.$size.'"><ul>';
								foreach($images as $image)
								{
									$img = wp_get_attachment_image_src( $image['image'], $imageSize );
									
									$return_statement .= '<li><img class="'.$image['image_effet'].'" src ="'.$img[0].'"/><div class="label_text"><p>'.$image['image_description'].'</p></div></li>';
								}
						$return_statement.='</ul></div>';
												
					}
			}
		}
	}
	
    return $return_statement;
}
add_shortcode('Slider', 'umbrella_Slider_shortcode');
/*Slider*/

/*Activity Shortcode*/
function activity_shortcode(){


}

add_shortcode('Activity','activity_shortcode');
/*shortcode*/


/*Generics use the hooks above*/
function register_button( $buttons ) {
	array_push( $buttons, "blockquote_btn" );

    array_push( $buttons, "accordion" );
    array_push( $buttons, "tabs" );
    array_push( $buttons, "buttonWhite" );
	array_push( $buttons, "buttonBlack" );
    array_push( $buttons, "buttonBlue" );
    array_push( $buttons, "buttonGreen" );
    array_push( $buttons, "buttonOrange" );
    array_push( $buttons, "buttonRed" );
	array_push( $buttons, "tours" );
	 array_push( $buttons, "Slider" );
	return $buttons;
}
add_filter('mce_buttons_3', 'register_button');


function register_button_4( $buttons ) {
	array_push($buttons,'fontAwesome');
	array_push( $buttons, "h1_btn" );
    array_push( $buttons, "h2_btn" );
    array_push( $buttons, "h3_btn" );
    array_push( $buttons, "h4_btn" );
    array_push( $buttons, "h5_btn" );
    array_push( $buttons, "h6_btn" );
	array_push( $buttons, "column_1_2" );
    array_push( $buttons, "column_1_3" );
    array_push( $buttons, "column_1_4" );
    array_push( $buttons, "column_1_6" );
    return $buttons;
}
add_filter('mce_buttons_4', 'register_button_4');
function add_plugin( $plugin_array ) {
	$plugin_array['blockquote_btn'] = get_template_directory_uri() . '/includes/tiny_mce_buttons.js';	
    $plugin_array['h1_btn'] = get_template_directory_uri() . '/includes/tiny_mce_buttons.js';	
    $plugin_array['h2_btn'] = get_template_directory_uri() . '/includes/tiny_mce_buttons.js';
    $plugin_array['h3_btn'] = get_template_directory_uri() . '/includes/tiny_mce_buttons.js';
    $plugin_array['h4_btn'] = get_template_directory_uri() . '/includes/tiny_mce_buttons.js';
    $plugin_array['h5_btn'] = get_template_directory_uri() . '/includes/tiny_mce_buttons.js';
    $plugin_array['h6_btn'] = get_template_directory_uri() . '/includes/tiny_mce_buttons.js';
    $plugin_array['accordion'] = get_template_directory_uri() . '/includes/tiny_mce_buttons.js';
    $plugin_array['tabs'] = get_template_directory_uri() . '/includes/tiny_mce_buttons.js';	
    $plugin_array['buttonWhite'] = get_template_directory_uri() . '/includes/tiny_mce_buttons.js';	
	$plugin_array['buttonBlack'] = get_template_directory_uri() . '/includes/tiny_mce_buttons.js';
    $plugin_array['buttonBlue'] = get_template_directory_uri() . '/includes/tiny_mce_buttons.js';
    $plugin_array['buttonGreen'] = get_template_directory_uri() . '/includes/tiny_mce_buttons.js';
    $plugin_array['buttonOrange'] = get_template_directory_uri() . '/includes/tiny_mce_buttons.js';
    $plugin_array['buttonRed'] = get_template_directory_uri() . '/includes/tiny_mce_buttons.js';
	$plugin_array['tours'] = get_template_directory_uri() . '/includes/tiny_mce_buttons.js';
	$plugin_array['fontAwesome'] = get_template_directory_uri() . '/includes/tiny_mce_buttons.js';
	$plugin_array['column_1_2'] = get_template_directory_uri() . '/includes/tiny_mce_buttons.js';
    $plugin_array['column_1_3'] = get_template_directory_uri() . '/includes/tiny_mce_buttons.js';
    $plugin_array['column_1_4'] = get_template_directory_uri() . '/includes/tiny_mce_buttons.js';
    $plugin_array['column_1_6'] = get_template_directory_uri() . '/includes/tiny_mce_buttons.js';
	$plugin_array['Slider'] = get_template_directory_uri() . '/includes/tiny_mce_buttons.js';
    return $plugin_array;
}
/*Generics*/
	
?>