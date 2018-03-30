<?php
/**
 * The template for displaying comments.
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package omni
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

<div id="comments" class="blog-comments">

	<?php if ( have_comments() ) : ?>

			<h2 class="h2 titel-left">
				<?php
				printf( // WPCS: XSS OK.
					_nx( 'One comment', 'Comments <span>(%1$s)</span>', get_comments_number(), 'comments title', 'omni' ),
					number_format_i18n( get_comments_number() )
				);
				?>
			</h2>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
			<nav id="comment-nav-above" class="navigation comment-navigation" role="navigation">
				<h2 class="screen-reader-text hide"><?php esc_html_e( 'Comment navigation', 'omni' ); ?></h2>
				<ul class="pager">

					<li class="previous"><?php previous_comments_link( esc_html__( 'Older Comments', 'omni' ) ); ?></li>
					<li class="next"><?php next_comments_link( esc_html__( 'Newer Comments', 'omni' ) ); ?></li>

				</ul>
				<!-- .pager -->
			</nav><!-- #comment-nav-above -->
		<?php endif; // Check for comment navigation. ?>


		<div class="blog-comments-container">
			<?php wp_list_comments( array( 'callback' => 'crum_comments', 'style' => 'div' ) ); ?>
		</div>


		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>

			<nav id="comment-nav-below" class="navigation comment-navigation" role="navigation">
				<h2 class="screen-reader-text hide"><?php esc_html_e( 'Comment navigation', 'omni' ); ?></h2>
				<ul class="pager">

					<li class="previous"><?php previous_comments_link( esc_html__( 'Older Comments', 'omni' ) ); ?></li>
					<li class="next"><?php next_comments_link( esc_html__( 'Newer Comments', 'omni' ) ); ?></li>

				</ul>
				<!-- .pager -->
			</nav><!-- #comment-nav-below -->
		<?php endif; // Check for comment navigation. ?>

	<?php endif; // Check for have_comments(). ?>

	<?php
	// If comments are closed and there are comments, let's leave a little note, shall we?
	if ( ! comments_open() && '0' !== get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
		?>
		<h3 class="no-comments"><?php esc_html_e( 'Comments are closed.', 'omni' ); ?></h3>
	<?php endif; ?>

	<?php

	$fields = array(
		'author' => '<input id="author" placeholder="' . esc_html__( 'Your Name (required)', 'omni' ) . '" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
		'" size="30" required />',
		'email'  => '<input id="email" placeholder="' . esc_html__( 'Your Email (required)', 'omni' ) . '"  name="email" type="email"  value="' . esc_attr( $commenter['comment_author_email'] ) .
		'" size="30" required />',
		'url' => '',
	);

	$comments_args = array(
		'class_submit'  => 'button',
		'comment_field' => '<textarea id="comment" name="comment" aria-required="true" placeholder="' . esc_html__( 'Comment', 'omni' ) . '" required ></textarea>',
		'fields'        => apply_filters( 'comment_form_default_fields', $fields ),
	);

	comment_form( $comments_args );

	?>

</div><!-- #comments -->
