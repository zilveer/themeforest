<?php

$output = $position = $type = $el_class = $holder_style = $title_style = $font_size = $margin_top = $margin_bottom = $uppercase = '';
$title = $text_color = $a13_fa_icon = $no_text = '';

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

//extract(shortcode_atts(array(
//    'title' => '',
//    'title_align' => '',
//    'el_width' => '',
//    'style' => '',
//    'color' => '',
//    'accent_color' => '',
//    'el_class' => '',
//    'margin_top' => '',
//    'margin_bottom' => '',
//    'font_size' => '',
//    'bold' => false,
//    'uppercase' => false,
//    'no_text' => false,
//    'text_color' => false,
//    'a13_fa_icon' => '',
//), $atts));
$class = "vc_separator wpb_content_element";
$uppercase = (bool)$uppercase;
$bold = (bool)$bold;
$no_text = (bool)$no_text;

//$el_width = "90";
//$style = 'double';
//$title = '';
//$color = 'blue';

$class .= ($title_align!='') ? ' vc_'.$title_align : '';
$class .= ($el_width!='') ? ' vc_el_width_'.$el_width : ' vc_el_width_100';
$class .= ($style!='') ? ' vc_sep_'.$style : '';
$class .= ($color!='') ? ' vc_sep_color_'.$color : '';

$inline_css = ($accent_color!='') ? ' style="'.vc_get_css_color('border-color', $accent_color).'"' : '';

//holder style
if(strlen($margin_bottom) || strlen($margin_top)){
    $holder_style .= ' style="';
    if(strlen($margin_top)){
        $holder_style .= 'margin-top:'.((int)$margin_top).'px;';
    }
    if(strlen($margin_bottom)){
        $holder_style .= 'margin-bottom:'.((int)$margin_bottom).'px;';
    }
    $holder_style .= '"';
}

//title style
$title_style .= ' style="';
if(strlen($font_size)){
    $title_style .= 'font-size:'.((int)$font_size).'px;';
}
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
//color
if($text_color !== false && strlen($text_color)){
    $title_style .= 'color:'.$text_color.';';
}

$title_style .= '"';

if( $a13_fa_icon != '' ){
    $a13_fa_icon = '<i class="fa fa-'.$a13_fa_icon.'"></i>';
    $title = $a13_fa_icon.(strlen($title)? (' '.$title) : '');
}


$class .= $this->getExtraClass($el_class);
$class .= $no_text? '' :  $this->getExtraClass('vc_text_separator');
$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class, $this->settings['base']);

?>
<div class="<?php echo esc_attr(trim($css_class)); ?>"<?php echo $holder_style; ?>>
	<span class="vc_sep_holder vc_sep_holder_l"><span<?php echo $inline_css; ?> class="vc_sep_line"></span></span>
	<?php if($title!=''): ?><h4<?php echo $title_style; ?>><?php echo $title; ?></h4><?php endif; ?>
	<span class="vc_sep_holder vc_sep_holder_r"><span<?php echo $inline_css; ?> class="vc_sep_line"></span></span>
</div>
<?php echo $this->endBlockComment('separator')."\n";