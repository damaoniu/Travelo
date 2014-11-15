<?php
function um_widgets_init() {

	register_sidebar( array(
		'name' => __( 'Sidebar', 'umbrella' ),
		'id' => 'sidebar-1',
		'before_widget' => '<div id="%1$s" class="tags">',
		'after_widget' => "</div>",
		'before_title' => '<div class="tagHeader">',
		'after_title' => '</div>',
	) );
	register_sidebar( array(
		'name' => __( 'Sidebar2', 'umbrella' ),
		'id' => 'sidebar-2',
		'before_widget' => '<div id="%1$s" class="tags">',
		'after_widget' => "</div>",
		'before_title' => '<div class="tagHeader">',
		'after_title' => '</div>',
	) );

	
}
add_action( 'widgets_init', 'um_widgets_init' );
?>