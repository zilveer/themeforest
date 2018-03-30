<?php
/**
 * Blog entry layout
 *
 * @package Total WordPress theme
 * @subpackage Partials
 * @version 3.5.3
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Vars
$text = wpex_get_translated_theme_mod( 'blog_entry_readmore_text' );
$text = $text ? $text : esc_html__( 'Read More', 'total' );

// Apply filters for child theming
$text = apply_filters( 'wpex_post_readmore_link_text', $text );

// Button classes
$button_args = apply_filters( 'wpex_blog_entry_button_args', array(
	'style' => '',
	'color' => '',
) ); ?>

<div class="blog-entry-readmore clr">
	<a href="<?php the_permalink(); ?>" class="<?php echo wpex_get_button_classes( $button_args ); ?>" title="<?php echo $text ?>"><?php echo $text ?><span class="readmore-rarr hidden">&rarr;</span></a>
</div><!-- .blog-entry-readmore -->