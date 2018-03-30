<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! function_exists( 'wolf_shortcode_images_gallery' ) ) {
	/**
	 * Gallery shortcode
	 *
	 * Will overwrite the default gallery shortcode
	 *
	 * @param array $atts
	 * @param string $content
	 * @return string
	 */
	function wolf_shortcode_images_gallery( $atts, $content = null ) {

		if ( class_exists( 'Vc_Manager' ) && function_exists( 'vc_map_get_attributes' ) ) {
			$atts = vc_map_get_attributes( 'wolf_images_gallery', $atts );
		}

		extract( shortcode_atts( array(
			'ids' => '',
			'layout' => 'simple',
			'columns' => '3',
			'size' => 'classic-thumb',
			'link' => 'attachment',
			'padding' => 'no',
			'hover_effect' => 'default',
			'orderby' => '',
			'inline_style' => '',
			'class' => '',
		), $atts ) );

		$images = explode( ',', $ids );
		$size = ( 'thumbnail' == $size ) ? 'classic-thumb' : $size;
		$size = wolf_get_image_size( $size );

		if ( wolf_is_blog() || wolf_is_portfolio() ) {

			$output = wolf_flexslider_gallery( $images, $orderby );

		} else {
			if ( 'carousel_mosaic' == $layout || 'mosaic' == $layout ) {
				$carousel = ( $layout == 'carousel_mosaic' ) ? true : false;
				$output = wolf_mosaic_gallery( $images, $link, $hover_effect, $orderby, $carousel, $inline_style, $class );

			} elseif ( 'carousel_simple' == $layout ) {
				$output = wolf_simple_carousel_gallery( $images, $link, $size, $padding, $hover_effect, $orderby, $inline_style, $class );

			} elseif ( 'simple' == $layout ) {
				$output = wolf_simple_gallery( $images, $link, $size, $padding, $columns, $hover_effect, $orderby, $inline_style, $class );

			} elseif ( 'masonry' == $layout  ) {
				$output = wolf_albums_gallery( $images, $orderby, $inline_style, $class );
			}
		}

		return $output;
	}
	remove_shortcode( 'gallery' );
	add_shortcode( 'gallery', 'wolf_shortcode_images_gallery' );
	// add_filter( 'post_gallery', 'wolf_shortcode_images_gallery', 10, 3 );
	add_shortcode( 'wolf_images_gallery', 'wolf_shortcode_images_gallery' );
}

if ( ! function_exists( 'wolf_albums_gallery' ) ) {
	/**
	 * Display the single gallery post type
	 *
	 * @access public
	 * @param array $images
	 * @param string $orderby
	 * @return string $output
	 */
	function wolf_albums_gallery( $images = array(), $orderby, $inline_style = '', $class = '' ) {
		$post_id = get_the_ID();
		$permalink = get_permalink();
		$selector = "gallery-$post_id";

		$style = '';
		$class = ( $class ) ? "$class " : ''; // add space
		$class .= "masonry-gallery clearfix hover-scale-to-greyscale";

		$layout = get_post_meta( $post_id, '_layout', true ) ? get_post_meta( $post_id, '_layout', true ) : 'masonry';
		if ( 'rand' == $orderby ) {
			shuffle( $images );
		}

		if ( $inline_style ) {
			$style .= $inline_style;
		}

		$style = ( $style ) ? " style='$style'" : '';

		$output = "<div class='$class' id='$selector'$style><ul>";
		foreach ( $images as $image_id ) {
			$attachment = get_post( $image_id );
			$image_url = esc_url( wolf_get_url_from_attachment_id( $image_id, 'masonry' ) );
			$full_size_image_url = esc_url( wolf_get_url_from_attachment_id( $image_id, 'extra-large' ) );

			$title = wptexturize( $attachment->post_title );
			$post_excerpt = wolf_sample( wptexturize( $attachment->post_excerpt ), 88 );
			$title_attr = ( $post_excerpt ) ? $post_excerpt : '';

			$output .= "<li>
				<a href='$full_size_image_url' class='lightbox'>
				<img src='$image_url' class='image-item' alt='$title'></a>";

			$output .= '</li>';
		}
		$output .= '</ul></div>';

		return $output;
	}
}

