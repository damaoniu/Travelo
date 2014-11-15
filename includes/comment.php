<?php
if (!function_exists( 'um_reivew')) :
function um_reivew( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
	?>
		<p><?php _e( 'Pingback:', 'um_lang' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( 'Edit', 'um_lang' ), '<span class="edit-link">', '</span>' ); ?></p>
	<?php
			break;
		default :
	?> 	
				<td>
                    <?php
						$avatar_size = 68;
						if ( '0' != $comment->comment_parent )
							$avatar_size = 39;
						echo get_avatar( $comment, $avatar_size );
                        ?>
                </td>
                <td>
            <div class="reviewText">   

                        <?php
                   $user_rating = get_field('enable_user_rating');
                   if($user_rating)
                   {
                       $Commentstars = '<span data-score="'. get_comment_meta(get_comment_ID(), 'review', true ) . '" class="starsRated"></span>';
                   }
                   else
                   {
                       $Commentstars = "";
                   }
                        printf( __( '%1$s %2$s'. $Commentstars, 'um_lang' ),
							sprintf( '<h5><b>%s</b></h5>', get_comment_author() ),
							sprintf( '<span><b><time datetime="%2$s">%3$s</time></b></span>',
								esc_url( get_comment_link( $comment->comment_ID ) ),
								get_comment_time( 'c' ),
								sprintf( __( '%1$s at %2$s', 'um_lang' ), get_comment_date(), get_comment_time() )
							)
						);
					?>

				        <?php edit_comment_link( __( 'Edit', 'um_lang' ), '<span class="edit-link">', '</span>' ); ?>
              
                  <div class="replyComment" style="display:none;">
				    <?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply', 'um_lang' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			    </div><!-- .replyComment -->

				        <?php if ( $comment->comment_approved == '0' ) : ?>
					        <em class="comment-awaiting-moderation"><?php _e( 'Your Reviews is awaiting moderation.', 'um_lang' ); ?></em>
					        <br />
				        <?php endif; ?>

                        <p><?php comment_text(); ?></p>
                        
		    </div>
          </td>
        </tr>                  
       
	<?php
			break;
	endswitch;
}
endif; // ends check for um_reivew()



add_action( 'comment_post', 'save_comment_meta_data' );
 
function save_comment_meta_data( $comment_id ) {
    add_comment_meta( $comment_id, 'review', wp_filter_nohtml_kses($_POST[ 'score' ]) );
}


add_filter( 'preprocess_comment', 'verify_comment_meta_data' );
function verify_comment_meta_data( $commentdata ) {

    if(isset($_POST["shouldScore"]) && $_POST["shouldScore"]){
        if ( ! isset( $_POST['score'] ) || $_POST['score'] == ""){
                    wp_die(__('Error: please fill the required field (Review).','um_lang' ));
        }
    }
    return $commentdata;
}

add_filter( 'get_comment_author_link', 'attach_review_to_author' );
function attach_review_to_author( $author ) {
    $review = get_comment_meta( get_comment_ID(), 'review', true );
    if ( $review )
        $author .= " ($review)";
    return $author;
}

if (!function_exists( 'um_comments')) :
function um_comments( $comment, $args, $depth ) {
 
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
	?>
		<p><?php _e( 'Pingback:', 'um_lang' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( 'Edit', 'um_lang' ), '<span class="edit-link">', '</span>' ); ?></p>
	<?php
			break;
		default :
	?> 	
				<td>
                    <?php
						$avatar_size = 68;
						if ( '0' != $comment->comment_parent )
							$avatar_size = 39;
						echo get_avatar( $comment, $avatar_size );
                        ?>
                </td>
                <td>
            <div class="reviewText"> 

                        <?php
                   $user_rating = get_field('enable_user_rating');
                   if($user_rating)
                   {
                       $Commentstars = '<span data-score="'. get_comment_meta(get_comment_ID(), 'review', true ) . '" class="starsRated"></span>';
                   }
                   else
                   {
                       $Commentstars = "";
                   }
                        printf( __( '%1$s %2$s'. $Commentstars, 'um_lang' ),
							sprintf( '<h5><b>%s</b></h5>', get_comment_author() ),
							sprintf( '<span><b><time datetime="%2$s">%3$s</time></b></span>',
								esc_url( get_comment_link( $comment->comment_ID ) ),
								get_comment_time( 'c' ),
								sprintf( __( '%1$s at %2$s', 'um_lang' ), get_comment_date(), get_comment_time() )
							)
						);
					?>

				        <?php edit_comment_link( __( 'Edit', 'um_lang' ), '<span class="edit-link">', '</span>' ); ?>
		
                <div class="replyComment">
				    <?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply', 'um_lang' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			    </div><!-- .replyComment -->

				        <?php if ( $comment->comment_approved == '0' ) : ?>
					        <em class="comment-awaiting-moderation"><?php _e( 'Your Reviews is awaiting moderation.', 'um_lang' ); ?></em>
					        <br />
				        <?php endif; ?>

                        <p><?php comment_text(); ?></p>
                        
		    </div>
          </td>
        </tr>                  
       
	<?php
			break;
	endswitch;
}
endif; // ends check for um_comments()

if (!function_exists( 'testimony')) :
	$comment_count = 1;// how many comments we have
function testimony( $comment, $args, $depth ) {
 
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
	?>
		<p><?php _e( 'Pingback:', 'um_lang' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( 'Edit', 'um_lang' ), '<span class="edit-link">', '</span>' ); ?></p>
	<?php
			break;
		default :
		
	?> 	
				<td>
				<?php if($comment_count%2==0): ?>
				 <div class="testRight">
				 	<?php endif;
				 	if($comment_count%2!=0): ?>
				 <div class="testRight">
                    <?php endif;
							$avatar_size = 39;
						echo get_avatar( $comment, $avatar_size );
						echo $comment_count;
                        ?>
           			<div class="reviewText"> 

                        <?php
                        printf( __( '%1$s %2$s'. $Commentstars, 'um_lang' ),
							sprintf( '<h5><b>%s</b></h5>', get_comment_author() ),
							sprintf( '<span><b><time datetime="%2$s">%3$s</time></b></span>',
								esc_url( get_comment_link( $comment->comment_ID ) ),
								get_comment_time( 'c' ),
								sprintf( __( '%1$s at %2$s', 'um_lang' ), get_comment_date(), get_comment_time() )
							)
						);
					?>

				        <?php edit_comment_link( __( 'Edit', 'um_lang' ), '<span class="edit-link">', '</span>' ); ?>

				        <?php if ( $comment->comment_approved == '0' ) : ?>
					        <em class="comment-awaiting-moderation"><?php _e( 'Your Reviews is awaiting moderation.', 'um_lang' ); ?></em>
					        <br />
				        <?php endif; ?>

                        <p><?php comment_text();
                        	$comment_count++; 

                        ?></p>
                        
		   			</div>
				</div>
          </td>
    
        </tr>                  
       
	<?php
			break;
	endswitch;
}
endif; // ends check for Testimony()

?>