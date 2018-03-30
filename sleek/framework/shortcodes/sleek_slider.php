<?php

/*------------------------------------------------------------
 * Shortcode: Slider
 *------------------------------------------------------------*/

/*
[slider slides="n,n,n" height="" padding="70" effect="pulse" interval="4000" control="arrows"]

@slides [required]:
	ids of slides to slide, separated by coma
@height [optional]:
	n - minimum height of slider
@padding:
	n - content padding
@effect [optional]:
	fade [default]
	pulse
	slide_x
	slide_y
@interval [optional]:
	0 - off [default]
	4000 - ms
	n - automatic animation interval in milliseconds
@control:
	false - off
	arrows [default]
	pager
*/

if( !function_exists( 'sleek_slider' ) ){
function sleek_slider($atts, $content = null) {

	extract( shortcode_atts( array(
		 'slides' 	=> ''
		,'height' 	=> ''
		,'padding' 	=> '70'
		,'effect' 	=> 'fade'
		,'interval' => ''
		,'control' 	=> 'arrows'
	), $atts ) );

	$padding 	= $padding ? $padding : '0';
	$effect 	= $effect ? $effect : 'fade';
	$control 	= $control ? $control : 'false';



	$loop = sleek_slider_loop($slides, $padding);

	// slider classes
	$classes = '';

	if($effect){
		$classes .= ' effect-'.$effect;
	}

	// return shortcode wrapper, returned loop items, arrows and pagination
	$output = '';
	$output .= '<div class="sleek-slider sleek-slider--element js-sleek-slider '.$classes.'" data-shortcode="sleek_slider" data-interval="'.$interval.'" data-control="'.$control.'" data-height="'.$height.'">';

	$output .= '<ul class="sleek-slider__items js-sleek-slider-items">';
		$output .= $loop['html'];
	$output .= '</ul>';



	/* Slider Arrows
	 *------------------------------------------------------------*/

	if( $control == 'arrows' && $loop['found_posts'] > 1 ){

		$output .= '<div class="sleek-ui sleek-ui--slider-arrows">';

			// Prev Arrow
			$output .= '<a href="#" class="sleek-ui__arrow sleek-ui__arrow--prev js-sleek-ui-arrow--prev js-skip-ajax" title="' . __('Previous', 'sleek') . '"><i class="icon-arrow-' . sleek_get_rtl('left') . '"></i></a>';

			// Info pager [ 1/4 ]
			$output .= '<div class="sleek-ui__slider-info">';
				$output .= '<span class="js-info-current">1</span>';
				$output .= '/';
				$output .= '<span class="js-info-total">4</span>';
			$output .= '</div>';

			// Next Arrow
			$output .= '<a href="#" class="sleek-ui__arrow sleek-ui__arrow--next js-sleek-ui-arrow--next js-skip-ajax" title="' . __('Next', 'sleek') . '"><i class="icon-arrow-'.sleek_get_rtl('right').'"></i></a>';

			// Loader
			// $output .= '<div class="sleek-ui__loader"></div>';

		$output .= '</div>';

	}



	/* Slider Pager
	 *------------------------------------------------------------*/

	if( $control == 'pager' && $loop['found_posts'] > 1 ){
		$output .= '<ul class="sleek-ui sleek-ui--slider-pager">';

		for ( $i = 0 ; $i < $loop['found_posts']; $i++ ){
			$active_class = $i === 0 ? 'active' : '';

			$output .= '<li><a href="#" class="js-sleek-slider-pager-item '.$active_class.'" title="'.__('Slider Item ', 'sleek').$i.'" data-id="slider-item-'.$i.'"></a></li>';
		}

		$output .= '</ul>';
	}



	$output .= '</div>'; // /.sleek-slider



	return $output;
}
}




/*------------------------------------------------------------
 * Loop: Slider
 *------------------------------------------------------------*/

if( !function_exists( 'sleek_slider_loop' ) ){
function sleek_slider_loop($slides, $padding) {

	$query = new WP_Query( array(
		'post_type' 		=> 'sleek-slider'
		,'posts_per_page' 	=> '-1'
		,'post__in' 		=> explode(',', $slides)
		,'orderby'			=> 'post__in'
	));

	$html = '';
	$i = 0;
	if ( $query->have_posts() ):
	while ( $query->have_posts() ) : $query->the_post();

		$classes 	= '';
		$id 		= get_the_ID();
		$media 		= '';

		// active class for first item
		$classes .= $i == 0 ? ' active' : '';
		$classes .= get_post_meta( get_the_ID(), 'slide_image_is_dark', true ) ? ' dark-mode' : '';



		$video_media = get_post_meta( $id, 'video_media', true );
		if( $video_media ){
			$media .= '<div class="sleek-slider__media sleek-slider__media-video">';
				$media .= do_shortcode('[video loop="on" autoplay="on"]'.$video_media.'[/video]');

				// add video overlay if turned on
				if( get_post_meta( $id, 'video_overlay_use', true ) ){
					$video_overlay = 'style="background:' . get_post_meta( $id, 'advanced_background', true ) . ';"';
				}else{
					$video_overlay = '';
				}

				$media .= '<div class="video-overlay" '.$video_overlay.'></div>';

			$media .= '</div>';

		}else{

			// Use Custom Background Field
			if( get_post_meta( get_the_ID(), 'slide_image', true ) ){
				$media .= '<div class="sleek-slider__media sleek-slider__media-image" style="background:' . get_post_meta( get_the_ID(), 'slide_image', true ) . '"></div>';
			}else{

				// Get Featured Image Media
				if( has_post_thumbnail($id) ){
					$thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( $id ), 'xl' );
					$media .= '<div class="sleek-slider__media sleek-slider__media-image" style="background-image:url('.$thumbnail_src[0].')"></div>';
				}else{

					// Empty Media
					$media .= '<div class="sleek-slider__media sleek-slider__media--empty"></div>';
				}
			}
		}

		$text = '';
		$text .= '<div class="sleek-slider__text" style="padding:' . $padding . 'px 0;">';
		$filtered_content = apply_filters( 'the_content', get_the_content($id) );
		$filtered_content = str_replace( ']]>', ']]&gt;', $filtered_content );
		$text .= do_shortcode( $filtered_content );
		$text .= '</div>';


		$html .= '<li class="sleek-slider__item js-sleek-slider-item '.$classes.'" data-id="slider-item-'.$i.'">';
		$html .= '<div class="sleek-slider__item-inwrap">';
		$html .= $media;
		$html .= $text;
		$html .= '</div>';
		$html .= '</li>';
		$i = $i + 1;

	endwhile;
	endif;
	wp_reset_postdata();

	// generate and return output
	$output = array();
	$output['found_posts'] = $query->found_posts;
	$output['html'] = $html;
	return $output;
}
}

add_shortcode('slider', 'sleek_slider');
