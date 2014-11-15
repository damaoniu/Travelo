<div class="clear"></div>
	<div class="footer">
		<div class="footer_inner">
      <div class="container_12">
        <!--# footer col 1 -->
        <div class="widgetarea f_col_1">
          
            <!-- widget_categories -->
          <div class="widget-container widget_categories">
            <h3 class="widget-title">DESTINATIONS:</h3>
              <ul>
                <li>
                  <form method ="post" action="<?php echo site_url("/destinations");?>" onClick="jQuery(this).submit();">
                      <input type="hidden" name="country" value="canada">
                      <a><span>Canada</span></a>
                  </form>
                </li>
                <li>
                  <form method ="post" action="<?php echo site_url("/destinations");?>" onClick="jQuery(this).submit();">
                      <input type="hidden" name="country" value="usa">
                      <a><span>USA</span></a>
                  </form>
                </li>
                <li>
                  <form method ="post" action="<?php echo site_url("/destinations");?>" onClick="jQuery(this).submit();">
                      <input type="hidden" name="country" value="europe">
                      <a><span>Europe</span></a>
                  </form>
                </li>
                <li>
                  <form method ="post" action="<?php echo site_url("/destinations");?>" onClick="jQuery(this).submit();">
                      <input type="hidden" name="country" value="asia">
                      <a><span>Asia</span></a>
                  </form>
                </li>
                <!--li class="item-search">
                  <a href="#"><span>Search for more</span></a>
                </li-->
              </ul>
          </div>  
          <!--/ widget_categories -->
           
        </div>
        <!--/ footer col 1 -->
        <!--# footer col 2 -->
        <div class="widgetarea f_col_2">
          
            <div class="widget-container widget_pages">
              <h3 class="widget-title">USEFUL LINKS:</h3>
                <ul>  
                  <li class="menu-level-0"><a href="<?php echo site_url("/request-quote");?>"><span>Request a Quote</span></a></li>
                  <li class="menu-level-0 "><a href="<?php echo site_url("/blog");?>"><span>Testimonies</span></a>
                  </li>
                  <li class="menu-level-0"><a href="<?php echo site_url("/contact-us");?>"><span>Contact Us</span></a></li>
                  <li class="menu-level-0"><a href="<?php echo site_url("/about-us");?>"><span>About Us</span></a></li>
                  <li class="menu-level-0"><a href="<?php echo site_url("/terms");?>"><span>Terms</span></a></li>
                  <li class="menu-level-0"><a href="<?php echo site_url("/faq");?>"><span>FAQ</span></a></li>
                </ul>
             </div>
        </div>
        <!--/ footer col 2 -->
        <!--Contacts--> 
        <div class="widgetarea f_col_3">
                      <?php if(!(get_field('disable_contact','options'))):?>
                     		<div class="widget-container widget_contact">
                				   <h3 class="widget-title"><?php _e('Contact Us','um_lang');?></h3>
                           <div class="inner">
                              <!--div class="contact-social">
                                <?php $social = get_field('social_networks','options');
                                  if($social):?>
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
                                <?php endif;?>
                              </div-->
                              <div class="contact-address">
                                  <div class="name"><strong>MPO Educational Travel</strong></div>
                                  <div class="address"><?php if(get_field('address','options')):?><?php the_field('address','options');?><?php endif;?></div>
                                  <div class="phone"><em><?php if(get_field('phone','options')):?><?php _e('Phone ','um_lang');?></em> <span><?php the_field('phone','options');?></span><?php endif;?></div>
                                  <!--<div class="fax"><em>Fax:</em> <span>555-345.285</span></div>-->
                                  <div class="mail"><em><?php if(get_field('email','options')):?><?php _e('Email ','um_lang');?></em> <a href="mailto:<?php the_field('email','options');?>"><?php the_field('email','options');?></a><?php endif;?></div>
                              </div>
                              
                            </div>
                          </div>
                      <?php endif;?>
        </div>
        <!--copyright-->
        <div class="copyright">
          <p class="alignleft"><?php the_field('copyright_text_1','options')?></p>
          <p><a href="<?php site_url();?>"> <?php the_field('copyright_text_2','options')?> </a></p>
        </div>
        <!--/copyright-->
        </div><!--end container_12-->
    	</div><!-- END footer_inner -->
</div><!-- END footer --> 
<!--a href="#" id="toTop" style="display: inline;"><span id="toTopHover" style="opacity: 1;"></span>To Top</a-->       
</div><!--end body wrap-->

</body>
<?php
wp_footer();
?>
</html>