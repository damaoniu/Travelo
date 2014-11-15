<?php

/*
 *	Advanced Custom Fields - New field template
 *	
 *	Create your field's functionality below and use the function:
 *	register_field($class_name, $file_path) to include the field
 *	in the acf plugin.
 *
 *	Documentation: 
 *
 */
 
 
class Skins_field extends acf_Field
{

	/*--------------------------------------------------------------------------------------
	*
	*	Constructor
	*	- This function is called when the field class is initalized on each page.
	*	- Here you can add filters / actions and setup any other functionality for your field
	*
	*	@author Elliot Condon
	*	@since 2.2.0
	* 
	*-------------------------------------------------------------------------------------*/
	
	function __construct($parent)
	{
		// do not delete!
    	parent::__construct($parent);
    	
    	// set name / title
    	$this->name = 'skins'; // variable name (no spaces / special characters / etc)
		$this->title = __("Skins",'acf'); // field label (Displayed in edit screens)
		
   	}

	
	/*--------------------------------------------------------------------------------------
	*
	*	create_options
	*	- this function is called from core/field_meta_box.php to create extra options
	*	for your field
	*
	*	@params
	*	- $key (int) - the $_POST obejct key required to save the options to the field
	*	- $field (array) - the field object
	*
	*	@author Elliot Condon
	*	@since 2.2.0
	* 
	*-------------------------------------------------------------------------------------*/
	
	function create_options($key, $field)
	{
		
	}

	
	/*--------------------------------------------------------------------------------------
	*
	*	create_field
	*	- this function is called on edit screens to produce the html for this field
	*
	*	@author Elliot Condon
	*	@since 2.2.0
	* 
	*-------------------------------------------------------------------------------------*/
	
	function create_field($field)
	{
        global $UM_PRESETS;
        $presets = $UM_PRESETS;
        $value = $field["value"];
        if($presets):
        foreach($presets as $preset):
        ?>
        <a href="#" style="display: inline-block;" class="<?php echo $field['class']; ?>" data-parentid="<?php echo $field['name']; ?>" data-skin="<?php echo $preset["view_color"]; ?>">
        <div style="width:64px;
			height:64px;
			padding:10px;
			background-color:<?php echo "#".$preset["view_color"]; ?>;
			float: left;
            margin-top:15px;
			margin-left: 10px;
            <?php echo $value == $preset["view_color"] ? "border: 5px solid #ADA7AB;" : "" ; ?>
             ">
	
	        <div style="border-top: 65px solid transparent;
			        border-left: 65px solid <?php echo $preset["skin"] == "light" ? "white" : "black";?>;
			        border-bottom: 0px solid transparent;
			        width: 0;
			        height: 0;">
	
	        </div>
	
        </div>
        </a>
        <?php endforeach;endif; ?>
        <input class="skins" type="hidden" name="<?php echo $field["name"]; ?>" id="<?php echo $field["name"]; ?>" value="<?php echo $value; ?>">
        <br style="clear: both"/>
        <?php
	}
	
	
	/*--------------------------------------------------------------------------------------
	*
	*	admin_head
	*	- this function is called in the admin_head of the edit screen where your field
	*	is created. Use this function to create css and javascript to assist your 
	*	create_field() function.
	*
	*	@author Elliot Condon
	*	@since 2.2.0
	* 
	*-------------------------------------------------------------------------------------*/
	
	function admin_head()
	{
		?>
		<script>
      jQuery(document).ready(function ($) {
          $("a.skins").click(function (e) {
              e.preventDefault();
              var preset = $(this).data("skin");
              var parent = $(this).data("parentid");
              $("input:hidden.skins").val(preset);
              $("a.skins").each(function () {
                  $(this).children().eq(0).css("border", "none");
              });
              $(this).children().eq(0).css("border", "5px solid #ADA7AB");
          });
      });
        </script>
		<?php	
	}

	
	/*--------------------------------------------------------------------------------------
	*
	*	update_value
	*	- this function is called when saving a post object that your field is assigned to.
	*	the function will pass through the 3 parameters for you to use.
	*
	*	@params
	*	- $post_id (int) - usefull if you need to save extra data or manipulate the current
	*	post object
	*	- $field (array) - usefull if you need to manipulate the $value based on a field option
	*	- $value (mixed) - the new value of your field.
	*
	*	@author Elliot Condon
	*	@since 2.2.0
	* 
	*-------------------------------------------------------------------------------------*/
	
	function update_value($post_id, $field, $value)
	{
		// save value
		parent::update_value($post_id, $field, $value);
	}
	
	
	
	
	
	/*--------------------------------------------------------------------------------------
	*
	*	get_value
	*	- called from the edit page to get the value of your field. This function is useful
	*	if your field needs to collect extra data for your create_field() function.
	*
	*	@params
	*	- $post_id (int) - the post ID which your value is attached to
	*	- $field (array) - the field object.
	*
	*	@author Elliot Condon
	*	@since 2.2.0
	* 
	*-------------------------------------------------------------------------------------*/
	
	function get_value($post_id, $field)
	{
		// get value
		$value = parent::get_value($post_id, $field);
		
		// return value
		return $value;		
	}
	
	
	/*--------------------------------------------------------------------------------------
	*
	*	get_value_for_api
	*	- called from your template file when using the API functions (get_field, etc). 
	*	This function is useful if your field needs to format the returned value
	*
	*	@params
	*	- $post_id (int) - the post ID which your value is attached to
	*	- $field (array) - the field object.
	*
	*	@author Elliot Condon
	*	@since 3.0.0
	* 
	*-------------------------------------------------------------------------------------*/
	
	function get_value_for_api($post_id, $field)
	{
		// get value
		$value = $this->get_value($post_id, $field);
        global $UM_PRESETS;
        $presets = $UM_PRESETS;
        foreach($presets as $preset){
            if($value == $preset["view_color"] && $preset["deffault"] == false ){
                return $preset;
            }
        }
		// return value
		return "";

	}
	
}

?>