<?php
/**
 * Custom Post Type Entry Readmore
 *
 * @package Total WordPress theme
 * @subpackage Partials
 * @version 3.5.3
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Readmore button classes
$button_args = apply_filters( 'wpex_'. get_post_type() .'_entry_button_args', array(
	'style' => '',
	'color' => '',
) );

// Readmore text
$text = apply_filters( 'wpex_'. get_post_type() .'_readmore_link_text', null );
$text = $text ? $text : esc_html__( 'Read more', 'total' ); ?>

<div class="cpt-entry-readmore-wrap entry-readmore-wrap wpex-clr">
	<a href="<?php wpex_permalink(); ?>" class="<?php echo wpex_get_button_classes( $button_args ); ?>" title="<?php wpex_esc_title(); ?>"><?php echo esc_html( $text ); ?></a>
</div>