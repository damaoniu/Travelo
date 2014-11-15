<?php
$postspage_id = 0;
if(!is_page()){
    $postspage_id = get_option('page_for_posts'); 
    $post = get_post($postspage_id);
}
get_header();

#add the filter-search function to overide part of the result thus solving the pagination problem
/*if(isset($_POST['destinationFilter'])&& !empty($_POST['destinationFilter'])){
    $arg = search_filter();
    $wp_query = new WP_Query($arg);
    print_r($arg);
}*/

//echo "seach.php";
?>
<div id="middle" class="cols2 sidebar_left">
    <div class="container_12"> 
        <!-- breadcrumbs -->
        <div class="breadcrumbs">
            <p><a href="<?php get_site_url();?>">Homepage</a> <span class="separator">&gt;</span> <a href="#">Search</a> <span class="separator">&gt;</span> <span><?php echo $_POST['s'];?></span></p>
        </div>
        <!--/ breadcrumbs -->
        
        <div class="content" id="single_content"> 
            <div class="title">
                <h1>Packages match your search: <span><?php echo $_POST['s'];?></span></h1>
                <span class="title_right count"><?php echo $wp_query->found_posts;?> mathing results</span>
            </div>

            
            <!--package list-->
                <div class="re-list">  
                         
                    <!-- sorting,pagination pages -->
                        
                              
                                <?php if($wp_query->max_num_pages > 1):                          
                                      if (function_exists("pagination")) {
                                         pagination($wp_query->max_num_pages,1);
                                        }
                                endif;
                                ?>
                            
                        <!--/ sorting, pages -->
                    <?php if($wp_query->have_posts()):
                            while ( $wp_query->have_posts()): 
                                $wp_query->the_post();
                                $price=get_field('price');
                                $currency=get_field('currency');
                                $type=get_post_type();
                    ?>

                        <div class="re-item">           
                                    
                                            <?php 
                                                $tour_images = get_field('tour_slider');
                                                if($tour_images):
                            
                                                ?>
                                                        <div class="re-image">
                                                            <a href="<?php the_permalink();?>" hidefocus="true" style="outline: none; overflow:hidden;">
                                                                <img src="<?php echo $tour_images[0]['image']; ?>">
                                                                <span class="caption">View More Details</span>
                                                            </a>
                                                        </div>
                                                <?php   endif; ?>
                                    <div class="re-short">              
                                        <div class="re-top">
                                            <h2><a href="<?php the_permalink();?>" hidefocus="true" style="outline: none;"><?php the_title();echo "  ".$type;?></a></h2>
                                        </div>                
                                        <div class="re-descr">
                                            <p><?php the_content();?></p>
                                        </div>                
                                        
                                    </div>
                                    <div class="re-bot">
                                            <span class="re-price">Price: <strong><?php echo $currency.$price;?></strong></span>
                                            <a href="<?php the_permalink();?>" class="link-viewimages" title="View Photos" hidefocus="true" style="outline: none;">Photos</a>
                                    </div>
                                    <div class="clear"></div>
                                </div>
    

                    <?php 
                            endwhile;
                    else: ?>
                    
                        <div class="resultWrapper">
                            <h3 class="orange"> <?php  _e('No results.','um_lang'); ?> </h3>
                            <p> <?php  _e("Sorry we couldn't find any results.","um_lang"); ?></p>
                            <p class="smile">:(</p>
                        </div>
                    <?php endif;?>
                </div>
                
                
        </div><!--/end content-->
        <!--filter-->
            <?php destinationFilter();?>
        <!--/filter-->
        <div class="clear"></div>
    </div>
</div>
    
<div class="clear"></div>
          
    
<?php
get_footer();
?>