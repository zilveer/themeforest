<?php
/**
 * Plus Three Hover Overlay
 *
 * @package Total WordPress Theme
 * @subpackage Partials
 * @version 3.5.3
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Only used for inside position
if ( 'inside_link' != $position ) {
	return;
}

if ( has_post_thumbnail() && $img = get_post_meta( get_the_ID(), 'wpex_secondary_thumbnail', true ) )  {
	if ( is_numeric( $img ) ) {
		$img = wpex_get_post_thumbnail( array(
			'attachment' => $img,
			'width'      => isset( $args['img_width'] ) ? $args['img_width'] :'',
			'height'     => isset( $args['img_height'] ) ? $args['img_height'] :'',
			'crop'       => isset( $args['img_crop'] ) ? $args['img_crop'] :'',
			'alt'        => isset( $args['post_esc_title'] ) ?$args['post_esc_title'] :'',
			'size'       => isset( $args['img_size'] ) ?$args['img_size'] :'',
		) );
	} else {
		esc_url( $img );
	}
	if ( $img ) {
		echo '<div class="overlay-thumb-swap-secondary">'. $img .'</div>';
	}

}