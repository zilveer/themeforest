<?php

/*------------------------------------------------------------
 * Shortcode: Blog
 * Currently returns loop-templates via output buffering.
 *------------------------------------------------------------*/

/*
[blog title="" title_above="" posts="8" style="list" category="" sort_by="date" sort_order="DESC" carousel_arrows="false" carousel_grid="3" interval="4000" slider_effect="slide_x" slider_control="arrows"]

@title:
	- Title
@title_above:
	- Title Above - label
@posts:
	- number
	- -1: unlimited / all
	- empty: [default] WP setting for posts per page
@style:
	-list [default]
	-masonry
	-newspaper
	-carousel
	-slider
	-slider_overlay
	-widget_list
	-widget_slider
@category:
	-category slug: show only chosen categories, separated by coma
	-empty: all categories selected
@sort_by:
	-date [default]
	-comment_count
	-[all worpdress order & orderby params supported]
@sort_order:
	-ASC
	-DESC [default]
@carousel_arrows:
	-true - use previous/next navigation instead of scrollbar
	-false [default]
@carousel_grid:
	-maximum visible items in single carousel row
	defaults to 3, max allowed 4
@interval:
	-n
@slider_effect:
	-animation slider_effect [slider setting]
@slider_control:
	-false - off
	-arrows [default]
	-pager
@extra_class:
	-extra class to add on loop-container

*/