if ( ! function_exists( 'wolf_flexslider_gallery' ) ) {
	/**
	 * Display a slider with the image frome the gallery shortcode
	 *
	 * @access public
	 * @param array $images
	 * @param string $orderby
	 * @return string $output
	 */
	function wolf_flexslider_gallery( $images = array(), $orderby, $inline_style = '', $class = '' ) {

		if ( 'rand' == $orderby ) {
			shuffle( $images );
		}

		$post_id = get_the_ID();
		$permalink = get_permalink();
		$selector = "gallery-$post_id";

		$style = '';
		$class = ( $class ) ? "$class " : ''; // add space
		$class .= "post-gallery-slider flexslider clearfix";

		if ( $inline_style ) {
			$style .= $inline_style;
		}

		$style = ( $style ) ? " style='$style'" : '';

		$output = "<div class='$class' id='$selector'$style><ul class='slides'>";
		$size = 'slide';

		if (	'masonry' == wolf_get_theme_option( 'blog_type' ) && wolf_is_blog()
			|| 'masonry' == wolf_get_theme_option( 'work_type' ) && wolf_is_portfolio() ) {
			$size = 'classic-thumb';
		}

		foreach ( $images as $image_id ) {
			$attachment = get_post( $image_id );
			$image_url = esc_url( wolf_get_url_from_attachment_id( $image_id, $size ) );
			$title = wptexturize( $attachment->post_title );
			$alt = esc_attr( get_post_meta( $attachment->ID, '_wp_attachment_image_alt', true ) );
			$alt = ( $alt ) ? $alt : $title;
			$post_excerpt = wolf_sample( wptexturize( $attachment->post_excerpt ), 88 );
			$title_attr = ( $post_excerpt ) ? $post_excerpt : '';

			$output .= "<li class='slide'>
				<img src='$image_url' alt='$alt'>";

				if ( $post_excerpt )
					$output .= "<p class='flex-caption'>$post_excerpt</p>";

			$output .= '</li>';
		}

		$output .= '</ul></div>';

		return $output;
	}
}

if ( ! function_exists( 'wolf_simple_gallery' ) ) {
	/**
	 * Generate a simple gallery
	 *
	 * @access public
	 * @param array $images
	 * @param string $link
	 * @param string $size
	 * @param string $padding
	 * @param int $columns
	 * @param string $hover_effect
	 * @param string $orderby
	 * @return string $output
	 */
	function wolf_simple_gallery( $images = array(), $link = 'file', $size = 'classic-thumb', $padding = 'no', $columns = 3, $hover_effect = 'default', $orderby = '', $inline_style = '', $class = '' ) {

		if ( 'rand' == $orderby ) {
			shuffle( $images );
		}

		$rand_id = rand( 0,999 );
		$selector = "gallery-$rand_id";

		$style = '';
		$class = ( $class ) ? "$class " : ''; // add space
		$class .= "wolf-images-gallery clearfix simple-gallery hover-$hover_effect";

		if ( $inline_style ) {
			$style .= $inline_style;
		}

		$style = ( $style ) ? " style='$style'" : '';

		if ( 'yes' == $padding )
			$class .= " padding";

		$columns = absint( $columns );
		$itemwidth = $columns > 0 ? round( 100 / $columns, 2,  PHP_ROUND_HALF_DOWN ) - 0.01 : 100;
		$float = is_rtl() ? 'right' : 'left';

		$css = "<style type='text/css'>
			#{$selector} .block {
				float: {$float};
				width: {$itemwidth}%;";

		if ( 1 == $columns ) {
			$css .= 'padding-bottom:10px!important;';
		}

		$css .= '}</style>';

		$output = wolf_compact_css( $css );

		if ( 1 == $columns ) {
			$size = 'extra-large';
		}
		$output .= "<div class='$class' id='$selector'$style>";

		foreach ( $images as $image_id ) {

			$attachment = get_post( $image_id );
			$image_url = esc_url( wolf_get_url_from_attachment_id( $image_id, $size ) );

			$file = esc_url( wolf_get_url_from_attachment_id( $image_id, 'extra-large' ) );
			$image_page = get_attachment_link( $image_id );
			$href = ( 'post' == $link || 'attachment' == $link ) ? $image_page : $file;
			$class = ( 'file' == $link ) ? 'lightbox image-item' : 'image-item';

			$title = wptexturize( $attachment->post_title );
			$post_excerpt = wolf_sample( wptexturize( $attachment->post_excerpt ), 88 );
			$title_attr = ( $post_excerpt ) ? $post_excerpt : '';

			$output .= "<div class='block'>";

			if ( 'none' != $link )
				$output .= "<a title='$title_attr' href='$href' class='$class' rel='$selector'>";
			else
				$output .= "<span class='$class'>";

			$output .= "<img src='$image_url' alt='$title'>";

			if ( 'none' != $link )
				$output .= '</a>';
			else
				$output .= '</span>';

			$output .= '</div>';
		}

		$output .= '</div>';

		if ( array() != $images )
			return $output;
	}
}

