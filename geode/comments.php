<?php
/**
 * @package WordPress
 * @subpackage Geode
 * @since Geode 1.0
 */

if ( post_password_required() || (! have_comments() && ! comments_open()) ) {
	return;
}
?>

<div id="comments" class="comments-area row">

	<div class="row-inside <?php echo apply_filters('geode_fx_onscroll',''); ?>">

		<?php if ( have_comments() ) : ?>

		<h3 class="comments-title">
			<?php
				printf( _n( 'One comment', '%1$s comments', get_comments_number(), 'geode' ),
					number_format_i18n( get_comments_number() ) );
			?>
		</h3>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
		<nav id="comment-nav-above" class="navigation comment-navigation" role="navigation">
			<h1 class="screen-reader-text"><?php _e( 'Comment navigation', 'geode' ); ?></h1>
			<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'geode' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'geode' ) ); ?></div>
		</nav><!-- #comment-nav-above -->
		<?php endif; // Check for comment navigation. ?>

		<ul class="comment-list">
			<?php
				wp_list_comments( array(
					'style'      => 'ul',
					'short_ping' => true,
					'avatar_size'=> 100,
				) );
			?>
		</ul><!-- .comment-list -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
		<nav id="comment-nav-below" class="navigation comment-navigation" role="navigation">
			<h1 class="screen-reader-text"><?php _e( 'Comment navigation', 'geode' ); ?></h1>
			<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'geode' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'geode' ) ); ?></div>
		</nav><!-- #comment-nav-below -->
		<?php endif; // Check for comment navigation. ?>

		<?php if ( ! comments_open() ) : ?>
		<p class="no-comments"><?php _e( 'Comments are closed.', 'geode' ); ?></p>
		<?php endif; ?>

		<?php endif; // have_comments() ?>

		<?php comment_form(); ?>

	</div><!-- .row-inside -->

</div><!-- #comments -->
