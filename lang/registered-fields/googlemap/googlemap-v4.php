<?php

class acf_field_googlemap extends acf_field
{
	// vars
	var $settings, // will hold info such as dir / path
		$defaults; // will hold default field options
		
		
	/*
	*  __construct
	*
	*  Set name / label needed for actions / filters
	*
	*  @since	3.6
	*  @date	23/01/13
	*/
	
	function __construct()
	{
		// vars
		$this->name = 'googlemap';
		$this->label = __('Google Map');
		$this->category = __("Basic",'acf'); // Basic, Content, Choice, etc
		$this->defaults = array(
			// add default here to merge into your field. 
			// This makes life easy when creating the field options as you don't need to use any if( isset('') ) logic. eg:
			//'preview_size' => 'thumbnail'
		);
		
		
		// do not delete!
    	parent::__construct();
    	
    	
    	// settings
		$this->settings = array(
			'path' => apply_filters('acf/helpers/get_path', __FILE__),
			'dir' => apply_filters('acf/helpers/get_dir', __FILE__),
			'version' => '1.0.0'
		);
	}
	
	
	/*
	*  create_options()
	*
	*  Create extra options for your field. This is rendered when editing a field.
	*  The value of $field['name'] can be used (like bellow) to save extra data to the $field
	*
	*  @type	action
	*  @since	3.6
	*  @date	23/01/13
	*
	*  @param	$field	- an array holding all the field's data
	*/
	
	function create_options( $field )
	{
		// defaults?
		/*
		$field = array_merge($this->defaults, $field);
		*/
		
		// key is needed in the field names to correctly save the data
		$key = $field['name'];
		
		
		// Create Field Options HTML
		
	}
	
	
	/*
	*  create_field()
	*
	*  Create the HTML interface for your field
	*
	*  @param	$field - an array holding all the field's data
	*
	*  @type	action
	*  @since	3.6
	*  @date	23/01/13
	*/

    public function create_field($field)
    {
        // Build an unique id based on ACF's one.
        $pattern = array('/\[/', '/\]/');
        $replace = array('_', '');
        $uid = preg_replace($pattern, $replace, $field['name']);
        // Retrieve options value
        $zoom = "8";
        $center = array(0,0);

        ?>
        <script type="text/javascript">
            var uid = "<?php echo $uid;?>";
            jQuery(document).ready(function location_<?php echo $uid;?>(){function addMarker(position,address){if(marker){marker.setMap(null)}marker=new google.maps.Marker({map:map,position:position,title:address,draggable:true});map.setCenter(position);dragdropMarker()}function dragdropMarker(){google.maps.event.addListener(marker,'dragend',function(mapEvent){coordinates=mapEvent.latLng.lat()+','+mapEvent.latLng.lng();locateByCoordinates(coordinates)})}function locateByAddress(address){geocoder.geocode({'address':address},function(results,status){if(status==google.maps.GeocoderStatus.OK){addMarker(results[0].geometry.location,address);coordinates=results[0].geometry.location.lat()+','+results[0].geometry.location.lng();coordinatesAddressInput.value=address+'|'+coordinates;ddAddress.innerHTML=address;ddCoordinates.innerHTML=coordinates}else{alert("<?php _e("This address couldn't be found: ",'acf-location-field');?>"+status)}})}function locateByCoordinates(coordinates){latlngTemp=coordinates.split(',',2);lat=parseFloat(latlngTemp[0]);lng=parseFloat(latlngTemp[1]);latlng=new google.maps.LatLng(lat,lng);geocoder.geocode({'latLng':latlng},function(results,status){if(status==google.maps.GeocoderStatus.OK){address=results[0].formatted_address;addMarker(latlng,address);coordinatesAddressInput.value=address+'|'+coordinates;ddAddress.innerHTML=address;ddCoordinates.innerHTML=coordinates}else{alert("<?php _e("This place couldn't be found: ",'acf-location-field');?>"+status)}})}var map,lat,lng,latlng,marker,coordinates,address,val;var geocoder=new google.maps.Geocoder();var ddAddress=document.getElementById('location_dd-address_<?php echo $uid; ?>');var dtAddress=document.getElementById('location_dt-address_<?php echo $uid; ?>');var ddCoordinates=document.getElementById('location_dd-coordinates_<?php echo $uid; ?>');var locationInput=document.getElementById('location_input_<?php echo $uid; ?>');var location=locationInput.value;var coordinatesAddressInput=document.getElementById('location_coordinates-address_<?php echo $uid; ?>');var coordinatesAddress=coordinatesAddressInput.value;if(coordinatesAddress){var coordinatesAddressTemp=coordinatesAddress.split('|',2);coordinates=coordinatesAddressTemp[1];address=coordinatesAddressTemp[0]}if(address){ddAddress.innerHTML=address}if(coordinates){ddCoordinates.innerHTML=coordinates;var latlngTemp=coordinates.split(',',2);lat=parseFloat(latlngTemp[0]);lng=parseFloat(latlngTemp[1])}else{lat=<?php echo $center[0];?>;lng=<?php echo $center[1];?>}latlng=new google.maps.LatLng(lat,lng);var mapOptions={zoom:<?php echo $zoom;?>,center:latlng,mapTypeId:google.maps.MapTypeId.ROADMAP};map=new google.maps.Map(document.getElementById('location_map_<?php echo $uid; ?>'),mapOptions);if(coordinates){addMarker(map.getCenter())}google.maps.event.addListener(map,'click',function(point){locateByCoordinates(point.latLng.lat()+','+point.latLng.lng())});locationInput.addEventListener('keypress',function(event){if(event.keyCode==13){location=locationInput.value;var regexp=new RegExp('^\-?[0-9]{1,3}\.[0-9]{6,},\-?[0-9]{1,3}\.[0-9]{6,}$');if(location){if(regexp.test(location)){locateByCoordinates(location)}else{locateByAddress(location)}}event.stopPropagation();event.preventDefault();return false}},false);dtAddress.addEventListener('click',function(){if(coordinates){locateByCoordinates(coordinates)}},false)});
        </script>
        <input type="text" id="location_input_<?php echo $uid; ?>" placeholder="Search for a location" />
        <input type="hidden" value="<?php echo $field['value']; ?>" id="location_coordinates-address_<?php echo $uid; ?>" name="<?php echo $field['name']; ?>"/>
        <dl class="location_dl">
            <dt class="location_dt-address" id="location_dt-address_<?php echo $uid; ?>" role="button" title="<?php _e('Find the complete address','acf-location-field'); ?>"><?php _e('Address: ','acf-location-field'); ?></dt>
            <dd class="location_dd" id="location_dd-address_<?php echo $uid; ?>">&nbsp;</dd>
            <dt class="location_dt-coordinates"><?php _e('Coordinates: ','acf-location-field'); ?></dt>
            <dd class="location_dd" id="location_dd-coordinates_<?php echo $uid; ?>">&nbsp;</dd>
        </dl>
        <div class="location_map-container">
            <div class="location_map" id="location_map_<?php echo $uid; ?>"></div>
        </div>
    <?php
    }
	
	
	/*
	*  input_admin_enqueue_scripts()
	*
	*  This action is called in the admin_enqueue_scripts action on the edit screen where your field is created.
	*  Use this action to add css + javascript to assist your create_field() action.
	*
	*  $info	http://codex.wordpress.org/Plugin_API/Action_Reference/admin_enqueue_scripts
	*  @type	action
	*  @since	3.6
	*  @date	23/01/13
	*/

