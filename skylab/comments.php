<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments
 * and the comment form. The actual display of comments is
 * handled by a callback to mega_comment() which is
 * located in the functions.php file.
 *
 * @package WordPress
 * @subpackage Skylab
 * @since Skylab 1.0
 */
?>
	<div id="comments" class="clearfix">
	<?php if ( post_password_required() ) : ?>
		<p class="nopassword"><?php _e( 'This post is password protected. Enter the password to view any comments.', 'mega' ); ?></p>
	</div><!-- #comments -->
	<?php
			/* Stop the rest of comments.php from being processed,
			 * but don't kill the script entirely -- we still have
			 * to fully load the template.
			 */
			return;
		endif;
	?>

	<?php // You can start editing here -- including this comment! ?>

	<?php if ( have_comments() ) : ?>
		<h3 id="comments-title">
			<?php
				printf( _n( 'One comment on &ldquo;%2$s&rdquo;', '%1$s comments on &ldquo;%2$s&rdquo;', get_comments_number(), 'mega' ),
					number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' );
			?>
		</h3>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav id="comment-nav-above">
			<h1 class="assistive-text"><?php _e( 'Comment navigation', 'mega' ); ?></h1>
			<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'mega' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'mega' ) ); ?></div>
		</nav>
		<?php endif; // check for comment navigation ?>

		<ol class="commentlist">
			<?php
				/* Loop through and list the comments. Tell wp_list_comments()
				 * to use mega_comment() to format the comments.
				 * See mega_comment() in mega/functions.php for more.
				 */
				wp_list_comments( array( 'callback' => 'mega_comment' ) );
			?>
		</ol>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav id="comment-nav-below">
			<h1 class="assistive-text"><?php _e( 'Comment navigation', 'mega' ); ?></h1>
			<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'mega' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'mega' ) ); ?></div>
		</nav>
		<?php endif; // check for comment navigation ?>

	<?php
		/* If there are no comments and comments are closed, let's leave a little note, shall we?
		 * But we don't want the note on pages or post types that do not support comments.
		 */
		elseif ( ! comments_open() && ! is_page() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="nocomments"><?php _e( 'Comments are closed.', 'mega' ); ?></p>
	<?php endif; ?>

	<?php global $required_text; ?>
	<?php global $aria_req; ?>
	<?php $comments_args = array(
		'comment_field' => '<p class="comment-form-comment"><label for="comment">' . _x( 'Comment', 'noun', 'mega' ) . '</label> <textarea id="comment" name="comment" placeholder="' . _x( 'Comment', 'noun', 'mega' ) . '" cols="45" rows="8" aria-required="true"></textarea></p>',
		'title_reply' => __( '<span>Leave a Comment</span>', 'mega' ),
		'title_reply_to' => __( 'Reply', 'mega' ),
		'cancel_reply_link' => __( 'Cancel', 'mega' ),
		'label_submit' => __( 'Submit Comment', 'mega' ),
		'comment_notes_after' => __( '<p class="form-allowed-tags">' . sprintf( __( 'You may use these <abbr title="HyperText Markup Language">HTML</abbr> tags and attributes: %s' ), ' <code>' . allowed_tags() . '</code>' ) . '</p>', 'mega' ),
		'comment_notes_before' => '<p class="comment-notes">' . __( 'Your email address will not be published.', 'mega' ) . ( $req ? $required_text : '' ) . '</p>',
		'fields' => apply_filters( 'comment_form_default_fields', array(

			'author' =>
			  '<p class="comment-form-author">' .
			  '<label for="author">' . __( 'Name', 'mega' ) . '</label> ' .
			  ( $req ? '<span class="required">' . __( '(required)', 'mega' ) . '</span>' : '' ) .
			  '<input id="author" name="author" type="text" placeholder="' . __( 'Name', 'mega' ) . ( $req ? __( ' (required)', 'mega' ) : '' ) . '" value="' . esc_attr( $commenter['comment_author'] ) .
			  '" size="30"' . $aria_req . ' /></p>',

			'email' =>
			  '<p class="comment-form-email"><label for="email">' . __( 'Email', 'mega' ) . '</label> ' .
			  ( $req ? '<span class="required">' . __( '(required)', 'mega' ) . '</span>' : '' ) .
			  '<input id="email" name="email" type="text" type="text" placeholder="' . __( 'Email', 'mega' ) . ( $req ? __( ' (required)', 'mega' ) : '' ) . '" value="' . esc_attr(  $commenter['comment_author_email'] ) .
			  '" size="30"' . $aria_req . ' /></p>',
			'url' =>
			  '<p class="comment-form-url"><label for="url">' .
			  __( 'Website', 'mega' ) . '</label>' .
			  '<input id="url" name="url" type="text" placeholder="' . __( 'Website', 'mega' ) .'" value="' . esc_attr( $commenter['comment_author_url'] ) .
			  '" size="30" /></p>'
			)
		),
	); ?>
	
	<?php comment_form( $comments_args ); ?>

</div><!-- #comments -->
