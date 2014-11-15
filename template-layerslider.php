<?php
/*
Template Name:Home
*/
 get_header();
 before_content();
?> 
<div id="middle" class="full_width">
    <div class="container_12"> 
        <div class="content"> 
            <h2>MPO Smple Tours:</h2>
             <hr/> 
            <div class="post-detail"> 
                <div class="entry"> 
                    <div class="grid_list">          
                            <?php
                                $args1 = array(
                                    'post_type' => 'tours_post',
                                    'sample_tour' => 'no',
                                    'posts_per_page' => 9
                                    );
                                $the_query2 = new WP_Query($args1);
                                    
                                while ( $the_query2->have_posts() ):
                                         $the_query2->the_post();
                                ?>
                                <div class="list_item">
                                    <div class="item_img">
                                        <?php
                                         $images= get_field('tour_slider');
                                         if($images):
                                        ?>
                                        <img src="<?php echo $images[0]['image'];?>">
                                        <?php endif; ?>
                                        <p class="caption">
                                            <a href="<?php the_permalink();?>"><?php the_title();?></a>
                                            <span class="price">
                                            <?php if(!get_field('disable_all_price','options')):?>
                                                <ins><?php the_field('tour_currency');?></ins><strong><?php the_field('price');?></strong>
                                            <?php endif; ?>
                                            </span>
                                        </p>
                                        <a href="<?php the_permalink();?>" class="link-img">more...</a>
                                    </div>
                        
                                </div>
                            <?php endwhile; ?>
                    </div>  
                </div>       
            </div>
        </div> 
        <div class="clear"></div>            
    </div>
</div> 

<?php
after_content();
get_footer();
?>