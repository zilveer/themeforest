<?php
if ( ! function_exists( 'flow_paging_nav' ) ) :
/**
 * Displays navigation to next/previous set of posts when applicable.
 *
 * @return void
 */
function flow_paging_nav() {
	global $wp_query;

	// Don't print empty markup if there's only one page.
	if ( $wp_query->max_num_pages < 2 ) {
		return;
	}
	?>
	<nav class="navigation paging-navigation clearfix" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Posts navigation', 'flowthemes' ); ?></h1>
		<?php if ( get_next_posts_link() ) { ?>
			<div class="nav-previous"><?php next_posts_link( __( 'Older Entries', 'flowthemes' ) ); ?></div>
		<?php } ?>
		<?php if ( get_previous_posts_link() ) { ?>
			<div class="nav-next"><?php previous_posts_link( __( 'Newer Entries', 'flowthemes' ) ); ?></div>
		<?php } ?>
	</nav>
	<?php
}
endif;

if ( ! function_exists( 'flow_post_nav' ) ) :
/**
 * Displays navigation to next/previous post when applicable.
 *
 * @return void
 */
function flow_post_nav() {
	global $post;

	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( false, '', true );
	$next = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous ) {
		return;
	}
	?>
	<nav class="navigation post-navigation clearfix" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Post navigation', 'flowthemes' ); ?></h1>
		<div class="nav-links">
			<?php previous_post_link( '%link', __( 'Previous', 'flowthemes' ) ); ?>
			<?php next_post_link( '%link', __( 'Next', 'flowthemes' ) ); ?>
		</div>
	</nav>
	<?php
}
endif;
