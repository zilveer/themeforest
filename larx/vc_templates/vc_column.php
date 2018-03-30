<?php
$output = $font_color = $el_class = $width = $offset = '';
extract(shortcode_atts(array(
	'font_color'      => '',
    'el_class' => '',
    'width' => '1/1',
    'css' => '',
	'offset' => '',
    'th_is_fullwith' => 'no'
), $atts));

$el_class = $this->getExtraClass($el_class);
$width = wpb_translateColumnWidthToSpan($width);
$width = vc_column_offset_class_merge($offset, $width);
//$el_class .= ' wpb_column vc_column_container';

$th_bootstrap_col_class = str_replace('vc_col-sm-','',$width);

if($th_is_fullwith == "yes"){
    $el_class .= ' fullwidth';
}elseif($th_is_fullwith == "no"){
    $el_class .= ' col-md-'.$th_bootstrap_col_class.'';
}

$style = $this->buildStyle( $font_color );

//$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $width . $el_class . vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $el_class . vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );

$output .= "\n\t".'<div class="'.$css_class.'"'.$style.'>';
//$output .= "\n\t\t".'<div class="wpb_wrapper">';
$output .= "\n\t\t\t".wpb_js_remove_wpautop($content);
//$output .= "\n\t\t".'</div> '.$this->endBlockComment('.wpb_wrapper');
$output .= "\n\t".'</div> '.$this->endBlockComment($el_class) . "\n";

echo $output;