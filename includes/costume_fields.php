<?php
/**
 *  Install Add-ons
 *
 *  The following code will include all 4 premium Add-Ons in your theme.
 *  Please do not attempt to include a file which does not exist. This will produce an error.
 *
 *  All fields must be included during the 'acf/register_fields' action.
 *  Other types of Add-ons (like the options page) can be included outside of this action.
 *
 *  The following code assumes you have a folder 'add-ons' inside your theme.
 *
 *  IMPORTANT
 *  Add-ons may be included in a premium theme as outlined in the terms and conditions.
 *  However, they are NOT to be included in a premium / free plugin.
 *  For more information, please read http://www.advancedcustomfields.com/terms-conditions/
 */

// Fields
add_action('acf/register_fields', 'my_register_fields');

function my_register_fields()
{
	include_once('add-ons/acf-repeater/repeater.php');
	//include_once('add-ons/acf-gallery/gallery.php');
	include_once('add-ons/acf-flexible-content/flexible-content.php');
}

// Options Page
include_once( 'add-ons/acf-options-page/acf-options-page.php' );


/**
 *  Register Field Groups
 *
 *  The register_field_group function accepts 1 array which holds the relevant data to register a field group
 *  You may edit the array as you see fit. However, this may result in errors if the array is not compatible with ACF
 */


