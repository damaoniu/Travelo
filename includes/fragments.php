<?php
function get_country_menu_list($country){
    $terms=get_terms("um_".toAscii($country),array ('hide_empty' => false));
    $count=0;
    foreach ($terms as $term):
        if($count<1):?>
        <li class="menu-level-2 first">
            <form method ="get" action="<?php echo site_url("/destinations");?>" onClick="jQuery(this).submit();">
              <input type="hidden" name="country" value="<?php echo $country;?>">
              <input type="hidden" name="city" value="<?php echo $term->slug;?>">
              <a ><span><?php echo $term->name;?></span></a>
            </form>

        </li>
        <?php
            $count++;
         elseif($count<10):?>
        <li class="menu-level-2">
            <form method ="get" action="<?php echo site_url("/destinations");?>" onClick="jQuery(this).submit();">
              <input type="hidden" name="country" value="<?php echo $country;?>">
              <input type="hidden" name="city" value="<?php echo $term->slug;?>">
              <a ><span><?php echo $term->name;?></span></a>
            </form>
        </li>
    <?php 
       $count++;
    else:?>
        <li class="menu-level-2 more-nav last">
            <form method ="get" action="<?php echo site_url("/destinations");?>" onClick="jQuery(this).submit();">
                <input type="hidden" name="country" value="<?php echo $country;?>">
                <a ><span>See all Destinations</span></a>
            </form>
        </li>
      <?php 
         return;
      endif;
      endforeach;
      ?>

<?php 
}
function new_header()
{
?>
<div class="header">
    <div class="container_12">
        
        <div class="logo">    
            <a href="<?php echo site_url(); ?>" class="logo"><img src = "http://mpoeduc.com/wp-content/uploads/2013/12/MPO-logo-shadow-2-e1386452789693.png"/></a>
        </div> 
            <div class="header_right">
                <?php search_form();?> 
                
                <!--<div class="toplogin">
                    <p><a href="#">SIGN IN</a> <span class="separator">|</span> <a href="#">REGISTER</a></p>
                </div>-->    
                
                <div class="header_phone">
                    <p style="font-size:15px;">CALL US NOW: &nbsp; <strong style="font-size:15px;" class="telephone"> 1-888-MPO-EDUC (676-3382)</strong></p>
                </div>          
                
                <div class="clear"></div>
            </div>
        
        <div class="topmenu">
            <ul class="dropdown">
                <li class="menu-level-0 menu-item-home"><a href="<?php echo site_url();?>"><span>Home</span></a></li>
                <li class="menu-level-0 mega-nav parent">
                    <form method ="post" action="<?php echo site_url("/destinations");?>" onClick="jQuery(this).submit();">
                        <a href="#"><span>Destinations</span></a>
                    </form>
                    <ul class="submenu-1">
                        <li class="menu-level-1 parent first">
                            <form method ="get" action="<?php echo site_url("/destinations");?>" onClick="jQuery(this).submit();">
                                <input type="hidden" name="country" value="canada">
                                <a ><img src="http://mpoeduc.com/wp-content/uploads/2014/06/map-canada-white.png" alt=""> <span>Canada</span></a>
                            </form>
                            <ul class="submenu-2">
                                 <?php get_country_menu_list("canada");?>
                            </ul>
                        </li>
                        <li class="menu-level-1 parent">
                            <form method ="get" action="<?php echo site_url("/destinations");?>" onClick="jQuery(this).submit();">
                                <input type="hidden" name="country" value="usa">
                                <a ><img src="http://mpoeduc.com/wp-content/uploads/2014/06/map-usa-white.png" alt=""> <span>USA</span></a>
                            </form>
                            <ul class="submenu-2">
                                 <?php get_country_menu_list("usa");?>             
                            </ul>
                            
                        </li>
                        <li class="menu-level-1 parent">
                            <form method ="get" action="<?php echo site_url("/destinations");?>" onClick="jQuery(this).submit();">
                                <input type="hidden" name="country" value="europe">
                                <a ><img src="<?php echo get_template_directory_uri();?>/images/icons/continent_4.png" alt=""> <span>EUROPE</span></a>
                            </form>
                            <ul class="submenu-2">
                                 <?php get_country_menu_list("europe");?>
                            </ul>

                        </li>
                        <li class="menu-level-1 parent last">
                            <form method ="get" action="<?php echo site_url("/destinations");?>" onClick="jQuery(this).submit();">
                                <input type="hidden" name="country" value="asia">    
                                <a ><img src="<?php echo get_template_directory_uri();?>/images/icons/continent_5.png" alt=""> <span>ASIA & SOUTH PACIFIC</span></a>
                            </form>
                            <ul class="submenu-2">
                                 <?php get_country_menu_list("asia");?>
                            </ul>

                        </li>
                    </ul>
                </li>
                <li class="menu-level-0"><a href="<?php echo site_url("/request-quote");?>"><span>Request a Quote</span></a></li>
                <li class="menu-level-0 "><a href="<?php echo site_url("/blog");?>"><span>Testimonials</span></a>
                </li>
                <li class="menu-level-0"><a href="<?php echo site_url("/about-us");?>"><span>About Us</span></a>
                    <ul class="submenu-1" >
                    <li class="menu-level-1 first" style=""><a href="<?php echo site_url("/contact-us");?>" ><span>Contact Us</span></a>
                    </li>
                </ul>
                </li>
                <li class="menu-level-0"><a href="<?php echo site_url("/terms");?>"><span>Terms</span></a></li>
                <li class="menu-level-0"><a href="<?php echo site_url("/faq");?>"><span>FAQ</span></a></li>
                <li class="menu-level-0"><a href="/myforms"><span>Client Area</span></a></li>
                
            </ul>
            <div class="clear"></div>
        </div>
        
        <div class="clear"></div>
    </div>
</div>
<!--/ header -->
<?php
}



