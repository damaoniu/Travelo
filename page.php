<?php
get_header();
global $post;
setup_postdata($post);
?>
  
<div class="contentAndCommentsHolder">
        <?php get_sidebar();?>
      <div class="contentDefault">
          <div class="blankHeader">
                <h5><?php the_title();?></h5>
            </div>
       <div class ="blankBody">
            <?php the_content(); ?>
        </div>
    </div>
    </div>
<?php get_footer(); ?>