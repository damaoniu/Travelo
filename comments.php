	
	<?php if ( post_password_required() ) : ?>
		<p class="nopassword"><?php _e( 'This post is password protected. Enter the password to view any Reviews.', 'um_lang' ); ?></p>
	<?php
			return;
		endif;
	?>

   <div class="reviews">	   
            <p><span><b><?php _e('Reviews','um_lang');?></b></span><?php _e('Read other people opinions','um_lang');?></p>
		    <div class="reviewIcon"></div>        
 	</div> <!--review--> 

 <div class="reviewsBody">
 <table style="width:95%;">
	 <?php if ( have_comments() ) : ?>

         <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		    <nav id="comment-nav-above">
			     <div class="pageNrBtn"><?php next_comments_link( __( 'Next', 'um_lang' ) ); ?>
                    <?php previous_comments_link( __( 'Prev', 'um_lang' ) ); ?></div>
		    </nav>
		    <?php endif; // check for comment navigation ?>
		    	<?php wp_list_comments( array( 'callback' => 'um_reivew' ) ); ?>
		    <?php
		    if ( ! comments_open() && get_comments_number() ) : ?>
		    <p class="nocomments"><?php _e( 'Reviews are closed.' , 'um_lang' ); ?></p>
		    <?php endif; ?>

	    <?php endif; // have_comments() ?>

     </table> 

<?php
	$commenter = wp_get_current_commenter();
	$user = wp_get_current_user();
	$user_identity = $user->exists() ? $user->display_name : '';

	$req = get_option( 'require_name_email' );
	$aria_req = ( $req ? " aria-required='true'" : '' );

          $user_rating = get_field('enable_user_rating');
            if($user_rating)
            {
                $Commentstars = '<div class="reviewInput">'.'<label><b>'. __('review','um_lang') . ':</b></label><br /><input type="text" disabled class="reviewInputStarsBg" /> <span class="stars"></span><input type="hidden" name="shouldScore" value="true"></div>';
            }
            else
            {
                $Commentstars = "";
            }
    
    $fields =  array(
	    'author' => '<div class="reviewInput"><b><label for="author">' . __( 'Name', 'domainreference' ) . ':</label> ' . ( $req ? '' : '' ) . '<br><input class="reviewInputFields" id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></b></div>',
	    'email' => '<div class="reviewInput"><b><label for="email">' . __( 'Email', 'domainreference' ) . ':</label> ' . ( $req ? '' : '' ) . '<br><input class="reviewInputFields" id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /></b></div>',
        'score' =>  $Commentstars
    ); 

    $args = array(
	      'fields' => $fields,
          'label_submit'=>'Add Review',
          'id_submit'            => 'addReviewBtn',
          'title_reply'=> '',
          'comment_notes_before' => '<p class="comment-notes">' . __( 'Your email address will not be published.' ,'um_lang') . ( $req ? __(' All the fields are required to add a review.','um_lang') : '' ) . '</p>',
          'comment_notes_after' => '',
          'comment_field'        => '<div class="reviewInput"><b><label for="comment">' . _x( 'Comment', 'noun','um_lang' ) . ':</b></label><br><textarea class="writeComment" id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea></div>',
         );
?>

 <div class="writeReview"><p><b>Write Your Own review</b></p></div>
    <div class="reviewForm"> 
        <?php comment_form($args);?> 
    </div>
    </div><!-- END reviewsBody --> 

  


 