<?php
$output = $title = $interval = $el_class = $tab_style = '';
extract( shortcode_atts( array(
	'title' => '',
	'interval' => 0,
	'tab_style' => '',
	'el_class' => ''
), $atts ) );

wp_deregister_script( 'jquery-ui-tabs' );

$el_class = $this->getExtraClass( $el_class );

$element = 'horizontal';
if ( 'vc_tour' == $this->shortcode ) $element = 'vertical';

// Extract tab titles
preg_match_all( '/vc_tab([^\]]+)/i', $content, $matches, PREG_OFFSET_CAPTURE );
$tab_titles = array();
/**
 * vc_tabs
 *
 */
if ( isset( $matches[1] ) ) {
	$tab_titles = $matches[1];
}
$tabs_nav = '';
$tabs_nav .= '<ul class="tabs">';
foreach ( $tab_titles as $tab ) {
	$tab_atts = shortcode_parse_atts($tab[0]);
	if(isset($tab_atts['icon']) && $tab_atts['icon'] != '' ){
        $icon = '<i class="fa '.$tab_atts['icon'].'"></i>';
    } else {
		$icon = '';
	}
	if(isset($tab_atts['title'])) {
		$tabs_nav .= '<li class="tab"><a href="#tab-' . ( isset( $tab_atts['tab_id'] ) ? $tab_atts['tab_id'] : sanitize_title( $tab_atts['title'] ) ) . '"><h6>'.$icon.$tab_atts['title'] . '</h6></a></li>';
	}
}
$tabs_nav .= '</ul>' . "\n";

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, trim( 'tabset '. $element .' '.$tab_style.' '. $el_class ), $this->settings['base'], $atts );

$output .= '<div class="'.$css_class.'">';
$output .= $tabs_nav;
$output .= wpb_js_remove_wpautop( $content );
$output .= '</div> ' . $this->endBlockComment( $element );

echo $output;