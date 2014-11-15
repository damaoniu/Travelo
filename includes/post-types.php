<?php
add_action( 'init', 'register_posts' );
	function register_posts() {
				
        register_post_type( 'tours_post',
			array(
				'labels' => array(
					'name' => __( "Tours","um_lang"),
					'singular_name' => __( "Tour" ,"um_lang")
				),
				'public' => true,
				'has_archive' => true,			
				'rewrite' => array('slug' => "tours_post", 'with_front' => TRUE),
				'supports' => array('title','editor','comments','thumbnail','page-attributes')				
			)
		);

		/*register_taxonomy('tour_category',array (
		  0 => 'tours_post',
		),array( 'hierarchical' => true, 'label' => __('Tour Category',"um_lang"),'show_ui' => true,'query_var' => true,'singular_label' => __('Tour Category',"um_lang")) );*/
        
	}
	register_post_type("activity",
			array(
				'labels'=>array(
					'name'=>__("Activities","um_lang"),
					'singular_name' => __('Activity','um_lang')
					),
				'public' => true,
				'has_archive' => true,
				'rewrite' => array('slug' => 'activity', 'with_front' => true),
				'supports' => array('title','editor', 'comments','thumbnail','page-attributes')


				)
		);
	register_taxonomy(
		'activity_category',
		array (
		  0 => 'activity',
		),
		array ( 'hierarchical' => true, 
			'label' => __('Activity Category',"um_lang"),
			'show_ui' => true,'query_var' => true,
			'singular_label' => __('Activity Test',"um_lang")
			) 
		);
    
    register_taxonomy(
    	'sample_tour',
    	array (
    	  0 => 'tours_post',
    	  ),
    	  array (
    	  	'hierarchical' => true, 
    	  	'label' => __('Sample Tour',"um_lang"),
    	  	'show_ui' => true,
    	  	'query_var' => true,
    	  	'singular_label' => __('Sample Tour',"um_lang")
    	  	)
    	);

// try at a new section on tours post


?>