function before_content(){
    ?>
<!-- before content-home -->
    <div class="before_content">
    <div class="before_inner">
        <div class="container_12">
            
            <div class="title">
                <h2>Search For A Sample Tour</h2>
                <!--\span class="title_right"><a href="#">See sample packages</a></span-->
                <!--span class="title_right search_main">
                        <input type="button" id="searcherButton" value="Search" class="btn btn-find">
                </span-->
            </div>
            
            <div class="search_main">
                <?php printFilter();?>        
            </div>
            
        </div>
    </div>
    </div>
<!--/ before content home -->
<?php 
}

function after_content(){
    ?>
    <!-- after content -->
<div class="after_content">
<div class="after_inner">
    <div class="container_12">
        
        <!--# widgets area, col 1 -->    
        <div class="widgetarea widget_col_1">
            <h3>Registered with:</h3>   
            
            <a href="http://tico.ca" target="_blank">
                <img src="http://mpoeduc.com/wp-content/uploads/2014/06/icon_tico_logo.png" height="69" width="100">
            </a> 
            <br/> 
            <span><b>Registration number</b>: #50014300</span>
      
            <br/>
            <br/>
            
            <a href="http://acta.ca" target="_blank">
                <img src="http://mpoeduc.com/wp-content/uploads/2014/06/icon-ACTA.jpg" height="44" width="100">
            </a>
        
            <br/> 
            <br/>
           
            <a href="http://www.syta.org" target="_blank">
                <img src="http://mpoeduc.com/wp-content/uploads/2014/06/icon-SYTA.jpg" height="50" width="208">
            </a>
                      

        
            
            
        </div>
        <!--/ widgets area, col 1 -->    
        
        <!--# widgets area, col 2 -->
        <div class="widgetarea widget_col_2">
            
            <?php news_letter();?>
            
        </div>
        <!--/ widgets area, col 2 -->
        
        <!--# widgets area, col 3 -->
        <div class="widgetarea widget_col_3">
            
            <!-- widget_twitter -->            
            <div class="widget-container widget-youtube">
                <h3 style="align:center;"><img src="<?php echo get_template_directory_uri();?>/images/YouTube-logo-full_color.png" width="115.5" height="72" alt="MPO Educational Travel">&nbsp;</h3>  
                    <div class="inner">
                     Find us and join us on our Youtube channel as we update with you with our traveling videos.
                    </div>
                    <div class="clear"></div>
                <a target="blank" href="http://www.youtube.com/channel/UCG7gHsfF_RRCTfn1rvFcicQ" class="fallow"><img src="<?php echo get_template_directory_uri();?>/images/YouTube-icon-full_color.png" with="51" height="36"/></a>
            </div>
            <!--/ widget_twitter -->
        </div>
        <!--/ widgets area, col 3 -->
        
        <div class="clear"></div>
    </div>
</div>
</div>
<!--/ after content -->
<?php
}

function sidebar(){
    ?>
    <!-- sidebar -->
        <div class="sidebar">
            
            <!-- widget_contact -->
            <div class="widget-container widget_contact">   
                <div class="inner">   
                    
                    <div class="contact-address">
                        <div class="name"><strong>MPO Educational Travel</strong></div>
                        <div class="address"><?php if(get_field('address','options')):?><?php the_field('address','options');?><?php endif;?></div>
                        <div class="phone"><em><?php if(get_field('phone','options')):?><?php _e('Phone ','um_lang');?></em> <span><?php the_field('phone','options');?></span><?php endif;?></div>
                        <!--<div class="fax"><em>Fax:</em> <span>555-345.285</span></div>-->
                        <div class="mail"><em><?php if(get_field('email','options')):?><?php _e('Email ','um_lang');?></em> <a href="mailto:<?php the_field('email','options');?>"><?php the_field('email','options');?></a><?php endif;?></div>
                    </div>
                    <?php $social = get_field('social_networks','options');
                        if($social):?>
                        <div class="contact-social">
                            <?php foreach($social as $network):?>

                                <?php if($network['network']=="F"):?>
                                <div><strong>Join us:</strong><br><a href="<?php echo $network['link'];?>" class="btn btn_fb"><?php echo $network['network'];?></a></div>
                                <?php endif;?>
                                <?php if($network['network']=="t"):?>
                                <div><strong>Follow us:</strong><br><a href="<?php echo $network['link'];?>" class="btn btn_twitter"><?php echo $network['network'];?></a></div>
                                <?php endif;?>
                                <?php if($network['network']=="s"):?>
                                <div><strong>Call us:</strong><br><a href="<?php echo $network['link'];?>" class="btn btn_skype"><?php echo $network['network'];?></a></div>
                                <?php endif;?>
                            <?php endforeach;?>
                            <div class="clear"></div>
                        </div>    
                    <?php endif;?>
                    
                </div>     
            </div>
            <!--/ widget_contact -->
            
            <div class="contact-map">
                <?php if(!get_field('disable_map')):?>
                    <div class="mapView">
                            <div id="googleMap"  style="width:302px;height:252px;"></div>
                    </div>
                <?php endif;?>
            </div>
            <div class="clear"></div>
        </div>
        <!--/ sidebar -->
<?php
}

