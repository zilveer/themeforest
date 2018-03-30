<?php
/**
 * Functions for handling how comments are displayed and used on the site. This allows more precise 
 * control over their display and makes more filter and action hooks available to developers to use in their 
 * customizations.
 */


if ( ! function_exists( 'st_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own st_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 */
function st_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
		// Display trackbacks differently than normal comments.
	?>

<li class="post pingback">
  <p>
    <?php _e( 'Pingback:', 'framework' ); ?>
    <?php comment_author_link(); ?>
    <?php edit_comment_link( __( '(Edit)', 'framework' ), ' ' ); ?>
  </p>
  <?php
break;
default :
?>
<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
  <article id="comment-<?php comment_ID(); ?>" class="comment">
    <div class="comment-action">
      <?php edit_comment_link( __( 'Edit', 'framework' ), '', '' ); ?>
      <?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply', 'framework' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
    </div>
    <!-- .comment-action -->
    
    <header class="comment-meta comment-author vcard">
      <?php
					echo get_avatar( $comment, 70 );
					printf( '<cite class="fn">%1$s %2$s</cite>', get_comment_author_link(), ''	);
					printf( '<a href="%1$s"><time pubdate datetime="%2$s">%3$s</time></a>',
						esc_url( get_comment_link( $comment->comment_ID ) ),
						get_comment_time( 'c' ),
						/* translators: 1: date, 2: time */
						sprintf( __( '%1$s at %2$s', 'framework' ), get_comment_date(), get_comment_time() )
					);
				?>
    </header>
    <!-- .comment-meta -->
    
    <?php if ( '0' == $comment->comment_approved ) : ?>
    <p class="comment-awaiting-moderation">
      <?php _e( 'Your comment is awaiting moderation.', 'framework' ); ?>
    </p>
    <?php endif; ?>
    <div class="comment-content clearfix">
      <?php comment_text(); ?>
    </div >

    
  </article>
  <!-- #comment-## -->
  <?php
		break;
	endswitch; // end comment_type check
}
endif;



function st_comment_form_args( $args ) {
	global $user_identity;

	/* Get the current commenter. */
	$commenter = wp_get_current_commenter();

	/* Create the required <span> and <input> element class. */
	$req = ( ( get_option( 'require_name_email' ) ) ? ' <span class="required">' . __( '*', 'framework' ) . '</span> ' : '' );
	$input_class = ( ( get_option( 'require_name_email' ) ) ? ' req' : '' );

	/* Sets up the default comment form fields. */
	$fields = array(
		'author' => '<p class="form-author clearfix' . esc_attr( $input_class ) . '"><label for="author">' . __( 'Name', 'framework' ) . $req . '</label> <input type="text" class="text-input" name="author" id="author" value="' . esc_attr( $commenter['comment_author'] ) . '" size="40" /></p>',
		'email'  => '<p class="form-email clearfix' . esc_attr( $input_class ) . '"><label for="email">' . __( 'Email', 'framework' ) . $req . '</label> <input type="text" class="text-input" name="email" id="email" value="' . esc_attr( $commenter['comment_author_email'] ) . '" size="40" /></p>',
		'url'    => '<p class="form-url clearfix"><label for="url">' . __( 'Website', 'framework' ) . '</label><input type="text" class="text-input" name="url" id="url" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="40" /></p>'
	);

	/* Sets the default arguments for displaying the comment form. */
	$args = array(
		'fields'               => apply_filters( 'comment_form_default_fields', $fields ),
		'comment_field'        => '<p class="form-textarea req clearfix"><label for="comment">' . __( 'Comment', 'framework' ) . '</label><textarea name="comment" id="comment" cols="60" rows="10"></textarea></p>',
		'must_log_in'          => '<p class="alert">' . sprintf( __( 'You must be <a href="%1$s" title="Log in">logged in</a> to post a comment.', 'framework' ), wp_login_url( get_permalink() ) ) . '</p><!-- .alert -->',
		'logged_in_as'         => '<p class="log-in-out">' . sprintf( __( 'Logged in as <a href="%1$s" title="%2$s">%2$s</a>.', 'framework' ), admin_url( 'profile.php' ), esc_attr( $user_identity ) ) . ' <a href="' . wp_logout_url( get_permalink() ) . '" title="' . esc_attr__( 'Log out of this account', 'framework' ) . '">' . __( 'Log out &raquo;', 'framework' ) . '</a></p><!-- .log-in-out -->',
		'comment_notes_before' => '',
		'comment_notes_after'  => '',
		'id_form'              => 'commentform',
		'id_submit'            => 'submit',
		'name_submit'       	=> 'submit',
		'class_submit'			=> 'submit',
		'submit_button' => '<input name="%1$s" type="submit" id="%2$s" class="%3$s" value="%4$s" />',
		'submit_field' => '<p class="form-submit">%1$s %2$s</p',
		'title_reply'          => __( 'Leave A Comment?', 'framework' ),
		'title_reply_to'       => __( 'Leave a Reply to %s', 'framework' ),
		'cancel_reply_link'    => __( 'Click here to cancel reply.', 'framework' ),
		'label_submit'         => __( 'Post Comment', 'framework' ),
	);

	/* Return the arguments for displaying the comment form. */
	return $args;
}

/* Filter the comment form defaults. */
add_filter( 'comment_form_defaults', 'st_comment_form_args' );


