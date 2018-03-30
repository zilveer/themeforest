<?php
/**
 * Blog single post related entry
 *
 * @package Total WordPress theme
 * @subpackage Partials
 * @version 3.0.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Disable embeds
$show_embeds = apply_filters( 'wpex_related_blog_posts_embeds', false );

// Check if experts are enabled
$has_excerpt = wpex_get_mod( 'blog_related_excerpt', true );

// Get post format
$format = get_post_format();

// Get featured image
$thumbnail = wpex_get_post_thumbnail( array(
	'size' => 'blog_related',
) );

// Add classes
$classes	= array( 'related-post', 'clr', 'nr-col' );
$classes[]	= wpex_grid_class( $wpex_columns );
$classes[]	= 'col-'. $wpex_count; ?>

<article <?php post_class( $classes ); ?>>

	<?php
	// Display post video
	if ( $show_embeds && 'video' == $format && $video = wpex_get_post_video_html() ) : ?>

		<div class="related-post-video">
			<?php echo $video; ?>
		</div><!-- .related-post-video -->

	<?php
	// Display post audio
	elseif ( $show_embeds && 'audio' == $format && $audio = wpex_get_post_audio_html() ) : ?>

		<div class="related-post-video">
			<?php echo $audio; ?>
		</div><!-- .related-post-audio -->

	<?php
	// Display post thumbnail
	elseif ( $thumbnail ) :

		// Overlay style
		$overlay = wpex_get_mod( 'blog_related_overlay' ); ?>

		<figure class="related-post-figure clr <?php echo wpex_overlay_classes( $overlay ); ?>">

			<a href="<?php the_permalink(); ?>" title="<?php wpex_esc_title(); ?>" rel="bookmark" class="related-post-thumb<?php wpex_entry_image_animation_classes(); ?>">
				<?php echo $thumbnail; ?>
				<?php wpex_overlay( 'inside_link', $overlay ); ?>
			</a><!-- .related-post-thumb -->
			<?php wpex_overlay( 'outside_link', $overlay ); ?>
		</figure>

	<?php endif; ?>

	<?php
	// Display post excerpt
	if ( $has_excerpt ) : ?>

		<div class="related-post-content clr">
			<h4 class="related-post-title">
				<a href="<?php wpex_permalink(); ?>" title="<?php wpex_esc_title(); ?>" rel="bookmark"><?php the_title(); ?></a>
			</h4><!-- .related-post-title -->
			<div class="related-post-excerpt clr">
				<?php wpex_excerpt( array(
					'length' => wpex_get_mod( 'blog_related_excerpt_length', '15' ),
				) ); ?>
			</div><!-- related-post-excerpt -->
		</div><!-- .related-post-content -->

	<?php endif; ?>

</article><!-- .related-post -->