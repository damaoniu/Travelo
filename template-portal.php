<?php 
/*
Template Name:portal_page
*/

	get_header();
	global $post;
	setup_postdata( $post );	
 ?>
 <?php //get_sidebar();?>

<div class="contentAndCommentsHolder">
    	
       
        
     
		<div class="singlepostContent">
               <div <?php post_class(); ?>>
                <?php if(get_field('content_image')):?>
                    <img src="<?php the_field('content_image');?>" />
                <?php endif;?>
            <h3><?php the_title();?></h3>
            <p><?php the_content();?></p>

             
        </div><!--END singlepostContent-->
    
        
   
 <?php if(!get_field('disable_comments')) comments_template( '/post-comments.php' ); ?> 
</div>
<?php get_footer(); ?>