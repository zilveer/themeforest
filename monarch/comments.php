<?php
/**
 * The template for displaying comments
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @package WordPress
 * @subpackage Monarch
 * @since Monarch 1.0
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
	if ( post_password_required() ) {
		return;
	}
?>

<?php if ( have_comments() ) : ?>
<div id="comments" class="comments-area">

	<h2 class="comments-title ShowOnScroll">
		<?php
			printf( _nx( 'One thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', get_comments_number(), 'comments title', 'monarch' ),
				number_format_i18n( get_comments_number() ), get_the_title() );
		?>
	</h2>

	<?php monarch_comment_nav(); ?>

	<ol class="comment-list">
		<?php
			wp_list_comments( array(
				'style'       => 'ol',
				'short_ping'  => true,
				'avatar_size' => 56,
			) );
		?>
	</ol>

	<!-- .comment-list -->
	<?php monarch_comment_nav(); ?>

</div>
<?php endif; ?>

<div id="comments" class="comments-area ShowOnScroll">

	<div class="timeline-badge"><i class="ion-chatbubbles"></i></div>

	<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>

	<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'monarch' ); ?></p>
	
	<?php endif; ?>
	<?php comment_form( $comment_args ); ?>
</div>