<?php
/*
Template Name:Travels
*/
    $categoryName = '';
    if(isset($_POST["um_CatSearch"]) && $_POST["um_CatSearch"])
    {
        $categoryName = $_POST["um_CatSearch"];          
    }
get_header();?>
	
    
  

 <div class="bWrapp" <?php if($slideDown){ echo "id='SlideDown'"; }?> >
<?php
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1; 
    if($showOneCategory)
	{
		$args = array(
			
			'post_type'      => 'tours_post',
			'posts_per_page' => 6,
			'paged'          => $paged,
			'tax_query' => array(
						array(
							'taxonomy' => 'tour_category',
							'field' => 'ID',
							'terms' => $showOneCategory
						)
			
					)
		);
	}
	else{
		$args = array(
			'post_type'      => 'tours_post',
			'posts_per_page' => 6,
			'paged'          => $paged,
			'tour_category'  => $categoryName
		);
	}

	
        $the_Query = new WP_Query($args);        
         while ($the_Query->have_posts())
          {
                $the_Query->the_post();   
                get_template_part("content","bucket");
	      }
?>
 </div><!-- END bWrapp -->
   
 <div style="clear:both"></div>
<?php if($the_Query->max_num_pages > 1):?>
 <div class="contentPagesTravels">
<?php
         if (function_exists("pagination")) 
            {
                pagination($the_Query->max_num_pages, 1,"");   
            }
?>
</div>
<?php endif;?>
<?php get_footer(); ?>