if(function_exists("register_field_group"))
{
register_field_group(array (
		'id' => 'acf_main',
		'title' => 'Main',
		'fields' => array (
			array (
				'key' => 'field_51d4377064949',
				'label' => 'Skins',
				'name' => 'skins',
				'type' => 'radio',
				'instructions' => 'Choose a skin for your website',
				'multiple' => 0,
				'allow_null' => 0,
				'choices' => array (
					'skin_default.css' => 'Default',
					'skin_blue.css' => 'Blue',
					'skin_green.css' => 'Green',
					'skin_orange.css' => 'Orange',
					'skin_pink.css' => 'Pink',
					'skin_purple.css' => 'Purple',
				),
				'default_value' => '',
				'layout' => 'vertical',
			),
			array (
				'key' => 'field_51e4211bf77b9',
				'label' => 'Google Fonts',
				'name' => 'google_fonts',
				'type' => 'googlefonts',
				'instructions' => 'Choose a font for you website',
			),
			array (
				'key' => 'field_51e54b3aaec15',
				'label' => 'Disable Responsive',
				'name' => 'disable_responsive',
				'type' => 'true_false',
				'instructions' => 'Click if you want to disable Responsive',
				'message' => '',
				'default_value' => 0,
			),
			array (
				'key' => 'field_51caf3141c21e',
				'label' => 'Disable all price',
				'name' => 'disable_all_price',
				'type' => 'true_false',
				'instructions' => 'Disables all the precises',
				'message' => '',
				'default_value' => 0,
			),
			array (
				'key' => 'field_51cc5fba3b2c2',
				'label' => 'Right Sidebar',
				'name' => 'right_sidebar',
				'type' => 'true_false',
				'instructions' => 'To setup the sidebar in the Right side.',
				'message' => '',
				'default_value' => 0,
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'options_page',
					'operator' => '==',
					'value' => 'acf-options-main',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
	register_field_group(array (
		'id' => 'acf_revslider',
		'title' => 'RevSlider',
		'fields' => array (
			array (
				'key' => 'field_51e409e870ea2',
				'label' => 'Do shortcode',
				'name' => 'do_shortcode',
				'type' => 'text',
				'instructions' => 'Add the short code of the RevSlider here to appear on the header.',
				'default_value' => '',
				'formatting' => 'html',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'page',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'tours_post',
					'order_no' => 0,
					'group_no' => 1,
				),
			),
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'post',
					'order_no' => 0,
					'group_no' => 2,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'no_box',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
	register_field_group(array (
		'id' => 'acf_short-code-sliders',
		'title' => 'Short-code Sliders',
		'fields' => array (
			array (
				'key' => 'field_51d19c62d4eb6',
				'label' => 'Sliders',
				'name' => 'sliders',
				'type' => 'repeater',
				'instructions' => 'Use "Add Slider" button to add a new Slider',
				'sub_fields' => array (
					array (
						'key' => 'field_51d19cbbd4eb7',
						'label' => 'Unique Slider Name',
						'name' => 'slider_name',
						'type' => 'text',
						'instructions' => 'Use this Slider name for the shortcode -	Name must be unique.',
						'column_width' => 100,
						'default_value' => '',
						'formatting' => 'html',
					),
					array (
						'key' => 'field_51d19d40d4eb8',
						'label' => 'Theme',
						'name' => 'theme',
						'type' => 'select',
						'multiple' => 0,
						'allow_null' => 0,
						'choices' => array (
							'' => 'Default',
							'minimalist' => 'Minimalist',
							'round' => 'Round',
							'clean' => 'Clean',
							'square' => 'Square',
						),
						'default_value' => '',
						'column_width' => 100,
					),
					array (
						'key' => 'field_51d19d7dd4eb9',
						'label' => 'Size',
						'name' => 'size',
						'type' => 'select',
						'multiple' => 0,
						'allow_null' => 0,
						'choices' => array (
							'large' => 'Large',
							'medium' => 'Medium',
							'small' => 'Small',
						),
						'default_value' => '',
						'column_width' => 100,
					),
					array (
						'key' => 'field_51d19da8d4eba',
						'label' => 'Images',
						'name' => 'images',
						'type' => 'repeater',
						'instructions' => 'Use "Add Image" button to add a new image to the slider',
						'column_width' => 100,
						'sub_fields' => array (
							array (
								'key' => 'field_51d19dc0d4ebb',
								'label' => 'Image',
								'name' => 'image',
								'type' => 'image',
								'column_width' => '',
								'save_format' => 'id',
								'preview_size' => 'thumbnail',
							),
							array (
								'key' => 'field_51d19e4dd4ebd',
								'label' => 'Image Description',
								'name' => 'image_description',
								'type' => 'textarea',
								'column_width' => '',
								'default_value' => '',
								'formatting' => 'br',
							),
							array (
								'key' => 'field_51d19debd4ebc',
								'label' => 'Image Effet',
								'name' => 'image_effet',
								'type' => 'select',
								'multiple' => 0,
								'allow_null' => 0,
								'choices' => array (
									'random' => 'random',
									'randomSmart' => 'randomSmart',
									'cube' => 'cube',
									'cubeRandom' => 'cubeRandom',
									'block' => 'block',
									'cubeStop' => 'cubeStop',
									'cubeHide' => 'cubeHide',
									'cubeSize' => 'cubeSize',
									'horizontal' => 'horizontal',
									'showBars' => 'showBars',
									'showBarsRandom' => 'showBarsRandom',
									'tube' => 'tube',
									'fade' => 'fade',
									'fadeFour' => 'fadeFour',
									'paralell' => 'paralell',
									'blind' => 'blind',
									'blindHeight' => 'blindHeight',
									'blindWidth' => 'blindWidth',
									'directionTop' => 'directionTop',
									'directionBottom' => 'directionBottom',
									'directionRight' => 'directionRight',
									'directionLeft' => 'directionLeft',
									'cubeStopRandom' => 'cubeStopRandom',
									'cubeSpread' => 'cubeSpread',
									'cubeJelly' => 'cubeJelly',
									'glassCube' => 'glassCube',
									'glassBlock' => 'glassBlock',
									'circles' => 'circles',
									'circlesInside' => 'circlesInside',
									'circlesRotate' => 'circlesRotate',
									'cubeShow' => 'cubeShow',
									'upBars' => 'upBars',
									'downBars' => 'downBars',
									'hideBars' => 'hideBars',
									'swapBars' => 'swapBars',
									'swapBarsBack' => 'swapBarsBack',
									'swapBlocks' => 'swapBlocks',
									'cut' => 'cut',
								),
								'default_value' => '',
								'column_width' => '',
							),
						),
						'row_min' => 0,
						'row_limit' => '',
						'layout' => 'table',
						'button_label' => 'Add Image',
					),
				),
				'row_min' => 0,
				'row_limit' => '',
				'layout' => 'row',
				'button_label' => 'Add Slider',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'options_page',
					'operator' => '==',
					'value' => 'acf-options-shortcode-sliders',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
	register_field_group(array (
		'id' => '5166a916cb118',
		'title' => 'About Fields',
		'fields' =>
		array (
			0 =>
			array (
				'key' => 'field_51543c4cdcff1',
				'label' => 'Video',
				'name' => 'about_video',
				'type' => 'text',
				'instructions' => 'the code of your video like:XA-v7QorIck',
				'required' => '0',
				'column_width' => '',
				'default_value' => '',
				'formatting' => 'html',
				'order_no' => 0,
			),
			1 =>
			array (
				'key' => 'field_51543c4cdcii1',
				'label' => 'Image',
				'name' => 'about_image',
				'type' => 'image',
				'instructions' => 'The image of the about us page: dimension 260x270px. ',
				'required' => '0',
				'column_width' => '',
				'default_value' => '',
				'formatting' => 'html',
				'order_no' => 1,
			),
			2 =>
			array (
				'key' => 'field_51543c4cdcea1',
				'label' => 'Paragraphs',
				'name' => 'paragraphs',
				'type' => 'repeater',
				'instructions' => 'A paragraph to display your work',
				'required' => '0',
				'sub_fields' =>
				array (
					0 =>
					array (
						'key' => 'field_51543c4cdceb3',
						'label' => 'Title',
						'name' => 'title',
						'type' => 'text',
						'instructions' => '',
						'column_width' => '',
						'default_value' => '',
						'formatting' => 'html',
						'order_no' => 0,
					),
					1 =>
					array (
						'key' => 'field_51543c4cdceb9',
						'label' => 'Content',
						'name' => 'content',
						'type' => 'wysiwyg',
						'instructions' => '',
						'column_width' => '',
						'default_value' => '',
						'formatting' => 'br',
						'order_no' => 1,
					),
				),
				'row_min' => '0',
				'row_limit' => '',
				'layout' => 'table',
				'button_label' => 'Add Paragraph',
				'order_no' => 2,
			),
			3 =>
			array (
				'key' => 'field_515444a5ac160',
				'label' => 'Staff Members',
				'name' => 'staff_members',
				'type' => 'repeater',
				'instructions' => '',
				'required' => '0',
				'sub_fields' =>
				array (
					0 =>
					array (
						'key' => 'field_515444a5ac169',
						'label' => 'Full Name',
						'name' => 'full_name',
						'type' => 'text',
						'instructions' => '',
						'column_width' => '',
						'default_value' => '',
						'formatting' => 'html',
						'order_no' => 0,
					),
					1 =>
					array (
						'key' => 'field_515444a5ac16d',
						'label' => 'Position',
						'name' => 'position',
						'type' => 'text',
						'instructions' => '',
						'column_width' => '',
						'default_value' => '',
						'formatting' => 'html',
						'order_no' => 1,
					),
					2 =>
					array (
						'key' => 'field_515444a5ac171',
						'label' => 'Facebook',
						'name' => 'facebook',
						'type' => 'text',
						'instructions' => '',
						'column_width' => '',
						'default_value' => '',
						'formatting' => 'html',
						'order_no' => 2,
					),
					3 =>
					array (
						'key' => 'field_515444a5ac174',
						'label' => 'Linked in',
						'name' => 'linked_in',
						'type' => 'text',
						'instructions' => '',
						'column_width' => '',
						'default_value' => '',
						'formatting' => 'html',
						'order_no' => 3,
					),
					4 =>
					array (
						'key' => 'field_515444a5ac177',
						'label' => 'Twitter',
						'name' => 'twitter',
						'type' => 'text',
						'instructions' => '',
						'column_width' => '',
						'default_value' => '',
						'formatting' => 'html',
						'order_no' => 4,
					),
					5 =>
					array (
						'key' => 'field_515444a5ac17a',
						'label' => 'Image',
						'name' => 'image',
						'type' => 'image',
						'instructions' => '',
						'column_width' => '',
						'save_format' => 'object',
						'preview_size' => 'thumbnail',
						'order_no' => 5,
					),
					6 =>
					array (
						'key' => 'field_515444a5ac17e',
						'label' => 'Description',
						'name' => 'description',
						'type' => 'wysiwyg',
						'instructions' => '',
						'column_width' => '',
						'default_value' => '',
						'formatting' => 'br',
						'order_no' => 6,
					),
				),
				'row_min' => '0',
				'row_limit' => '',
				'layout' => 'table',
				'button_label' => 'Add staff',
				'order_no' => 3,
			),
		),
		'location' =>
		array (
			'rules' =>
			array (
				0 =>
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'template-about.php',
					'order_no' => 0,
				),
			),
			'allorany' => 'all',
		),
		'options' =>
		array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' =>
			array (
			),
		),
		'menu_order' => 0,
	));
	register_field_group(array (
		'id' => '5166a916cb882',
		'title' => 'Animate',
		'fields' =>
		array (
			0 =>
			array (
				'key' => 'field_513e11e304aba',
				'label' => 'Slide Down',
				'name' => 'slide_down',
				'type' => 'true_false',
				'instructions' => 'Check to animate - slide down',
				'required' => '0',
				'message' => '',
				'order_no' => 0,
			),
		),
		'location' =>
		array (
			'rules' =>
			array (
				0 =>
				array (
					'param' => 'options_page',
					'operator' => '==',
					'value' => 'options-main',
					'order_no' => 0,
				),
			),
			'allorany' => 'all',
		),
		'options' =>
		array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' =>
			array (
			),
		),
		'menu_order' => 0,
	));
	register_field_group(array (
		'id' => '5166a916cbc42',
		'title' => 'Booking Fields',
		'fields' =>
		array (
			0 =>
			array (
				'key' => 'field_51486df054962',
				'label' => 'Booking Field',
				'name' => 'booking_field',
				'type' => 'repeater',
				'instructions' => 'Use "Add field" to add a field, ',
				'required' => '0',
				'sub_fields' =>
				array (
					0 =>
					array (
						'key' => 'field_51486df054974',
						'label' => 'Field Name',
						'name' => 'field_name',
						'type' => 'text',
						'instructions' => 'Add a name to your field',
						'column_width' => '',
						'default_value' => '',
						'formatting' => 'html',
						'order_no' => 0,
					),
					1 =>
					array (
						'choices' =>
						array (
							'text' => 'Text',
							'phone' => 'Phone',
							'num' => 'Number',
							'date' => 'Date',
						),
						'key' => 'field_51486df05497a',
						'label' => 'Type',
						'name' => 'type',
						'type' => 'select',
						'instructions' => 'Choose a type for your field',
						'column_width' => '',
						'default_value' => 'text : Text',
						'allow_null' => '0',
						'multiple' => '0',
						'order_no' => 1,
					),
					2 =>
					array (
						'key' => 'field_51486df054991',
						'label' => 'Is Mandatory',
						'name' => 'is_mandatory',
						'type' => 'true_false',
						'instructions' => 'Choose if the field is mandatory',
						'column_width' => '',
						'message' => '',
						'order_no' => 2,
					),
				),
				'row_min' => '0',
				'row_limit' => '',
				'layout' => 'table',
				'button_label' => 'Add Field',
				'order_no' => 0,
			),
			1 =>
			array (
				'key' => 'field_514870d0d4274',
				'label' => 'Extra Text',
				'name' => 'extra_text',
				'type' => 'true_false',
				'instructions' => 'Click to add an "Extra Message" filed on the booking page',
				'required' => '0',
				'message' => '',
				'order_no' => 1,
			),
			2 =>
			array (
				'key' => 'field_514871f8910bd',
				'label' => 'Terms and Conditions ',
				'name' => 'terms_and_conditions',
				'type' => 'true_false',
				'instructions' => 'Click to add	"Terms and Conditions"	to the page',
				'required' => '0',
				'message' => '',
				'order_no' => 2,
			),
			3 =>
			array (
				'key' => 'field_514871f8916bf',
				'label' => 'Terms and Conditions Short Text',
				'name' => 'terms_and_conditions_short_text',
				'type' => 'text',
				'instructions' => 'Add the text witch will appear on the "Terms and Conditions"',
				'required' => '0',
				'default_value' => '',
				'formatting' => 'html',
				'order_no' => 3,
			),
			4 =>
			array (
				'key' => 'field_514871f891c83',
				'label' => 'Terms and Conditions	Long Text',
				'name' => 'terms_and_conditions_long_text',
				'type' => 'wysiwyg',
				'instructions' => 'Add the log text for the Terms and Conditions witch will appear when the user clicks the link in the "Terms and Conditions "',
				'required' => '0',
				'default_value' => '',
				'toolbar' => 'full',
				'media_upload' => 'yes',
				'the_content' => 'yes',
				'order_no' => 4,
			),
			5 =>
			array (
				'key' => 'field_515056c892bb7',
				'label' => 'Message Subject',
				'name' => 'message_subject',
				'type' => 'text',
				'instructions' => 'Add the email subject for the approved/unapproved	booking ',
				'required' => '0',
				'default_value' => '',
				'formatting' => 'html',
				'order_no' => 5,
			),
			6 =>
			array (
				'key' => 'field_515056c8933e5',
				'label' => 'Approved Booking Email Message',
				'name' => 'approved_booking_email_message',
				'type' => 'wysiwyg',
				'instructions' => 'Add the email text for the approved booking',
				'required' => '0',
				'default_value' => '',
				'toolbar' => 'full',
				'media_upload' => 'yes',
				'the_content' => 'yes',
				'order_no' => 6,
			),
			7 =>
			array (
				'key' => 'field_515056c8939c5',
				'label' => 'Unapproved Booking Email Message',
				'name' => 'unapproved_booking_email_message',
				'type' => 'wysiwyg',
				'instructions' => 'Add the email text for the unapproved booking',
				'required' => '0',
				'default_value' => '',
				'toolbar' => 'full',
				'media_upload' => 'yes',
				'the_content' => 'yes',
				'order_no' => 7,
			),	array (
				'key' => 'field_518be9074b923',
				'label' => 'Enable Email Notification',
				'name' => 'enable_email_notification',
				'type' => 'true_false',
				'instructions' => 'Get notified by email when a new booking is made',
				'message' => '',
				'default_value' => 0,
			),
			array (
				'key' => 'field_518be94b4b924',
				'label' => 'Email Address (e-mail notification)',
				'name' => 'email_address',
				'type' => 'text',
				'instructions' => 'Add a custom email	that you want to receive the notifications. Note: if left empty the notification will go to the admin Email',
				'default_value' => '',
				'formatting' => 'html',
			),
		),
		'location' =>
		array (
			'rules' =>
			array (
				1 =>
				array (
					'param' => 'options_page',
					'operator' => '==',
					'value' => 'options-booking-options',
					'order_no' => 1,
				),
			),
			'allorany' => 'all',
		),
		'options' =>
		array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' =>
			array (
			),
		),
		'menu_order' => 0,
	));
	register_field_group(array (
		'id' => '5166a916ccc29',
		'title' => 'ContactFields',
		'fields' =>
		array (
			0 =>
			array (
				'key' => 'field_5152f5a996501',
				'label' => 'Disable map',
				'name' => 'disable_map',
				'type' => 'true_false',
				'instructions' => 'Disable map',
				'required' => '0',
				'message' => '',
				'order_no' => 0,
			),
			1 =>
			array (
				'key' => 'field_5152fd9adc1df',
				'label' => 'Disable phone',
				'name' => 'disable_phone',
				'type' => 'true_false',
				'instructions' => 'Disable phone in contact form',
				'required' => '0',
				'message' => '',
				'order_no' => 1,
			),
			2 =>
			array (
				'key' => 'field_5153118680fc6',
				'label' => 'Disable Contact info',
				'name' => 'disable_contact_info',
				'type' => 'true_false',
				'instructions' => 'Disable Contact info',
				'required' => '0',
				'message' => '',
				'order_no' => 2,
			),
			3 =>
			array (
				'key' => 'field_515313d68a2b4',
				'label' => 'Disable location',
				'name' => 'disable_location',
				'type' => 'true_false',
				'instructions' => 'Disable location',
				'required' => '0',
				'message' => '',
				'order_no' => 3,
			),
			4 =>
			array (
				'label' => 'Location',
				'name' => 'location',
				'type' => 'text',
				'instructions' => '',
				'required' => '0',
				'default_value' => '',
				'formatting' => 'html',
				'key' => 'field_515ae0f880270',
				'order_no' => 4,
			),
			5 =>
			array (
				'key' => 'field_5152f6cece83c',
				'label' => 'Contact form name',
				'name' => 'contact_form_name',
				'type' => 'text',
				'instructions' => 'The contact form title',
				'required' => '0',
				'default_value' => '',
				'formatting' => 'html',
				'order_no' => 5,
			),
			6 =>
			array (
				'key' => 'field_51531186815b4',
				'label' => 'Mobile',
				'name' => 'mobile',
				'type' => 'text',
				'instructions' => '',
				'required' => '0',
				'default_value' => '',
				'formatting' => 'html',
				'order_no' => 6,
			),
			7 =>
			array (
				'key' => 'field_5153118688c29',
				'label' => 'Email',
				'name' => 'email',
				'type' => 'text',
				'instructions' => '',
				'required' => '0',
				'default_value' => '',
				'formatting' => 'html',
				'order_no' => 7,
			),
			8 =>
			array (
				'key' => 'field_515311868935b',
				'label' => 'Fax',
				'name' => 'fax',
				'type' => 'text',
				'instructions' => '',
				'required' => '0',
				'default_value' => '',
				'formatting' => 'html',
				'order_no' => 8,
			),
			9 =>
			array (
				'key' => 'field_5153179e48841',
				'label' => 'Google Map',
				'name' => 'google_map',
				'type' => 'googlemap',
				'instructions' => '',
				'required' => '0',
				'val' => 'address',
				'center' => '48.856614,2.3522219000000177',
				'zoom' => '2',
				'order_no' => 9,
			),
		),
		'location' =>
		array (
			'rules' =>
			array (
				0 =>
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'template-contact.php',
					'order_no' => 0,
				),
			),
			'allorany' => 'all',
		),
		'options' =>
		array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' =>
			array (
			),
		),
		'menu_order' => 0,
	));
	register_field_group(array (
		'id' => '5166a916cdde4',
		'title' => 'Default Tour Attributes',
		'fields' =>
		array (
			0 =>
			array (
				'key' => 'field_513dc3f3ea422',
				'label' => 'Tour Attributes',
				'name' => 'tour_attributes',
				'type' => 'repeater',
				'instructions' => 'Use add row to create attributes which you can use them for the default tours ',
				'required' => '0',
				'sub_fields' =>
				array (
					0 =>
					array (
						'key' => 'field_513dc3f3ea432',
						'label' => 'Attribute Name',
						'name' => 'attribute_name',
						'type' => 'text',
						'instructions' => '',
						'column_width' => '',
						'default_value' => '',
						'formatting' => 'html',
						'order_no' => 0,
					),
					1 =>
					array (
						'key' => 'field_513dc3f3ea438',
						'label' => 'Attribute Value',
						'name' => 'attribute_value',
						'type' => 'text',
						'instructions' => '',
						'column_width' => '',
						'default_value' => '',
						'formatting' => 'html',
						'order_no' => 1,
					),
					2 =>
					array (
						'key' => 'field_513dc3f3ea43b',
						'label' => 'Show on tours',
						'name' => 'show_on_tour',
						'type' => 'true_false',
						'instructions' => 'Check to show the attributes on your tours',
						'column_width' => '',
						'message' => '',
						'order_no' => 2,
					),
				),
				'row_min' => '0',
				'row_limit' => '',
				'layout' => 'table',
				'button_label' => 'Add Row',
				'order_no' => 0,
			),
		),
		'location' =>
		array (
			'rules' =>
			array (
				0 =>
				array (
					'param' => 'options_page',
					'operator' => '==',
					'value' => 'options-default-tour-attibutes',
					'order_no' => 0,
				),
			),
			'allorany' => 'all',
		),
		'options' =>
		array (
			'position' => 'normal',
			'layout' => 'no_box',
			'hide_on_screen' =>
			array (
			),
		),
		'menu_order' => 0,
	));
	register_field_group(array (
		'id' => '5166a916ce1b9',
		'title' => 'Filter Options',
		'fields' =>
		array (
			0 =>
			array (
				'key' => 'field_512b4a81c3365',
				'label' => 'Show price on filter',
				'name' => 'show_price_on_filter',
				'type' => 'true_false',
				'instructions' => 'Check to show the price in the filter',
				'required' => '0',
				'message' => '',
				'order_no' => 0,
			),
			1 =>
			array (
				'key' => 'field_5123b8ac986ba',
				'label' => 'FIlter Options',
				'name' => 'filter_options',
				'type' => 'repeater',
				'instructions' => 'Chose as many filter price options as you want by clicking "Add row" button.',
				'required' => '0',
				'sub_fields' =>
				array (
					0 =>
					array (
						'key' => 'field_5123b8ac986cf',
						'label' => 'Minimum Price',
						'name' => 'minimum_price',
						'type' => 'number',
						'instructions' => '',
						'column_width' => '',
						'default_value' => '',
						'order_no' => 0,
					),
					1 =>
					array (
						'key' => 'field_5123b8ac986dc',
						'label' => 'Maximum Price',
						'name' => 'maximum_price',
						'type' => 'number',
						'instructions' => '',
						'column_width' => '',
						'default_value' => '',
						'order_no' => 1,
					),
				),
				'row_min' => '0',
				'row_limit' => '',
				'layout' => 'table',
				'button_label' => 'Add Row',
				'order_no' => 1,
			),
			2 =>
			array (
				'key' => 'field_5123b9094a366',
				'label' => 'Filter Options Attributes',
				'name' => 'filter_options_attributes',
				'type' => 'repeater',
				'instructions' => 'Use add row to create Tour Categories which you can use them for filter purposes',
				'required' => '0',
				'sub_fields' =>
				array (
					0 =>
					array (
						'key' => 'field_5123b9094a374',
						'label' => 'Category Name',
						'name' => 'category_name',
						'type' => 'text',
						'instructions' => '',
						'column_width' => '',
						'default_value' => '',
						'formatting' => 'none',
						'order_no' => 0,
					),
					1 =>
					array (
						'key' => 'field_5127528fba272',
						'label' => 'Show on filter',
						'name' => 'show_on_filter',
						'type' => 'true_false',
						'instructions' => '',
						'column_width' => '',
						'message' => 'Show on filter',
						'order_no' => 1,
					),
				),
				'row_min' => '0',
				'row_limit' => '',
				'layout' => 'table',
				'button_label' => 'Add Row',
				'order_no' => 2,
			),
		),
		'location' =>
		array (
			'rules' =>
			array (
				0 =>
				array (
					'param' => 'options_page',
					'operator' => '==',
					'value' => 'options-filter',
					'order_no' => 0,
				),
			),
			'allorany' => 'all',
		),
		'options' =>
		array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' =>
			array (
			),
		),
		'menu_order' => 0,
	));
	register_field_group(array (
		'id' => '5166a916ce8e0',
		'title' => 'Footer Fields',
		'fields' =>
		array (
			0 =>
			array (
				'key' => 'field_51546405b4e43',
				'label' => 'Disable Text Field',
				'name' => 'disable_text_field',
				'type' => 'true_false',
				'instructions' => 'Disable the Text field.',
				'required' => '0',
				'message' => '',
				'order_no' => 0,
			),
			1 =>
			array (
				'key' => 'field_515468f4638f6',
				'label' => 'Footer Text Title',
				'name' => 'footer_text_title',
				'type' => 'text',
				'instructions' => 'Add the Title',
				'required' => '0',
				'default_value' => '',
				'formatting' => 'html',
				'order_no' => 1,
			),
			2 =>
			array (
				'key' => 'field_515468f463ef4',
				'label' => 'Footer Text Content',
				'name' => 'footer_text_content',
				'type' => 'wysiwyg',
				'instructions' => 'Add the content',
				'required' => '0',
				'default_value' => '',
				'formatting' => 'br',
				'order_no' => 2,
			),
			3 =>
			array (
				'key' => 'field_51546b62ed3cd',
				'label' => 'Disable Gallery',
				'name' => 'disable_gallery',
				'type' => 'true_false',
				'instructions' => '',
				'required' => '0',
				'message' => '',
				'order_no' => 3,
			),
			4 =>
			array (
				'key' => 'field_51546b742272d',
				'label' => 'Gallery Title',
				'name' => 'gallery_title',
				'type' => 'text',
				'instructions' => '',
				'required' => '0',
				'default_value' => '',
				'formatting' => 'html',
				'order_no' => 4,
			),
			5 =>
			array (
				'key' => 'field_51546adab6a95',
				'label' => 'Certification logo',
				'name' => 'certification_logo',
				'type' => 'repeater',
				'instructions' => 'Put in information of the travel associations',
				'required' => '0',
				'sub_fields' =>
				array (
					0 =>
					array (
						'key' => 'field_51546adab6aa2',
						'label' => 'Association',
						'name' => 'association',
						'type' => 'text',
						'instructions' => '',
						'column_width' => '',
						'allow_null' => '0',
						'multiple' => '0',
						'order_no' => 0,
					),
					1 =>
					array (
						'key' => 'field_51546adab6aa9',
						'label' => 'Image',
						'name' => 'image',
						'type' => 'image',
						'instructions' => '',
						'column_width' => '',
						'save_format' => 'object',
						'preview_size' => 'tour_footer',
						'order_no' => 1,
					),
				),
				'row_min' => '0',
				'row_limit' => '',
				'layout' => 'table',
				'button_label' => 'Add Row',
				'order_no' => 5,
			),
			6 =>
			array (
				'key' => 'field_51547584f1a1d',
				'label' => 'Disable Contact',
				'name' => 'disable_contact',
				'type' => 'true_false',
				'instructions' => '',
				'required' => '0',
				'message' => '',
				'order_no' => 6,
			),
			7 =>
			array (
				'key' => 'field_51547584f2136',
				'label' => 'Address',
				'name' => 'address',
				'type' => 'text',
				'instructions' => '',
				'required' => '0',
				'default_value' => '',
				'formatting' => 'html',
				'order_no' => 7,
			),
			8 =>
			array (
				'key' => 'field_51547584f2871',
				'label' => 'Phone',
				'name' => 'phone',
				'type' => 'text',
				'instructions' => '',
				'required' => '0',
				'default_value' => '',
				'formatting' => 'html',
				'order_no' => 8,
			),
			9 =>
			array (
				'key' => 'field_51547584f2df5',
				'label' => 'Email',
				'name' => 'email',
				'type' => 'text',
				'instructions' => '',
				'required' => '0',
				'default_value' => '',
				'formatting' => 'html',
				'order_no' => 9,
			),
			10 =>
			array (
				'key' => 'field_51547c7523144',
				'label' => 'Social Networks',
				'name' => 'social_networks',
				'type' => 'repeater',
				'instructions' => 'Add a Social Network',
				'required' => '0',
				'sub_fields' =>
				array (
					0 =>
					array (
						'choices' =>
						array (
							'F' => 'Facebook',
							'v' => 'vimeo',
							't' => 'twitter',
							'l' => 'Linked in',
							'g' => 'google+',
							's' => 'skype',
							'y' => 'you tube',
						),
						'key' => 'field_51547c752314d',
						'label' => 'Network',
						'name' => 'network',
						'type' => 'select',
						'instructions' => '',
						'column_width' => '',
						'default_value' => '',
						'allow_null' => '0',
						'multiple' => '0',
						'order_no' => 0,
					),
					1 =>
					array (
						'key' => 'field_51547c7523171',
						'label' => 'Link',
						'name' => 'link',
						'type' => 'text',
						'instructions' => '',
						'column_width' => '',
						'default_value' => '',
						'formatting' => 'html',
						'order_no' => 1,
					),
				),
				'row_min' => '0',
				'row_limit' => '',
				'layout' => 'table',
				'button_label' => 'Add Row',
				'order_no' => 10,
			),
			11 =>
			array (
				'key' => 'field_5154784d2dbea',
				'label' => 'Copyright Text 1',
				'name' => 'copyright_text_1',
				'type' => 'wysiwyg',
				'instructions' => '',
				'required' => '0',
				'default_value' => '',
				'toolbar' => 'full',
				'media_upload' => 'yes',
				'the_content' => 'yes',
				'order_no' => 11,
			),
			12 =>
			array (
				'key' => 'field_5154784d2e362',
				'label' => 'Copyright Text 2',
				'name' => 'copyright_text_2',
				'type' => 'wysiwyg',
				'default_value' => '',
				'toolbar' => 'full',
				'media_upload' => 'yes',
			),
		),
		'location' =>
		array (
			'rules' =>
			array (
				0 =>
				array (
					'param' => 'options_page',
					'operator' => '==',
					'value' => 'options-footer',
					'order_no' => 0,
				),
			),
			'allorany' => 'all',
		),
		'options' =>
		array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' =>
			array (
			),
		),
		'menu_order' => 0,
	));
	register_field_group(array (
		'id' => '5166a916cfdd7',
		'title' => 'Main',
		'fields' =>
		array (
			0 =>
			array (
				'key' => 'field_5154620a2112a',
				'label' => 'Logo',
				'name' => 'logo',
				'type' => 'image',
				'instructions' => '',
				'required' => '0',
				'save_format' => 'object',
				'preview_size' => 'logo',
				'order_no' => 0,
			),
			1 =>
			array (
				'key' => 'field_5127b5b748560',
				'label' => 'Currency',
				'name' => 'currency',
				'type' => 'text',
				'instructions' => '',
				'required' => '0',
				'default_value' => '',
				'formatting' => 'html',
				'order_no' => 1,
			),
			2 =>
			array (
				'key' => 'field_515c31eac2409',
				'label' => 'Default image',
				'name' => 'default_image',
				'type' => 'image',
				'instructions' => 'In case a page dosent have the featured image.
	 Add a default image that will be used as a page featured image',
				'required' => '0',
				'save_format' => 'url',
				'preview_size' => 'page_featured_image',
				'order_no' => 2,
			),
			3 =>
			array (
				'key' => 'field_515c09871f1fe',
				'label' => 'Disable Search',
				'name' => 'disable_search',
				'type' => 'true_false',
				'instructions' => 'Disable search filter on Home page',
				'required' => '0',
				'message' => '',
				'order_no' => 3,
			),
			4 =>
			array (
				'key' => 'field_515c0d9f2a901',
				'label' => 'Disable attributes on bucket',
				'name' => 'disable_attributes_on_bucket',
				'type' => 'true_false',
				'instructions' => 'Show / Hide attributes on Bucket',
				'required' => '0',
				'message' => '',
				'order_no' => 4,
			),
			5 =>
			array (
				'key' => 'field_515c1645389ec',
				'label' => 'Custom css',
				'name' => 'custom_css',
				'type' => 'textarea',
				'instructions' => 'Add custom css',
				'required' => '0',
				'default_value' => '',
				'formatting' => 'html',
				'order_no' => 5,
			),
			6 =>
			array (
				'key' => 'field_515c1645390c5',
				'label' => 'Custom javascript',
				'name' => 'custom_javascript',
				'type' => 'textarea',
				'instructions' => 'Add custom javascript',
				'required' => '0',
				'default_value' => '',
				'formatting' => 'html',
				'order_no' => 6,
			),
			7 =>
			array (
				'label' => 'site_favicon',
				'name' => 'site_favicon',
				'type' => 'image',
				'instructions' => 'add site icon',
				'required' => '0',
				'save_format' => 'url',
				'preview_size' => 'thumbnail',
				'key' => 'field_5165792d1bda6',
				'order_no' => 7,
			),
		),
		'location' =>
		array (
			'rules' =>
			array (
				0 =>
				array (
					'param' => 'options_page',
					'operator' => '==',
					'value' => 'options-main',
					'order_no' => 0,
				),
			),
			'allorany' => 'all',
		),
		'options' =>
		array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' =>
			array (
			),
		),
		'menu_order' => 0,
	));
	register_field_group(array (
		'id' => '5166a916d0a6c',
		'title' => 'Post Fields',
		'fields' =>
		array (
			0 =>
			array (
				'key' => 'field_51507270642',
				'label' => 'Content Image',
				'name' => 'content_image',
				'type' => 'image',
				'instructions' => 'Add image',
				'required' => '0',
				'save_format' => 'url',
				'preview_size' => 'thumbnail',
				'order_no' => 0,
			),
			1 =>
			array (
				'key' => 'field_5150763f1b3dc',
				'label' => 'Post Description',
				'name' => 'post_description',
				'type' => 'wysiwyg',
				'instructions' => 'Post Description that will show on the blog page',
				'required' => '0',
				'default_value' => '',
				'formatting' => 'br',
				'order_no' => 1,
			),
			2 =>
			array (
				'key' => 'field_51509086057bc',
				'label' => 'Disable comments',
				'name' => 'disable_comments',
				'type' => 'true_false',
				'instructions' => 'Disable comments',
				'required' => '0',
				'message' => '',
				'order_no' => 2,
			),
			3 =>
			array (
				'label' => 'Disable Tags',
				'name' => 'disable_tags',
				'type' => 'true_false',
				'instructions' => 'Disable Tags',
				'required' => '0',
				'message' => '',
				'key' => 'field_5166a33056c6e',
				'order_no' => 3,
			),
		),
		'location' =>
		array (
			'rules' =>
			array (
				0 =>
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'post',
					'order_no' => 0,
				),
			),
			'allorany' => 'all',
		),
		'options' =>
		array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' =>
			array (
			),
		),
		'menu_order' => 0,
	));
	register_field_group(array (
		'id' => 'homepageshortcode',
		'title' => 'Home page Short code sliders',
		'fields' =>
		array (
			0 =>
			array (
				'key' => 'field_home_slider',
				'label' => 'Home Sliders',
				'name' => 'home_sliders',
				'type' => 'repeater',
				'instructions' => 'Press "Add Slider"	to add a new slider, Maximum 5',
				'required' => '0',
				'sub_fields' =>
				array (
					0 =>
					array (
						'key' => 'field_5140738d1b694',
						'label' => 'Title',
						'name' => 'title',
						'type' => 'text',
						'instructions' => 'The title of the slider',
						'column_width' => '',
						'default_value' => '',
						'formatting' => 'html',
						'order_no' => 0,
						),
						1 =>
						array (
							'key' => 'field_shortcode',
							'label' => 'Slider shortcode',
							'name' => 'shortcode',
							'type' => 'text',
							'instructions' => 'Add the slider shortcode',
							'column_width' => '',
							'default_value' => '',
							'formatting' => 'html',
							'order_no' => 1,
						),
						2 =>
						array (
							'key' => 'height_shortcode',
							'label' => 'Slider height',
							'name' => 'slider_height',
							'type' => 'text',
							'instructions' => 'Add the slider Height',
							'column_width' => '',
							'default_value' => '300px',
							'formatting' => 'html',
							'order_no' => 2,
						),
					),
					'row_min' => '0',
					'row_limit' => '5',
					'layout' => 'table',
					'button_label' => 'Add slider',
					'order_no' => 7,
					),
			1=>
			array (
				'label' => 'Tours',
				'name' => 'tours',
				'type' => 'relationship',
				'instructions' => 'Please select exactly 9 tours',
				'required' => '0',
				'post_type' =>
				array (
					0 => 'tours_post',
				),
				'taxonomy' =>
				array (
					0 => 'all',
				),
				'max' => '',
				'key' => 'field_5124dbffd391d',
				'order_no' => 0,
			),

		),
		'location' =>
		array (
			'rules' =>
			array (
				0 =>
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'template-home.php',
					'order_no' => 0,
				),
			),
			'allorany' => 'all',
		),
		'options' =>
		array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' =>
			array (
			),
		),
		'menu_order' => 0,
	));