/*The function for display the cities*/
function single_city(){
 ?>   
<div id="middle" class="cols2">
    <div class="container_12">
        <div id="single_content" class="content">
            <?php          
               $city= strtolower($_GET['city']);
               $country=strtolower($_GET['country']);
               /*/if($city=="maritimes"){
                $city="halifax";
               }*/
               //echo $city;
               $tours=new WP_Query( array (
                'post_type'=>'tours_post',
                'um_'.toAscii($country)=>$city,
                'sample_tour' => 'no',
                'post_per_page' => -1
                ));

               $arg= array (
                'post_type' => 'tours_post',
                'um_'.toAscii($country) => $city,
                'sample_tour'=>"yes",
                'post_per_page' => -1
                );
               
               $number = $tours->found_posts;
               $city_query = new WP_Query($arg);
               if($city_query->have_posts()):
                while($city_query->have_posts()):
                    $city_query->the_post();
                    $latlang=get_field("google_map"); 
                  //echo $latlang["coordinates"];
                        ?>
                       <!--middle-column where the city details go-->
                        <form method="post" action="" style="display:none" id="cityHidden">
                            <input type='hidden' name="city" value="<?php echo $city;?>"/>
                            <input type='hidden' name="country" value="<?php echo $country;?>"/>
                        </form>
                        <!--introduction-->
                        <h3><?php echo $city_name;?></h3>
                        <div class="post-detail">
                            <h1><?php the_title();?></h1>
                           
                            <!--h6 onClick="jQuery(this).find('form').submit();"><span class="title"><a>Available Packages:<?php echo $number;?></a></span>
                                <?php /*$pages = get_pages(array(
                                        'meta_key' => '_wp_page_template',
                                        'meta_value' => 'template-search.php',
                                        'hierarchical' => 0
                                    )); */
                                ?>
                                <form action="<?php //echo get_permalink(get_page_by_title($pages[0]->post_title)); ?>" method="get" onClick="jQuery(this).submit();">
                                 <input type="hidden" name="country" value="<?php //echo $country;?>">
                                 <input type="hidden" name="city_auto_new" value="<?php //echo $city;?>">
                                </form>
                            </h6-->
                            <div class="entry">
                               <?php 
                                $tour_images = get_field('tour_slider');
                                if($tour_images):
                                ?>
                                    <img src="<?php echo $tour_images[0]['image']; ?>">
                                <?php 
                                     
                                    endif;                       
                                ?>
                            </div>
                            <div>
                                <?php the_content();?>
                            </di>
                            <!-- post share -->
                            <!--div class="block_hr post-share">
                                <div class="inner">
                                    <p>Share "<strong><?php the_title();?></strong>" via:</p>
                                    <p><a href="#" class="btn-share" hidefocus="true" style="outline: none;"><img src="/images/share_twitter.png" width="79" height="25" alt=""></a> <a href="#" class="btn-share" hidefocus="true" style="outline: none;"><img src="/images/share_facebook.png" width="88" height="25" alt=""></a> <a href="#" class="btn-share" hidefocus="true" style="outline: none;"><img src="/images/share_google.png" width="67" height="25" alt=""></a> </p>
                                </div>
                            </div-->
                            <!--/ postshare -->
                            
                        </div>
                        <!--/end introduction-->
                        <div id="single_city" class="tabs_products">
                 
                            <ul class="tabs linked">
                                <li><a href="#tab_overview;?>">Overview</a></li>
                                <li><a href="#tab_atractions">Attractions</a></li>
                                <li><a id="map_click" href="#tab_map">Maps & Weather</a></li>
                                <li><a target="_blank" id="single_to_package" href="<?php echo site_url("/search/?country=".$country."&city_auto_new=".$city);?>">Packages</a></li>

                            </ul>

                            <div class="tabcontent">
                             <?php the_field('overview');?>
                            </div>
                            
                            <div class="tabcontent" style="display:none">
                                <div id="tab_subjects" class="row topmenu">
                                    <ul>
                                        <li id="s_show_all" style="color:#a409ba;">All </li>
                                        <li id="s_arts" >Arts </li>
                                        <li id="s_culture">Culture </li>
                                        <li id="s_history">History </li>
                                        <li id="s_language">Language </li>
                                        <li id="s_music">Music </li>
                                        <li id="s_recreation">Recreation </li>
                                        <li id="s_science">Science </li>
                                    </ul>
                                </div>
                                <div class="row" id="s_activity">
                                        <div class="list_arrows">
                                            <?php $arg= array (
                                            'post_type' => 'activity',
                                            'um_'.toAscii($country) =>$city,
                                            'posts_per_page' => -1
                                            );
                                            $activities = new WP_Query($arg);
                                            if($activities->have_posts()):?>
                                                <div class="widget-container widget_products" id="destination_grid">
                                                  <div class="inner">
                                                  <script type="text/javascript">
                                                  jQuery(document).ready(function(){

                                                    jQuery("#destination_grid .prod_itemNew").on("mouseover",function(e){
                                                       if(jQuery(this).find('.tooltip').css('display')!='block'){
                                                            jQuery(this).find('.tooltip').fadeIn('slow');
                                                            jQuery(this).css('z-index','1000');
                                                       }
                                                    }).on("mouseleave",function(){
                                                      jQuery(this).find('.tooltip').fadeOut('slow');
                                                      jQuery(this).css('z-index','auto');
                                                    });

                                                  });
                                                  </script>

                                                <?php while ( $activities->have_posts()):
                                                    $activities->the_post();
                                                    $link =get_field("link");
                                                ?>
                                                <div class="prod_itemNew"<?php show_subjects_new($id);?>>
                                                    <div class="prod_img">
                                                      <a target="_blank"  href="<?php the_permalink();?>" hidefocus="true" style="outline: none; overflow:hidden;">
                                                        <?php 
                                                          $imag_url = wp_get_attachment_url( get_post_thumbnail_id($post->ID, 'thumbnail') );
                                                          if($imag_url):?>
                                                              <img src="<?php echo $imag_url; ?>">
                                                        <?php else:?>
                                                          <img src="http://mpoeduc.com/wp-content/uploads/2013/12/MPO-logo-shadow-2-e1386452789693.png">
                                                        <?php  endif;  ?>
                                                      </a>
                                                      <p class="caption">
                                                        <a target="_blank"  href="<?php the_permalink();?>" hidefocus="true" style="outline:none;">
                                                         <?php the_title();?>
                                                        </a>
                                                      </p>
                                                    </div>
                                                    
                                                    <div style="display:none" class="tooltip">
                                                        <h6><?php the_title();?></h6>
                                                        <p>
                                                          <?php 
                                                            $overview = wp_trim_words(get_the_content(),20,'<a href="'.get_permalink().'">...Read More</a>');
                                                            echo $overview;
                                                          ?>
                                                        </p>
                                                         <p><a target="_blank" href="<?php the_permalink();?>">Read more</a><a target="_blank" href="<?php echo $link;?>">|Activity website</a></p>
                                                    </div>
                                                </div>
                                            <?php
                                            endwhile;
                                            endif;
                                            wp_reset_postdata();
                                            ?>
                                            </div>
                                         </div>
                                    </div>
                                </div>
                            </div>

                            <div class="tabcontent" style="display:none">
                                <h3>Map:</h3>
                                <div id="mapView" style="width:100%; height:400px;"></div>
                                <script type="text/javascript">
                                  jQuery(document).ready(function($){

                                        var myCenter=new google.maps.LatLng(<?php echo $latlang['coordinates']; ?>);
                                        var mapProp = {
                                          center:myCenter,
                                          zoom:5,
                                          mapTypeId:google.maps.MapTypeId.ROADMAP
                                        };
                                        var map=new google.maps.Map(document.getElementById("mapView"),mapProp);
                                        var marker=new google.maps.Marker({
                                          position:myCenter,
                                          });
                                        var map_click =document.getElementById('map_click');
                                        google.maps.event.addDomListenerOnce(map_click, 'click', function(){
                                          //alert("aiyo");
                                          setTimeout(function(){
                                           google.maps.event.trigger(map, 'resize');
                                           map.setCenter(myCenter);
                                           marker.setMap(map);
                                          },"100");
                                          
                                        });
                                  });
                                        
                                 </script>
                                
                                <?php
                                  $weather_fields=get_field('weather');
                                  //print_r($weather_fields);
                                  if($weather_fields){
                                    ?>
                                    <h3>Weather</h3>
                                   <?php 
                                   weather($weather_fields);
                                  }
                                  ?>
                                
                            </div>
                            <!--video-->
                            <div class="tabcontent">
                            <?php 
                            $videos = get_field("videos");
                            if($videos):
                            ?>
                            <?php endif;?>
                            </div>
                            <!--/video-->
                            
                        </div><!--/tab-->
                        </div>
                    <?php
                        endwhile;
                    endif;
                    ?>
                  
                </div><!--end content-->
                <!--filter-->
                <?php destinationFilter();?>
                <!--/filter-->
                <div class="clear"></div>  
            </div><!--end container-->  
        </div><!--end middle-->
<?php
 }
