<?php
$output = $style = $margin_top = $margin_bottom = $el_class = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$el_class = $this->getExtraClass($el_class);
$cssclass = '';
if ( ! empty( $el_class ) ) {
	$class= 'divider '. wp_strip_all_tags( $style ) .' '. wp_strip_all_tags( $el_class );
	$cssclass = ' '. $el_class;
} else {
	$class= 'divider '. wp_strip_all_tags ( $style );
}
if( $style == 'divider-icon' ) {
	$output = '<div class="blog-divider'. wp_strip_all_tags( $cssclass ) .'"> <span></span> <i class="icon-home-ico"></i> <span></span></div>';
} else {
	$output = '<div class="'. $class .'"></div>';
}
global $majesty_allowed_tags;
echo wp_kses( $output, $majesty_allowed_tags  );