<?php
$output = $el_class = $bg_image = $bg_color = $bg_image_repeat = $font_color = $padding = $margin_bottom = $css = '';
extract(shortcode_atts(array(
'type'			 => 'in_container',   
 'el_class'        => '',
 'el_id'		=> '',		
    'bg_image'        => '',
    'bg_color'        => '',
    'bg_image_repeat' => '',
    'font_color'      => '',
    'padding'         => '',
    'margin_bottom'   => '',
    'css' => ''
), $atts));


wish_enq_vc_row();



$el_class = $this->getExtraClass($el_class);

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, ' '. ( $this->settings('base')==='vc_row_inner' ? 'vc_inner ' : '' ) /*. get_row_css_class() */. $el_class . vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );

$style = wish_buildStyle($bg_image, $bg_color, $bg_image_repeat, $font_color, $padding, $margin_bottom);

$id_string = "";

if($el_id != ""){
    $id_string = 'id="'.$el_id.'"';
}

$output .= '<div '.$id_string.' class="'.$type.' '.$css_class.'"'.$style.'>';
$output .= wpb_js_remove_wpautop($content);
$output .= '</div>'.$this->endBlockComment('row');

echo wish_filter_html($output);