<?php
class acf_field_presets_plugin
{
	/*
	*  Construct
	*
	*  @description: 
	*  @since: 3.6
	*  @created: 1/04/13
	*/
	
	function __construct()
	{
		// set text domain
		/*
		$domain = 'acf-presets';
		$mofile = trailingslashit(dirname(__File__)) . 'lang/' . $domain . '-' . get_locale() . '.mo';
		load_textdomain( $domain, $mofile );
		*/
		
		
		// version 4+
		add_action('acf/register_fields', array($this, 'register_fields'));	

		
		// version 3-
		add_action( 'init', array( $this, 'init' ));
	}
	
	
	/*
	*  Init
	*
	*  @description: 
	*  @since: 3.6
	*  @created: 1/04/13
	*/
	
	function init()
	{
		if(function_exists('register_field'))
		{ 
			register_field('acf_field_presets', dirname(__File__) . '/presets-v3.php');
		}
        include_once('presets-v4.php');
	}
	
	/*
	*  register_fields
	*
	*  @description: 
	*  @since: 3.6
	*  @created: 1/04/13
	*/
	
	function register_fields()
	{
		include_once('presets-v4.php');
	}
	
}

new acf_field_presets_plugin();
		
?>
