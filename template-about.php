<?php
/*
Template Name:About
*/
get_header();
global $post;
setup_postdata($post);
?>
<div id="middle" class="cols2">
    <div class="container_12">
    
        <!-- breadcrumbs -->
        <div class="breadcrumbs">
            <p><a href="index.html">Homepage</a> <span class="separator">&gt;</span> <span>About us</span></p>
        </div>
        <!--/ breadcrumbs -->
        
        <!-- content -->
        <div class="content">
            
            <!-- post details -->
            <div class="post-detail">
                <h1><span><?php the_title();?></span></h1>

                
                <div class="entry">
                    <?php the_content();?>
                    <div>
                        <?php $paragraphs = get_field('paragraphs');
                                if($paragraphs):
                            foreach($paragraphs as $paragraph):
                            ?>
                 
                        <div class="row" >
                            <div >
                                <h5><?php echo $paragraph['title'];?></h5>
                            </div>
                            <div >
                                <p><?php echo $paragraph['content'];?></p>
                            </div>
                        </div>

                        <?php endforeach;?>
                             <?php endif;?>
                    </div>
                    <br><br><br>

                    
                    <div class="row">
                        <div class="col col_1_2 alpha">
                            <!-- widget_contact -->
                          <div class="widget-container widget_contact">   
                                <div class="inner">   
                                    
                                    <div class="contact-address">
                                        <?php if(get_field('address','options')):?><p><span class="bold"><b><?php _e('Address ','um_lang');?></b></span><?php the_field('address','options');?></p><?php endif?>
                                        <?php if(get_field('phone','options')):?><div><span class="bold"><strong><?php _e('Phone ','um_lang');?></strong></span>  <?php the_field('phone','options');?></div><?php endif?>
                                        <?php if(get_field('email','options')):?><p><span class="bold"><b><?php _e('Email ','um_lang');?></b></span>  <?php the_field('email','options');?></p><?php endif?>
                                    </div>
                                          
                                    <div class="contact-social">
                                        <?php $social = get_field('social_networks','options');
                                                if($social):?>
                                              <div >
                                               <?php foreach($social as $network):?>
                                                    <a href="<?php echo $network['link'];?>" class="btn btn_fb"><?php echo $network['network'];?></a>
                                                  <?php endforeach;?>
                                              </div>    
                                        <?php endif;?>
                                    <div class="clear"></div>
                                    </div>
                                    
                                </div>     
                            </div>
                            <!--/ widget_contact -->

                        </div>
                        
                        <div class="col col_1_2 omega">
                        <?php
                           $image = get_field("about_image");
                            if($image):
                        ?>
                            <div class="contact-map">
                                   <img src="<?php echo $image;?>" alt="">
                            </div>
                        <?php endif; ?>

                        </div>
                    </div>
                    <div class="clear"></div>
                    
              </div>                
            </div>
            <!--/ post details -->
            
            
            
        </div>
        <!--/ content -->
        
        <!-- sidebar -->
        <div class="sidebar">
            <?php
             $video = get_field('about_video');
                            if ($video):
            ?>
                <div class="facebook_box">
                <!--youtube api-->
                    <div class="video">
                        <iframe title="mpoeduc travel" width="100%" height="100%" src="http://www.youtube.com/embed/<?php echo $video;?>"></iframe>
                    </div>
                
                </div>
            <?php endif;?>
            
        </div>
        <!--/ sidebar -->
        
        <div class="clear"></div> 
        <!--staff-->
        <div >
         <?php $staff_members = get_field('staff_members');
                if($staff_members):
                    foreach($staff_members as $member):
            ?>
     
            <div>
            <div >
            <img src="<?php echo $member['image']['sizes']['staff_preview']; ?>"/>
              
                    <h5><?php echo $member['full_name']; ?></h5>
                <h6 class="Title"><?php echo $member['position'];?></h6>
                
                <div >
                   
                    <?php if($member['facebook']): ?>
                    <a href="<?php echo  $member['facebook']; ?>">F</a>
                    <?php endif;?>
                    
                    <?php if($member['linked_in']): ?>
                    <a href="<?php echo  $member['linked_in']; ?>">l</a>
                    <?php endif;?>
                    
                    <?php if($member['twitter']): ?>
                    <a href="<?php echo  $member['twitter']; ?>">t</a>
                    <?php endif;?>
                </div>
                </div>
                <div class="aboutUsStaffBody">
                    <p><?php echo $member['description']; ?></p>
                </div>
            </div>
          <?php endforeach;?>
         <?php endif;?>

        </div><!-- END aboutUsContent-->       
    </div>
</div>
<!--/ middle -->

<!-- after content -->

<!--/after content-->
<?php 
after_content();
get_footer();?>
