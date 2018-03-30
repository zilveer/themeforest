<?php
$output = $title = $el_class = $color = $icon = '';
extract( shortcode_atts( array(
	'title' => esc_html__( 'Meta', 'homeshop' ),
	'icon' => '',
	'color' => 'default',
	'el_class' => ''
), $atts ) );

$el_class = $this->getExtraClass( $el_class );

$output = '<div class="vc_wp_meta wpb_content_element' . $el_class . '">';



$type = 'WP_Widget_Meta1';
$args = array();

$mad_widget_args = array(
	'before_widget' => '<div id="%1$s" class="section widget %2$s appear-animation fadeInDown appear-animation-visible" data-appear-animation="fadeInDown" data-appear-animation-delay="1150" >',
	'after_widget' => '</div>',
	'before_title' => '<div class="widget-head"><h3 class="section_title">',
	'after_title' => '</h3></div>'
);



ob_start();
the_widget( $type, $atts, $mad_widget_args );
$output .= ob_get_clean();

$output .= '</div>' . $this->endBlockComment( 'vc_wp_meta' ) . "\n";

echo $output;