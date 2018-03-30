<?php
$icon_align = $el_class = $icon_color = $a13_fa_icon = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
//extract(shortcode_atts(array(
//    'icon_align' => 'left',
//    'a13_fa_icon' => '',
//    'icon_color' => '',
//    'href'      => '',
//    'hover_off' => false,
//    'el_class' => ''
//), $atts));
$hover_off = (bool)$hover_off;
$with_hover = !$hover_off;

$css_classes = $this->getExtraClass($el_class);


if($a13_fa_icon != ''){
	$a13_fa_icon  = '<i class="title-icon a13-icon-'.$icon_color.' fa fa-'.$a13_fa_icon.'"></i>';
	if(strlen($href)){
		$a13_fa_icon  = '<a href="'.$href.'">'.$a13_fa_icon.'</a>';
	}
}

$output = '<div class="a13_big_icon'.($with_hover? ' hover' : '' ).'" style="text-align:'.$icon_align.';">'.$a13_fa_icon.'</div>'."\n";

echo $output;