/***********************************
  Fields for the terms page
***********************************/
register_field_group(
	array (
		'id' => '5166a916d1466',
		'title' => 'Terms and conditions',
		'fields' =>
		array (
			0 =>
			array (
				'key' => 'field_51225aa17a08c',
				'label' => 'Terms',
				'name' => 'new_terms',
				'type' => 'repeater',
				'instructions' => 'Press "Add term" to add a term',
				'required' => '0',
				'sub_fields' =>
				array (
					0=>
					array (
						'key' => 'field_5125fb116c574',
						'label' => 'Title',
						'name' => 'term_title',
						'type' => 'text',
						'instructions' => 'The title of the term',
						'column_width' => '',
						'default_value' => '',
						'formatting' => 'html',
						'order_no' => 0,
						),
					1 =>
					array (
						'key' => 'field_5125fb116c575',
						'label' => 'Content',
						'name' => 'term_content',
						'type' => 'text',
						'instructions' => 'The terms content ',
						'column_width' => '',
						'default_value' => '',
						'formatting' => 'html',
						'order_no' => 1,
						),
					),
				'row_min' => '0',
				'layout' => 'table',
				'row_limit' => '',
				'button_label' => 'Add Terms',
				'order_no' => 0,
			),
		),
		'location' =>
		array (
			'rules' =>
			array (
				0 =>
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'template-terms.php',
					'order_no' => 0,
				),
			),
			'allorany' => 'all',
		),

		'options' =>
		array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' =>
			array (
			),
		),
		'menu_order' => 0,

));
/*********************
FAQ page
*********************/
register_field_group(
	array (
		'id' => '5166a916d1477',
		'title' => 'Q&A',
		'fields' =>
		array (
			0 =>
			array (
				'key' => 'field_51225aa17a06c',
				'label' => 'For Teachers',
				'name' => 'for_teachers',
				'type' => 'repeater',
				'instructions' => 'Press "Add " to add a Question',
				'required' => '0',
				'sub_fields' =>
				array (
					0=>
					array (
						'key' => 'field_5125fb116c523',
						'label' => 'Question',
						'name' => 'question_title',
						'type' => 'text',
						'instructions' => '',
						'column_width' => '',
						'default_value' => '',
						'formatting' => 'html',
						'order_no' => 0,
						),
					1 =>
					array (
						'key' => 'field_5125fb116c524',
						'label' => 'Answer',
						'name' => 'question_content',
						'type' => 'text',
						'instructions' => '',
						'column_width' => '',
						'default_value' => '',
						'formatting' => 'html',
						'order_no' => 1,
						),
					),
				'row_min' => '0',
				'row_limit' => '',
				'layout' => 'table',
				'button_label' => 'Add',
				'order_no' => 0,
			),
			1 =>
			array (
				'key' => 'field_51225aa17a06e',
				'label' => 'For Parents',
				'name' => 'for_parents',
				'type' => 'repeater',
				'instructions' => 'Press "Add " to add a Question',
				'required' => '0',
				'sub_fields' =>
				array (
					0=>
					array (
						'key' => 'field_5125fb116c543',
						'label' => 'Question',
						'name' => 'parents_question_title',
						'type' => 'text',
						'instructions' => '',
						'column_width' => '',
						'default_value' => '',
						'formatting' => 'html',
						'order_no' => 0,
						),
					1 =>
					array (
						'key' => 'field_5125fb116c544',
						'label' => 'Answer',
						'name' => 'parents_question_content',
						'type' => 'text',
						'instructions' => '',
						'column_width' => '',
						'default_value' => '',
						'formatting' => 'html',
						'order_no' => 1,
						),
					),
				'row_min' => '0',
				'row_limit' => '',
				'layout' => 'table',
				'button_label' => 'Add',
				'order_no' => 1,
			),
			2 =>
			array (
				'key' => 'field_51225aa17a06d',
				'label' => 'For Students',
				'name' => 'for_students',
				'type' => 'repeater',
				'instructions' => 'Press "Add " to add a Question',
				'required' => '0',
				'sub_fields' =>
				array (
					0=>
					array (
						'key' => 'field_5125fb116c533',
						'label' => 'Question',
						'name' => 'students_question_title',
						'type' => 'text',
						'instructions' => '',
						'column_width' => '',
						'default_value' => '',
						'formatting' => 'html',
						'order_no' => 0,
						),
					1 =>
					array (
						'key' => 'field_5125fb116c534',
						'label' => 'Answer',
						'name' => 'students_question_content',
						'type' => 'text',
						'instructions' => '',
						'column_width' => '',
						'default_value' => '',
						'formatting' => 'html',
						'order_no' => 1,
						),
					),
				'row_min' => '0',
				'row_limit' => '',
				'layout' => 'table',
				'button_label' => 'Add',
				'order_no' => 2,
			),
		),
		'location' =>
		array (
			'rules' =>
			array (
				0 =>
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'template-faq.php',
					'order_no' => 0,
				),
			),
			'allorany' => 'all',
		),

		'options' =>
		array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' =>
			array (
			),
		),
		'menu_order' => 0,

	));


	register_field_group(array (
		'id' => '5166a916d1488',
		'title' => 'Tour Meta',
		'fields' =>
		array (
			0 =>
			array (
				'key' => 'field_51225aa17a08d',
				'label' => 'Price',
				'name' => 'price',
				'type' => 'text',
				'instructions' => 'Enter the price for this tour.',
				'required' => '0',
				'default_value' => '',
				'order_no' => 0,
			),
			1 =>
			array (
				'key' => 'field_5125fb116c538',
				'label' => 'Overview',
				'name' => 'overview',
				'type' => 'wysiwyg',
				'instructions' => 'Enter overview that will show on the overview tab.',
				'required' => '0',
				'default_value' => '',
				'formatting' => 'br',
				'order_no' => 1,
			),
			2 =>
			array (
				'key' => 'field_5125fb116cb2b',
				'label' => 'Terms',
				'name' => 'terms',
				'type' => 'wysiwyg',
				'instructions' => 'Enter special terms for each tour.',
				'required' => '0',
				'default_value' => '',
				'formatting' => 'br',
				'order_no' => 2,
			),

			3 =>
			array (
				'key' => 'field_5137533fcdc10',
				'label' => 'Tour Attributes',
				'name' => 'tour_attributes',
				'type' => 'repeater',
				'instructions' => 'Use add row to create attributes which you can use them for tour purposes',
				'required' => '0',
				'sub_fields' =>
				array (
					0 =>
					array (
						'key' => 'field_5137533fcdc1b',
						'label' => 'Attribute Name',
						'name' => 'attribute_name',
						'type' => 'text',
						'instructions' => '',
						'column_width' => '',
						'default_value' => '',
						'formatting' => 'html',
						'order_no' => 0,
					),
					1 =>
					array (
						'key' => 'field_5137533fcdc1f',
						'label' => 'Attribute Value',
						'name' => 'attribute_value',
						'type' => 'text',
						'instructions' => '',
						'column_width' => '',
						'default_value' => '',
						'formatting' => 'html',
						'order_no' => 1,
					),
					2 =>
					array (
						'key' => 'field_5137533fcdc22',
						'label' => 'Show on tour',
						'name' => 'show_on_tour',
						'type' => 'true_false',
						'instructions' => 'Check to show the attributes on your tour',
						'column_width' => '',
						'message' => '',
						'order_no' => 2,
					),
				),
				'row_min' => '0',
				'row_limit' => '',
				'layout' => 'table',
				'button_label' => 'Add Row',
				'order_no' => 3,
			),
			4 =>
			array (
				'key' => 'field_513f49bad43de',
				'label' => 'Tour Slider',
				'name' => 'tour_slider',
				'type' => 'repeater',
				'instructions' => '',
				'required' => '0',
				'sub_fields' =>
				array (
					0 =>
					array (
						'key' => 'field_513f49bad43e6',
						'label' => 'Image',
						'name' => 'image',
						'type' => 'image',
						'instructions' => 'Add image to slider',
						'column_width' => '',
						'save_format' => 'url',
						'preview_size' => 'thumbnail',
						'order_no' => 0,
					),
				),
				'row_min' => '0',
				'row_limit' => '',
				'layout' => 'table',
				'button_label' => 'Add Row',
				'order_no' => 4,
			),
			5 =>
			array (
				'choices' =>
				array (
					1 => 'One',
					2 => 'Two',
					3 => 'Three',
					4 => 'Four',
					5 => 'Five',
				),
				'key' => 'field_5142fa5509606',
				'label' => 'Rating',
				'name' => 'rating',
				'type' => 'select',
				'instructions' => 'Rate the tour',
				'required' => '0',
				'default_value' => '1 : One',
				'allow_null' => '0',
				'multiple' => '0',
				'order_no' => 5,
			),
			6 =>
			array (
				'key' => 'field_513dc528c62ec',
				'label' => 'Use Default Tour Attribute',
				'name' => 'use_default_tour_attribute',
				'type' => 'true_false',
				'instructions' => 'Check this if you want to use the default values (Witch can be fount in Ubrella -> Default Tour Attributes)',
				'required' => '0',
				'message' => '',
				'order_no' => 6,
			),

			7 =>
			array (
				'key' => 'field_5141999c0749e',
				'label' => 'Show Reviews on Page',
				'name' => 'show_reviews_on_page',
				'type' => 'true_false',
				'instructions' => 'Check to show the Reviews on the tour page',
				'required' => '0',
				'message' => '',
				'order_no' => 7,
			),
			8 =>
			array (
				'key' => 'field_5146e013cb315',
				'label' => 'Enable User Rating',
				'name' => 'enable_user_rating',
				'type' => 'true_false',
				'instructions' => 'Enable users to rate the Tour ',
				'required' => '0',
				'message' => '',
				'order_no' => 8,
			),
			9 =>
			array (
				'key' => 'field_5146e013cb316',
				'label' => 'Acitivities',
				'name' => 'activities',
				'type' => 'relationship',
				'post_type'=>
				array (
					0 => 'activity',
					),
				'taxonomy' =>
				array (
					0 => 'all',
					),
				'order_no' => 9,
				),
			10 =>
			array (
				'key' => 'field_5153179e48841',
				'label' => 'Google Map',
				'name' => 'google_map',
				'type' => 'googlemap',
				'instructions' => '',
				'required' => '0',
				'val' => 'address',
				'center' => '48.856614,2.3522219000000177',
				'zoom' => '2',
				'order_no' => 10,
			),
			11 =>
			array (
				'key' => 'field_5137533fcdc20',
				'label' => 'Weather Codes and map coordinates',
				'name' => 'weather',
				'type' => 'repeater',
				'instructions' => '',
				'required' => '0',
				'sub_fields' =>
				array (
					0 =>
					array (
						'key' => 'field_5137533fcdc2b',
						'label' => 'City',
						'name' => 'city_name',
						'type' => 'text',
						'instructions' => '',
						'column_width' => '',
						'default_value' => '',
						'formatting' => 'html',
						'order_no' => 0,
					),
					1 =>
					array (
						'key' => 'field_5137533fcdc2g',
						'label' => 'Map coordinates',
						'name' => 'city_coordinates',
						'type' => 'text',
						'instructions' => ' Find the coordinates of each city in above map and put them here!',
						'column_width' => '',
						'default_value' => '',
						'formatting' => 'html',
						'order_no' => 1,
					),
					2 =>
					array (
						'key' => 'field_5137533fcdc2f',
						'label' => 'City Code',
						'name' => 'city_code',
						'type' => 'text',
						'instructions' => 'Add City codes from the weather network: http://past.theweathernetwork.com/weather_centre/cmswxbuttons',
						'column_width' => '',
						'default_value' => '',
						'formatting' => 'html',
						'order_no' => 2,
					),
				),
				'row_min' => '0',
				'row_limit' => '',
				'layout' => 'table',
				'button_label' => 'Add Row',
				'order_no' => 11,
			),
			12 =>
			array (
				'key' => 'field_5137533fcdc99',
				'label' => 'Meals',
				'name' => 'meals',
				'type' => "repeater",
				'instructions' => 'Meals options',
				'required' => '0',
				'sub_fields' =>
				array (
					0 =>
					array (
						'key' => 'field_5137533fcff99',
						'choices' => array (

							1 => "Yes",
							2 => "NO"
							),
						'label' => 'Need',
						'name' => 'need',
						'type' => 'select',
						'instructions' => '',
						'column_width' => '',
						'default_value' => '',
						'formatting' => 'html',
						'order_no' => 0,
					),
					2 =>
					array (
						'key' => 'field_5137533fcff88',
						'choices' =>  array (
							0 => "Not included",
							1 => "Continental",
							2 => "American",
							3 => "Buffet",
							),
						'label' => 'Breakfast',
						'name' => 'breakfast',
						'type' => 'select',
						'instructions' => '',
						'column_width' => '',
						'default_value' => '',
						'formatting' => 'html',
						'order_no' => 2,
					),
					3 =>
					array (
						'key' => 'field_5137533fcff89',
						'label' => 'Breakfast Number',
						'name' => 'breakfast_number',
						'type' => 'text',
						'instructions' => '',
						'column_width' => '',
						'default_value' => '',
						'formatting' => 'html',
						'order_no' => 3,
					),
					4 =>
					array (
						'key' => 'field_5137533fcff77',
						'choices' => array (
							0 => "Not included",
							1 => "Standard",
							2 => "Buffet",
							3 => "Both",
							),
						'label' => 'Lunch',
						'name' => 'lunch',
						'type' => 'select',
						'instructions' => '',
						'column_width' => '',
						'default_value' => '',
						'formatting' => 'html',
						'order_no' => 4,
					),
					5 =>
					array (
						'key' => 'field_5137533fcff78',
						'label' => 'Lunch Number',
						'name' => 'lunch_number',
						'type' => 'text',
						'instructions' => '',
						'column_width' => '',
						'default_value' => '',
						'formatting' => 'html',
						'order_no' => 5,
					),
					6 =>
					array (
						'key' => 'field_5137533fcff66',
						'choices' => array (
							0 => "Not included",
							1 => "Standard",
							2 => "Buffet",
							3 => "Both",
							4 => "Dinner theatre",
							5 => "Thematic Dinner",
							),
						'label' => 'Dinner',
						'name' => 'dinner',
						'type' => 'select',
						'instructions' => 'press Ctrl + C to select more than one option',
						'column_width' => '',
						'multiple' => '1',
						'default_value' => '',
						'formatting' => 'html',
						'order_no' => 6,
					),
					7 =>
					array (
						'key' => 'field_5137533fcff67',
						'label' => 'Dinner Number',
						'name' => 'dinner_number',
						'type' => 'text',
						'instructions' => '',
						'column_width' => '',
						'default_value' => '',
						'formatting' => 'html',
						'order_no' => 7,
					),
				),
				'layout' => 'table',
				'row_min' => '0',
				'row_limit' => '1',
				'order_no' => 12,
			),
			13 =>
			array (
				'key' => 'field_5137533fcdc00',
				'label' => 'Transportation',
				'name' => 'transportation',
				'type' => "repeater",
				'instructions' => 'Transportation Options',
				'required' => '0',
				'sub_fields' =>
				array (
					0 =>
					array (
						'key' => 'field_5137533fcgg99',
						'choices' => array (
							0 => "Not included",
							1 => "Yes",
							2 => "NO"
							),
						'label' => 'Air',
						'name' => 'air',
						'type' => 'select',
						'instructions' => '',
						'column_width' => '',
						'default_value' => '',
						'formatting' => 'html',
						'order_no' => 0,
					),
					2 =>
					array (
						'key' => 'field_5137533fcgg88',
						'choices' =>  array (
							0 => "Not included",
							1 => "Coach Only",
							2 => "Standard Bus Only",
							3 => "Both",
							),
						'label' => 'Bus',
						'name' => 'bus',
						'type' => 'select',
						'instructions' => '',
						'column_width' => '',
						'default_value' => '',
						'formatting' => 'html',
						'order_no' => 2,
					),
					3 =>
					array (
						'key' => 'field_5137533fcgg66',
						'choices' => array (
							0 => "Not included",
							1 => "Public",
							2 => "Taxi",
							3 => "Train",
							),
						'label' => 'Other',
						'name' => 'other',
						'type' => 'select',
						'instructions' => 'press Ctrl + C to select more than one option',
						'column_width' => '',
						'multiple' => '1',
						'default_value' => '',
						'formatting' => 'html',
						'order_no' => 3,
					),
				),
				'layout' => 'table',
				'row_min' => '0',
				'row_limit' => '1',
				'order_no' => 13,
			),
			14 =>
			array (
				'key' => 'field_5137533fcdc11',
				'label' => 'Hotel',
				'name' => 'hotel',
				'type' => "repeater",
				'instructions' => 'Hotel Options',
				'required' => '0',
				'sub_fields' =>
				array (
					0 =>
					array (
						'key' => 'field_5137533fcdd99',
						'choices' => array (
							0 => "Not included",
							1 => "2 stars",
							2 => "3 stars",
							3 => "4 stars",
							4 => "Youth Hotel",
							),
						'label' => 'Type',
						'name' => 'hotel_type',
						'type' => 'select',
						'instructions' => '',
						'column_width' => '',
						'default_value' => '',
						'formatting' => 'html',
						'order_no' => 0,
					),
					2 =>
					array (
						'key' => 'field_5137533fcdd88',
						'choices' =>  array (
							0 => "Not included",
							1 => "Double",
							2 => "Quad",
							),
						'label' => 'Students Room',
						'name' => 'student_r',
						'type' => 'select',
						'instructions' => '',
						'column_width' => '',
						'default_value' => '',
						'formatting' => 'html',
						'order_no' => 2,
					),
					3 =>
					array (
						'key' => 'field_5137533fcdd66',
						'choices' => array (
							0 => "Not included",
							1 => "Single",
							2 => "Double",
							),
						'label' => 'Adults Room',
						'name' => 'adult_r',
						'type' => 'select',
						'instructions' => '',
						'column_width' => '',
						'default_value' => '',
						'formatting' => 'html',
						'order_no' => 3,
					),
				),
				'layout' => 'table',
				'row_min' => '0',
				'row_limit' => '1',
				'order_no' => 14,
			),
			15 =>
			array (
				'key' => 'field_5137533fcdc22',
				'label' => 'Services',
				'name' => 'services',
				'type' => "repeater",
				'instructions' => 'Service Options',
				'required' => '0',
				'sub_fields' =>
				array (
					0 =>
					array (
						'key' => 'field_5137533fccc99',
						'choices' => array (
							0 => "Not included",
							1 => "Yes",
							2 => "No",
							),
						'label' => 'Tour Director',
						'name' => 'director',
						'type' => 'select',
						'instructions' => '',
						'column_width' => '',
						'default_value' => '',
						'formatting' => 'html',
						'order_no' => 0,
					),
					2 =>
					array (
						'key' => 'field_5137533fccc88',
						'choices' =>  array (
							0 => "Not included",
							1 => "Yes",
							2 => "No",
							),
						'label' => 'Night Security',
						'name' => 'security',
						'type' => 'select',
						'instructions' => '',
						'column_width' => '',
						'default_value' => '',
						'formatting' => 'html',
						'order_no' => 2,
					),
					3 =>
					array (
						'key' => 'field_5137533fcee66',
						'choices' => array (
							0 => "To be assured",
							1 => "English",
							2 => "French",
							3 => "Other",
							),
						'label' => 'Tour Language',
						'name' => 'language',
						'type' => 'select',
						'instructions' => '',
						'multiple' => '1',
						'column_width' => '',
						'default_value' => '',
						'formatting' => 'html',
						'order_no' => 3,
					),
					4 =>
					array (
						'key' => 'field_5137533fcee33',
						'label' => 'Other Language',
						'name' => 'other_language',
						'type' => 'text',
						'instructions' => 'If other language, please write down here',
						'column_width' => '',
						'default_value' => '',
						'formatting' => 'html',
						'order_no' => 4,
						),
				),
				'layout' => 'table',
				'row_min' => '0',
				'row_limit' => '1',
				'order_no' => 15,
			),
			16 =>
			array (
				'key' => 'field_5137533fcii99',
				'choices' => array (
					0 => "Not included",
					1 => 'Yes',
					2 => 'No',
					),
				'label' => 'Insurance',
				'name' => 'insurance',
				'type' => 'select',
				'instructions' => '',
				'column_width' => '',
				'order_no' => 16,
			),
			17 =>
			array (
				'key' => 'field_514706cf21163',
				'label' => 'Numbers',
				'name' => 'tour_number',
				'type' => 'repeater',
				'instructions' => 'Add in the numbers of student and adults',
				'required' => '0',
				'sub_fields' =>
				array (
					0 =>
					array (
						'key' => 'field_5140722d1b694',
						'label' => 'Number of Students',
						'name' => 'student_number',
						'type' => 'text',
						'instructions' => 'And in the number of students',
						'column_width' => '',
						'default_value' => '',
						'formatting' => 'html',
						'order_no' => 0,
					),
					1 =>
					array (
						'key' => 'field_5140733d1b694',
						'label' => 'Number of Adults',
						'name' => 'adult_number',
						'type' => 'text',
						'instructions' => 'Add the number of adults in the tour',
						'column_width' => '',
						'default_value' => '',
						'formatting' => 'html',
						'order_no' => 1,
					),
					2 =>
					array (
						'key' => 'field_5140733d1b695',
						'choices' => array (
							0 => "1-3 grades",
							1 => '4-6 grades',
							2 => '7-9 grades',
							3 => '10-12 grades',
							4 => 'College',
							),
						'label' => 'Grade Level',
						'name' => 'grade_level',
						'type' => 'select',
						'multiple' => '1',
						'instructions' => 'Choose a grade level for the tour',
						'column_width' => '',
						'default_value' => '',
						'formatting' => 'html',
						'order_no' => 1,
					),

				),
				'row_min' => '0',
				'row_limit' => '1',
				'layout' => 'table',
				'button_label' => 'Add Row',
				'order_no' => 17,
				),
		),
		'location' =>
		array (
			'rules' =>
			array (
				0 =>
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'tours_post',
					'order_no' => 0,
				),
			),
			'allorany' => 'all',
		),
		'options' =>
		array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' =>
			array (
			),
		),
		'menu_order' => 0,
	));
