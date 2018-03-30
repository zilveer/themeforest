<?php $rgb = sc_hexToRGB(get_option(SHORTNAME . '_accent_color')); ?>
<?php
$output = '';

$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'wpb_separator wpb_content_element', $this->settings['base']);
$output .= '<div class="'.$css_class.'" style="border-bottom-color: rgba('. implode(',', $rgb) .', 0.2);"></div>'.$this->endBlockComment('separator')."\n";

echo $output;