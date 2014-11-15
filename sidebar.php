<?php
    if(is_active_sidebar( 'sidebar-1' )):
?>
	<?php if(get_field('right_sidebar','options')):?>
		<div class="right">
	<?php else:?>
		<div class="left">
	<?php endif; ?>
    
	<?php dynamic_sidebar( 'sidebar-1' );?>
		
		</div><!-- end Left -->
<?php endif;?>
