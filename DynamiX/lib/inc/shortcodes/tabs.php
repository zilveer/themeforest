<?php

/* ------------------------------------
:: jQUERY TABS
------------------------------------*/

function tabs_shortcode( $atts, $content = null, $code ) {
   extract( shortcode_atts( array(
      'id' => '',
	  'class' => '',
), $atts ) );

	wp_enqueue_script('jquery-ui-tabs',false,array('jquery'));
	
	if($code=="tabswrap") {
		return '<div class="nv-tabs clearfix '.esc_attr($class).'">'. do_shortcode($content) .'</div>';
	} elseif($code=="tabhead") { // tab title check if first
	if( esc_attr($id)=="1") {
		return '<ul><li class="'.esc_attr($class).'"><h4 class="tabhead"><a href="#tabs-'. esc_attr($id).'">'. $content .'</a></h4></li>';
	} else {
		return '<li class="'.esc_attr($class).'"><h4 class="tabhead"><a href="#tabs-'. esc_attr($id).'">'. $content .'</a></h4></li>';
	}
	} elseif($code=="tabhead_last") {
		return '<li class="'.esc_attr($class).'"><h4 class="tabhead"><a href="#tabs-'. esc_attr($id).'">'. $content .'</a></h4></li></ul>';
	} elseif($code=="tab") {	
		return '<div class="tab-content '.esc_attr($class).'" id="tabs-'. esc_attr($id).'">'. do_shortcode($content) .'</div>';
	}
}

add_shortcode('tab', 'tabs_shortcode');
add_shortcode('tabswrap', 'tabs_shortcode');
add_shortcode('tabhead', 'tabs_shortcode');
add_shortcode('tabhead_last', 'tabs_shortcode');