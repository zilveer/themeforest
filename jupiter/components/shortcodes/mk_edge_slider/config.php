<?php
/**
 *  Shortcode defaults and user settings
 * ============================================================== */

extract( shortcode_atts( array(
	'slides' 			=> '',
	'orderby'			=> 'date',
	'order'				=> 'DESC',
	'full_height' 		=> 'true',
	'height' 			=> 700,
	'swiper_bg' 		=> '#000',
	'first_el' 			=> 'false',
	'parallax' 			=> 'false',
	'animation_effect' 	=> 'slide',
	'animation_speed' 	=> 700,
	'slideshow_speed' 	=> 7000,
	'direction_nav' 	=> 'roundslide',
	'pagination' 		=> 'stroke',
	'skip_arrow' 		=> 'true',
	'el_class' 			=> '',
), $atts ) );
Mk_Static_Files::addAssets('mk_edge_slider');
Mk_Static_Files::addAssets('mk_swipe_slideshow');
Mk_Static_Files::addAssets('mk_page_section');