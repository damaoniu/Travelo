<?php
/*
Template Name:Blog
*/
$postspage_id = 0;
if(!is_page()){
    $postspage_id = get_option('page_for_posts'); 
    $post = get_post($postspage_id);
 

}
get_header();

?>
<div id="middle" class="cols2 sidebar_left">
    <div class="container_12">
        <!--bread crumbs-->
            <div class="breadcrumbs">
                <p><a href="<?php echo get_site_url(); ?>">Homepage</a><span class="separator">&gt;</span> <a href="<?php echo site_url("/blog");?>">Testimony</a> 
            </div>
        <!--/bread crumbs-->
        <!--main list-->
            <div class="content">
                <?php setup_postdata($post);
                $paged = (get_query_var('paged')) ? get_query_var('paged') : 1; 
                $arg= array(
                        'post_type'=>'post',
                        'paged' => $paged,
                        );
                $blog= new WP_Query($arg);
                //the_content();
                ?>
                <!--pagination-->
                    <?php if($blog->max_num_pages > 1):
                              if (function_exists("pagination")){
                                    pagination($blog->max_num_pages, 2);
                                }
                         endif;
                    ?>
                <!---pagination-->
                <div class="post-list">
                    <?php 
                    if( $blog->have_posts()):
                    while ( $blog->have_posts() ) : 
                        $blog->the_post();
                    ?>
                    <div class="post-item">
                        <div class="post-title"><h2><a><?php the_title();?></a></h2></div>
                        <div class="post-image">
                            <a href="<?php the_permalink();?>">
                                 <?php 
                                    $post_image = get_field('content_image');
                                    if($post_image):
                                ?>
                                <img src="<?php echo $post_image;?>" alt="" width="219" height="156">
                                <?php endif; ?>
                            </a>
                        </div>
                        <div class="post-short">     
                            <div class="post-descr">
                                <p><?php the_field('post_description');?></p>
                                <p><?php the_content();?></p>
                            </div>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <?php
                    endwhile;
                    endif; 
                    ?>
                </div>
                
            </div>

        <!--/main list-->
        <!--filter-->
        <?php destinationFilter(); ?>
        <!--filter-->
		 
    </div><!--/container-->
</div><!--/middle-->
<div class="clear"></div>
    
<?php
after_content();
get_footer();
?>