function country_city(){

                    $country=$_GET['country'];
                    $country=trim($country);
                    $country = strtolower($country);
                    $cities=get_terms('um_'.toAscii($country),array("hide_empty"=>false));
                    foreach ($cities as $city){
                        $query_city.=$city->slug.","; 
                     }
                    $arg= array (
                        'post_type'=>'tours_post',
                        'um_'.toAscii($country)=>$query_city,
                        'sample_tour' => 'yes',
                        'posts_per_page' => -1
                        );
                    $cities= new WP_Query($arg);
                    $query_city="";
                    ?>

                    <div id="middle" class="full_width">
                        <div class="container_12">
                            <h1><?php echo strtoupper($country);?>:</h1>
                            <div class="content">           
                                <div class="post-detail">  
                                    <div class="entry">                
                                        <div class="grid_list">
                                                <?php
                                                  if($cities->have_posts()):
                                                    while ($cities->have_posts()):
                                                        $cities->the_post();

                                                    ?>
                                                    <div class="list_item">
                                                        <form method="get" action="">
                                                            <input type="hidden" name="country" value="<?php echo $country;; ?>">
                                                            <input type="hidden" name="city" value="<?php the_title(); ?>">
                                                        </form>
                                                        <div class="item_img" >
                                                                <?php
                                                                $city = trim(strtolower(get_the_title()));
                                                                $city=explode(" ", $city);
                                                                $city=implode("-", $city);
                                                                $tours= new WP_Query( array (
                                                                    'post_type'=>'tours_post',
                                                                    'um_'.toAscii($country)=>$city,
                                                                    'sample_tour' => 'no',
                                                                    'post_per_page' => -1
                                                                    ));
                                                                #$number = $tours->found_posts;
                                                                $image=get_field('tour_slider');
                                                                 if($image):?>
                                                                    <img src="<?php echo $image[0]['image'];?>">
                                                                <?php endif;?>
                                                            <p class="caption">
                                                                <a><?php the_title();?></a>
                                                            </p>
                                                        </div>
                                                    </div>
                                                             
                                                    <?php 
                                                        endwhile;
                                                    endif; 
                                                    wp_reset_postdata();
                                                    ?>
                                        </div>  
                                    </div>       
                                </div>
                            </div>
                            <div class="clear"></div>  
                        </div>             
                    </div>

<?php  
}
function city_navigator(){
?>
<!--List the Countries-->
 <div id="middle" class="full_width">
    <div class="container_12">
        <h1>Destination:</h1>
        <div class="content">           
            <div class="post-detail">  
                <div class="entry">                
                    <div class="grid_list">
                                     
                                <!--Canada-->
                                <div class="list_item" onclick="jQuery(this).closest('form').submit();return false;">
                                     <form method="get" action="">
                                     <input type="hidden" name="country" value="canada">
                                     </form>
                                    <div class="item_img">
                                        <img src="http://mpoeduc.com/wp-content/uploads/2013/12/rsz_canada_image_1.jpg">
                                        <p class="caption">
                                            <a href="">Canada</a>
                                        </p>
                                    </div>
                        
                                </div>
                            
                                <!--USA-->
                                <div class="list_item" onclick="jQuery(this).closest('form').submit();return false;">
                                    <form method="get" action="">
                                    <input type="hidden" name="country" value="usa">
                                    </form>
                                    <div class="item_img" onclick="jQuery(this).closest('form').submit();return false;">
                                        
                                        <img src="http://mpoeduc.com/wp-content/uploads/2013/12/rsz_statue_of_liberty_image_2.jpg">
                                        
                                        <p class="caption">
                                            <a href="">USA</a>
                                        </p>
                                    </div>
                                </div>
                            
                                <!--Europe-->
                                <div class="list_item" onclick="jQuery(this).closest('form').submit();return false;">
                                    <form method="get" action="">
                                    <input type="hidden" name="country" value="europe">
                                    </form>
                                    <div class="item_img">
                                        
                                        <img src="http://mpoeduc.com/wp-content/uploads/2013/12/rsz_europe_image_6.jpg">
                                        
                                        <p class="caption">
                                            <a href="">Europe</a>
                                        </p>
                                    </div>
                        
                                </div>
                            
                                <!--Asia-->
                                <div class="list_item" >
                                    <form method="get" action="">
                                    <input type="hidden" name="country" value="asia">
                                    </form>
                                    <div class="item_img">
                                        <img src="http://mpoeduc.com/wp-content/uploads/2013/12/rsz_asia_image_1.jpg">
                                        <p class="caption">
                                            <a>Asia</a>
                                            <!--span class="price">
                                                <?php 
                                            #$cities = get_terms("um_".toAscii("asia"),array ('hide_empty' => false));
                                            #$number = count($cities);
                                            ?>
                                                <ins><?#php echo $number;?></ins><strong>cities</strong>
                                            </span-->
                                        </p>
                                    </div>
                                </div>
                    </div>  
                </div>       
            </div>
        </div>
        <div class="clear"></div>  
    </div>             
</div>
<?php
}
function destinationFilter(){

        $pages = get_pages(array(
                'meta_key' => '_wp_page_template',
                'meta_value' => 'template-search.php',
                'hierarchical' => 0
        ));
    ?>
        <div class="sidebar">
            
            <!-- filter -->
            <div class="widget-container widget_adv_filter">
                <h3 class="widget-title">Search a package</h3>
                    <form action="<?php echo get_permalink(get_page_by_title($pages[0]->post_title)); ?>" method="get" class="form_white" id="filter_form">
                        <input type="hidden" name="filter" value="">
                        <input type="hidden" name="destinationFilter" value="yes" />
                        <div class="row">
                            <label class="label_title">City:</label>
                            <?php city_autocomplete();?>
                        </div>
                        
                        <div class="row">
                            <label class="label_title">Grades:</label>
                            <select  id="grade_level" name="grade_level" class="select_styled white_select">
                                <option name="grade_level" value="" selected="selected">Choose a grade</option>
                                <?php $grades = get_terms("um_".toAscii('grade_level'),array("hide_empty"=>false));
                                    foreach ($grades as $grade):
                                ?>
                                    <option name="grade_level" value="<?php echo $grade->slug;?>"><?php echo $grade->name;?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                        
                        <div class="row">
                            <label class="label_title">Subjects:</label>
                            <select id="subjects" name="subjects" class="select_styled white_select">
                            <option name="subjects" value="" selected="selected">Choose a subject</option>
                            <?php $subjects = get_terms("um_".toAscii('subjects'),array("hide_empty"=>false));
                                foreach ($subjects as $subject):
                            ?>
                                <option name="subjects" value="<?php echo $subject->slug;?>"><?php echo $subject->name;?></option>
                            <?php endforeach;?>
                            </select>
                        </div>
                        <div class="row">
                            <label class="label_title">Length:</label>
                            <select id="length" name="length" class="select_styled white_select">
                            <option name="length" value="" selected="selected">Choose days</option>
                            <?php $days = get_terms("um_".toAscii('number_of_days'),array("hide_empty"=>false));
                                foreach ($days as $day):
                            ?>
                                <option name="length" value="<?php echo $day->slug;?>"><?php echo $day->name;?></option>
                            <?php endforeach;?>
                            </select>
                        </div> 
                        <div class="row">
                            <label class="label_title">Price:</label>
                            <select id ="price" name="price" class="select_styled white_select">
                            <option name="price" value="" selected="selected">Price range</option>
                            <?php 
                            $filterPrice = get_field('filter_options','options');
                                if($filterPrice):
                                    $currency = get_field('currency','options'); 
                                foreach ($filterPrice as $price):
                            ?>
                                <option name="price" value="<?php echo $price->slug;?>"><?php echo $currency.$price->name;?></option>
                            <?php endforeach;
                                endif;
                            ?>
                            </select>
                        </div>  

                        <div class="row rowSubmit">
                            <input type="button" value="Search" id="filter" class="btn-submit">
                        </div>
                        
                    </form>    
                    
                               
            </div>
            <!--/ filter -->
            
        </div>
        <!--/ sidebar -->
<?php
}
/****************Widgets********************/
function news_letter(){
?>
<!-- widget_newsletter -->
            <div class="widget-container newsletterBox">
                <script type="text/javascript">
                //<![CDATA[
                if (typeof newsletter_check !== "function") {
                window.newsletter_check = function (f) {
                    var re = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-]{1,})+\.)+([a-zA-Z0-9]{2,})+$/;
                    if (!re.test(f.elements["ne"].value)) {
                        alert("The email is not correct");
                        return false;
                    }
                    if (f.elements["nn"] && (f.elements["nn"].value == "" || f.elements["nn"].value == f.elements["nn"].defaultValue)) {
                        alert("The name is not correct");
                        return false;
                    }
                    if (f.elements["ns"] && (f.elements["ns"].value == "" || f.elements["ns"].value == f.elements["ns"].defaultValue)) {
                        alert("The last name is not correct");
                        return false;
                    }
                    if (f.elements["ny"] && !f.elements["ny"].checked) {
                        alert("You must accept the privacy statement");
                        return false;
                    }
                    return true;
                }
                }
                //]]>
                </script>
                <div class="inner">
                    <h3>NEWSLETTER SIGNUP:</h3>
                    <form method="get" action="http://mpoeduc.com/wp-content/plugins/newsletter/do/subscribe.php">


                        </label><input type="hidden" name="nr" value="widget">
                        <label for="n_fname">First Name:</label><input id="n_fname" type="text" name="nn" class="inputField" required><br/>
                        <label for="n_lname">Last Name:</label><input id="n_lname" type="text" name="ns" class="inputField" required>
                        <label for="n_email">Email</label><input id="n_email" type="text" value="Enter your email address" onfocus="if (this.value == 'Enter your email address') {this.value = '';}" onblur="if (this.value == '') {this.value = 'Enter your email address';}" name="ne" class="inputField">                                  
            
                        <input type="submit" value="SUBSCRIBE" class="btn-submit">
                    </form> 
                    <div class="clear"></div>    
                </div>
            </div>
            <!--/ widget_newsletter -->
