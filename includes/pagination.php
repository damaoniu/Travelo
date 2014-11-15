<?php
function pagination($pages = '', $range = 4,$extLink = '#mpo_educational_travel')
{  
     $showitems = ($range * 2)+1;  
     #echo "pagination".$showitems;
     global $paged;
     if(empty($paged)) $paged = 1;
     if($pages == '')
     {
         global $wp_query;
         $pages = $wp_query->max_num_pages;
         if(!$pages)
         {
             $pages = 1;
         }
     }   
 
     if(1 != $pages)
     {
        ?>
        <div class="block_hr tf_pagination">   
            <div class="inner">
         <?php for ($i=1; $i <= $pages; $i++)
         {
             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
             {
                 echo ($paged == $i)? "<span class=\"page-numbers page_current\" id=\"current\">".$i."</span>":"<a class=\"page-numbers\" href='".get_pagenum_link($i).$extLink."'/>".$i."</a>";
             }
         }
         
         
         if(!($paged == $pages))echo "<a  class=\"page_next\" href=\"".get_pagenum_link($paged + 1).$extLink."\"><span>Next</span></a>";  
         if(!($paged == 1))echo "<a class=\"page_prev\" href='".get_pagenum_link($paged - 1).$extLink."'><span>Prev</span></a>";
         ?>
            </div>
            <div class="clear"></div>
        </div>
<?php 
     }
    }
?>