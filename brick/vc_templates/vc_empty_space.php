<?php
if(version_compare(qode_get_vc_version(), '4.6.2') >= 0) {
    $height = $el_class = $background_image = $image_repeat = '';
    $atts = vc_map_get_attributes($this->getShortcode(), $atts);
    extract($atts);
} else {
    extract( shortcode_atts( array(
        'height' => WPBMap::getParam( 'vc_empty_space', 'height' ),
        'el_class' => '',
        'background_image' => '',
        'image_repeat' => ''
    ), $atts ) );
}
$class = "vc_empty_space";

$height = esc_attr($height);
$background_image = esc_attr($background_image);
$el_class = esc_attr($el_class);

$html = '';
$pattern = '/^(\d*(?:\.\d+)?)\s*(px|\%|in|cm|mm|em|rem|ex|pt|pc|vw|vh|vmin|vmax)?$/';
// allowed metrics: http://www.w3schools.com/cssref/css_units.asp
$regexr = preg_match($pattern,$height,$matches);
$value = isset( $matches[1] ) ? (float) $matches[1] : (float) WPBMap::getParam('vc_empty_space','height');
$unit = isset( $matches[2] ) ? $matches[2] : 'px';
$height = $value . $unit;

$inline_css = ( (float) $height >= 0.0 ) ? ' style="height: '.$height.'"' : '';

if(version_compare(qode_get_vc_version(), '4.7.4') >= 0) {
    $class = 'vc_empty_space ' . $this->getExtraClass( $el_class ). vc_shortcode_custom_css_class( $css, ' ' );
} else {
    $class .= $this->getExtraClass( $el_class );
}
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class, $this->settings['base'], $atts );

?>
    <div class="<?php echo esc_attr(trim($css_class)); ?>" <?php print $inline_css;


    ?> ><span class="vc_empty_space_inner"><div class="empty_space_image"
                <?php

                if($background_image != ""){
                    if (is_numeric($background_image)) {
                        $image_src = wp_get_attachment_url($background_image);
                    }
                    $html .= 'style="background-image:url('.$image_src.');';
                    if ($image_repeat != ""){
                        $html .= 'background-repeat:'.$image_repeat.';"';
                    }
                }
                print $html;
                ?> ></div>
</span></div>
<?php print $this->endBlockComment('empty_space')."\n";