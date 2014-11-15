<?php
/*
Template Name: Destination
Version 1.0 
Year Sep 2013
By Joe Zhou for MPO Eudcational Travel
*/

global $wpdb;
get_header();
?>


 <!--maintian container-->

        
    <?php  
        
        if(isset($_GET['country'])&&!isset($_GET['city'])){
            country_city(); 
        }
        elseif ((isset($_GET['city'])&&isset($_GET['country']))) {
            single_city(); 

        }else{
        city_navigator();//destinationFilter();
        }

    ?>
  
  <div class="clear"></div>
  
<?php 
after_content();
get_footer();
?>
	
