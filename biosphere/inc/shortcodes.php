<?php
/**
 * Shortcodes used in the theme.
 */

add_filter( 'the_content', 'dd_do_shorcode' );
function dd_do_shorcode( $content ){   
	
	$array = array (
		'<p>[' => '[', 
		']</p>' => ']', 
		']<br />' => ']'
	);
	$content = strtr( $content, $array );
	
	return do_shortcode( $content );

}

add_shortcode( 'slider', 'dd_slider_sc' );
function dd_slider_sc( $atts, $content ) {

	/* Attributes */
	extract( shortcode_atts( array(
		'option' => 'option',
	), $atts));
	
	ob_start();

	$nav_content = str_replace( '[slide', '[slide for="nav"', $content);

	?>

	<div class="slider-container-loader"><img src="<?php echo get_template_directory_uri() . '/images/misc/ajax-loader.gif'; ?>"></div>

	<div class="slider-container">

		<div class="slider">

			<div class="flexslider">

				<ul class="slides">

					<?php echo dd_do_shorcode( $content ); ?>

				</ul><!-- .slides -->

			</div><!-- .flexslider -->

		</div><!-- .slider -->

		<div class="slider-nav">

			<div class="flexslider">

				<ul class="slides">

					<?php echo dd_do_shorcode( $nav_content ); ?>
					<li class="slider-nav-fake-slide"></li>

				</ul><!-- .slides -->

			</div><!-- .flexslider -->

			<div class="slider-nav-arrows">

				<a href="#" class="slider-nav-arrow-prev"><span class="icon-chevron-left"></span></a>
				<a href="#" class="slider-nav-arrow-next"><span class="icon-chevron-right"></span></a>

			</div><!-- .products-carousel-nav -->

			<div class="slider-nav-overlay-left"></div>
			<div class="slider-nav-overlay-right"></div>

		</div><!-- .slider-nav -->

	</div><!-- .slider-container -->

	<?php

	$output = ob_get_contents();
	ob_end_clean();

	return dd_do_shorcode( $output );

}

add_shortcode( 'slide', 'dd_slider_slide_sc' );
function dd_slider_slide_sc( $atts, $content ) {

	/* Attributes */
	extract( shortcode_atts( array(
		'for' => '',
		'img' => '',
		'link' => '',
	), $atts));

	if ( $for == 'nav' ) {
		
		$image_id = dd_get_image_id( $img );
		$img_array = wp_get_attachment_image_src( $image_id, 'dd-tiny' );
		$img = $img_array[0];

	}

	if ( $for == 'nav' ) {
		return dd_do_shorcode( '<li><img src="' . $img . '" /></li>' );
	} else {
		return dd_do_shorcode( '<li><a href="' . $img . '" rel="prettyPhoto"><img src="' . $img . '" /></a></li>' );
	}

}