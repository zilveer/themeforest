<?php 
extract( shortcode_atts( array(
	'title' => __( "Section", "mk_framework" ),
	'icon' 	=> '',
), $atts ) );

if(!empty( $icon )) {
	if ((strpos($icon, 'mk-') === FALSE)) {
		$icon = 'mk-'.$icon;
	}
	$icon = Mk_SVG_Icons::get_svg_icon_by_class_name(false, $icon);

	// We need to add <i> to work with vc_accordions.css correctly.
	$icon = '<i>'.$icon.'</i>';
} else {
	$icon = '';
}
Mk_Static_Files::addAssets('vc_accordion_tab');