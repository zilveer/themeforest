<?php
/**
 * The template for displaying Comments
 *
 * The area of the page that contains comments and the comment form.
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

/*
 * If the current post is protected by a password and the visitor has not yet
 * entered the password we will return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area post-comments">

	<?php if ( have_comments() ) : ?>

	<h3><?php esc_html_e('Comments', 'KowloonBay'); ?> <span class="number"><?php echo esc_html( get_comments_number() ); ?></span>
		<?php
			// printf( _n( 'One thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', get_comments_number(), 'KowloonBay' ),
				// number_format_i18n( get_comments_number() ), get_the_title() );
		?>
	</h3>

	<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
	<nav id="comment-nav-above" class="navigation comment-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'KowloonBay' ); ?></h1>
		<div class="nav-previous"><?php previous_comments_link( esc_html__( '&larr; Older Comments', 'KowloonBay' ) ); ?></div>
		<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments &rarr;', 'KowloonBay' ) ); ?></div>
	</nav><!-- #comment-nav-above -->
	<?php endif; // Check for comment navigation. ?>

	<ol class="comment-list">
		<?php
			wp_list_comments( array(
				'style'      => 'ol',
				'short_ping' => true,
				'avatar_size'=> 34,
			) );
		?>
	</ol><!-- .comment-list -->

	<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
	<nav id="comment-nav-below" class="navigation comment-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'KowloonBay' ); ?></h1>
		<div class="nav-previous"><?php previous_comments_link( esc_html__( '&larr; Older Comments', 'KowloonBay' ) ); ?></div>
		<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments &rarr;', 'KowloonBay' ) ); ?></div>
	</nav><!-- #comment-nav-below -->
	<?php endif; // Check for comment navigation. ?>

	<?php if ( ! comments_open() ) : ?>
	<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'KowloonBay' ); ?></p>
	<?php endif; ?>

	<?php endif; // have_comments() ?>

	<?php
		$required_text = esc_html__('This field is required.', 'KowloonBay');
		$aria_req = ' required';
		$comment_form_args = array(
			'id_form'           => 'commentform',
			'id_submit'         => 'submit',
			'title_reply'       => esc_html__( 'Leave a Reply', 'KowloonBay' ),
			'title_reply_to'    => esc_html__( 'Leave a Reply to %s', 'KowloonBay' ),
			'cancel_reply_link' => esc_html__( 'Cancel Reply', 'KowloonBay' ),
			'label_submit'      => esc_html__( 'Post Comment', 'KowloonBay' ),

			'comment_field' =>  '<p class="comment-form-comment"><textarea id="comment" class="form-input-style" name="comment" cols="45" rows="8" placeholder="'. esc_attr(_x( 'Comment', 'noun', 'KowloonBay' )) .'" aria-required="true">' .
			'</textarea></p>',

			'must_log_in' => '<p class="must-log-in">' .
			sprintf(
				__( 'You must be <a href="%s">logged in</a> to post a comment.' ),
				wp_login_url( apply_filters( 'the_permalink', get_permalink() ) )
				) . '</p>',

			'logged_in_as' => '<p class="logged-in-as">' .
			sprintf(
				__( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>' ),
				admin_url( 'profile.php' ),
				$user_identity,
				wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) )
				) . '</p>',

			'comment_notes_before' => '<p class="comment-notes">' .
			__( 'Your email address will not be published.', 'KowloonBay' ) .' '. ( $req ? $required_text : '' ) .
			'</p>',

			'comment_notes_after' => '<p class="form-allowed-tags">' .
			sprintf(
				__( 'You may use these <abbr title="HyperText Markup Language">HTML</abbr> tags and attributes: %s' ),
				' <code>' . allowed_tags() . '</code>'
				) . '</p>',

			'fields' => apply_filters( 'comment_form_default_fields', array(

				'author' =>
				'<p class="comment-form-author">'.
				'<input class="form-input-style" id="author" name="author" type="text" placeholder="'. esc_attr__( 'Name', 'domainreference' ) .( $req ? '*' : '' ). '" value="' . esc_attr( $commenter['comment_author'] ) .
				'" size="30"' . $aria_req . ' /></p>',

				'email' =>
				'<p class="comment-form-email">' .
				'<input class="form-input-style" id="email" name="email" type="text" placeholder="'. esc_attr__( 'Email', 'domainreference' ) .( $req ? '*' : '' ). '" value="' . esc_attr(  $commenter['comment_author_email'] ) .
				'" size="30"' . $aria_req . ' /></p>',

				'url' =>
				'<p class="comment-form-url">' .
				'<input class="form-input-style" id="url" name="url" type="text" placeholder="'. esc_attr__( 'Website', 'domainreference' ) .'" value="' . esc_attr( $commenter['comment_author_url'] ) .
				'" size="30" /></p>'
				)
			),
		);
		comment_form($comment_form_args);
	?>

</div><!-- #comments -->
