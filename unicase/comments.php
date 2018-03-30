<?php
/**
 * The template for displaying comments.
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @package unicase
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

<div id="comments" class="comments-area">

	<?php if ( have_comments() ) : ?>
		<h2 class="comments-title">
			<?php echo apply_filters( 'unicase_comments_title', esc_html__( 'Comments', 'unicase' ) );?>
		</h2>

		<ol class="comment-list">
			<?php
				wp_list_comments( array(
					'type'			=> 'comment',
					'style'      	=> 'ol',
					'short_ping' 	=> true,
					'callback'		=> 'unicase_comment',
				) );
			?>
		</ol><!-- .comment-list -->

		<?php $comments_by_type = separate_comments($comments); ?>
		<?php if ( ! empty( $comments_by_type['pings'] ) ) : ?>
			<h2 class="pings-title">
				<?php echo apply_filters( 'unicase_pingbacks_title', esc_html__( 'Trackbacks and Pingbacks', 'unicase' ) );?>
			</h2>

			<ol class="pings-list">
				<?php
					wp_list_comments( array(
						'type'			=> 'pings',
						'style'      	=> 'ol',
						'short_ping' 	=> true,
						'callback'		=> 'unicase_pings',
					) );
				?>
			</ol><!-- .ping-list -->
		<?php endif; // check for pings list ?>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav id="comment-nav-below" class="comment-navigation">
			<h1 class="screen-reader-text sr-only"><?php esc_html_e( 'Comment navigation', 'unicase' ); ?></h1>
			<div class="nav-previous"><?php previous_comments_link( esc_html__( '&larr; Older Comments', 'unicase' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments &rarr;', 'unicase' ) ); ?></div>
		</nav><!-- #comment-nav-below -->
		<?php endif; // check for comment navigation ?>

	<?php endif; // have_comments() ?>

	<?php if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>
		<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'unicase' ); ?></p>
	<?php endif; ?>

	<?php comment_form(); ?>

</div><!-- #comments -->
