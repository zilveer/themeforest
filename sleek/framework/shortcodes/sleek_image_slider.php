<?php

/*------------------------------------------------------------
 * Shortcode: Image Slider
 *------------------------------------------------------------*/

/*
[image_slider slides="n,n,n" height="" effect="pulse" interval="4000" control="arrows"]

@slides [required]:
	ids of slides to slide, separated by coma
@height [optional]:
	n - maximum height of slider
@effect [optional]:
	fade
	pulse [default]
	slide_x
	slide_y
@interval [optional]:
	0 - off
	4000 - ms [default]
	n - automatic animation interval in milliseconds
@control:
	false - off
	arrows [default]
	pager
*/

if( !function_exists( 'sleek_image_slider' ) ){
function sleek_image_slider($atts, $content = null) {

	extract( shortcode_atts( array(
		 'slides' => ''
		,'height' => ''
		,'effect' => 'fade'
		,'interval' => '2000'
		,'control' => 'arrows'
	), $atts ) );

	$effect 	= $effect ? $effect : 'pulse';
	$interval 	= $interval ? $interval : '4000';
	$control 	= $control ? $control : 'false';



	$loop = sleek_image_slider_loop($slides);

	// slider classes
	$classes = '';

	if($effect){
		$classes .= ' effect-'.$effect;
	}

	// slider styles
	$styles_ul = '';
	if($height){
		$styles_ul .= 'max-height:'.$height.'px;';
	}

	// return shortcode wrapper, returned loop items, arrows and pagination
	$output = '';
	$output .= '<div class="sleek-slider sleek-slider--images js-sleek-slider '.$classes.'" data-shortcode="sleek_image_slider" data-interval="'.$interval.'" data-control="'.$control.'" >';

	$output .= '<ul class="sleek-slider__items js-sleek-slider-items" style="'.$styles_ul.'">';
		$output .= $loop['html'];
	$output .= '</ul>';



	/* Slider Arrows
	 *------------------------------------------------------------*/

	if( $control == 'arrows' && $loop['found_posts'] > 1 ){

		$output .= '<div class="sleek-ui sleek-ui--slider-arrows">';

			// Prev Arrow
			$output .= '<a href="#" class="sleek-ui__arrow sleek-ui__arrow--prev js-sleek-ui-arrow--prev js-skip-ajax" title="' . __('Previous', 'sleek') . '"><i class="icon-arrow-left"></i></a>';

			// Info pager [ 1/4 ]
			$output .= '<div class="sleek-ui__slider-info">';
				$output .= '<span class="js-info-current">1</span>';
				$output .= '/';
				$output .= '<span class="js-info-total">4</span>';
			$output .= '</div>';

			// Next Arrow
			$output .= '<a href="#" class="sleek-ui__arrow sleek-ui__arrow--next js-sleek-ui-arrow--next js-skip-ajax" title="' . __('Next', 'sleek') . '"><i class="icon-arrow-right"></i></a>';

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

			$output .= '<li><a href="#" class="js-sleek-slider-pager-item '.$active_class.'" data-id="slider-item-'.$i.'"></a></li>';
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

if( !function_exists( 'sleek_image_slider_loop' ) ){
function sleek_image_slider_loop($slides) {

	$query = new WP_Query(
		array(
			 'post_type' => 'attachment'
			,'post_status' => 'inherit'
			,'posts_per_page' => -1
			,'post__in' => explode(',', $slides)
			,'orderby' => 'post__in'
		)
	);

	$html = '';
	$i = 0;
	if ( $query->have_posts() ):
	while ( $query->have_posts() ) : $query->the_post();

		$classes = '';
		$id = get_the_ID();

		// active class for first item
		$classes .= $i == 0 ? ' active' : '';
		$img_post = get_post( get_post_thumbnail_id( $id ) );

		$html .= '<li class="sleek-slider__item js-sleek-slider-item '.$classes.'" data-id="slider-item-'.$i.'">';
		$html .= '<div class="sleek-slider__item-inwrap">';

			$thumbnail_src = wp_get_attachment_image_src( $img_post->ID, 'full' );

			$html .= '<img src="'.$thumbnail_src[0].'" width="'.$thumbnail_src[1].'" height="'.$thumbnail_src[2].'" alt="'.$img_post->post_excerpt.'"/>';

			if( $img_post->post_excerpt ){
				$html .= '<div class="caption">'.$img_post->post_excerpt.'</div>';
			}

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

add_shortcode('image_slider', 'sleek_image_slider');
