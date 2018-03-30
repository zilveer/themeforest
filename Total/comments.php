 <?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments and the comment
 * form. The actual display of comments is handled by a callback to
 * wpex_comment() which is located at functions/comments-callback.php
 *
 * @package Total WordPress Theme
 * @subpackage Templates
 * @version 3.4.0
 */

// Return if password is required
if ( post_password_required() ) {
	return;
}

// Add classes to the comments main wrapper
$classes = 'comments-area clr';

if ( ! comments_open() && get_comments_number() < 1 ) {
	$classes .= ' empty-closed-comments';
	return;
}

if ( 'full-screen' == wpex_global_obj( 'post_layout' ) ) {
	$classes .= ' container';
} ?>

<section id="comments" class="<?php echo esc_attr( $classes ); ?>">

	<?php if ( have_comments() ) : ?>

		<?php
		// Get comments title
		$comments_number = number_format_i18n( get_comments_number() );
		if ( '1' == $comments_number ) {
			$comments_title = esc_html__( 'This Post Has One Comment', 'total' );
		} else {
			$comments_title = sprintf( esc_html__( 'This Post Has %s Comments', 'total' ), $comments_number );
		}
		$comments_title = apply_filters( 'wpex_comments_title', $comments_title );

		// Display comments heading
		wpex_heading( array(
			'content'		=> $comments_title,
			'tag'			=> 'h2',
			'classes'		=> array( 'comments-title' ) ,
			'apply_filters'	=> 'comments',
		) ); ?>

		<ol class="comment-list">
			<?php
			// List comments
			wp_list_comments( array(
				'style'       => 'ol',
				'avatar_size' => 50,
				'format'      => 'html5',
			) ); ?>
		</ol><!-- .comment-list -->

		<?php
		// Display comment navigation - WP 4.4.0
		if ( function_exists( 'the_comments_navigation' ) ) : ?>
			<?php the_comments_navigation( array(
				'prev_text' => '<span class="fa fa-angle-left"></span>',
				'next_text' => '<span class="fa fa-angle-right"></span>',
			) ); ?>
		<?php elseif ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>

			<div class="comment-navigation wpex-clr">
				<?php paginate_comments_links( array(
					'prev_text' => '<span class="fa fa-angle-left"></span>',
					'next_text' => '<span class="fa fa-angle-right"></span>',
				) ); ?>
			</div>

		<?php endif; ?>

		<?php
		// Display comments closed message
		if ( ! comments_open() && get_comments_number() ) : ?>
			<p class="no-comments"><?php esc_html_e( 'Comments are closed.' , 'total' ); ?></p>
		<?php endif; ?>

	<?php endif; ?>

	<?php
	// The comment form
	comment_form( array(
		'cancel_reply_link'	=> '<span class="fa fa-times"></span>'. esc_html__( 'Cancel comment reply', 'total' ),
	) ); ?>

</section><!-- #comments -->