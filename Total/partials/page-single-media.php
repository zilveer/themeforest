<?php
/**
 * Page Media
 *
 * @package Total WordPress theme
 * @subpackage Partials
 * @version 3.5.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Check for video
if ( $video = wpex_get_post_video() ) : ?>

	<div id="post-media" class="wpex-clr"><?php wpex_post_video_html(); ?></div>

<?php
// Audio
elseif ( $audio = wpex_get_post_audio() ) : ?>

	<div id="post-media" class="wpex-clr"><?php wpex_post_audio_html(); ?></div>

<?php
// Thumbnail
else :

	// Thumbnail args
	$args = apply_filters( 'wpex_page_single_thumbnail_args', array(
		'size'          => 'full',
		'alt'           => wpex_get_esc_title(),
		'schema_markup' => true
	) );

	// Get thumbnail
	$thumbnail = wpex_get_post_thumbnail( $args );

	// Display featured image
	if ( $thumbnail ) : ?>

		<div id="page-featured-img" class="wpex-clr"><?php echo $thumbnail; ?></div>

	<?php endif; ?>

<?php endif; ?>