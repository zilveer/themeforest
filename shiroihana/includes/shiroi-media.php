<?php if ( ! defined( 'ABSPATH' ) ) {
	die( 'Cheatin&#8217; uh?' );
}

/* ==========================================================================
	Fotorama
============================================================================= */

if( ! function_exists( 'shiroi_fotorama_defaults' ) ):

function shiroi_fotorama_defaults() {
	return apply_filters( 'shiroi_fotorama_defaults', array(
		'width'               => null, 
		'height'              => null, 
		'ratio'               => null, 
		'margin'              => 2, 
		'fit'                 => 'contain', 
		'nav'                 => 'dots', 
		'navposition'         => 'bottom', 
		'thumbwidth'          => 64, 
		'thumbheight'         => 64, 
		'thumbfit'            => 'cover', 
		'allowfullscreen'     => false, 
		'transition'          => 'slide', 
		'transitionduration'  => 300, 
		'loop'                => false, 
		'autoplay'            => false, 
		'stopautoplayontouch' => true, 
		'keyboard'            => false, 
		'arrows'              => true, 
		'click'               => true, 
		'swipe'               => true, 
		'trackpad'            => false, 
		'shuffle'             => false, 
		'shadows'             => true
	));
}
endif;

if( ! function_exists( 'shiroi_fotorama' ) ):

function shiroi_fotorama( $attachments, $args = array(), $echo = true ) {

	/* Make sure we have attachments */
	if( ! is_array( $attachments ) || empty( $attachments ) ) {
		return '';
	}

	/* Microdata */
	$microdata = isset( $args['microdata'] ) && $args['microdata'];

	/* Captions */
	$show_caption = isset( $args['show_caption'] ) && $args['show_caption'];

	/* Attachment size */
	$attachment_size = 'full';
	if( isset( $args['attachment_size'] ) ) {
		if( preg_match( '/^(full|shiroi_(fullwidth|medium))$/', $args['attachment_size'] ) ) {
			$attachment_size = $args['attachment_size'];
		}
		unset( $args['attachment_size'] );
	}

	/* RTL Layouts */
	if( is_rtl() ) {
		$args['direction'] = 'rtl';
	}

	/* Parse default options */
	$defaults = shiroi_fotorama_defaults();
	$args = array_intersect_key( $args, $defaults );
	$args = wp_parse_args( $args, $defaults );

	/* Start fotorama markup */
	$output = '<div class="fotorama"';

	/* Fotorama options */
	foreach( $args as $key => $arg ) {
		if( $arg != $defaults[ $key ] ) {
			$output .= ' data-' . $key . '="' . esc_attr( $arg ) . '"';
		}
	}

	if( $microdata ):
		$output .= ' itemscope itemtype="http://schema.org/ImageGallery"';
	endif;

	$output .= '>';

	/* Fotorama images */
	foreach( $attachments as $attachment_id ):

		if( $attachment_src = wp_get_attachment_image_src( $attachment_id, $attachment_size ) ):

			$attachment_meta = wp_get_attachment_metadata( $attachment_id, true );

			$output .= '<a href="' . esc_url( $attachment_src[0] ) . '"';

			if( $show_caption ) {
				$attachment = get_post( $attachment_id );
				$post_excerpt = trim( $attachment->post_excerpt );
				if( ! empty( $post_excerpt ) ) {
					$output .= ' data-caption="' . esc_attr( $post_excerpt ) . '"';;
				}
			}

			$output .= ' itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">';

				/* Microdata */
				if( isset( $attachment_meta['width'], $attachment_meta['height'] ) ):
					$output .= '<meta itemprop="width" content="' . esc_attr( $attachment_meta['width'] ) . '">';
					$output .= '<meta itemprop="height" content="' . esc_attr( $attachment_meta['height'] ) . '">';
				endif;
				$output .= '<meta itemprop="uploadDate" content="' . esc_attr( get_the_date( 'c' ), $attachment_id ) . '">';
				$output .= '<meta itemprop="contentUrl" content="' . esc_attr( wp_get_attachment_url( $attachment_id ) ) . '">';

				$output .= wp_get_attachment_image( $attachment_id, 'shiroi_thumbnail', false, array( 'itemprop' => 'thumbnail' ) ); 

			$output .= '</a>';

		endif;

	endforeach;

	$output .= '</div>';

	if( $echo ) {
		echo $output;
	}

	return $output;
}
endif;

/* ==========================================================================
	Justified Grid
============================================================================= */

if( ! function_exists( 'shiroi_justified_grid' ) ):

function shiroi_justified_grid( $attachments, $args, $echo = true ) {

	$args = wp_parse_args( $args, array(
		'margin'    => 4, 
		'minwidth'  => 160, 
		'minheight' => 160
	));

	$output = '<div class="justified-grids "';

		$output .= ' data-justified-margin="' . esc_attr( $args['margin'] ) . '"';
		$output .= ' data-justified-min-width="' . esc_attr( $args['minwidth'] ) . '"';
		$output .= ' data-justified-min-height="' . esc_attr( $args['minheight'] ) . '"';

	$output .= '>';

	foreach( $attachments as $attachment_id ):

		if( ! wp_attachment_is( 'image', $attachment_id ) ) {
			continue;
		}

		/* Get attachment metadata */
		$attachment_meta = wp_get_attachment_metadata( $attachment_id );

		/* Construct grid */
		$output .= '<figure class="media-grid" itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">';

			/* Microdata */
			if( isset( $attachment_meta['width'], $attachment_meta['height'] ) ):
				$output .= '<meta itemprop="width" content="' . esc_attr( $attachment_meta['width'] ) . '">';
				$output .= '<meta itemprop="height" content="' . esc_attr( $attachment_meta['height'] ) . '">';
			endif;
			$output .= '<meta itemprop="uploadDate" content="' . esc_attr( get_the_date( 'c', $attachment_id ) ) . '">';

			/* Link + Image */
			$output .= '<a href="' . esc_url( wp_get_attachment_url( $attachment_id ) ) . '" class="media-grid-link" itemprop="contentUrl">';
				$output .= wp_get_attachment_image( $attachment_id, shiroi_thumbnail_size(), false, array( 'itemprop' => 'thumbnail' ) );
			$output .= '</a>';

			/* Caption */
			$attachment = get_post( $attachment_id );
			$post_excerpt = trim( $attachment->post_excerpt );
			if( ! empty( $post_excerpt ) ) {
				$output .= '<figcaption class="gallery-caption media-grid-caption" itemprop="caption">' . esc_html( $post_excerpt ) . '</figcaption>';
			}

		$output .= '</figure>';

	endforeach;

	$output .= '</div>';

	if( $echo ) {
		echo $output;
	}

	return $output;
}
endif;

/* ==========================================================================
	Mapbox Access Token
============================================================================= */

if( ! function_exists( 'shiroi_mapbox_access_token' ) ):

function shiroi_mapbox_access_token() {
	return 'pk.eyJ1IjoibWFpbWFpcmVsIiwiYSI6ImNpbzlxZXQzMjAzMmR3M2tqcDE3cTczcGMifQ.3O0JjyrwD2NxYe9PDCqUZQ';
}
endif;
