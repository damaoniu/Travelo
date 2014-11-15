<?php
$postspage_id = 0;
if(!is_page()){
    $postspage_id = get_option('page_for_posts'); 
    $post = get_post($postspage_id);
}
get_header();
?>
   	<div class="contentAndCommentsHolder">
    
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
               <?php if($wp_query->max_num_pages > 1):?>
        <div class="contentPages">  
                    <?php
                      if (function_exists("pagination")){
                            pagination($wp_query->max_num_pages,4,"");
                        }
                    ?>
       
        </div>
            <?php endif;?>
        </div><!--END content-->        
    </div><!--END contentAndCommentsHolder-->
    
<?php
get_footer();
?>