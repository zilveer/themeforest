<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

/*-----------------------------------------------------------------------------------*/
/* Featured Slider: Hook Into Content */
/*-----------------------------------------------------------------------------------*/

if ( ! function_exists( 'woo_featured_slider_loader' ) ) :

	function woo_featured_slider_loader () {

		$settings = woo_get_dynamic_values( array( 'featured' => 'true' ) );

		if ( ( is_home() || is_front_page() ) && ( $settings['featured'] == 'true' ) ) {

	        dahz_get_template( 'sliders', 'featured-slider' );  

		}

		if(  is_page_template('template-home.php') ) {

			if (get_post_meta( get_the_ID(), '_revolutionslider', true ) == '0' && ( $settings['featured'] == 'true' ) ) { 
		
	        	dahz_get_template( 'sliders', 'featured-slider' );  

			} else { 

				if (get_post_meta( get_the_ID(), '_revolutionslider', true ) != '0') { 
			
					if(class_exists('RevSlider')){ putRevSlider(get_post_meta( get_the_ID(), '_revolutionslider', true )); } 
			
				} // end slidertype = revslider 

			}

		}

	} // End woo_featured_slider_loader()
endif;

add_action( 'woo_content_before', 'woo_featured_slider_loader' );

/*-----------------------------------------------------------------------------------*/
/* Featured Slider: Get Slides */
/*-----------------------------------------------------------------------------------*/

if ( ! function_exists( 'woo_featured_slider_get_slides' ) ):
	function woo_featured_slider_get_slides ( $args ) {

		$defaults = array( 'limit' => '5', 'order' => 'DESC', 'term' => '0' );
		$args = wp_parse_args( (array)$args, $defaults );
		$query_args = array( 'post_type' => 'slide' );

		if ( in_array( strtoupper( $args['order'] ), array( 'ASC', 'DESC' ) ) ) {
			$query_args['order'] = strtoupper( $args['order'] );
		}

		if ( 0 < intval( $args['limit'] ) ) {
			$query_args['numberposts'] = intval( $args['limit'] );
		}
		
		if ( 0 < intval( $args['term'] ) ) {
			$query_args['tax_query'] = array(
											array( 'taxonomy' => 'slide-page', 'field' => 'id', 'terms' => intval( $args['term']) )
										);
		}

		$slides = false;

		$query = get_posts( $query_args );

		if ( ! is_wp_error( $query ) && ( 0 < count( $query ) ) ) {
			$slides = $query;
		}

		return $slides;
	} // End woo_featured_slider_get_slides()
endif;