<?php
}
/*
search_form()
*/
function search_form(){
?>
<div class="topsearch">
    <form id="searchForm" action="<?php echo site_url(); ?>" method="get">
        <input type="submit" id="searchSubmit" value="" class="btn-search">
        <input type="text" name="s" id="stext" value="" class="stext"> 
        <input type="hidden" name="search_nonce" value="<?php echo wp_create_nonce('search_nonce');?>">                   
    </form>
</div>  
<?php
}
/*City autocomplete*/
function city_autocomplete(){
?>
<input type="text" list="citiesAuto" name="city_auto" id="city" class="inputField" value="" placeHolder="City">
<datalist id="citiesAuto">
    <?php
        $canadas= get_terms('um_'.toAscii('canada'),array('hide_empty'=>false));
            foreach ($canadas as $canada):?>
           <option country="canada" value="<?php echo $canada->name;?>"></option>
            <?php endforeach;?>
    <?php
        $usas= get_terms('um_'.toAscii('usa'),array('hide_empty'=>false));
            foreach ($usas as $usa):?>
           <option country="usa" value="<?php echo $usa->name;?>"></option>
            <?php endforeach;?>
    <?php
        $europes= get_terms('um_'.toAscii('europe'),array('hide_empty'=>false));
            foreach ($europes as $europe):?>
           <option  country="europe" value="<?php echo $europe->name;?>"></option>
            <?php endforeach;?>
    <?php
        $asias= get_terms('um_'.toAscii('asia'),array('hide_empty'=>false));
            foreach ($asias as $asia):?>
           <option country="asia" value="<?php echo $asia->name;?>"></option>
            <?php endforeach;?>
</datalist>
<?php
}
/****tabs in customization page****/

