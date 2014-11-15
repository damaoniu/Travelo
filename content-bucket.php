<?php if(!get_field('disable_attributes_on_bucket','options')):?> 
        <div class="bucketEx" id="search_results">
    <?php else:?>   
        <div class="bucket2" id="search_results">
    <?php endif;?>
	<?php if(!get_field('disable_all_price','options')):?>
        	<h5><b><?php the_field('tour_currency'); the_field('price');?></b></h5>
	<?php endif; ?>
             <div class="imgHover"></div>
			 <?php 
                if ( has_post_thumbnail() ) {
	                the_post_thumbnail("tour_preview");
                }
                else {
	                echo '<div class="bucketImgDefault"></div>';
                }
            ?>
    <div class="bucketExContent">
				<a href="<?php the_permalink(); ?>"> <h3><?php the_title();?></h3> </a>
				<p><?php the_field("tour_description"); ?></p>
            
        <?php if(!get_field('disable_attributes_on_bucket','options')):
                     $checkForDefault = get_field('use_default_tour_attribute');
                    if($checkForDefault)    { $tour_attributes = get_field('tour_attributes','options'); }
                    else                    { $tour_attributes = get_field('tour_attributes'); }
                    
                    if($tour_attributes):
                        $count = 0;
                        foreach($tour_attributes as $attribute)
                        {
                            if($attribute['show_on_tour'])
                            {       
                                    if ($count == 0)
                                    {
                                        echo "<table>\n";
                                    } 
                                    echo "<tr>\n";
                                    echo "<td>".$attribute['attribute_name']."</td>\n";
                                    echo "<td>".$attribute['attribute_value']."</td>\n";
                                    echo "</tr>\n";
                                    $count++;
                                if ($count == 5)
                                    {
                                        echo "</table>\n";
                                        $count = 0;
                                    }
                            }
                        }
                        if($count != 0)
                        {
                            echo "</table>\n";
                        }  
                    ?> 
                    <div class="bPageHolder">
                        <ol class="bPageList"></ol>
                    </div>
                        <?php endif; ?>
             <?php endif;?>
         </div><!-- END bucketExContent -->
      </div><!-- END bucketEx -->