if ( ! function_exists( 'wolf_simple_carousel_gallery' ) ) {
	/**
	 * Generate a simple carouel layout gallery
	 *
	 * @access public
	 * @param array $images
	 * @param string $link
	 * @param string $size
	 * @param string $padding
	 * @param int $columns
	 * @param string $hover_effect
	 * @param string $orderby
	 * @return string $output
	 */
	function wolf_simple_carousel_gallery( $images = array(), $link = 'file', $size = 'classic-thumb', $padding = 'no', $hover_effect = 'default', $orderby = '', $inline_style = '', $class = '' ) {

		if ( 'rand' == $orderby ) {
			shuffle( $images );
		}

		$rand_id = rand( 0,999 );
		$selector = "gallery-$rand_id";

		$style = '';
		$class = ( $class ) ? "$class " : ''; // add space
		$class .= "wolf-images-gallery clearfix carousel-simple-gallery owl-carousel hover-$hover_effect";

		if ( 'yes' == $padding )
			$class .= " padding";

		if ( $inline_style ) {
			$style .= $inline_style;
		}

		$style = ( $style ) ? " style='$style'" : '';

		$output = "<div class='$class' id='$selector'$style>";

		foreach ( $images as $image_id ) {

			$attachment = get_post( $image_id );
			$image_url = esc_url( wolf_get_url_from_attachment_id( $image_id, $size ) );

			$file = esc_url( wolf_get_url_from_attachment_id( $image_id, 'extra-large' ) );
			$image_page = get_attachment_link( $image_id );
			$href = ( 'post' == $link || 'attachment' == $link ) ? $image_page : $file;
			$class = ( 'file' == $link ) ? 'lightbox image-item' : 'image-item';

			$title = wptexturize( $attachment->post_title );
			$post_excerpt = wolf_sample( wptexturize( $attachment->post_excerpt ), 88 );
			$title_attr = ( $post_excerpt ) ? $post_excerpt : '';

			$output .= "<div class='block'>";

			if ( 'none' != $link )
				$output .= "<a title='$title_attr' href='$href' class='$class' rel='$selector'>";
			else
				$output .= "<span class='$class'>";

			$output .= "<img src='$image_url' alt='$title'>";

			if ( 'none' != $link )
				$output .= '</a>';
			else
				$output .= '</span>';

			$output .= '</div>';
		}

		// $output .= '</ul>';

		$output .= '</div>';

		if ( array() != $images )
			return $output;
	}
}

if ( ! function_exists( 'wolf_mosaic_gallery' ) ) {
	/**
	 * Generate a mosaic carouel layout gallery
	 *
	 * @access public
	 * @param array $images
	 * @param string $link
	 * @param string $hover_effect
	 * @param string $orderby
	 * @param bool $carousel
	 * @return string $output
	 */
	function wolf_mosaic_gallery( $images = array(), $link = 'file', $hover_effect = 'default', $orderby = '', $carousel = true, $inline_style = '', $class = '' ) {

		if ( 'rand' == $orderby ) {
			shuffle( $images );
		}

		$rand_id = rand( 0,999 );
		$selector = "gallery-$rand_id";

		$style = '';
		$class = ( $class ) ? "$class " : ''; // add space
		$class .= "wolf-images-gallery clearfix hover-$hover_effect";

		if ( $carousel ) {
			$class .= " carousel-mosaic-gallery owl-carousel";
		} else {
			$class .= " mosaic-gallery";
		}

		if ( $inline_style ) {
			$style .= $inline_style;
		}

		$style = ( $style ) ? " style='$style'" : '';


		$output = "<div class='$class' id='$selector'$style>";

		$i = 0;

		foreach ( $images as $image_id ) {
			if ( $i%6 == 0) {
				if ( $i == 0 ) {
					$output .= "\n";
					$output .= '<div class="slide block">';
					$output .= "\n";
				} elseif ( $i != count( $images ) ) {
					$output .= '</div><!--.block-->';
					$output .= "\n";
					$output .= '<div class="slide block">';
					$output .= "\n";
				} else {
					$output .= '</div><!--.block-->';
					$output .= "\n";
				}
			}

			/* Images sizes */
			if ( $i%6 == 1) {
				$size = '2x1';

			} elseif ($i%6 == 3 ) {
				$size = '1x2';

			} elseif( $i%6 == 5 ) {
				$size = '2x1';

			} else {
				$size = '2x2';
			}

			$i++;

			$attachment = get_post( $image_id );

			if ( $attachment ) {

				$image_url = esc_url( wolf_get_url_from_attachment_id( $image_id, $size ) );

				$file = esc_url( wolf_get_url_from_attachment_id( $image_id, 'extra-large' ) );
				$image_page = get_attachment_link( $image_id );
				$href = ( 'post' == $link || 'attachment' == $link ) ? $image_page : $file;
				$class = ( 'file' == $link ) ? 'lightbox image-item' : 'image-item';

				$title = wptexturize( $attachment->post_title );
				$post_excerpt = esc_attr( wolf_sample( wptexturize( $attachment->post_excerpt ), 88 ) );
				$title_attr = ( $post_excerpt ) ? " title='$post_excerpt'" : '';

				if ( 'none' != $link ) {
					$output .= "<a$title_attr href='$href' class='$class' rel='$selector'>";
					$output .= "\n";
				} else {
					$output .= "<span class='$class'>";
					$output .= "\n";
				}

				$output .= "<img src='$image_url' alt='$title'>";
				$output .= "\n";

				if ( 'none' != $link ) {
					$output .= '</a>';
					$output .= "\n";
				} else {
					$output .= '</span>';
					$output .= "\n";
				}
			}

		} // end for each

		$output .= '</div><!--.block-->';
		$output .= "\n";
		$output .= '</div><!--.wolf-images-gallery-->';

		if ( array() != $images )
			return $output;
	}
}