/*
information
*/  
function information($tour_id,$tour_cities){
?>
 <!--information-->
            
        <div id="information-quote" class="tabcontent" style="display: block;" >
             
          <div class="inner">
            <div class="row">
                    <span><strong>Please fill out the information as much or as little as you would like. Each section will permit you to customize your tour and pick exactly what you  would like to do. But you can also just fill in your basic information.<br></strong></span>
                    <br>
                    <form method="post" action="" id="inform">
                        <input type="hidden" name="tour_id" value="<?php echo $tour_id;?>">
                        <div class="row">
                            <h3>Your Information:</h3>
                            <div class="col col_1_2 alpha" style="text-align:right; border-left:2px bold;" >
                                <div class="inner">
                                    <div class="row">
                                        <strong>School/Company/Organization*:</strong><input type="text" name="schoolName" placeholder="required" value="">
                                    </div>
                                    <div class="row" style="align:right">
                                        <strong>Contact Name*:</strong><input type="text" name="contactName" placeholder="required" >
                                    </div>
                                    <div class="row">
                                        <strong>Contact Phone number*:</strong><input type="text" name="phone" placeholder="required">
                                    </div>
                                    <div class="row">
                                        <strong>Email*:</strong><input type="text" name="email" placeholder="required">
                                    </div>
                                    <div class="row"></div>

                                </div>

                            </div>  
                            <div class="col col_2_5 omega" style="text-align:right;">
                                <div class="inner">
                                    <div class="row">
                                        Street:<input type="text" name="street">
                                    </div>
                                    <div class="row">
                                        City:<input type="text" name="city">
                                    </div>
                                    <div class="row">
                                        Province:<input type="text" name="province">
                                    </div>
                                    <div class="row">
                                        Country:<input type="text" name="country">
                                    </div>
                                    <div class="row">
                                        Post Code:<input type="text" name="post">
                                    </div>

                                </div>
                            </div> 
                      </div>
                      <div class="clear"></div>
                      <style type="text/css">

                          .half,.lefthalf{
                            width: 45%;
                          }
                          .row{
                            min-height: 45px;
                          }
                          .lefthalf{
                            text-align: right;
                          }
                          .col .inner{
                            padding: 20px;
                          }
                          #information-quote .col{
                            background: url("../images/line_vertical.png") right repeat-y; 
                          }
                      </style>
                      <div class="row">
                            <h3>Trip Information:</h3>
                            <input id="notKnow" type="checkbox" value="on" name="unknown">I don't have details yet
                          <div class="inner">
                          <div class="col col_1_2 alpha" style="border-left:2px bold;">
                                
                                    <h5><?php _e('Select your destinations:','um_lang');?></h5>
                                    <!--city tab-->
                                    <div id="tabs_city" class="tabs_framed tf_sidebar_tabs">
                                        <ul class="tabs">
                                            <li class="current"><a  hidefocus="true" style="outline: none;">Canada</a></li>
                                            <li><a  hidefocus="true" style="outline: none;">USA</a></li>
                                            <li><a  hidefocus="true" style="outline: none;">Europe</a></li>
                                            <li><a  hidefocus="true" style="outline: none;">Asia</a></li>
                                        </ul>
                                        <?php  if($tour_id):?>
                                        <!--canada-->
                                            <?php show_country_city("Canada",$tour_cities);?>
                                        <!--/canada-->
                                        <!--USA-->
                                            <?php show_country_city("USA", $tour_cities);?>
                                        <!--/USA-->
                                        <!--Europe-->
                                            <?php show_country_city("Europe",$tour_cities);?>
                                        <!--/Europe-->
                                        <!--Asia-->
                                            <?php show_country_city("Asia",$tour_cities);?>
                                        <!--/Asia-->
                                        <?php else:?>
                                    <!--canada-->
                                            <?php show_country_city("Canada","");?>
                                        <!--/canada-->
                                        <!--USA-->
                                            <?php show_country_city("USA","");?>
                                        <!--/USA-->
                                        <!--Europe-->
                                            <?php show_country_city("Europe","");?>
                                        <!--/Europe-->
                                        <!--Asia-->
                                            <?php show_country_city("Asia","");?>
                                            <!--/Asia-->
                                        <?php endif;?>
                                        
                                    </div>

                          </div>
                          <div class="col col_2_5 omega">
                                <h5>&nbsp;</h5>
                                <br/>
                                <div class="lefthalf" style="float:left;">
                                    <div class="row">
                                    <input type="text" id="from" value="" class="inputField" name="from" placeholder="Departure Date">
                                    </div>
                                    <div class="row">Time of the Year:</div>
                                    <div class="row">Number of Students:</div>
                                    <div class="row">Number of adults:</div>
                                    <div class="row">Average Age of Students:</div>
                                    <div class="row">Grade Level:</div>
                                    <div class="row">Need your Quote by:</div>
                                    <div class="row">Best time to contact you:</div>
                                   
                                </div>
                                <div class="half omega" style="float:right;">
                                    <div class="row">
                                        <input type="text" id="to" value="" class="inputField" name="to" placeholder="Return Date">
                                    </div>
                                    <div class="row">
                                        <select type="text" class="inputField" name="time">
                                            <option value="Spring">Spring</option>
                                            <option value="Summer">Summer</option>
                                            <option value="Autumn">Autumn</option>
                                            <option value="Winter">Winter</option>
                                        </select>
                                    </div>
                                    <div class="row">
                                        <input type="number" value="0" min="0" name="children" class="inputField">
                                    </div>
                                    <div class="row">
                                        <input type="number" value="0" min="0" name="adult" class="inputField">
                                    </div>
                                    <div class="row">
                                        <input value="0" type="number" name="age" min="0" class="inputField">
                                    </div>
                                    <div class="row">
                                        <select type="number" name="grade" min="0" class="inputtext"> 
                                            <option value="1-3">1-3</option>
                                            <option value="4-6">4-6</option>
                                            <option value="7-9">7-9</option>
                                            <option value="11-12">10-12</option>
                                            <option value="college">College</option>
                                        </select>
                                    </div>
                                    <div class="row">
                                        <input type="text" id="tripBy" class="inputField" name="by" placeholder="Pick a date">
                                    </div>
                                    <div class="row">
                                        <input id="contactTime" value="" type="text" name="contact" class="inputField">
                                    </div>
                                    
                                </div>
                              
                          </div>
                      </div>
                    </div>
                    <input type="hidden" name="quote_submit" value="true"/>
                    <div class="clear"></div>
                </form>
        </div>
      </div>
    </div>
            <!--/information-->
