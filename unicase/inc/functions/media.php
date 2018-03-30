<?php
/**
 * unicase media functions
 *
 * @package unicase
 */

if( ! function_exists( 'unicase_get_image_sizes' ) ) {
	/**
	 * List available image sizes with width and height following
	 * @since 1.0.0
	 * @return mixed
	 */
	function unicase_get_image_sizes( $size = '' ) {

		global $_wp_additional_image_sizes;

		$sizes 							= array();
        $get_intermediate_image_sizes 	= get_intermediate_image_sizes();

        // Create the full array with sizes and crop info
        foreach( $get_intermediate_image_sizes as $_size ) {

            if ( in_array( $_size, array( 'thumbnail', 'medium', 'large' ) ) ) {

                $sizes[ $_size ]['width'] 	= get_option( $_size . '_size_w' );
                $sizes[ $_size ]['height'] 	= get_option( $_size . '_size_h' );
                $sizes[ $_size ]['crop'] 	= (bool) get_option( $_size . '_crop' );

            } elseif ( isset( $_wp_additional_image_sizes[ $_size ] ) ) {

                $sizes[ $_size ] = array(
                    'width' 	=> $_wp_additional_image_sizes[ $_size ]['width'],
                    'height' 	=> $_wp_additional_image_sizes[ $_size ]['height'],
                    'crop' 		=>  $_wp_additional_image_sizes[ $_size ]['crop']
                );
            }
        }

        // Get only 1 size if found
        if ( $size ) {

            if( isset( $sizes[ $size ] ) ) {
                return $sizes[ $size ];
            } else {
                return false;
            }

        }

        return $sizes;
	}
}

if( ! function_exists( 'unicase_get_thumbnail' ) ) {
	/**
	 * Gets Thumbnail of a post or custom post
	 *
	 * @since 1.0.0
	 * @return string
	 */
	function unicase_get_thumbnail( $id, $image_size, $placeholder = TRUE, $should_link = TRUE, $placeholder_icon = 'fa fa-headphones' ) {
		$post_thumbnail = '';

		if( has_post_thumbnail( $id ) ) {

			$post_thumbnail = get_the_post_thumbnail( $id, $image_size );

		} elseif( $placeholder && function_exists( 'unicase_get_img_placeholder' ) ) {

			$image_dimensions = unicase_get_image_sizes( $image_size );

			if( $image_dimensions && $image_dimensions['width'] > 0 ) {

				$atts = array(
					'width'		=> $image_dimensions['width'] . 'px',
					'height'	=> $image_dimensions['height'] . 'px',
				);
				$post_thumbnail = unicase_get_img_placeholder( $atts, $placeholder_icon );
			}
		}

		if( $should_link && ! empty( $post_thumbnail ) ) {
			$post_thumbnail = sprintf( '<a href="%s">%s</a>', esc_url( get_permalink() ), $post_thumbnail );
		}

		return $post_thumbnail;
	}
}

if( ! function_exists( 'unicase_get_img_placeholder' ) ) {
	/**
	 * Gets Image Placeholder HTML
	 *
	 * @since 1.0.0
	 * @return void
	 */
	function unicase_get_img_placeholder( $atts = array(), $icon = 'fa fa-camera') {
		$default_atts = apply_filters( 'unicase_img_placeholder_default_atts', array(
			'width'					=> '280px',
			'height'				=> '164px',
			'background-color'		=> '#DDD',
			'color'					=> '#FFF',
			'font-size'				=> '34px',
		) );

		if( isset( $atts ) ) {
			$atts = array_merge( $default_atts, $atts );
		} else {
			$atts = $default_atts;
		}

		$style_attr = '';
		foreach( $atts as $key => $att ) {
			if( $key != 'height' && $key != 'width' ) {
				$style_attr .= $key . ':' . $att . ';';
			}
		}

		if( ! empty( $style_attr ) ) {
			$style_attr = 'style="' . esc_attr( $style_attr ) . '"';
		}

		$width 		= absint( $atts[ 'width' ] );
		$height 	= absint( $atts[ 'height' ] );
		$bg_color	= str_replace( '#', '', $atts[ 'background-color' ] );

		$placeholder_url = 'http://placehold.it/' . $width . 'x' . $height . '/' . $bg_color . '/' . $bg_color . '/'; // color and bg color are same so that the text in placeholder is hidden and replaced with icon

		$img_tag = '<img src="' . esc_url( $placeholder_url ) . '" alt="">';

		return apply_filters( 'unicase_img_placeholder_html', '<div class="unicase-img-placeholder" ' . $style_attr . '>' . $img_tag . '<i class="' . esc_attr( $icon ) . '"></i></div>', $atts, $icon );
	}
}

if( ! function_exists( 'unicase_img_placeholder' ) ) {
	/**
	 * Displays the Image Placeholder
	 *
	 * @since 1.0.0
	 * @return void
	 */
	function unicase_img_placeholder( $atts = array(), $icon = 'fa fa-camera' ) {
		echo unicase_get_img_placeholder( $atts, $icon );
	}
}

if( ! function_exists( 'unicase_get_post_icon' ) ) {
	/**
	 * Display Post Icon based on post format
	 * @since 1.0.0
	 */
	function unicase_get_post_icon( $post_format = '' ) {

		$post_format = ( empty( $post_format ) ? get_post_format() : $post_format );
		$post_icon = 'fa fa-paragraph';

		switch( $post_format ) {
			case 'image':
				$post_icon = 'fa fa-image';
			break;
			case 'gallery':
				$post_icon = 'fa fa-th-large';
			break;
			case 'video':
				$post_icon = 'fa fa-film';
			break;
			case 'audio':
				$post_icon = 'fa fa-music';
			break;
			case 'quote':
				$post_icon = 'fa fa-quote-left';
			break;
			case 'link':
				$post_icon = 'fa fa-link';
			break;
			case 'status':
				$post_icon = 'fa fa-comment-o';
			break;
			case 'chat':
				$post_icon = 'fa fa-comments-o';
			break;
			case 'aside':
				$post_icon = 'fa fa-hand-o-left';
			break;
			default :
				$post_icon = 'fa fa-paragraph';
		}

		return apply_filters( 'unicase_post_icon', $post_icon, $post_format );
	}
}

add_image_size( 'unicase_blog-carousel-thumb', 370, 165, true );
add_image_size( 'unicase_blog-single-thumb', 879, 400, true );