/***********************************************
Add custom field to the acitivity
***********************************************/
register_field_group(array (
		'id' => 'activity_link',
		'title' => 'External Link for activity',
		'fields' => array (
	    		1 =>
	    		 array (
	    		'key' => 'field_activity-link',
				'label' => 'Link',
				'name' => 'link',
				'type' => 'text',
				'instructions' => 'Add a link to the activity!',
				'column_width' => '',
				'save_format' => 'url',
				'order_no' => 0,
	    		),
	    		2 =>
	    		array (
				'key' => 'field_activity_slider',
				'label' => 'Activity Slider',
				'name' => 'activity_slider',
				'type' => 'repeater',
				'instructions' => '',
				'required' => '0',
				'sub_fields' =>
				array (
					0 =>
					array (
						'key' => 'field_activity_slide',
						'label' => 'Image',
						'name' => 'image',
						'type' => 'image',
						'instructions' => 'Add image to slider',
						'column_width' => '',
						'save_format' => 'url',
						'preview_size' => 'thumbnail',
						'order_no' => 0,
					),
				),
				'row_min' => '0',
				'row_limit' => '',
				'layout' => 'table',
				'button_label' => 'Add Row',
				'order_no' => 1,
			),

	    ),
		'location' => array (

		'rules' =>
			array (
				0 =>
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'activity',
					'order_no' => 0,
				),
			),
			'allorany' => 'all',
		),
		'options' =>
		array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' =>
			array (
			),
		),
		'menu_order' => 0,

	));
