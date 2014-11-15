<?php
	class umbrella_search_filter extends WP_Widget{
	
		function umbrella_search_filter() 
		{
			parent::WP_Widget(false, $name = 'Umbrella > Tour Search');
		}
		
		function widget($args, $instance)
		{
			extract( $args );
			$title = apply_filters('widget_title', $instance['title']);
			
			
            echo $before_widget;
			?>
			<div class="tagHeader">
				<?php echo $title; ?>
			</div>			
			
			<?php printWidgetFilter(); ?>
			
			
			<?php
            echo $after_widget;
		}
		
		function update($new_instance, $old_instance)
		{
			$instance = $old_instance;
			$instance['title'] = strip_tags($new_instance['title']);
			
			
			return $instance;
		}
		
		function form($instance)
		{
			$title = isset($instance['title']) ? esc_attr($instance['title']) : "";
		
		
			?>
			<p>
				<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Widget Title',"um_lang"); ?></label>
				<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
			
			<?php
		}
	}
	
	function umbrella_search_filter() {			
		register_widget('umbrella_search_filter');			
	}
	add_action('widgets_init', 'umbrella_search_filter');
?>