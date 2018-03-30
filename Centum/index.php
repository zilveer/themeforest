<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Centum
 */

get_header(); 

if(is_front_page()) {

	$slider_on  = ot_get_option( 'slider_on' );
	$slider_type =  ot_get_option( 'incr_slider_home' );

	if ($slider_type == "royal") {
		$slides = ot_get_option( 'mainslider', array() );
		if ( $slider_on == 'yes' && !empty( $slides )) {
			get_template_part('slider');
		}
	}

	if ($slider_type == "revolution") {
		if ( $slider_on == 'yes') {
			$layout = get_theme_mod( 'centum_layout_style', 'boxed' );
			if($layout == "wide") {
				echo '<section class="slider">'; putRevSlider(ot_get_option( 'incr_revo_slider' )); echo "</section>";
			} else {
				echo '<div class="container"><div class="sixteen columns"><section class="slider">'; putRevSlider(ot_get_option( 'incr_revo_slider' )); echo "</section></div></div>";
			}
		}
	}
}


get_template_part('loop');

get_sidebar();

get_footer();

?>