<?php
}
function destination(){
?>
<!--Destionation-->
            <div id="main_2" class="tabcontent" style="display: none;">
              <div class="inner">
                <!--header-->
                <div class="row">
                <!--Activities-->
                    <h5><?php _e('Select Activities By City:','um_lang');?></h5>
                    <div id="tab_activity" class="tabs_framed tf_sidebar_tabs">
                        <ul class="tabs">
                        </ul>
                        <section class="row">
                            <div id="tab_subjects" class="row topmenu" style="margin-left:0;">
                                <ul>
                                    <li id="show_all">All </li>
                                    <li id="arts">Arts </li>
                                    <li id="culture">Culture </li>
                                    <li id="history">History </li>
                                    <li id="language">Language </li>
                                    <li id="music">Music </li>
                                    <li id="recreation">Recreation </li>
                                    <li id="science">Science </li>
                                    <li id="selected">Selected</li>
                                </ul>
                            </div>
                        </section>
                    </div>
                    
                       <!--/Activities-->
                </div>
                <div class="clear"></div>
                
              </div>
            </div>
            <!--/destination-->
<?php
}
/*****************************************
Similar Productions in the single_post page
******************************************/
function similar_products($ID){
?>  
<!-- widget_products -->
          <hr/>
          <div id="samplePackage" class="widget-container widget_products">
              <div class="inner">
                <?php
                  $current_title=get_the_title($ID);
                  //echo $current_title;
                  $queries = trim($current_title);
                  $queries = explode(" ", $queries);
                  $query_ids= array ();
                  array_push($query_ids, $ID);
                  foreach ($queries as $query):
                    $packages = new WP_Query("s=$query");
                      while ( $packages->have_posts()):
                        $packages->the_post();
                        $type=get_post_type();
                        $id= get_the_ID();
                        $myterm;
                        if($type=='tours_post'):
                            if(!in_array($id, $query_ids)):
                                //print_r($query_ids);
                                array_push($query_ids, $id);
                                try{
                                $terms = get_the_terms($id, 'sample_tour');
                                   foreach ($terms as $term) {
                                        $myterm=$term->slug;
                                   }
                                }catch(Exception $e){
                                    die();
                                }
                                   if($myterm!="yes"):
                                
                      ?>
                      <div class="prod_itemNew">
                        <div class="prod_image"><a href="<?php the_permalink();?>">
                            <?php $tour_images = get_field('tour_slider'); 
                            if($tour_images):?>
                          <img src="<?php echo $tour_images[0]['image'];?>" width="140" height="98" alt="">
                            <?php endif;?>
                            </a>
                        </div>
                        <span class="price_box">
                          <?php if(!get_field('disable_all_price','options')):?>
                          <ins><?php the_field('tour_currency');?></ins><strong><?php the_field('price');?></strong>
                          <?php endif; ?>
                        </span>
                        <div class="prod_title">
                            <a href="<?php the_permalink();?>"><strong><?php the_title();?></strong></a><br>
                          <span class="title"><a href="<?php the_permalink();?>" class="link-map" hidefocus="true" style="outline:none;"></a></span>
                        </div> 
                      </div>
                    <?php
                          endif;
                        endif;
                      endif;
                     endwhile;
                     wp_reset_postdata();
                    endforeach;
                    ?>
                  <div class="clear"></div>
              </div>
            </div>
     
<?php
// should not die here otherwise it stops the page
}
/****************************************************************
 Customization of the Destionation 
****************************************************************/
function show_country_city($country, $tour_cities){
    
?>
    <div id="tabs_2_1" class="tabcontent" style="display: block;">
        <div class="inner">
          <h5><?php _e('Cities in '.$country,'um_lang');?></h5>
            <div class=" row input_styled inlinelist" name="city">
                  <?php 
                    $country = strtolower($country);
                    $newterms = get_terms('um_'.toAscii($country),array("hide_empty"=>false));
                      if($newterms):?>
                        <script type="text/javascript">
                            var <?php echo $country;?> = 0;
                        </script>
                       <?php foreach($newterms as $term):?>
                        <div class="rowRadio">
                               <?php if(!empty($tour_cities) && in_array($term->name, $tour_cities)): 
                                ?>
                                    <script type="text/javascript">
                                        <?php echo $country;?>++;
                                    </script>
                                    <input  type="checkbox" checked id="<?php echo $term->slug;?>" name="<?php echo $country;?>"  value="<?php echo $term->slug; ?>" class="button_link"><label for="<?php echo $term->slug;?>"><?php echo$term->name; ?></label>
                                <?php else:?>
                                    <input  type="checkbox"  id="<?php echo $term->slug;?>" name="<?php echo $country;?>"  value="<?php echo $term->slug; ?>" class="button_link"><label for="<?php echo $term->slug;?>"><?php echo$term->name; ?></label>
                                <?php 
                                endif;?>
                        </div>
                      <?php   endforeach; 
                     endif;?>
            </div>
        </div>
    </div>
<?php
}

