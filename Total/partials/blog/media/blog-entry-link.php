<?php
/**
 * Blog entry link format media
 *
 * @package Total WordPress theme
 * @subpackage Partials
 * @version 3.3.2
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Display media if thumbnail exists
if ( $thumbnail = wpex_get_blog_entry_thumbnail() ) : ?>
	<div class="blog-entry-media entry-media clr">
		<a href="<?php wpex_permalink(); ?>" title="<?php wpex_esc_title(); ?>" rel="bookmark" class="blog-entry-media-link<?php wpex_entry_image_animation_classes(); ?>">
			<?php echo $thumbnail; ?>
		</a>
	</div>
<?php endif; ?>