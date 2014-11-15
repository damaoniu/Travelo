<?php
/*
Template Name: NewsLetter
*/
get_header();
?>
	<div class="contentAndCommentsHolder">
			<div class="mainContent">
				<div class = "blankBody"id ="Blank">
						<?php setup_postdata($post);?>
							<?php the_content();?>
						<?php wp_reset_postdata();?> 
				</div>
            </div>
    
<?php get_sidebar();?>

        <?php $slideDown = get_field("slide_down","options")?>
        <div class="content"  <?php if($slideDown){ echo "id='SlideDown'"; }?> >
            
          <?php 
            
            while ( $wp_query->have_posts() ) : $wp_query->the_post();
	        ?>
            <div class="bucketBlog">
                <?php if ( has_post_thumbnail() ):?>
                <div class="bucketImg">
                	<?php the_post_thumbnail("tour_preview"); ?>
                    <div class="bucketImgHover"></div>
                </div>
                
                <?php endif;?>
               
                 <div class="bucketContent">
                    <a href="<?php the_permalink(); ?>"><h3><?php the_title(); ?></h3></a>
                    <p><?php the_field('post_description');?></p>
                </div><!--END bucketContent-->
            </div><!--END bucketBlog-->
               
            <?php endwhile;?>
       
        </div><!--END content-->        
		     <?php if($wp_query->max_num_pages > 1):?>
        <div class="contentPages">  
                    <?php
                      if (function_exists("pagination")){
                            pagination($wp_query->max_num_pages,4,"");
                        }
                    ?>
        </div>
            <?php endif;?>
    </div><!--END contentAndCommentsHolder-->
    
<?php
get_footer();
?>