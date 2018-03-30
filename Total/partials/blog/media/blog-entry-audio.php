<?php
/**
 * Blog entry audio format media
 *
 * @package Total WordPress theme
 * @subpackage Partials
 * @version 3.5.3
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Display media
if ( apply_filters( 'wpex_blog_entry_audio_embed', false )
	&& ! post_password_required()
	&& $audio = wpex_get_post_audio_html()
) : ?>

	<div class="blog-entry-media entry-media wpex-clr"><?php echo $audio; ?></div>

<?php
// Display media if thumbnail exists
elseif ( $thumbnail = wpex_get_blog_entry_thumbnail() ) :

	// Overlay style
	$overlay = wpex_get_mod( 'blog_entry_overlay' );
	$overlay = $overlay ? $overlay : 'none'; ?>

	<div class="blog-entry-media entry-media wpex-clr <?php echo wpex_overlay_classes( $overlay ); ?>">
		<a href="<?php wpex_permalink(); ?>" title="<?php wpex_esc_title(); ?>" rel="bookmark" class="blog-entry-img-link<?php wpex_entry_image_animation_classes(); ?>">
			<?php echo $thumbnail; ?>
			<?php if ( $overlay ) { ?>
				<?php wpex_overlay( 'inside_link', $overlay ); ?>
			<?php } else { ?>
				<div class="blog-entry-music-icon-overlay"><span class="fa fa-music"></span></div>
			<?php } ?>
		</a>
		<?php wpex_overlay( 'outside_link', $overlay ); ?>
	</div>

<?php endif; ?>