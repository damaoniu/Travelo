<?php 
	get_header();
	global $post;
	setup_postdata( $post );	
 ?>
 <?php //get_sidebar();?>
<div id="middle" class="cols2">
    <div class="container_12">
    
        <!-- breadcrumbs -->
        <div class="breadcrumbs">
            <p><a href="index.html">Homepage</a>  <span class="separator">&gt;</span> <a href="<?php the_permalink();?>"><?php the_title();?></a></p>
        </div>
        <!--/ breadcrumbs -->
        
        <!-- content -->
        <div class="content">
            
            <!-- post details -->
            <div class="post-detail">
                <h1><?php the_title();?></h1>
                
                <div class="post-meta-top"><span class="meta-date"><?php //the_date();?></span><!-- Posted by:--> <span class="author"><?php //the_author();?></span></div>
                <div class="entry">
                  <?php if(get_field('content_image')):?>
                    <img src="<?php the_field('content_image');?>" alt="<?php the_title();?>" />
                <?php endif;?>
                  <?php the_content();?>
                </div>
                
                <!-- post share -->
                <div class="block_hr post-share">
                    <div class="inner">
                        <?php 
                          $imag_url = wp_get_attachment_url( get_post_thumbnail_id($post->ID, 'thumbnail') );
                          if($imag_url):?>
                              <img src="<?php echo $imag_url; ?>">
                        <?php else:?>
                          <img height="150" width="200" src="http://mpoeduc.com/wp-content/uploads/2013/12/MPO-logo-shadow-2-e1386452789693.png">
                        <?php  endif;  ?>
                        <?php 
                            $link =get_field("link");
                         ?>
                        <a href="<?php echo $link;?>"> Activity Website</a>
                        <!--p>Share "<strong><?php //the_title();?></strong>" via:</p>
                        <p><a href="#" class="btn-share"><img src="images/share_twitter.png" width="79" height="25" alt=""></a> <a href="#" class="btn-share"><img src="images/share_facebook.png" width="88" height="25" alt=""></a> <a href="#" class="btn-share"><img src="images/share_google.png" width="67" height="25" alt=""></a> </p-->

                    </div>
                </div>
                <!--/ postshare -->
                
            </div>
            <!--/ post details -->
            
            <!-- post comments 
                        <div class="comment-list" id="comments">
                            <?php //if(!get_field('disable_comments')) comments_template( '/post-comments.php' ); ?> 
                           
                          <h2>3 Comments Added</h2>
                            
                            <a href="#addcomments" class="link-join">Join the conversation</a>
                            
                            <ol>
                                <li class="comment">
                                
                                    <div class="comment-body">
                                    <div class="comment-avatar">
                                        <div class="avatar"><img src="images/temp/gavatar_1.jpg" width="90" height="90" alt=""></div>
                                        <a href="#" class="link-author">Lenny Di Natale</a>
                                    </div>    
                                    <div class="comment-text">
                                        <div class="comment-author"> <span class="comment-date">Saturday 15th of June, 2012</span></div>
                                        <div class="comment-entry">
                                        Britain's phone hacking claimed another casualty on Monday when Yates, the deputy of London's Metropolitan Police, resigned a day after the country's top police officer quit and Rebekah Brooks, the former chief executive of Rupert Murdoch's News International was arrested on suspicion of illegally intercepting phone calls and bribing the police
                                        <a href="#addcomment" class="link-reply">Reply</a>
                                        </div>
                                    </div>
                                    <div class="clear"></div>
                                    </div>
                                    
                                  
                                    <ul class="children">
                                        <li class="comment">
                                            <div class="comment-body">
                                                <div class="comment-avatar">
                                                    <div class="avatar"><img src="images/temp/gavatar_3.jpg" width="90" height="90" alt=""></div>
                                                    <a href="#" class="link-author">Ari Gold</a>
                                                </div> 
                                                <div class="comment-text">
                                                    <div class="comment-author"><span class="comment-date">Sunday 16th of June, 2012</span></div>
                                                    <div class="comment-entry">Rebekah Brooks, the former chief executive of Rupert Murdoch's News International was arrested on suspicion of illegally intercepting phone calls and bribing the police. <a href="#addcomment" class="link-reply">Reply</a>                                                    </div>
                                                </div>
                                                <div class="clear"></div>
                                            </div>
                                            
                                        </li>
                                        
                                    </ul>
                                    
                                </li>
                                
                                <li class="comment">
                                    <div class="comment-body">
                                
                                    <div class="comment-avatar">
                                        <div class="avatar"><img src="images/temp/gavatar_2.jpg" width="90" height="90" alt=""></div>
                                        <a href="#" class="link-author">James Hale</a>
                                    </div> 
                                    <div class="comment-text">
                                        <div class="comment-author"><span class="comment-date">July 29, 2011</span></div>
                                        <div class="comment-entry">There's every chance your competitors will wish they'd placed this entry, not you. While your customers will have probably forgotten. <a href="#addcomment" class="link-reply">Reply</a>                                        </div>
                                    </div>
                                    <div class="clear"></div>
                                    </div>
                                </li>
                                
                            </ol>
                        </div>
                
                        <div class="add-comment" id="addcomments">
                            
                            <div class="add-comment-title">
                            <h3>Leave a Reply</h3>
                            </div>
                            
                            <div class="comment-form">
                            <form action="#" method="post">
                                
                                <div class="row alignleft">
                                    <label><strong>Name</strong></label>
                                    <input type="text" name="name" value="" class="inputtext input_middle required">
                                </div>
                                
                                <div class="space"></div>
                                
                                <div class="row  alignleft">
                                    <label><strong>Email</strong> (never published)</label>
                                    <input type="text" name="email" value="" class="inputtext input_middle required">
                                </div>
                                
                                <div class="clear"></div>   
                                
                                <div class="row">
                                    <label><strong>Website</strong></label>
                                    <input type="text" name="url" value="" class="inputtext input_full">
                                </div>
                                
                              <div class="row">
                                    <label><strong>Comment</strong></label>
                                    <textarea cols="30" rows="10" name="message" class="textarea textarea_middle required"></textarea>
                                </div>
                              <input type="submit" value="POSTS COMMENT" class="btn-submit">
                            </form>
                            </div>
                        </div>
                 --> 
            
        </div>
        <!--/ content -->
        
        <!-- sidebar -->
        <div class="sidebar">
        <!-- filter -->

            <?php destinationFilter();?>
            <!--/ filter -->
        </div>
        <!--/ sidebar -->
        
        <div class="clear"></div>        
    </div>
</div>
<!--/ middle -->
 

<?php 
after_content();
get_footer();
 ?>