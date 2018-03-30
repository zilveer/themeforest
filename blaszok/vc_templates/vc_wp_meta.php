<?php
$output = $title = $el_class = '';
extract( shortcode_atts( array(
    'title' => '',
    'el_class' => ''
), $atts ) );

$el_class = $this->getExtraClass($el_class);

$output = '<div class="vc_wp_meta wpb_content_element'.$el_class.'">';
$type = 'WP_Widget_Meta';
$args = array(
		'before_title' => '<h5 class="widget-title sidebar-widget-title"><span class="mpcth-color-main-border">',
		'after_title' => '</span></h5>'
	);

ob_start();
the_widget( $type, $atts, $args );
$output .= ob_get_clean();

$output .= '</div>' . $this->endBlockComment('vc_wp_meta') . "\n";

echo $output;