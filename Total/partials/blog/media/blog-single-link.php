<?php
/**
 * Blog single post link format media
 * Link formats should redirect to the URL defined in the custom fields
 * This template file is used as a fallback only.
 *
 * @package Total WordPress theme
 * @subpackage Partials
 * @version 3.0.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Get thumbnail
$thumbnail = wpex_get_blog_post_thumbnail();

// Return if there isn't a thumbnail
if ( ! $thumbnail ) {
    return;
} ?>

<div id="post-media" class="clr">
	<?php
	// Image with lightbox link
	if ( wpex_get_mod( 'blog_post_image_lightbox' ) ) : ?>

		<a href="<?php wpex_permalink(); ?>" title="<?php wpex_esc_title(); ?>" class="wpex-lightbox<?php wpex_img_animation_classes(); ?>" data-type="iframe" data-options="width:1920,height:1080">
			<?php echo $thumbnail; ?>
		</a>

	<?php
	// No lightbox
	else : ?>

		<a href="<?php wpex_permalink(); ?>" title="<?php wpex_esc_title(); ?>" class="<?php wpex_img_animation_classes(); ?>"><?php echo $thumbnail; ?></a>

	<?php endif; ?>

	<?php
	// Blog entry caption
	if ( wpex_get_mod( 'blog_thumbnail_caption' ) && $caption = wpex_featured_image_caption() ) : ?>
		<div class="post-media-caption clr">
			<?php echo $caption; ?>
		</div><!-- .post-media-caption -->
	<?php endif; ?>

</div><!-- #post-media -->