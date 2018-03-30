<?php
/**
 * Portfolio entry content template part
 *
 * @package Total WordPress theme
 * @subpackage Partials
 * @version 3.3.2
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Get loop
$wpex_loop = isset( $wpex_loop ) ? $wpex_loop : 'archive';

// Get video and thumbnail
$video     = wpex_get_portfolio_post_video();
$thumbnail = wpex_get_portfolio_entry_thumbnail( $wpex_loop );

// Classes
$classes = array( 'portfolio-entry-media', 'clr' );
if ( $overlay = wpex_overlay_classes() ) {
	$classes[] = $overlay;
}
$classes = implode( ' ', $classes );

// Return if there isn't a video or a thumbnail
if ( ! $video && ! $thumbnail ) {
	return;
} ?>

<div class="<?php echo esc_attr( $classes ); ?>">

	<?php
	// If the portfolio post has a video display it
	if ( $video ) : ?>

		<?php echo $video; ?>

	<?php
	// Otherwise display thumbnail if one exists
	elseif ( $thumbnail ) : ?>
		<a href="<?php the_permalink(); ?>" title="<?php wpex_esc_title(); ?>" class="portfolio-entry-media-link">
			<?php echo $thumbnail; ?>
			<?php wpex_overlay( 'inside_link' ); ?>
		</a>
		<?php wpex_overlay( 'outside_link' ); ?>
	<?php endif; ?>

</div><!-- .portfolio-entry-media -->