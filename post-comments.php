	
	<?php if ( post_password_required() ) : ?>
		<p class="nopassword"><?php _e( 'This post is password protected. Enter the password to view any Reviews.', 'um_lang' ); ?></p>
	<?php
			return;
		endif;
	?>

     <div class="singleCommentHeader">   
           <p><b><?php _e('Comments','um_lang');?>  </b>  </p>
 	</div> 

  <div class="singleCommentBody">
 <table style="width:100%;">
	 <?php if ( have_comments() ) : ?>

         <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		    <nav id="comment-nav-above" class="pagingBtnBg">
			     <div class="pageNrBtn"><?php next_comments_link( __( 'Next', 'um_lang' ) ); ?>
                    <?php previous_comments_link( __( 'Prev', 'um_lang' ) ); ?></div>
		    </nav>
		    <?php endif; // check for comment navigation ?>
		    	<?php wp_list_comments( array( 'callback' => 'um_comments' ) ); ?>
		    <?php
		    if ( ! comments_open() && get_comments_number() ) : ?>
		    <p class="nocomments"><?php _e( 'Reviews are closed.' , 'um_lang' ); ?></p>
		    <?php endif; ?>

	    <?php endif; // have_comments() ?>

     </table> 
     </div>
<?php
	$commenter = wp_get_current_commenter();
	$user = wp_get_current_user();
	$user_identity = $user->exists() ? $user->display_name : '';

	$req = get_option( 'require_name_email' );
	$aria_req = ( $req ? " aria-required='true'" : '' );

    $fields =  array(
	    'author' => '<div class="reviewInput"><b><label for="author">' . __( 'Name', 'domainreference' ) . ':</label> ' . ( $req ? '' : '' ) . '<br><input class="reviewInputFields" id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></b></div>',
	    'email' => '<div class="reviewInput"><b><label for="email">' . __( 'Email', 'domainreference' ) . ':</label> ' . ( $req ? '' : '' ) . '<br><input class="reviewInputFields" id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /></b></div>'
      
    ); 
    $args = array(
	      'fields' => $fields,
          'label_submit'=>'Add comment',
          'id_submit'            => 'addReviewBtn',
          'title_reply'=> '',
          'comment_notes_before' => '',
          'comment_notes_after' => '',
          'comment_field'        => '<div class="reviewInput"><b><label for="comment">' . _x( 'Comment', 'noun','um_lang' ) . ':</b></label><br><textarea class="writeCommentSingle" id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea></div>',
         );
?>

 
     <div class="singleCommentHeader">
         <p><b>Leave a comment</b></p>  
     </div>
      <div class="singleCommentBody">
          <div class="reviewForm">
            <?php comment_form($args);?> 
          </div>
        </div>
    

  


 