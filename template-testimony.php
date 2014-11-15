<?php
/*
Template Name:Testimony
*/
$postspage_id = 0;
if(!is_page()){
    $postspage_id = get_option('page_for_posts'); 
    $post = get_post($postspage_id);
 

}
get_header();

?>
<div id="middle" class="cols2">
    <div class="container_12">
        <!--bread crumbs-->
            <div class="breadcrumbs">
                <p><a href="<?php echo get_site_url(); ?>">Homepage</a><span class="separator">&gt;</span> <a href="<?php echo site_url("/blog");?>">Testimony</a> 
            </div>
        <!--/bread crumbs-->
        <!--main list-->
            <div class="content">
                <?php setup_postdata($post);?>
                <?php //the_content();?>
                <div class="post-list">
                    <?php 
                     $arg= array(
                        'post_type'=>'post',
                        'category' => 'testimony',
                        'posts_per_page'=>6 
                        );
                     $blog= new WP_Query($arg);

                    while ( $blog->have_posts() ) : 
                        $blog->the_post();
                    ?>
                    <div class="post-item">
                        <div class="post-title"><h2><a href="<?php the_permalink();?>"><?php the_title();?></a></h2></div>
                        <div class="post-image">
                            <a href="<?php the_permalink();?>">
                                 <?php 
                                    $post_image = get_field('content_image');
                                    if($tour_images):
                                ?>
                                <img src="<?php echo $post_image;?>" alt="" width="219" height="156">
                                <?php endif; ?>
                            </a>
                        </div>
                        <div class="post-short">     
                            <div class="post-descr">
                                <p><?php the_field('post_description');?></p>
                            </div>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <?php
                    endwhile;
                    ?>
                </div>
                <!--pagination-->
                <?php if($wp_query->max_num_pages > 1):?>
                    <div class="block_hr tf_pagination">
                        <div class="inner"> 
                                <?php
                                  if (function_exists("pagination")){
                                        pagination($wp_query->max_num_pages,4,"");
                                    }
                                ?>
                        </div>
                    </div>

                <?php endif;?>
                <?php wp_reset_postdata();?> 
            </div>

        <!--/main list-->
            <div class="sidebar"> 
            <?php destinationFilter();?> 
            </div>
		 
    </div><!--/container-->
</div><!--/middle-->
<div class="clear"></div>
    
<?php
after_content();
get_footer();
?>