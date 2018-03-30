<?php
/**
 * Gallery function (overwrite in images gallery shortcode)
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! function_exists( 'wolf_custom_gallery' ) ) {
	/**
	 * Custom Wordpress gallery shortcode output
	 * Renders WP gallery differently depending on context (masonry gallery, slider, default)
	 */
	add_filter( 'use_default_gallery_style', '__return_false' );
	add_filter( 'post_gallery', 'wolf_custom_gallery', 10, 2 );
	function wolf_custom_gallery( $output, $attr ) {
		global $post, $wp_locale;

		static $instance = 0;
		$instance++;

		// We're trusting author input, so let's at least make sure it looks like a valid orderby statement
		if ( isset( $attr['orderby'] ) ) {
			$attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
			if ( ! $attr['orderby'] )
				unset( $attr['orderby'] );
		}

		extract( shortcode_atts( array(
			'order'      => 'ASC',
			'orderby'    => 'menu_order ID',
			'id'         => $post->ID,
			'itemtag'    => 'dl',
			'icontag'    => 'dt',
			'captiontag' => 'dd',
			'columns'    => 3,
			'size'       => 'thumbnail',
			'include'    => '',
			'exclude'    => ''
			), $attr ) );

		$id = intval( $id );
		if ( 'RAND' == $order )
			$orderby = 'none';

		if ( ! empty( $include ) ) {
			$include = preg_replace( '/[^0-9,]+/', '', $include );
			$_attachments = get_posts( array( 'include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby ) );

			$attachments = array();
			foreach ( $_attachments as $key => $val ) {
				$attachments[ $val->ID ] = $_attachments[ $key ];
			}
		} elseif ( ! empty( $exclude ) ) {
			$exclude = preg_replace( '/[^0-9,]+/', '', $exclude );
			$attachments = get_children( array( 'post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby ) );
		} else {
			$attachments = get_children( array( 'post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby ) );
		}

		if ( empty( $attachments ) )
			return '';

		if ( is_feed() ) {
			$output = "\n";
			foreach ( $attachments as $att_id => $attachment )
				$output .= wp_get_attachment_link($att_id, $size, true) . "\n";
			return $output;
		}

		$itemtag = tag_escape($itemtag);
		$captiontag = tag_escape($captiontag);
		$columns = intval($columns);
		$itemwidth = $columns > 0 ? floor(100/$columns) : 100;
		$float = is_rtl() ? 'right' : 'left';

		$selector = "gallery-{$instance}";

		$output = apply_filters( 'gallery_style', "
			<style type='text/css'>
				#{$selector} {
					margin: auto;
				}
				#{$selector} .gallery-item {
					float: {$float};
					margin-top: 10px;
					text-align: center;
					width: {$itemwidth}%;
				}
				#{$selector} img {
					border: 2px solid #cfcfcf;
				}
				#{$selector} .gallery-caption {
					margin-left: 0;
				}
			</style>
			<!-- see gallery_shortcode() in wp-includes/media.php -->
			<div id='$selector' class='gallery galleryid-{$id}'>"
		);

		$i = 0;
		foreach ( $attachments as $id => $attachment ) {
			
			$link = isset( $attr['link'] ) && 'file' == $attr['link'] ? wp_get_attachment_link( $id, $size, false, false ) : wp_get_attachment_link( $id, $size, true, false );

			$output .= "<{$itemtag} class='gallery-item'>";
			$output .= "
			<{$icontag} class='gallery-icon'>
			$link
			</{$icontag}>";
			if ( $captiontag && trim($attachment->post_excerpt) ) {
				$output .= "
				<{$captiontag} class='gallery-caption'>
				" . wptexturize( $attachment->post_excerpt ) . "
				</{$captiontag}>";
			}
			$output .= "</{$itemtag}>";
			if ( $columns > 0 && ++$i % $columns == 0 )
				$output .= '<br style="clear: both" />';
		}

		$output .= "
		<br style='clear: both;' />
		</div>\n";

		/* Slider output */
		$slider_output = '<div class="wolf-wp-gallery-slider flexslider"><ul class="slides">';
		foreach ( $attachments as $id => $attachment ) {
			$src = wolf_get_url_from_attachment_id( $id, '2x1' );
			$slider_output .= '';
			$slider_output .= '<li class="slide">';
			$slider_output .= "<img src='$src' alt=''>";
			$slider_output .= '</li>';
		}
		$slider_output .= '</ul></div>';

		/* Masonry gallery output */ 
		$masonry_output = '<div class="clearfix gallery masonry-gallery"><ul>';
		foreach ( $attachments as $id => $attachment ) {
			$src = wolf_get_url_from_attachment_id( $id, 'masonry' );
			$full_src = wolf_get_url_from_attachment_id( $id, 'extra-large' );
			$masonry_output .= '<li>';
			$masonry_output .= "<a class='lightbox' href='$full_src'>";
			$masonry_output .= "<img src='$src' alt='gallery-image'>";
			$masonry_output .= '</a>';
			$masonry_output .= '</li>';
		}
		$masonry_output .= '</ul></div>';

		if ( wolf_is_blog() || wolf_is_portfolio() ) {
			return $slider_output;
		
		} elseif( is_singular( 'gallery' ) ) {

			return $masonry_output;

		} else {
			return $output;
		}
	}
}