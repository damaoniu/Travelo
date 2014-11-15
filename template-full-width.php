<?php
/*
Template Name:Full Width
*/
get_header();
global $post;
setup_postdata($post);

?>
    <div id="middle" class=" cols1 full_width">
    	<div class="container_12"> 
    		<div class="content">
                <h5><?php the_title();?></h5>
            
		            <?php the_content(); ?>
		      
		    </div>
		</div>
    </div>
   <div class="clear"></div>
<?php 
after_content();
get_footer(); ?>
