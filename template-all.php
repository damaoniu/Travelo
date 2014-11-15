<?php
/*
Template Name: All packages
*/
  get_header();		
  global $post;
  setup_postdata( $post );
  $arg = array (
  	'post_type' => 'tours_post',
  	'sample_tour' => 'no',
  	'posts_per_page' => 10,
  	'paged' => $paged = get_query_var('paged')? $paged = get_query_var('paged'):1
  	);
  $packages => new WP_Query($arg);
?>

<?php
after_content();
get_footer();
?>