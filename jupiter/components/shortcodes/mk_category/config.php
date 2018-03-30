<?php
/**
 *  Shortcode defaults and user settings
 * ============================================================== */

extract( shortcode_atts( array(
	'feed' 					=> 'post',
	'specific_categories_other' => '',
	'specific_categories_post' => '',
	'image_size'			=> 'crop',
	'hide_last_row'			=> 'false',
	'description'			=> 'false',
	'el_class' 				=> '',
	'columns' 				=> '4',
	'layout_style' 			=> 'grid',
	'row_height' 			=> '300',
	'gutter' 				=> '0',
	'text_color' 			=> '#fff',
	'title_hover' 			=> 'none',
	'image_hover' 			=> 'none',
	'overlay_color' 		=> '',
), $atts ) );

Mk_Static_Files::addAssets('mk_category');