	function input_admin_enqueue_scripts()
	{
		// Note: This function can be removed if not used
		
		
		// register acf scripts
		wp_register_script( 'acf-input-googlemap', $this->settings['dir'] . 'js/input.js', array('acf-input'), $this->settings['version'] );
		wp_register_style( 'acf-input-googlemap', $this->settings['dir'] . 'css/input.css', array('acf-input'), $this->settings['version'] ); 
		
		
		// scripts
		wp_enqueue_script(array(
			'acf-input-googlemap',	
		));

		// styles
		wp_enqueue_style(array(
			'acf-input-googlemap',	
		));
		
		
	}
	
	
	/*
	*  input_admin_head()
	*
	*  This action is called in the admin_head action on the edit screen where your field is created.
	*  Use this action to add css and javascript to assist your create_field() action.
	*
	*  @info	http://codex.wordpress.org/Plugin_API/Action_Reference/admin_head
	*  @type	action
	*  @since	3.6
	*  @date	23/01/13
	*/

	function input_admin_head()
	{
		// Note: This function can be removed if not used
        ?>
        <style>
            .location_dl {margin-left:10px;}
            .location_dl::after
            {
                content:"";
                display:table;
                clear:both;
            }
            .location_dt-address,
            .location_dt-coordinates
            {
                float:left;
                display:block;
                width:24px;
                height:24px;
                font:0/0 a;
                color:transparent;
                background-color:white;
                background-image:url('<?php echo $this->settings["dir"]; ?>/sprite.png');
                background-repeat:no-repeat;
                border-radius:50%;
                box-shadow:0 0 3px rgba(0, 0, 0, 0.3);
            }
            .location_dt-address {cursor:pointer;}
            .location_dt-address {background-position:5px 5px;}
            .location_dt-address:hover {background-position:5px -20px;}
            .location_dt-coordinates {background-position:5px -45px;}
            .location_dd
            {
                height:20px;
                padding-top:4px;
                margin-left:30px;
            }
            .location_map
            {
                position:relative;
                z-index:0;
                width:100%;
                height:300px;
                clear:both;
            }
            .location_map-container
            {
                position:relative;
                padding:5px;
                margin-top:10px;
                background-color:#fff;
                box-shadow:0 1px 3px rgba(0,0,0,.2);
            }
        </style>
         <script src="https://maps.googleapis.com/maps/api/js?sensor=false" type="text/javascript"></script>
        <?php
	}
	
	
	/*
	*  field_group_admin_enqueue_scripts()
	*
	*  This action is called in the admin_enqueue_scripts action on the edit screen where your field is edited.
	*  Use this action to add css + javascript to assist your create_field_options() action.
	*
	*  $info	http://codex.wordpress.org/Plugin_API/Action_Reference/admin_enqueue_scripts
	*  @type	action
	*  @since	3.6
	*  @date	23/01/13
	*/