/****************************
The weather network button for weather
****************************/
 function weather($args){
  
        // example api call:http://past.theweathernetwork.com/?product=weatherbutton&buttontype=lightbg_noST&producttype=city&locationcode=CAON0696&switchto=c&cms=WordPress&version=wp_3.6
        // Get city 
        echo '<!--start of code - The Weather Network '. $city .' -->';
        $buttontype = "lightbg_noST";
        $urlstring="";
        $citycount=0;
        foreach ($args as $arg) {
            $city=$arg['city_code'];
            if((isset($city))&&($city!="")){
                $cityarray=explode("|",$city);
                $producttype=$cityarray[0];
                $locationcode=$cityarray[1];
                //echo $locationcode;
            }else{
                break;
            }
            if($citycount>0){
                $urlstring=$urlstring."&producttype".$citycount."=".$producttype."&locationcode".$citycount."=".$locationcode;
            }else{
                $urlstring=$urlstring."&producttype=".$producttype."&locationcode=".$locationcode;
            }
            
            $citycount++;  
        }
        //echo "citycount:".$citycount;
        //echo "urlstring:".$urlstring;
        $weatherdatatype="c";
        if(($citycount<2)){
            $buttontype=$buttontype."_singlecity";
        }
        global $wp_version;
        $widget_call_string="http://www.theweathernetwork.com/index.php?product=weatherbutton&buttontype=".$buttontype.$urlstring."&switchto=".$weatherdatatype."&cms=WordPress&version=".$wp_version;
        echo '<script type="text/javascript" src="'.$widget_call_string . '"></script>';
        echo '<!-end of code-->';
        
    } 
?>