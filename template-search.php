<?php
/*
Template Name:Search
*/
get_header(); 
if(isset($_SESSION['filter_session'])){
             $arg = $_SESSION['filter_session'];
             EndSession();    
        }
        else{
        $arg = search_filter();
        //echo "without session";
        //print_r($arg);
    }
        
        $packages= new WP_Query($arg);
        #print_r($packages);
        #echo 'template-search';     
?>

<div id="middle" class="cols2 sidebar_right">
    <div class="container_12"> 
        <!-- breadcrumbs -->
        <div class="breadcrumbs">
            <p><a href="#">Homepage</a> <span class="separator">&gt;</span> <a href="#">Search</a> <span class="separator">&gt;</span> <span><?php echo $_POST['city'];?></span></p>
        </div>
        <!--/ breadcrumbs -->
        
        <div class="content" id="search_result"> 
            <div class="title">
                <h1>Packages match your search:</h1>
                <span class="title_right count"><?php echo $packages->found_posts;?> available packages</span>
            </div>

            <!--package list-->
                <div class="re-list">  
                    <?php if ($packages->have_posts()):?>

                    <?php
                        if(function_exists('wp_paginate')) {
                                wp_paginate();
                            }
                        /*$big = 999999999; // need an unlikely integer

                        echo paginate_links( array(
                            'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                            'format' => '?paged=%#%',
                            'current' => max( 1, get_query_var('paged') ),
                            'total' => $packages->max_num_pages
                        ) );*/
                    ?>

                    <?php  while ( $packages->have_posts()): 
                                $packages->the_post();
                                $price=get_field('price');
                                $currency=get_field('currency');
                                
                    ?>

                        <div class="re-item">           
                                    <div class="re-image">
                                        <a href="<?php the_permalink();?>" hidefocus="true" style="outline: none; overflow:hidden;">
                                            <?php 
                                                $tour_images = get_field('tour_slider');
                                                if($tour_images):?>
                                                    <img src="<?php echo $tour_images[0]['image']; ?>">
                                                <?php  endif;  ?>
                                            <span class="caption">View More Details</span>
                                        </a>
                                    </div>
                                    
                                    <div class="re-short">              
                                        <div class="re-top">
                                            <h2><a href="<?php the_permalink();?>" hidefocus="true" style="outline: none;"><?php the_title(); ?></a></h2>
                                        </div>                
                                        <div class="re-descr">
                                            <p><?php 
                                            $overview = wp_trim_words(get_field('overview'),40,'<a href="'.get_permalink().'">...Read More</a>');
                                            echo $overview;
                                            ?></p>
                                        </div>      
                                    </div>
                                    <div class="re-bot">
                                        <span class="re-price">Price: <strong><?php echo $currency.$price;?></strong></span>
                                        <a href="<?php echo site_url('request-quote?um_choose='.$post->ID);?>"  title="View Photos" hidefocus="true" style="outline: none;">| Customize this tour</a>
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
                    <?php endif; ?>
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
after_content();
get_footer(); 
?>