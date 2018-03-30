<?php
/**
 * The template for displaying Comments.
 *
 *
 * @KingSize 2011
 **/
 /**
*	Setup blog comment style
**/

if ( ! function_exists( 'twentyten_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own twentyten_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * 
 */
function twentyten_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case '' :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
	  <div id="comment-<?php comment_ID(); ?>">	
		<div class="post_title">
			<strong>
				<?php printf( __( '%s <span class="says">says:</span>', 'kslang' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
			</strong><!-- .comment-author .vcard -->
			<div class="date">
				<?php
					/* translators: 1: date, 2: time */
					printf( __( '%1$s at %2$s', 'kslang' ), get_comment_date(),  get_comment_time() ); ?><?php edit_comment_link( __( '(Edit)', 'kslang' ), ' ' );
				?>
			</div><!-- .comment-meta .commentmetadata -->
			
			<div class="pending_moderation">
			<?php if ( $comment->comment_approved == '0' ) : ?>
				<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'kslang' ); ?></em>
			<?php endif; ?>
			</div>
			
		 </div>

		<div class="post_avatar">
			<?php echo get_avatar( $comment, 40 ); ?>
		</div>

		<div class="post_text">
			<?php comment_text(); ?>
		</div>

		<div class="post_reply">
			<p><strong><?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?></strong></p>
		</div><!-- .reply -->
	 </div><!-- #comment-##  -->	
	<?php
			break;
		case 'pingback'  :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'kslang' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( '(Edit)', 'kslang' ), ' ' ); ?></p>
	<?php
			break;
	endswitch;
} //End functions
endif;
?>


	<?php if ( post_password_required() ) : ?>
			<p class="nopassword"><?php _e( 'This post is password protected. Enter the password to view any comments.', 'kslang' ); ?></p>
	<?php
			/* Stop the rest of comments.php from being processed,
			 * but don't kill the script entirely -- we still have
			 * to fully load the template.
			 */
			return;
		endif;
	?>
	
	<?php
		// You can start editing here -- including this comment!
	?>
	
	<?php if ( have_comments() ) : ?>
		<div class="blog_post comments_section">

				<h4><?php comments_number(__('No Comments', 'kslang'), __('1 Comment', 'kslang'), __('% Comments', 'kslang')); ?> <?php _e('on', 'kslang'); ?> <?php the_title(); ?></h4>

	<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
				<div class="navigation">
					<div class="nav-previous"><?php previous_comments_link( __( '<span class="meta-nav">&larr;</span> Older Comments', 'kslang' ) ); ?></div>
					<div class="nav-next"><?php next_comments_link( __( 'Newer Comments <span class="meta-nav">&rarr;</span>', 'kslang' ) ); ?></div>
				</div> <!-- .navigation -->
	<?php endif; // check for comment navigation ?>
	
		<ul class="no-bullet blog_comments">		
		<?php
			/* Loop through and list the comments. Tell wp_list_comments()
			 * to use twentyten_comment() to format the comments.
			 * If you want to overload this in a child theme then you can
			 * define twentyten_comment() and that will be used instead.
			 * See twentyten_comment() in twentyten/functions.php for more.
			 */
			wp_list_comments( array( 'callback' => 'twentyten_comment' ) );
		?>
		</ul>
				
	
	<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
				<div class="navigation">
					<div class="nav-previous"><?php previous_comments_link( __( '<span class="meta-nav">&larr;</span> Older Comments', 'kslang' ) ); ?></div>
					<div class="nav-next"><?php next_comments_link( __( 'Newer Comments <span class="meta-nav">&rarr;</span>', 'kslang' ) ); ?></div>
				</div><!-- .navigation -->
	<?php endif; // check for comment navigation ?>
	
	  </div><!-- //END blog_post comments_section -->

	<?php else : // or, if we don't have comments:
	
		/* If there are no comments and comments are closed,
		 * let's leave a little note, shall we?
		 */
		if ( ! comments_open() ) :
	?>
	<?php endif; // end ! comments_open() ?>
	
	<?php endif; // end have_comments() ?>
	
	
	<!-- Leave a comment box -->
	<?php
		$aria_req = ( $req ? " aria-required='true'" : '' );
		$required_text = sprintf( '' . __('Fields marked with * are required', 'kslang' ), '');
	
		$comment_args = array(

			'title_reply'       => __( 'Leave a Reply', 'kslang' ),
			'title_reply_to'    => __( 'Leave a Reply to %s', 'kslang' ),
			'cancel_reply_link' => __( 'Cancel Reply', 'kslang' ),
			'label_submit'      => __( 'Post Comment', 'kslang' ),
			
			'id_form'           => 'comment_form',
			'class_form'      => 'comment-form',
			'class_submit'      => 'send-link',
	
			
			'must_log_in' => '<div class="blog_post"><p>' . sprintf( __( 'You must be <a href="%s">logged in</a> to post a comment.', 'kslang' ), wp_login_url( apply_filters( 'the_permalink', get_permalink() ) ) ) . '</p></div>',

			'logged_in_as' => '<p class="logged-in-as">' .  sprintf( __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>', 'kslang'), admin_url( 'profile.php' ), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink() ) ) ) . '</p>',

			'comment_notes_before' => '<div class="post_text"><p class="comment-notes">' . __( 'Your email address will not be published. ', 'kslang') . ( $req ? $required_text : '' ) . '</p></div>',

			 
			'fields' => apply_filters( 'comment_form_default_fields', array(

				'author' => '<div class="row">' . '<input class="four columns text center" id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' placeholder="'.__('Name', 'kslang').'"/></div>',
	
				'email' => '<div class="row">'. '<input class="four columns text center" id="email" name="email" type="text" value="' . esc_attr( $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' placeholder="'.__('Email', 'kslang').'"/></div>',
	
				'url' => '<div class="row">'. '<input class="four columns text center" id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" placeholder="'.__('Website', 'kslang').'"/></div>',
				
				'comment_field' => '<div class="row"><textarea class="twelve columns" rows="6" name="comment" id="comment"  value="'.__('Message', 'kslang').'" placeholder="'.__('Message', 'kslang').'"> </textarea></div>',
	
			) ),
			
			
		
		);
			
		if ( !is_user_logged_in() ) {
		 $comment_args['comment_notes_after'] = '';
		 $comment_args['comment_field'] = '';
		}
		 		
		comment_form( $comment_args );
	
	?>
	<!-- End Comment Form integration -->

