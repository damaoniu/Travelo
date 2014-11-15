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
 
 
class patterns_field extends acf_Field
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
    	$this->name = 'patterns'; // variable name (no spaces / special characters / etc)
		$this->title = __("Patterns",'acf'); // field label (Displayed in edit screens)
		
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
        $value = $field["value"];
        ?>
        <select id="<?php echo $field["name"]; ?>" name="<?php echo $field["name"]; ?>" class="<?php echo $field["class"]; ?>">
            <option value="" <?php echo $value == "" ? "selected='selected'" : ""; ?> >None</option>
            <option value="billie_holiday.png" <?php echo $value == "billie_holiday.png" ? "selected='selected'" : ""; ?> >Billie Holiday</option>
            <option value="black_thread.png" <?php echo $value == "black_thread.png" ? "selected='selected'" : ""; ?>>Black Thread</option>
            <option value="blackorchid.png" <?php echo $value == "blackorchid.png" ? "selected='selected'" : ""; ?>>Black Orchid</option>
            <option value="checkered_pattern.png" <?php echo $value == "checkered_pattern.png" ? "selected='selected'" : ""; ?>>Checkered Pattern</option>
            <option value="classy_fabric.png" <?php echo $value == "classy_fabric.png" ? "selected='selected'" : ""; ?>>Classy Fabric</option>
            <option value="darkdenim3.png" <?php echo $value == "darkdenim3.png" ? "selected='selected'" : ""; ?>>Drak Denim</option>
            <option value="denim.png" <?php echo $value == "denim.png" ? "selected='selected'" : ""; ?>>Denim</option>
            <option value="dvsup.png" <?php echo $value == "dvsup.png" ? "selected='selected'" : ""; ?>>Dvsup</option>
            <option value="fabric_plaid.png" <?php echo $value == "fabric_plaid.png" ? "selected='selected'" : ""; ?>>Fabric Plaid</option>
            <option value="fake_brick.png" <?php echo $value == "fake_brick.png" ? "selected='selected'" : ""; ?>>Fake Brick </option>
            <option value="grilled.png" <?php echo $value == "grilled.png" ? "selected='selected'" : ""; ?>>Grilled </option>
            <option value="groovepaper.png" <?php echo $value == "groovepaper.png" ? "selected='selected'" : ""; ?>>Grove paper </option>
            <option value="hixs_pattern_evolution.png" <?php echo $value == "hixs_pattern_evolution.png" ? "selected='selected'" : ""; ?>>Hixs Pattern Evolution </option>
            <option value="irongrip.png" <?php echo $value == "irongrip.png" ? "selected='selected'" : ""; ?>>Iron Grip </option>
            <option value="nami.png" <?php echo $value == "nami.png" ? "selected='selected'" : ""; ?>>Nami </option>
            <option value="old_wall.png" <?php echo $value == "old_wall.png" ? "selected='selected'" : ""; ?>>Old Wall </option>
            <option value="pw_maze_black.png" <?php echo $value == "pw_maze_black.png" ? "selected='selected'" : ""; ?>>Black Maze </option>
            <option value="pw_maze_white.png" <?php echo $value == "pw_maze_white.png" ? "selected='selected'" : ""; ?>>White Maze </option>
            <option value="px_by_Gre3g.png" <?php echo $value == "px_by_Gre3g.png" ? "selected='selected'" : ""; ?>>PX </option>
            <option value="ravenna.png" <?php echo $value == "ravenna.png" ? "selected='selected'" : ""; ?>>Ravenna </option>
            <option value="ricepaper.png" <?php echo $value == "ricepaper.png" ? "selected='selected'" : ""; ?>>Rice Paper </option>
            <option value="ricepaper2.png" <?php echo $value == "ricepaper2.png" ? "selected='selected'" : ""; ?>>Rice Paper 2 </option>
            <option value="struckaxiom.png" <?php echo $value == "struckaxiom.png" ? "selected='selected'" : ""; ?>>Struck Axiom </option>
            <option value="texturetastic_gray.png" <?php echo $value == "texturetastic_gray.png" ? "selected='selected'" : ""; ?>>Texture Tastic Gray </option>
            <option value="vertical_cloth.png" <?php echo $value == "vertical_cloth.png" ? "selected='selected'" : ""; ?>>Vertical Cloth </option>
            <option value="white_plaster.png" <?php echo $value == "white_plaster.png" ? "selected='selected'" : ""; ?>>White Plaster </option>
            <option value="whitediamond.png" <?php echo $value == "whitediamond.png" ? "selected='selected'" : ""; ?>>White Diamond </option>
            <option value="wood_pattern.png" <?php echo $value == "wood_pattern.png" ? "selected='selected'" : ""; ?>>Wood Pattern </option>



        </select>

        <img src="<?php echo $value ? get_template_directory_uri()."/images/patterns/".$value : ""; ?>" class="<?php echo $field["class"]; ?>" style="margin-top: 10px;
        width: 200px;
        height: 50px;
        border: 1px solid;"/>
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
          $("select.patterns").change(function () {
              var image = $(this).val();
              if(!image){
                $("img.patterns").removeAttr("src");
                $("img.patterns").hide();
                return false;
            }
                $("img.patterns").show();
              $("img.patterns").attr("src","<?php echo get_template_directory_uri(); ?>/images/patterns/"+image);
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
        $value = $this->get_value($post_id, $field);
		// return value
		return $value;

	}
	
}

?>