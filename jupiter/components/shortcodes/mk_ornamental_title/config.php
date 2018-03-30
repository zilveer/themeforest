<?php
/**
 *  Shortcode defaults and user settings
 * ============================================================== */

extract( shortcode_atts( array(
	'tag_name' 				=> 'h2',
	'title_as'  			=> 'text',
	'title_image' 			=> '',
	'text_color' 			=> '',
	'font_family'			=> '',
	'font_size'  			=> 14,
	'font_weight' 			=> 'inherit',
	'font_style' 			=> 'inherit',
	'font_type'				=> '',
	'txt_transform'  		=> 'initial',
	'ornament_style' 		=> 'rovi-single',
	'nss_align'		 		=> 'left',
	'ornament_color' 		=> '',
	'ornament_thickness'	=> 1,
	'margin_top' 			=> 0,
	'margin_bottom' 		=> 20,
	'animation'  			=> '',
	'el_class' 				=> '',
), $atts ) );
Mk_Static_Files::addAssets('mk_ornamental_title');