/***********************************************
An administration page for the destinations page.
************************************************/
/*register_field_group( array (
	'id' => 'destination',
	'title' => 'destination',
	'fields' => array (
				'key' => 'field-destination_photo',
				'label' => 'Destionation photo',
				'name' => 'Photos for Destinations',
				'type' => 'image',
				'instructions' => 'Define your destination Photos',
				'message' => '',
				'default_value' => 0,
			),
	'location' => array (
			array (
				array (
					'param' => 'options_page',
					'operator' => '==',
					'value' => 'acf-options-main',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	)
	);*/



/************************************************
SWP FORMS FIELDS
************************************************/
if( !defined('SWP_DEV') )
{
	register_field_group(array (
		'id' => 'acf_client-forms-attach-organization',
		'title' => 'Client Forms - Attach Organization',
		'fields' => array (
			array (
				'key' => 'field_53f2e0e5ed6de',
				'label' => 'School',
				'name' => 'school_information',
				'type' => 'post_object',
				'post_type' => array (
					0 => 'school',
				),
				'taxonomy' => array (
					0 => 'all',
				),
				'allow_null' => 1,
				'multiple' => 0,
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'client_form',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array (
				0 => 'the_content',
			),
		),
		'menu_order' => 0,
	));
	register_field_group(array (
		'id' => 'acf_schools-information',
		'title' => 'Schools Information',
		'fields' => array (
			array (
				'key' => 'field_53f2db258b8dd',
				'label' => 'Name',
				'name' => 'school_name',
				'type' => 'text',
				'default_value' => '',
				'formatting' => 'html',
			),
			array (
				'key' => 'field_53f2dbf58b8e3',
				'label' => 'Office Contact',
				'name' => 'school_office_contact',
				'type' => 'text',
				'default_value' => '',
				'formatting' => 'html',
			),
			array (
				'key' => 'field_53f2db758b8de',
				'label' => 'Address Line 1',
				'name' => 'school_address_1',
				'type' => 'text',
				'default_value' => '',
				'formatting' => 'html',
			),
			array (
				'key' => 'field_53f2ddc714649',
				'label' => 'Address Line 2',
				'name' => 'school_address_2',
				'type' => 'text',
				'default_value' => '',
				'formatting' => 'html',
			),
			array (
				'key' => 'field_53f2dde01464a',
				'label' => 'City',
				'name' => 'school_city',
				'type' => 'text',
				'default_value' => '',
				'formatting' => 'html',
			),
			array (
				'key' => 'field_53f2ddf21464b',
				'label' => 'State / Providence',
				'name' => 'address_state',
				'type' => 'text',
				'default_value' => '',
				'formatting' => 'html',
			),
			array (
				'key' => 'field_53f2de1d1464c',
				'label' => 'Postal Code',
				'name' => 'school_zip',
				'type' => 'text',
				'default_value' => '',
				'formatting' => 'html',
			),
			array (
				'key' => 'field_53f2de661464d',
				'label' => 'Country',
				'name' => 'school_country',
				'type' => 'text',
				'default_value' => '',
				'formatting' => 'html',
			),
			array (
				'key' => 'field_53f2db928b8df',
				'label' => 'Phone',
				'name' => 'school_phone',
				'type' => 'text',
				'default_value' => '',
				'formatting' => 'html',
			),
			array (
				'key' => 'field_53f2dbb28b8e0',
				'label' => 'Fax',
				'name' => 'school_fax',
				'type' => 'text',
				'default_value' => '',
				'formatting' => 'html',
			),
			array (
				'key' => 'field_53f2dbc18b8e1',
				'label' => 'Website',
				'name' => 'school_website',
				'type' => 'text',
				'default_value' => '',
				'formatting' => 'html',
			),
			array (
				'key' => 'field_53f2dbd28b8e2',
				'label' => 'Notes',
				'name' => 'school_notes',
				'type' => 'textarea',
				'default_value' => '',
				'formatting' => 'br',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'school',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array (
				0 => 'the_content',
			),
		),
		'menu_order' => 0,
	));
	register_field_group(array (
		'id' => 'acf_client-forms-trip-summary',
		'title' => 'Client Forms - Trip Summary',
		'fields' => array (
			array (
				'key' => 'field_53f35e76687ae',
				'label' => 'Trip Title',
				'name' => 'trip_title',
				'type' => 'text',
				'default_value' => '',
				'formatting' => 'html',
			),
			array (
				'key' => 'field_53f35f68599a6',
				'label' => 'Trip Number',
				'name' => 'trip_number',
				'type' => 'text',
				'default_value' => '',
				'formatting' => 'html',
			),
			array (
				'key' => 'field_53f35efa91624',
				'label' => 'Start Date',
				'name' => 'start_date',
				'type' => 'date_picker',
				'date_format' => 'yymmdd',
				'display_format' => 'yy/mm/dd',
				'first_day' => 0,
			),
			array (
				'key' => 'field_53f35f3a59436',
				'label' => 'End Date',
				'name' => 'end_date',
				'type' => 'date_picker',
				'date_format' => 'yymmdd',
				'display_format' => 'yy/mm/dd',
				'first_day' => 0,
			),
			array (
				'key' => 'field_53f35f78599a7',
				'label' => 'Trip Contact Name',
				'name' => 'trip_contact_name',
				'type' => 'text',
				'default_value' => '',
				'formatting' => 'html',
			),
			array (
				'key' => 'field_53f35f93599a8',
				'label' => 'Teacher Phone',
				'name' => 'teacher_phone',
				'type' => 'text',
				'default_value' => '',
				'formatting' => 'html',
			),
			array (
				'key' => 'field_53f35fae599a9',
				'label' => 'Teacher E-mail',
				'name' => 'teacher_e-mail',
				'type' => 'email',
				'default_value' => '',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'client_form',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array (
				0 => 'the_content',
			),
		),
		'menu_order' => 1,
	));
	register_field_group(array (
		'id' => 'acf_client-forms-user-select',
		'title' => 'Client Forms - User Select',
		'fields' => array (
			array (
				'key' => 'field_53f278bef8da5',
				'label' => 'Clients',
				'name' => 'clients',
				'type' => 'user',
				'instructions' => 'Select all client accounts you wish to give access to.',
				'role' => array (
					0 => 'mpo_client',
				),
				'field_type' => 'multi_select',
				'allow_null' => 1,
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'client_form',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 2,
	));
	register_field_group(array (
		'id' => 'acf_form-locks',
		'title' => 'Form Locks',
		'fields' => array (
			array (
				'key' => 'field_53f3c64ae22a9',
				'label' => 'Manual Participants Lock',
				'name' => 'participants_is_locked',
				'type' => 'radio',
				'required' => 1,
				'multiple' => 0,
				'allow_null' => 0,
				'choices' => array (
					'true' => 'Locked',
					'false' => 'Unlocked',
				),
				'default_value' => 'false',
				'layout' => 'vertical',
			),
			array (
				'key' => 'field_53f3c7aa0d3a9',
				'label' => 'Auto Participants Lock',
				'name' => 'participants_lock_date',
				'type' => 'date_picker',
				'instructions' => 'Last date to edit list before it locks automatically (for clients).',
				'date_format' => 'yymmdd',
				'display_format' => 'yy/mm/dd',
				'first_day' => 0,
			),
			array (
				'key' => 'field_53f3c7680d3a8',
				'label' => 'Manual Rooming Lock',
				'name' => 'rooming_is_locked',
				'type' => 'radio',
				'multiple' => 0,
				'allow_null' => 0,
				'choices' => array (
					'true' => 'Locked',
					'false' => 'Unlocked',
				),
				'default_value' => 'false',
				'layout' => 'vertical',
			),
			array (
				'key' => 'field_53f3c82f0d3aa',
				'label' => 'Auto Rooming Lock',
				'name' => 'rooming_lock_date',
				'type' => 'date_picker',
				'instructions' => 'Last date to edit list before it locks automatically (for clients).',
				'date_format' => 'yymmdd',
				'display_format' => 'yy/mm/dd',
				'first_day' => 0,
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'client_form',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'side',
			'layout' => 'default',
			'hide_on_screen' => array (
				0 => 'the_content',
			),
		),
		'menu_order' => 2,
	));
	register_field_group(array (
		'id' => 'acf_client-forms-page-intros',
		'title' => 'Client Forms - Page Intros',
		'fields' => array (
			array (
				'key' => 'field_53f372a128109',
				'label' => 'Start / Welcome',
				'name' => 'intro_start',
				'type' => 'textarea',
				'default_value' => 'In this section, you will have the access to the forms to fill out the information that MPO needs to organize your trip. You will also be able to access information like important due dates, as well as detailed trip information such as the trip itinerary, hotel information, ticket information, and insurance information.
				Please fill out the forms and enjoy your trip with us!',
				'formatting' => 'br',
			),
			array (
				'key' => 'field_53f373112810a',
				'label' => 'Participants List',
				'name' => 'intro_participants',
				'type' => 'textarea',
				'default_value' => 'Please fill out this participant list by entering the full name (with the name on ID they will be

traveling with) of each participant, birth date, gender and indicate whether the participant is 

a student or adult. Once entered, the names will be available to be used for the medical and 

rooming lists so please fill out this list first. This list will also be used for insurance purposes and 

to send to the airline and for the train, if applicable. 

Please fill out this form as soon as you have the names. The list will be locked 60 days before 

your trip departure.',
				'formatting' => 'br',
			),
			array (
				'key' => 'field_53f373302810b',
				'label' => 'Dietary / Medical',
				'name' => 'intro_dietary',
				'type' => 'textarea',
				'default_value' => 'Important: the Participant List needs to be entered before filling out the Dietary / Medical list.

Please select the names of participants that have dietary or medical restrictions, then click on 

the restrictions from the list, or click other and type in the restrictions. 

Please remember that this list needs to be finalized 45 days before your trip departure. The list 

will be locked after that date.',
				'formatting' => 'br',
			),
			array (
				'key' => 'field_53f3734d2810c',
				'label' => 'Rooming List',
				'name' => 'intro_rooming',
				'type' => 'textarea',
				'default_value' => 'Important: the Participant List needs to be entered before filling out the Rooming list.

Please fill out the rooming list with 4 people max. per room (students, adults or a combination of 

both). Usually 4 students are placed together and 2 adults together unless otherwise indicated 

on your itinerary. You may add a cot if needed, but note that not all hotels have cots so contact 

MPO to see if it is possible. Select the appropriate box to indicate if the room is a male or female 

room. You may create a PDF and save it for your personal needs, by clicking on the PDF button. 

Please remember that this list needs to be finalized 45 days before your trip departure. The 

form will be locked after that date and that will be the list that will be sent to the hotel(s), unless 

otherwise advised.',
				'formatting' => 'br',
			),
			array (
				'key' => 'field_53f373662810d',
				'label' => 'Payment Schedule',
				'name' => 'intro_pay',
				'type' => 'textarea',
				'default_value' => 'Please find your payment schedule here. Please take note of the dates and check the numbers

of students and adults for accuracy. If there are any changes or errors let us know immediately. 

The final payment will be adjusted according the actual number of participants.',
				'formatting' => 'br',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'client_form',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array (
				0 => 'the_content',
			),
		),
		'menu_order' => 3,
	));
	register_field_group(array (
		'id' => 'acf_pricing',
		'title' => 'Pricing',
		'fields' => array (
			array (
				'key' => 'field_53f8bbd2f8855',
				'label' => 'Number of Students',
				'name' => 'number_students',
				'type' => 'number',
				'default_value' => '',
			),
			array (
				'key' => 'field_53f3beaa4d1b9',
				'label' => 'Cost per Student',
				'name' => 'cost_per_student',
				'type' => 'text',
				'default_value' => '',
				'formatting' => 'html',
			),
			array (
				'key' => 'field_53f8bbe7f8856',
				'label' => 'Number of Adults',
				'name' => 'number_adults',
				'type' => 'number',
				'default_value' => '',
			),
			array (
				'key' => 'field_53f3bee30d4f3',
				'label' => 'Cost per Adult',
				'name' => 'cost_per_adult',
				'type' => 'text',
				'default_value' => '',
				'formatting' => 'html',
			),
			array (
				'key' => 'field_541a24f690fd2',
				'label' => 'Number of Free Students',
				'name' => 'number_free_students',
				'type' => 'number',
				'default_value' => '',
			),
			array (
				'key' => 'field_53f3befe54028',
				'label' => 'Number of Free Adults',
				'name' => 'number_free_adults',
				'type' => 'number',
				'default_value' => '',
			),
			array (
				'key' => 'field_53f3bf173be36',
				'label' => 'Currency',
				'name' => 'currency',
				'type' => 'text',
				'instructions' => 'How the currency should be displayed on the forms, e.g.	\'US$\' => 100 (US$) or \'CD$\' => 100 (CD$).',
				'default_value' => '',
				'formatting' => 'html',
			),
			array (
				'key' => 'field_53fa990ed6591',
				'label' => 'adjustments',
				'name' => 'adjustments',
				'type' => 'text',
				'instructions' => 'Enter numeric adjustment only with either a \'+\' or \'-\' as the first character, no spaces, (e.g, +100).',
				'default_value' => '',
				'formatting' => 'none',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'client_form',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'side',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 5,
	));
	register_field_group(array (
		'id' => 'acf_initial-data',
		'title' => 'Initial Data',
		'fields' => array (
			array (
				'key' => 'field_53f3bdc5de7bb',
				'label' => 'Number of Rooms',
				'name' => 'init_rooms',
				'type' => 'number',
				'instructions' => 'If set, this will initialize the form with number of rooms specified.	Changing this value after the form has been accessed will NOT make any changes.',
				'default_value' => '',
			),
			array (
				'key' => 'field_53fa6f3fcc926',
				'label' => 'Dietary Checkboxes',
				'name' => 'dietary_checkboxes',
				'type' => 'textarea',
				'instructions' => 'List all items that should have a check-box in Dietary forms (separated by a comma).	Changes will only reflect in newly created participants.',
				'default_value' => 'Peanuts, Nuts, Vegetarian, No Pork, Gluten Intolerance/Celiac, Seafood, Shell Fish',
				'formatting' => 'none',
			),
			array (
				'key' => 'field_53fa7054cc927',
				'label' => 'Medical Checkboxes',
				'name' => 'medical_checkboxes',
				'type' => 'textarea',
				'instructions' => 'List all items that should have a check-box in Medical forms (separated by a comma).	Changes will only reflect in newly created participants.',
				'default_value' => 'Asthma, Has Epipen, Horse Allergy, Physical Handicap, Wheel Chair, Epileptic',
				'formatting' => 'none',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'client_form',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'side',
			'layout' => 'default',
			'hide_on_screen' => array (
				0 => 'the_content',
			),
		),
		'menu_order' => 10,
	));
}




}



?>