if( !function_exists( 'sleek_blog' ) ){
function sleek_blog($atts, $content = null) {

	extract( shortcode_atts( array(
		 'title' 			=> ''
		,'title_above' 		=> ''
		,'posts' 			=> get_option('posts_per_page')
		,'style' 			=> 'list'
		,'category' 		=> ''
		,'sort_by' 			=> ''
		,'sort_order' 		=> ''
		,'carousel_arrows'	=> 'false'
		,'carousel_grid'	=> '3'
		,'interval' 		=> '0'
		,'slider_effect' 	=> 'slide_x'
		,'slider_control' 	=> 'arrows'
		,'extra_class' 		=> ''
	), $atts ) );

	$output = '';

	$posts = $posts ? $posts : get_option('posts_per_page');
	$style = $style ? $style : 'list';
	$carousel_grid 		= (int)$carousel_grid > 4 ? '4' : $carousel_grid;
	$carousel_arrows	= $carousel_arrows ? $carousel_arrows : 'false';
	$slider_control 	= $slider_control ? $slider_control : 'false';



	$query = new WP_Query( array(
		 'posts_per_page' 	=> $posts
		,'category_name' 	=> $category
		,'orderby' 			=> $sort_by
		,'order' 			=> $sort_order
	));
	// d($query);



	/*	Loop Classes
	 *------------------------------------------------------------*/

	$loop_classes = '';
	$loop_classes .= ' loop-container--style-'.$style;
	if( $style == 'masonry' || $style == 'newspaper' ){
		$loop_classes .= ' js-loop-is-masonry';
	}
	$loop_classes .= ' effect-'.$slider_effect;
	$loop_classes .= ' carousel-arrows-'.$carousel_arrows;
	$loop_classes .= ' '.$extra_class;

	if( $style == 'slider_overlay' ){
		$loop_classes .= ' loop-container--style-slider';
	}



	/*	Loop Data
	 *------------------------------------------------------------*/

	$loop_data = '';
	$loop_data .= ' data-interval="'.$interval.'"';
	$loop_data .= ' data-carousel-grid="'.$carousel_grid.'"';
	$loop_data .= ' data-carousel-arrows="'.$carousel_arrows.'"';
	$loop_data .= ' data-control="'.$slider_control.'"';

	if( $style == 'slider' || $style == 'slider_overlay' || $style == 'widget_slider' ){
		$loop_classes .= ' sleek-slider sleek-slider--blog-slide js-sleek-slider';
	}


	if( $style == 'carousel' ){
		$loop_classes .= ' sleek-carousel sleek-carousel--blog-carousel js-sleek-carousel sleek-carousel--grid-'.$carousel_grid;
	}





/*------------------------------------------------------------*
 *	Print it!
 *------------------------------------------------------------*/

	if( $query->have_posts() ):

		$output .= '<div class="sleek-blog sleek-blog--shortcode sleek-blog--style-'.$style.'" data-shortcode="sleek_blog">';

		if( $title ){
			$output .= '<h2 style="text-align:center;">';
			if( $title_above ){
				$output .= '<span class="above">'.$title_above.'</span>';
			}
			$output .= $title;
			$output .= '</h2>';
		}


		$output .= '<div class="loop-container '.$loop_classes.'" '.$loop_data.'>';



		/*	Slider / Carosuel: Item Wrapper Start
		 *------------------------------------------------------------*/

		if( $style == 'slider' || $style == 'slider_overlay' || $style == 'widget_slider' ){
			$output .= '<div class="sleek-slider__items js-sleek-slider-items">';
		}
		elseif( $style == 'carousel' ){
			$output .= '<div class="sleek-carousel__inwrap js-sleek-carousel-items">';
			$output .= '<div class="sleek-carousel__items js-sleek-carousel-items">';
		}



		/*	Query Posts
		 *------------------------------------------------------------*/


		while( $query->have_posts() ) : $query->the_post();

			ob_start();
			get_template_part('loop_item', $style);
			$output .= ob_get_clean();

		endwhile;



		/*	Carousel: Item Wrapper End
		 *------------------------------------------------------------*/

		if( $style == 'slider' || $style == 'slider_overlay' || $style == 'widget_slider' ){
			$output .= '</div>';
		}
		elseif( $style == 'carousel' ){
			$output .= '</div>';
			$output .= '</div>';
		}



		/* Carousel Arrows
		 *------------------------------------------------------------*/

		if( $style == 'carousel' && $carousel_arrows == 'true' ){
			$output .= '<div class="sleek-ui sleek-ui--arrows">';
			$output .= '<a href="#" class="sleek-ui__arrow sleek-ui__arrow--prev js-sleek-ui-arrow--prev js-skip-ajax" title="' . __('Previous', 'sleek') . '"><i class="icon-arrow-left"></i> Previous</a>';
			$output .= '<a href="#" class="sleek-ui__arrow sleek-ui__arrow--next js-sleek-ui-arrow--next js-skip-ajax" title="' . __('Next', 'sleek') . '">Next <i class="icon-arrow-right"></i></a>';
			$output .= '</div>';
		}



		/* Slider Arrows
		 *------------------------------------------------------------*/

		if(
			( $style == 'slider' || $style == 'slider_overlay' || $style == 'widget_slider' )
			&& $query->found_posts > 1
			&& $slider_control == 'arrows'
		){
			$output .= '<div class="sleek-ui sleek-ui--slider-arrows sleek-ui--blog-slider">';

				// Prev Arrow
				$output .= '<a href="#" class="sleek-ui__arrow sleek-ui__arrow--prev js-sleek-ui-arrow--prev js-skip-ajax" title="' . __('Previous', 'sleek') . '"><i class="icon-arrow-'.sleek_get_rtl('left').'"></i></a>';

				// Info pager [ 1/4 ]
				$output .= '<div class="sleek-ui__slider-info">';
					$output .= '<span class="js-info-current">1</span>';
					$output .= '/';
					$output .= '<span class="js-info-total">4</span>';
				$output .= '</div>';

				// Next Arrow
				$output .= '<a href="#" class="sleek-ui__arrow sleek-ui__arrow--next js-sleek-ui-arrow--next js-skip-ajax" title="' . __('Next', 'sleek') . '"><i class="icon-arrow-'.sleek_get_rtl('right').'"></i></a>';

				// Loader
				// $output .= $style == 'slider' ? '<div class="sleek-ui__loader"></div>' : '';

			$output .= '</div>';

		}



		/* Slider Pager
		 *------------------------------------------------------------*/

		if(
			( $style == 'slider' || $style == 'slider_overlay' || $style == 'widget_slider' )
			&& $query->found_posts > 1
			&& $slider_control == 'pager'
		){
			$output .= '<ul class="sleek-ui sleek-ui--slider-pager sleek-ui--blog-slider">';

			$i = 0;
			foreach( $query->posts as $post){
				if( has_post_thumbnail( $post->ID ) ){
					$active_class = $i === 0 ? 'active' : '';

					$output .= '<li><a href="#" title="'.__('Slider Item ', 'sleek'). $i.'" class="js-sleek-slider-pager-item '.$active_class.'" data-id="slider-item-'.$i.'"></a></li>';

					$i++;
				}
			}

			// Loader
			$output .= $style == 'slider' ? '<div class="sleek-ui__loader"></div>' : '';

			$output .= '</ul>';
		}



		$output .= '</div>'; // /.loop-container
		$output .= '</div>'; // /.sleek-blog

	endif;


	wp_reset_postdata();
	return $output;
}
}

add_shortcode('blog', 'sleek_blog');