	function field_group_admin_enqueue_scripts()
	{
		// Note: This function can be removed if not used
	}

	
	/*
	*  field_group_admin_head()
	*
	*  This action is called in the admin_head action on the edit screen where your field is edited.
	*  Use this action to add css and javascript to assist your create_field_options() action.
	*
	*  @info	http://codex.wordpress.org/Plugin_API/Action_Reference/admin_head
	*  @type	action
	*  @since	3.6
	*  @date	23/01/13
	*/

	function field_group_admin_head()
	{
		// Note: This function can be removed if not used
	}


	/*
	*  load_value()
	*
	*  This filter is appied to the $value after it is loaded from the db
	*
	*  @type	filter
	*  @since	3.6
	*  @date	23/01/13
	*
	*  @param	$value - the value found in the database
	*  @param	$post_id - the $post_id from which the value was loaded from
	*  @param	$field - the field array holding all the field options
	*
	*  @return	$value - the value to be saved in te database
	*/
	
	function load_value( $value, $post_id, $field )
	{
		// Note: This function can be removed if not used
		return $value;
	}
	
	
	/*
	*  update_value()
	*
	*  This filter is appied to the $value before it is updated in the db
	*
	*  @type	filter
	*  @since	3.6
	*  @date	23/01/13
	*
	*  @param	$value - the value which will be saved in the database
	*  @param	$post_id - the $post_id of which the value will be saved
	*  @param	$field - the field array holding all the field options
	*
	*  @return	$value - the modified value
	*/
	
	function update_value( $value, $post_id, $field )
	{
		// Note: This function can be removed if not used
		return $value;
	}
	
	
	/*
	*  format_value()
	*
	*  This filter is appied to the $value after it is loaded from the db and before it is passed to the create_field action
	*
	*  @type	filter
	*  @since	3.6
	*  @date	23/01/13
	*
	*  @param	$value	- the value which was loaded from the database
	*  @param	$post_id - the $post_id from which the value was loaded
	*  @param	$field	- the field array holding all the field options
	*
	*  @return	$value	- the modified value
	*/
	
	function format_value( $value, $post_id, $field )
	{
		// defaults?
		/*
		$field = array_merge($this->defaults, $field);
		*/
		
		// perhaps use $field['preview_size'] to alter the $value?
		
		
		// Note: This function can be removed if not used
		return $value;
	}
	
	
	/*
	*  format_value_for_api()
	*
	*  This filter is appied to the $value after it is loaded from the db and before it is passed back to the api functions such as the_field
	*
	*  @type	filter
	*  @since	3.6
	*  @date	23/01/13
	*
	*  @param	$value	- the value which was loaded from the database
	*  @param	$post_id - the $post_id from which the value was loaded
	*  @param	$field	- the field array holding all the field options
	*
	*  @return	$value	- the modified value
	*/
	
	function format_value_for_api( $value, $post_id, $field )
	{
        // format value
        $value = explode('|', $value);
        if (count($value) == 2)
        {
            $value = array( 'coordinates' => isset($value[1]) ? $value[1] : $value[0] , 'address' => $value[0] );
        }
        else {
            $value = "";
        }

        // return value
        return $value;
	}
	
	
	/*
	*  load_field()
	*
	*  This filter is appied to the $field after it is loaded from the database
	*
	*  @type	filter
	*  @since	3.6
	*  @date	23/01/13
	*
	*  @param	$field - the field array holding all the field options
	*
	*  @return	$field - the field array holding all the field options
	*/
	
	function load_field( $field )
	{
		// Note: This function can be removed if not used
		return $field;
	}
	
	
	/*
	*  update_field()
	*
	*  This filter is appied to the $field before it is saved to the database
	*
	*  @type	filter
	*  @since	3.6
	*  @date	23/01/13
	*
	*  @param	$field - the field array holding all the field options
	*  @param	$post_id - the field group ID (post_type = acf)
	*
	*  @return	$field - the modified field
	*/

	function update_field( $field, $post_id )
	{
		// Note: This function can be removed if not used
		return $field;
	}

	
}


// create field
new acf_field_googlemap();

?>