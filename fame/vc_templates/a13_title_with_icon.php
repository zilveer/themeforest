<?php
$title = $title_size = $title_align = $el_class = $bold = $text_color = $title_style = $a13_fa_icon = '';

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

//extract(shortcode_atts(array(
//    'title' => __("Title", "fame"),
//    'title_size' => 'h1',
//    'title_align' => 'left',
//    'a13_fa_icon' => '',
//    'icon_color' => '',
//	'href'      => '',
//    'hover_off' => false,
//    'bold' => false,
//    'uppercase' => false,
//    'text_color' => false,
//    'el_class' => ''
//), $atts));
$uppercase = (bool)$uppercase;
$bold = (bool)$bold;
$hover_off = (bool)$hover_off;
$with_hover = !$hover_off;


$css_classes = $this->getExtraClass($el_class);


//bold font
if($bold === true){
    $title_style .= 'font-weight:bold;';
}
else{
    $title_style .= 'font-weight:normal;';
}
//text transform
if($uppercase === true){
    $title_style .= 'text-transform:uppercase;';
}
else{
    $title_style .= 'text-transform:none;';
}
if($text_color !== false && strlen($text_color)){
    $title_style .= 'color:'.$text_color.';';
}

if($a13_fa_icon != ''){
	$a13_fa_icon  = '<i class="title-icon a13-icon-'.$icon_color.' fa fa-'.$a13_fa_icon.'"></i>';
	if(strlen($href)){
		$a13_fa_icon  = '<a href="'.$href.'">'.$a13_fa_icon.'</a>';
	}
}

if(strlen($href) && strlen($title)){
	$title = '<'.$title_size.'><a href="'.$href.'" style="'.$title_style.'">'.$title.'</a></'.$title_size.'>';
}
else{
	$title = '<'.$title_size.' style="'.$title_style.'">'.$title.'</'.$title_size.'>';
}

$output = '<div class="a13_title_with_icon'.($with_hover? ' hover' : '' ).'" style="text-align:'.$title_align.';">'.$a13_fa_icon.$title.'</div>'."\n";

echo $output;
