<?php
/**
 * The template for displaying Comments
 *
 * The area of the page that contains comments and the comment form.
 *
 * @package Evential
 * @subpackage Evential
 * @since Evential 1.0
 */

/*
 * If the current post is protected by a password and the visitor has not yet
 * entered the password we will return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comment comments-area">

	<?php if ( have_comments() ) : ?>

	<h2>
		<?php
			printf( _n( 'Comments:', 'Comments: ', get_comments_number(), '8w' ),
				number_format_i18n( get_comments_number() ), get_the_title() );
		?>
	</h2>

	<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
	<nav id="comment-nav-above" class="navigation comment-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Comment navigation', '8w' ); ?></h1>
		<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', '8w' ) ); ?></div>
		<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', '8w' ) ); ?></div>
	</nav><!-- #comment-nav-above -->
	<?php endif; // Check for comment navigation. ?>

	<ol class="comment-list">
		<?php
			wp_list_comments( array(
				'style'      => 'ol',
				'short_ping' => true,
				'avatar_size'=> 50,
			) );
		?>
	</ol><!-- .comment-list -->

	<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
	<nav id="comment-nav-below" class="navigation comment-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Comment navigation', 'evential' ); ?></h1>
		<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'evential' ) ); ?></div>
		<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'evential' ) ); ?></div>
	</nav><!-- #comment-nav-below -->
	<?php endif; // Check for comment navigation. ?>

	<?php if ( ! comments_open() ) : ?>
	<p class="no-comments"><?php _e( 'Comments are closed.', 'evential' ); ?></p>
	<?php endif; ?>

	<?php endif; // have_comments() ?>
	<?php // Comment Form // ?>
	<div class="post_a_comment">
		<?php
			$comment_args = array( 'title_reply'=>'LEAVE A COMMENT:',
			'fields' => apply_filters( 'comment_form_default_fields', array(
			'author' => '<div class="input_type"><p class="comment-form-author">' . '' . ( $req ? '' : '' ) .
					'<input id="author" name="author" type="text" placeholder="Your Name*" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" /></p>',   
				'email'  => '<p class="comment-form-email">' .
							'' .
							( $req ? '' : '' ) .
							'<input id="email" name="email" type="text" placeholder="Your Email*" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" />'.'</p></div>',
				'url'    => '' ) ),
				'comment_field' => '<div class="text_area">' .
							'' .
							'<textarea id="comment" name="comment" cols="45" rows="8" placeholder="Message" aria-required="true"></textarea>' .
							'</div>',
				'comment_notes_after' => '',
			);
			comment_form($comment_args); 
		?>
	<div class="clear"></div>
	</div>
</div><!-- #comments -->
